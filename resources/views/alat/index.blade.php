@extends('layouts.app')

@section('title', 'Data Alat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Data Alat</h4>
        <small class="text-muted">Daftar peralatan hiking</small>
    </div>
    <a href="{{ route('alat.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Tambah Alat
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama alat...">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" @selected(request('status')=='tersedia')>Tersedia</option>
                    <option value="dipinjam" @selected(request('status')=='dipinjam')>Dipinjam</option>
                    <option value="perbaikan" @selected(request('status')=='perbaikan')>Perbaikan</option>
                    <option value="nonaktif" @selected(request('status')=='nonaktif')>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Harga Sewa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alat ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if(!empty($item->foto))
                                <img src="{{ asset('gambar/'.$item->foto) }}" class="rounded" width="45" height="45" style="object-fit:cover;">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width:45px;height:45px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->nama_alat }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <span class="badge bg-{{ $item->kondisi == 'baik' ? 'success' : ($item->kondisi == 'hilang' ? 'dark' : 'warning') }} badge-status">
                                {{ ucwords(str_replace('_',' ', $item->kondisi)) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'primary' : 'secondary') }} badge-status">
                                {{ ucwords($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->harga_sewa ? 'Rp '.number_format($item->harga_sewa,0,',','.') : '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('alat.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus alat ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data alat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $alat->links() ?? '' }}</div>
    </div>
</div>
@endsection
