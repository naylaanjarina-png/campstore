<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Alat <span class="text-danger">*</span></label>
        <input type="text" name="nama_alat" class="form-control" value="{{ old('nama_alat', $alat->nama_alat ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach(['Tas Carrier','Tenda','Sleeping Bag','Matras','Kompor','Nesting','Jaket','Sepatu','Trekking Pole','Lainnya'] as $k)
                <option value="{{ $k }}" @selected(old('kategori', $alat->kategori ?? '') == $k)>{{ $k }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
        <input type="number" min="0" name="jumlah" class="form-control" value="{{ old('jumlah', $alat->jumlah ?? 1) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Kondisi <span class="text-danger">*</span></label>
        <select name="kondisi" class="form-select" required>
            @foreach(['baik'=>'Baik','rusak_ringan'=>'Rusak Ringan','rusak_berat'=>'Rusak Berat','hilang'=>'Hilang'] as $val => $label)
                <option value="{{ $val }}" @selected(old('kondisi', $alat->kondisi ?? 'baik') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select" required>
            @foreach(['tersedia'=>'Tersedia','dipinjam'=>'Dipinjam','perbaikan'=>'Perbaikan','nonaktif'=>'Nonaktif'] as $val => $label)
                <option value="{{ $val }}" @selected(old('status', $alat->status ?? 'tersedia') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Harga Sewa</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" name="harga_sewa" class="form-control" value="{{ old('harga_sewa', $alat->harga_sewa ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Peminjaman</label>
        <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ old('tanggal_peminjaman', isset($alat->tanggal_peminjaman) ? \Carbon\Carbon::parse($alat->tanggal_peminjaman)->format('Y-m-d') : '') }}">
        <small class="text-muted">Diisi otomatis saat alat sedang dipinjam</small>
    </div>

    <div class="col-md-6">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="2">{{ old('deskripsi', $alat->deskripsi ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        @if(!empty($alat->foto))
            <div class="mt-2">
                <small class="text-muted d-block mb-1">Foto saat ini:</small>
                <img src="{{ str_starts_with($alat->foto, 'data:image') ? $alat->foto : asset('gambar/'.$alat->foto) }}" class="rounded border" width="60" height="60" style="object-fit:cover;">
            </div>
        @endif
    </div>

    <div class="col-12">
        <label class="form-label">Catatan</label>
        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $alat->catatan ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
