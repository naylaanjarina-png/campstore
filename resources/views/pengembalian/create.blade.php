@extends('layouts.app')

@section('title', 'Catat Pengembalian')

@section('content')
<h4 class="mb-3">Catat Pengembalian Alat</h4>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf
            @include('pengembalian.form')
        </form>
    </div>
</div>
@endsection
