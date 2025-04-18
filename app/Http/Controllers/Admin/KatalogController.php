<?php

namespace App\Http\Controllers;

use App\Models\Katalog; // <-- ini WAJIB ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index()
    {
        return view('Admin.katalog.index');
    }

    public function create()
    {
        return view('Admin.katalog.create');
    }

    public function store(Request $request)
    {
        // Simpan produk (simulasi dulu)
        return redirect()->route('admin.katalog.index');
    }

    public function edit($id)
    {
        return view('Admin.katalog.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Update produk (simulasi dulu)
        return redirect()->route('admin.katalog.index');
    }
}