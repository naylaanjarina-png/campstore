@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<h4 class="mb-3">Tambah Alat Baru</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('alat.form')
        </form>
    </div>
</div>
@endsection
