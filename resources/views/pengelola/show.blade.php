@extends('layouts.app')

@section('title', 'Detail Pengelola')

@section('content')
<h4 class="mb-3">Detail Pengelola</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="220">Nama Pengelola</th><td>: {{ $pengelola->nama_pengelola }}</td></tr>
            <tr><th>No. HP</th><td>: {{ $pengelola->no_hp }}</td></tr>
            <tr><th>Email</th><td>: {{ $pengelola->email ?? '-' }}</td></tr>
            <tr><th>Bagian</th><td>: {{ ucwords($pengelola->bagian) }}</td></tr>
            <tr><th>Alamat</th><td>: {{ $pengelola->alamat ?? '-' }}</td></tr>
        </table>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('pengelola.edit', $pengelola->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('pengelola.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
