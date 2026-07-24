<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengelola;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['alat', 'disetujuiOleh']);

        if ($request->filled('search')) {
            $query->where('kode_peminjaman', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->latest()->paginate(10)->appends($request->except('page'));

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $daftarAlat = Alat::where('status', 'tersedia')->get();
        $daftarPengelola = Pengelola::all();

        return view('peminjaman.create', compact('daftarAlat', 'daftarPengelola'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_peminjaman' => 'required|string|max:255|unique:peminjaman,kode_peminjaman',
            'alat_id' => 'required|exists:alat,id',
            'disetujui_oleh' => 'nullable|exists:pengelola,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:menunggu_konfirmasi,disetujui,ditolak,dipinjam,dikembalikan,terlambat,hilang,rusak',
            'denda' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $alat = Alat::findOrFail($validated['alat_id']);
        if ($validated['jumlah'] > $alat->jumlah) {
            return back()->withInput()->withErrors(['jumlah' => 'Jumlah pinjam melebihi stok alat yang tersedia (' . $alat->jumlah . ').']);
        }

        Peminjaman::create($validated);

        // Jika status langsung dipinjam, kurangi stok & update status alat
        if ($validated['status'] === 'dipinjam') {
            $alat->decrement('jumlah', $validated['jumlah']);
            if ($alat->jumlah <= 0) {
                $alat->update(['status' => 'dipinjam']);
            }
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['alat', 'disetujuiOleh']);

        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $daftarAlat = Alat::all();
        $daftarPengelola = Pengelola::all();

        return view('peminjaman.edit', compact('peminjaman', 'daftarAlat', 'daftarPengelola'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'kode_peminjaman' => 'required|string|max:255|unique:peminjaman,kode_peminjaman,' . $peminjaman->id,
            'alat_id' => 'required|exists:alat,id',
            'disetujui_oleh' => 'nullable|exists:pengelola,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:menunggu_konfirmasi,disetujui,ditolak,dipinjam,dikembalikan,terlambat,hilang,rusak',
            'denda' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
