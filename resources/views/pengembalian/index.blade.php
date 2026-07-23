@extends('layouts.app')

@section('title', 'Data Pengembalian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Data Pengembalian</h4>
        <small class="text-muted">Riwayat pengembalian alat hiking</small>
    </div>
    <a href="{{ route('pengembalian.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Catat Pengembalian
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Kode Peminjaman</th>
                        <th>Diterima Oleh</th>
                        <th>Tgl Kembali</th>
                        <th>Kondisi</th>
                        <th>Terlambat</th>
                        <th>Total Denda</th>
                        <th>Status Denda</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalian ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_pengembalian }}</td>
                        <td>{{ $item->peminjaman->kode_peminjaman ?? '-' }}</td>
                        <td>{{ $item->diterimaOleh->nama_pengelola ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->kondisi_alat == 'baik' ? 'success' : ($item->kondisi_alat == 'hilang' ? 'dark' : 'warning') }} badge-status">
                                {{ ucwords(str_replace('_',' ',$item->kondisi_alat)) }}
                            </span>
                        </td>
                        <td>
                            @if($item->terlambat)
                                <span class="badge bg-danger badge-status">Ya</span>
                            @else
                                <span class="badge bg-success badge-status">Tidak</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($item->total_denda,0,',','.') }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status_denda == 'lunas' ? 'success' : ($item->status_denda == 'belum_dibayar' ? 'danger' : 'secondary') }} badge-status">
                                {{ ucwords(str_replace('_',' ',$item->status_denda)) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pengembalian.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('pengembalian.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('pengembalian.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center text-muted py-4">Belum ada data pengembalian.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $pengembalian->links() ?? '' }}</div>
    </div>
</div>
@endsection
