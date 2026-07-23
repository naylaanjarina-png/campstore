@extends('layouts.app')

@section('title', 'Data Pengelola')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Data Pengelola</h4>
        <small class="text-muted">Petugas pengelola alat hiking</small>
    </div>
    <a href="{{ route('pengelola.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pengelola
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Bagian</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengelola ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_pengelola }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>
                            @php
                                $warnaBagian = match($item->bagian) {
                                    'admin' => 'dark',
                                    'kasir' => 'success',
                                    'gudang' => 'primary',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $warnaBagian }} badge-status">{{ ucwords($item->bagian) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pengelola.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('pengelola.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('pengelola.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pengelola.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $pengelola->links() ?? '' }}</div>
    </div>
</div>
@endsection
