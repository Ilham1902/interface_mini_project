<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    public function index()
    {
        $title = "Inventory";
        $response_barang = Http::get('http://127.0.0.1:8000/api/barang');
        $barang = $response_barang->json();
        return view('pages.inventory', compact('title', 'barang'));
    }

    public function create()
    {
        $title = "Inventory";
        $child_title = "Add Item";
        return view('pages.tambah_barang', compact('title', 'child_title'));
    }

    public function store(Request $request)
    {
        $data = [
            "nama" => $request->nama,
            "kategori" => $request->kategori,
            "harga" => $request->harga
        ];

        // Kirim data ke API
        $response = Http::post('http://127.0.0.1:8000/api/barang', $data);

        if ($response->successful()) {
            return redirect()->route('inventory')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('inventory')->with(['error_update' => "Gagal Update"]);
        }
    }

    public function edit($id)
    {
        $title = "Inventory";
        $child_title = "Edit Item";
        $response_barang = Http::get('http://127.0.0.1:8000/api/barang/' . $id);
        $barang = $response_barang[0];
        return view('pages.edit_item', compact('title', 'child_title', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            "nama" => $request->nama,
            "kategori" => $request->kategori,
            "harga" => $request->harga
        ];

        // Kirim data ke API
        $response = Http::put('http://127.0.0.1:8000/api/barang/' . $id, $data);

        if ($response->successful()) {
            return redirect()->route('inventory')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('inventory')->with(['error_update' => "Gagal Update"]);
        }
    }

    public function delete_item($id)
    {
        $response = Http::delete('http://127.0.0.1:8000/api/barang/' . $id);
        if ($response->successful()) {
            return redirect()->route('inventory')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('inventory')->with(['error_update' => "Gagal Update"]);
        }
    }
}
