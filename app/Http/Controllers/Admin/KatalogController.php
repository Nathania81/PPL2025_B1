<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog; // <-- ini WAJIB ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index()
    {
        $katalog = Katalog::where('stok', '>', 0)->get();
        return view('Admin.katalog.index', compact('katalog'));
    }

    public function create()
    {
        return view('Admin.katalog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('katalog', 'public');
        }

        Katalog::create($validated);

        return redirect()->route('admin.katalog.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $katalog = Katalog::findOrFail($id);
        return view('Admin.katalog.edit', compact('katalog'));
    }

    public function update(Request $request, $id)
    {
        $katalog = Katalog::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($katalog->foto) {
                Storage::disk('public')->delete($katalog->foto);
            }
            $validated['foto'] = $request->file('foto')->store('katalog', 'public');
        }

        $katalog->update($validated);

        return redirect()->route('admin.katalog.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);
        $katalog->delete(); // Soft delete
        return response()->json(['success' => true]);
    }

    public function detail($id)
    {
        $katalog = Katalog::findOrFail($id);
        return response()->json($katalog);
    }
}