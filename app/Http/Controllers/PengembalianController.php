<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengelola;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengembalian::with(['peminjaman', 'diterimaOleh']);

        if ($request->filled('search')) {
            $query->where('kode_pengembalian', 'like', '%' . $request->search . '%');
        }

        $pengembalian = $query->latest()->paginate(10);

        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $daftarPeminjaman = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])
            ->with('alat')
            ->get();
        $daftarPengelola = Pengelola::all();

        return view('pengembalian.create', compact('daftarPeminjaman', 'daftarPengelola'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pengembalian' => 'required|string|max:255|unique:pengembalian,kode_pengembalian',
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'diterima_oleh' => 'nullable|exists:pengelola,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'kondisi_alat' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'terlambat' => 'nullable|boolean',
            'denda_terlambat' => 'nullable|numeric|min:0',
            'denda_kerusakan' => 'nullable|numeric|min:0',
            'total_denda' => 'nullable|numeric|min:0',
            'status_denda' => 'nullable|in:tidak_ada,belum_dibayar,lunas',
            'catatan' => 'nullable|string',
        ]);

        $validated['terlambat'] = $request->boolean('terlambat');
        $validated['denda_terlambat'] = $validated['denda_terlambat'] ?? 0;
        $validated['denda_kerusakan'] = $validated['denda_kerusakan'] ?? 0;
        $validated['total_denda'] = $validated['denda_terlambat'] + $validated['denda_kerusakan'];

        $pengembalian = Pengembalian::create($validated);

        // Update peminjaman & stok alat terkait
        $peminjaman = Peminjaman::with('alat')->find($validated['peminjaman_id']);
        if ($peminjaman) {
            $statusPeminjaman = 'dikembalikan';
            if ($validated['kondisi_alat'] === 'hilang') {
                $statusPeminjaman = 'hilang';
            } elseif (in_array($validated['kondisi_alat'], ['rusak_ringan', 'rusak_berat'])) {
                $statusPeminjaman = 'rusak';
            } elseif ($validated['terlambat']) {
                $statusPeminjaman = 'terlambat';
            }

            $peminjaman->update([
                'status' => $statusPeminjaman,
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'denda' => $validated['total_denda'],
            ]);

            if ($peminjaman->alat) {
                // Kembalikan stok jika alat tidak hilang
                if ($validated['kondisi_alat'] !== 'hilang') {
                    $peminjaman->alat->increment('jumlah', $validated['jumlah_dikembalikan']);
                }
                $peminjaman->alat->update([
                    'status' => 'tersedia',
                    'kondisi' => $validated['kondisi_alat'],
                ]);
            }
        }

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dicatat.');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.alat', 'diterimaOleh']);

        return view('pengembalian.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        $daftarPeminjaman = Peminjaman::with('alat')->get();
        $daftarPengelola = Pengelola::all();

        return view('pengembalian.edit', compact('pengembalian', 'daftarPeminjaman', 'daftarPengelola'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'kode_pengembalian' => 'required|string|max:255|unique:pengembalian,kode_pengembalian,' . $pengembalian->id,
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'diterima_oleh' => 'nullable|exists:pengelola,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_dikembalikan' => 'required|integer|min:1',
            'kondisi_alat' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'terlambat' => 'nullable|boolean',
            'denda_terlambat' => 'nullable|numeric|min:0',
            'denda_kerusakan' => 'nullable|numeric|min:0',
            'total_denda' => 'nullable|numeric|min:0',
            'status_denda' => 'nullable|in:tidak_ada,belum_dibayar,lunas',
            'catatan' => 'nullable|string',
        ]);

        $validated['terlambat'] = $request->boolean('terlambat');
        $validated['denda_terlambat'] = $validated['denda_terlambat'] ?? 0;
        $validated['denda_kerusakan'] = $validated['denda_kerusakan'] ?? 0;
        $validated['total_denda'] = $validated['denda_terlambat'] + $validated['denda_kerusakan'];

        $pengembalian->update($validated);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil diperbarui.');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dihapus.');
    }
}
