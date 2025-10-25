<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function index()
    {
        $barang = Barang::orderBy('kategori', 'Asc')->get();
        return view('home', compact('barang'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $path = $request->file('gambar')->store('barang', 'public');

        Barang::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'gambar' => $path
        ]);

        return redirect()->back()->with('status', 'Produk Berhasil Ditambahkan');
    }

    public function show(Barang $barang)
    {
        //
    }

    public function edit(Barang $barang)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        if ($barang->gambar && file_exists(storage_path('app/public/' . $barang->gambar))) {
            unlink(storage_path('app/public/' . $barang->gambar));
        }

        $path = $request->file('gambar')->store('barang', 'public');


        $barang->update([
            'name' => $request->name,
            'harga' => $request->harga, 
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('update', 'Produk Telah di update');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
         
        $barang->delete();

        return redirect()->back()->with('delete', 'Produk Berhasil di hapus');
    }
}
