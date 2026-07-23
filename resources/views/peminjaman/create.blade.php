@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<h4 class="mb-3">Ajukan Peminjaman Alat</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            @include('peminjaman.form')
        </form>
    </div>
</div>
@endsection
