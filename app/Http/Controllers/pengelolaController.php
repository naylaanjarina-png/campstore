<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Http\Request;

class PengelolaController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengelola::query();

        if ($request->filled('search')) {
            $query->where('nama_pengelola', 'like', '%' . $request->search . '%');
        }

        $pengelola = $query->latest()->paginate(10)->appends($request->only('search'));

        return view('pengelola.index', compact('pengelola'));
    }

    public function create()
    {
        return view('pengelola.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengelola' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'bagian' => 'required|in:anggota,gudang,kasir,admin',
        ]);

        Pengelola::create($validated);

        return redirect()->route('pengelola.index')->with('success', 'Pengelola berhasil ditambahkan.');
    }

    public function show(Pengelola $pengelola)
    {
        return view('pengelola.show', compact('pengelola'));
    }

    public function edit(Pengelola $pengelola)
    {
        return view('pengelola.edit', compact('pengelola'));
    }

    public function update(Request $request, Pengelola $pengelola)
    {
        $validated = $request->validate([
            'nama_pengelola' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'bagian' => 'required|in:anggota,gudang,kasir,admin',
        ]);

        $pengelola->update($validated);

        return redirect()->route('pengelola.index')->with('success', 'Pengelola berhasil diperbarui.');
    }

    public function destroy(Pengelola $pengelola)
    {
        $pengelola->delete();

        return redirect()->route('pengelola.index')->with('success', 'Pengelola berhasil dihapus.');
    }
}
