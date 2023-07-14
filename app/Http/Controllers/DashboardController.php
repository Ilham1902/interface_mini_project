<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $response_penjualan = Http::get('http://127.0.0.1:8000/api/penjualan');
        $response_pelanggan = Http::get('http://127.0.0.1:8000/api/pelanggan');
        $response_barang    = Http::get('http://127.0.0.1:8000/api/barang');

        $penjualan = $response_penjualan->json();
        $pelanggan = $response_pelanggan->json();
        $barang = $response_barang->json();

        // Total Omset
        $totalOmset = 0;
        foreach ($penjualan as $key => $value) {
            $totalOmset += $value['SUB_TOTAL'];
        }
        // Total Penjualan
        $totalPenjualan = count($penjualan);
        // Total Pelanggan
        $totalPelanggan = count($pelanggan);
        // Total Barang
        $totalBarang = count($barang);
        return view('pages.dashboard', compact('totalOmset', 'totalPenjualan', 'totalPelanggan', 'totalBarang', 'title'));
    }
}
