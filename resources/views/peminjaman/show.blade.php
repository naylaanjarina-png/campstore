@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h4 class="mb-3">Detail Peminjaman</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="220">Kode Peminjaman</th><td>: {{ $peminjaman->kode_peminjaman }}</td></tr>
            <tr><th>Alat</th><td>: {{ $peminjaman->alat->nama_alat ?? '-' }}</td></tr>
            <tr><th>Jumlah</th><td>: {{ $peminjaman->jumlah }}</td></tr>
            <tr><th>Tanggal Pinjam</th><td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td></tr>
            <tr><th>Tanggal Kembali</th><td>: {{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') : '-' }}</td></tr>
            <tr><th>Status</th><td>: {{ ucwords(str_replace('_',' ',$peminjaman->status)) }}</td></tr>
            <tr><th>Disetujui Oleh</th><td>: {{ $peminjaman->disetujuiOleh->nama_pengelola ?? '-' }}</td></tr>
            <tr><th>Denda</th><td>: {{ $peminjaman->denda > 0 ? 'Rp '.number_format($peminjaman->denda,0,',','.') : '-' }}</td></tr>
            <tr><th>Keterangan</th><td>: {{ $peminjaman->keterangan ?? '-' }}</td></tr>
        </table>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
