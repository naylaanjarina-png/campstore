<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Pengembalian <span class="text-danger">*</span></label>
        <input type="text" name="kode_pengembalian" class="form-control" value="{{ old('kode_pengembalian', $pengembalian->kode_pengembalian ?? 'PGB-'.date('Y').'-'.str_pad(rand(1,9999),4,'0',STR_PAD_LEFT)) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Peminjaman <span class="text-danger">*</span></label>
        <select name="peminjaman_id" class="form-select" required>
            <option value="">-- Pilih Peminjaman --</option>
            @foreach($daftarPeminjaman ?? [] as $p)
                <option value="{{ $p->id }}" @selected(old('peminjaman_id', $pengembalian->peminjaman_id ?? '') == $p->id)>
                    {{ $p->kode_peminjaman }} - {{ $p->alat->nama_alat ?? '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Diterima Oleh</label>
        <select name="diterima_oleh" class="form-select">
            <option value="">-- Pilih Pengelola --</option>
            @foreach($daftarPengelola ?? [] as $p)
                <option value="{{ $p->id }}" @selected(old('diterima_oleh', $pengembalian->diterima_oleh ?? '') == $p->id)>{{ $p->nama_pengelola }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali', isset($pengembalian->tanggal_kembali) ? \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('Y-m-d') : date('Y-m-d')) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Jumlah Dikembalikan <span class="text-danger">*</span></label>
        <input type="number" min="1" name="jumlah_dikembalikan" class="form-control" value="{{ old('jumlah_dikembalikan', $pengembalian->jumlah_dikembalikan ?? 1) }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kondisi Alat <span class="text-danger">*</span></label>
        <select name="kondisi_alat" class="form-select" required>
            @foreach(['baik'=>'Baik','rusak_ringan'=>'Rusak Ringan','rusak_berat'=>'Rusak Berat','hilang'=>'Hilang'] as $val => $label)
                <option value="{{ $val }}" @selected(old('kondisi_alat', $pengembalian->kondisi_alat ?? 'baik') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label d-block">Terlambat?</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="terlambat" value="1" id="terlambatCheck" @checked(old('terlambat', $pengembalian->terlambat ?? false))>
            <label class="form-check-label" for="terlambatCheck">Ya, terlambat</label>
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status Denda</label>
        <select name="status_denda" class="form-select">
            @foreach(['tidak_ada'=>'Tidak Ada','belum_dibayar'=>'Belum Dibayar','lunas'=>'Lunas'] as $val => $label)
                <option value="{{ $val }}" @selected(old('status_denda', $pengembalian->status_denda ?? 'tidak_ada') == $val)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Denda Terlambat</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" name="denda_terlambat" class="form-control" value="{{ old('denda_terlambat', $pengembalian->denda_terlambat ?? 0) }}">
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">Denda Kerusakan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" name="denda_kerusakan" class="form-control" value="{{ old('denda_kerusakan', $pengembalian->denda_kerusakan ?? 0) }}">
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">Total Denda</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" min="0" name="total_denda" class="form-control" value="{{ old('total_denda', $pengembalian->total_denda ?? 0) }}">
        </div>
    </div>

    <div class="col-12">
        <label class="form-label">Catatan</label>
        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $pengembalian->catatan ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const terlambatInput = document.querySelector('[name="denda_terlambat"]');
        const kerusakanInput = document.querySelector('[name="denda_kerusakan"]');
        const totalInput = document.querySelector('[name="total_denda"]');

        function hitungTotal() {
            const t = parseInt(terlambatInput.value) || 0;
            const k = parseInt(kerusakanInput.value) || 0;
            totalInput.value = t + k;
        }
        terlambatInput.addEventListener('input', hitungTotal);
        kerusakanInput.addEventListener('input', hitungTotal);
    });
</script>
@endsection
