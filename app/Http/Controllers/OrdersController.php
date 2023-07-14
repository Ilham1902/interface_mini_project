<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('item')) {
            $count_item = count(session()->get('item'));
        } else {
            $count_item = 0;
        }
        $title = "Orders";
        $response_barang = Http::get('http://127.0.0.1:8000/api/barang');
        $barang = $response_barang->json();
        return view('pages.orders', compact('title', 'barang', 'count_item'));
    }

    public function add_cart(Request $request)
    {
        $item = $request->item;
        $harga = $request->harga;
        $kode = $request->kode;


        // Mengecek apakah session dengan key 'item' sudah ada
        if (Session::has('item')) {
            // Jika session sudah ada, tambahkan data ke dalam session yang sudah ada
            if (in_array($kode, Session::get('kode'))) {
                return redirect('/orders')->with(['success' => 'Item has added']);
            } else {
                Session::push('kode', $kode);
                Session::push('item', $item);
                Session::push('harga', $harga);
                Session::push('qty', 1);
            }
        } else {
            // Jika session belum ada, buat session baru dengan data
            Session::put('kode', [$kode]);
            Session::put('item', [$item]);
            Session::put('harga', [$harga]);
            Session::put('qty', [1]);
        }

        return redirect('/orders')->with(['success' => 'Added to cart']);
    }

    public function cart()
    {
        $title          = "Orders";
        $child_title    = "Cart";

        $response_pelanggan = Http::get('http://127.0.0.1:8000/api/pelanggan');
        $pelanggan = $response_pelanggan->json();

        return view('pages.cart', compact('title', 'child_title', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {

        $data = [
            "tgl" => $request->tgl,
            "kode_pelanggan" => $request->kode_pelanggan,
            "item" => $request->item,
            "qty" => $request->qty
        ];

        // Kirim data ke API
        $response = Http::post('http://127.0.0.1:8000/api/penjualan', $data);

        if ($response->successful()) {
            // Menghapus semua session
            Session::flush();

            return redirect()->route('orders')->with(['success_orders' => "Success"]);
        } else {
            return redirect()->route('cart')->with(['error_orders' => "Gagal checkout"]);
        }
    }

    public function list_orders()
    {
        $title = "List Orders";
        $response_barang = Http::get('http://127.0.0.1:8000/api/penjualan');
        $list_orders = $response_barang->json();
        return view('pages.list_orders', compact('title', 'list_orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_penjualan($id)
    {
        $title = "List Orders";
        $child_title = "Edit Orders";
        $response_penjualan = Http::get('http://127.0.0.1:8000/api/penjualan/' . $id);
        $penjualan = $response_penjualan["penjualan"];
        $item_penjualan = $response_penjualan["item_penjualan"];
        $data_penjualan = $penjualan[0];
        $data_item_penjualan = $item_penjualan;
        return view('pages.edit_penjualan', compact('title', 'child_title', 'data_penjualan', 'data_item_penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_penjualan($id, Request $request)
    {
        $data = [
            "tgl" => $request->tgl,
            "kode_pelanggan" => $request->kode_pelanggan,
            "item" => $request->item,
            "qty" => $request->qty
        ];

        // Kirim data ke API
        $response = Http::put('http://127.0.0.1:8000/api/penjualan/' . $id, $data);

        if ($response->successful()) {
            return redirect()->route('list_orders')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('list_orders')->with(['error_update' => "Gagal checkout"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_orders($id)
    {
        $response = Http::delete('http://127.0.0.1:8000/api/penjualan/' . $id);
        if ($response->successful()) {
            return redirect()->route('list_orders')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('list_orders')->with(['error_update' => "Gagal Update"]);
        }
    }
}
