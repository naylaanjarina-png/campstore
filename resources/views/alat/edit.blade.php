@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<h4 class="mb-3">Edit Alat: {{ $alat->nama_alat }}</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('alat.form')
        </form>
    </div>
</div>
@endsection
