<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampStore') | CampStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #1e2a3a; }
        .sidebar .nav-link { color: #c9d2dc; padding: .65rem 1rem; border-radius: .375rem; margin-bottom: .15rem; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background-color: #2f8f4e; color: #fff; }
        .sidebar .brand { color: #fff; font-weight: 700; letter-spacing: .5px; }
        .table thead th { background-color: #eef1f4; font-size: .85rem; text-transform: uppercase; letter-spacing: .03em; }
        .badge-status { font-size: .75rem; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-3" style="width: 250px;">
        <div class="brand fs-4 mb-4 px-2 d-block text-decoration-none"><i class="bi bi-tree-fill me-1"></i> CampStore</div>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{{ route('alat.index') }}" class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}">
                    <i class="bi bi-backpack2 me-2"></i> Alat
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-box-arrow-right me-2"></i> Peminjaman
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pengembalian.index') }}" class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-box-arrow-in-left me-2"></i> Pengembalian
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pengelola.index') }}" class="nav-link {{ request()->routeIs('pengelola.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge me-2"></i> Pengelola
                </a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1">
        <nav class="navbar navbar-light bg-white shadow-sm px-4">
    <span class="navbar-brand mb-0 h5">@yield('title', 'Dashboard')</span>
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-success">
            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
        </a>
        <span class="text-muted small">{{ now()->translatedFormat('l, d F Y') }}</span>
        </nav>

        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-x-circle me-1"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
