@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<h4 class="mb-3">Detail Alat</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="220">Nama Alat</th>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if(!empty($alat->foto))
                                    <img src="{{ asset('gambar/'.$alat->foto) }}" class="rounded" width="100" height="100" style="object-fit:cover;">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width:100px;height:100px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <span>{{ $alat->nama_alat }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr><th>Kategori</th><td>: {{ $alat->kategori }}</td></tr>
                    <tr><th>Jumlah</th><td>: {{ $alat->jumlah }}</td></tr>
                    <tr><th>Kondisi</th><td>: {{ ucwords(str_replace('_',' ',$alat->kondisi)) }}</td></tr>
                    <tr><th>Status</th><td>: {{ ucwords($alat->status) }}</td></tr>
                    <tr><th>Harga Sewa</th><td>: {{ $alat->harga_sewa ? 'Rp '.number_format($alat->harga_sewa,0,',','.') : '-' }}</td></tr>
                    <tr><th>Tanggal Peminjaman</th><td>: {{ $alat->tanggal_peminjaman ?? '-' }}</td></tr>
                    <tr><th>Deskripsi</th><td>: {{ $alat->deskripsi ?? '-' }}</td></tr>
                    <tr><th>Catatan</th><td>: {{ $alat->catatan ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('alat.edit', $alat->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
