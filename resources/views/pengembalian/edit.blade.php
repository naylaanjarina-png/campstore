@extends('layouts.app')

@section('title', 'Edit Pengembalian')

@section('content')
<h4 class="mb-3">Edit Pengembalian: {{ $pengembalian->kode_pengembalian }}</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('pengembalian.form')
        </form>
    </div>
</div>
@endsection
