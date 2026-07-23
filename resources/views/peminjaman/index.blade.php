@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Data Peminjaman</h4>
        <small class="text-muted">Transaksi peminjaman alat hiking</small>
    </div>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Ajukan Peminjaman
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kode peminjaman...">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach(['menunggu_konfirmasi','disetujui','ditolak','dipinjam','dikembalikan','terlambat','hilang','rusak'] as $s)
                        <option value="{{ $s }}" @selected(request('status')==$s)>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                    @endforeach
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
                        <th>Kode</th>
                        <th>Alat</th>
                        <th>Jml</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Disetujui Oleh</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman ?? [] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_peminjaman }}</td>
                        <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}</td>
                        <td>{{ $item->disetujuiOleh->nama_pengelola ?? '-' }}</td>
                        <td>
                            @php
                                $warna = match($item->status) {
                                    'disetujui', 'dikembalikan' => 'success',
                                    'menunggu_konfirmasi' => 'warning',
                                    'ditolak', 'hilang', 'rusak' => 'danger',
                                    'dipinjam' => 'primary',
                                    'terlambat' => 'dark',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $warna }} badge-status">{{ ucwords(str_replace('_',' ',$item->status)) }}</span>
                        </td>
                        <td>{{ $item->denda > 0 ? 'Rp '.number_format($item->denda,0,',','.') : '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('peminjaman.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $peminjaman->links() ?? '' }}</div>
    </div>
</div>
@endsection
