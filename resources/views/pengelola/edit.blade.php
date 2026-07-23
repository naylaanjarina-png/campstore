@extends('layouts.app')

@section('title', 'Edit Pengelola')

@section('content')
<h4 class="mb-3">Edit Pengelola: {{ $pengelola->nama_pengelola }}</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengelola.update', $pengelola->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('pengelola.form')
        </form>
    </div>
</div>
@endsection
