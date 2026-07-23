@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<h4 class="mb-3">Edit Peminjaman: {{ $peminjaman->kode_peminjaman }}</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('peminjaman.form')
        </form>
    </div>
</div>
@endsection
