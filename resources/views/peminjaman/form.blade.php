<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Peminjaman <span class="text-danger">*</span></label>
        <input type="text" name="kode_peminjaman" class="form-control" value="{{ old('kode_peminjaman', $peminjaman->kode_peminjaman ?? 'PJM-'.date('Y').'-'.str_pad(rand(1,9999),4,'0',STR_PAD_LEFT)) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Alat <span class="text-danger">*</span></label>
        <select name="alat_id" class="form-select" required>
            <option value="">-- Pilih Alat --</option>
            @foreach($daftarAlat ?? [] as $a)
                <option value="{{ $a->id }}" @selected(old('alat_id', $peminjaman->alat_id ?? '') == $a->id)>
                    {{ $a->nama_alat }} (Stok: {{ $a->jumlah }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
        <input type="number" min="1" name="jumlah" class="form-control" value="{{ old('jumlah', $peminjaman->jumlah ?? 1) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam', isset($peminjaman->tanggal_pinjam) ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali', isset($peminjaman->tanggal_kembali) ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select" required>
            @foreach(['menunggu_konfirmasi'=>'Menunggu Konfirmasi','disetujui'=>'Disetujui','ditolak'=>'Ditolak','dipinjam'=>'Dipinjam','dikembalikan'=>'Dikembalikan','terlambat'=>'Terlambat','hilang'=>'Hilang','rusak'=>'Rusak'] as $val => $label)
                <option value="{{ $val }}" @selected(old('status', $peminjaman->status ?? 'menunggu_konfirmasi') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Disetujui Oleh</label>
        <select name="disetujui_oleh" class="form-select">
            <option value="">-- Belum Ditentukan --</option>
            @foreach($daftarPengelola ?? [] as $p)
                <option value="{{ $p->id }}" @selected(old('disetujui_oleh', $peminjaman->disetujui_oleh ?? '') == $p->id)>{{ $p->nama_pengelola }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Denda</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" name="denda" class="form-control" value="{{ old('denda', $peminjaman->denda ?? 0) }}">
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $peminjaman->keterangan ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
