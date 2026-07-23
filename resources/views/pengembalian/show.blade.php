@extends('layouts.app')

@section('title', 'Detail Pengembalian')

@section('content')
<h4 class="mb-3">Detail Pengembalian</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="220">Kode Pengembalian</th><td>: {{ $pengembalian->kode_pengembalian }}</td></tr>
            <tr><th>Kode Peminjaman</th><td>: {{ $pengembalian->peminjaman->kode_peminjaman ?? '-' }}</td></tr>
            <tr><th>Diterima Oleh</th><td>: {{ $pengembalian->diterimaOleh->nama_pengelola ?? '-' }}</td></tr>
            <tr><th>Tanggal Kembali</th><td>: {{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</td></tr>
            <tr><th>Jumlah Dikembalikan</th><td>: {{ $pengembalian->jumlah_dikembalikan }}</td></tr>
            <tr><th>Kondisi Alat</th><td>: {{ ucwords(str_replace('_',' ',$pengembalian->kondisi_alat)) }}</td></tr>
            <tr><th>Terlambat</th><td>: {{ $pengembalian->terlambat ? 'Ya' : 'Tidak' }}</td></tr>
            <tr><th>Denda Terlambat</th><td>: Rp {{ number_format($pengembalian->denda_terlambat,0,',','.') }}</td></tr>
            <tr><th>Denda Kerusakan</th><td>: Rp {{ number_format($pengembalian->denda_kerusakan,0,',','.') }}</td></tr>
            <tr><th>Total Denda</th><td>: <strong>Rp {{ number_format($pengembalian->total_denda,0,',','.') }}</strong></td></tr>
            <tr><th>Status Denda</th><td>: {{ ucwords(str_replace('_',' ',$pengembalian->status_denda)) }}</td></tr>
            <tr><th>Catatan</th><td>: {{ $pengembalian->catatan ?? '-' }}</td></tr>
        </table>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('pengembalian.edit', $pengembalian->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
