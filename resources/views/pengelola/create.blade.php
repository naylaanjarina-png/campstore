@extends('layouts.app')

@section('title', 'Tambah Pengelola')

@section('content')
<h4 class="mb-3">Tambah Pengelola Baru</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengelola.store') }}" method="POST">
            @csrf
            @include('pengelola.form')
        </form>
    </div>
</div>
@endsection
