<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Pengelola <span class="text-danger">*</span></label>
        <input type="text" name="nama_pengelola" class="form-control" value="{{ old('nama_pengelola', $pengelola->nama_pengelola ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Bagian <span class="text-danger">*</span></label>
        <select name="bagian" class="form-select" required>
            @foreach(['anggota'=>'Anggota','gudang'=>'Gudang','kasir'=>'Kasir','admin'=>'Admin'] as $val => $label)
                <option value="{{ $val }}" @selected(old('bagian', $pengelola->bagian ?? 'anggota') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">No. HP <span class="text-danger">*</span></label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pengelola->no_hp ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $pengelola->email ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $pengelola->alamat ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('pengelola.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
