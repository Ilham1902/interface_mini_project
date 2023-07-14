<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustommersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Custommers";
        $response_custommers = Http::get('http://127.0.0.1:8000/api/pelanggan');
        $custommers = $response_custommers->json();
        return view('pages.custommers', compact('title', 'custommers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Custommers";
        $child_title = "Add Custommers";
        return view('pages.tambah_pelanggan', compact('title', 'child_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            "nama" => $request->nama,
            "domisili" => $request->domisili,
            "jenis_kelamin" => $request->jenis_kelamin
        ];

        // Kirim data ke API
        $response = Http::post('http://127.0.0.1:8000/api/pelanggan', $data);

        if ($response->successful()) {
            return redirect()->route('custommers')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('custommers')->with(['error_update' => "Gagal Update"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Custommers";
        $child_title = "Edit Custommers";
        $response_custommers = Http::get('http://127.0.0.1:8000/api/pelanggan/' . $id);
        $custommers = $response_custommers[0];
        return view('pages.edit_pelanggan', compact('title', 'child_title', 'custommers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            "nama" => $request->nama,
            "domisili" => $request->domisili,
            "jenis_kelamin" => $request->jenis_kelamin
        ];

        // Kirim data ke API
        $response = Http::put('http://127.0.0.1:8000/api/pelanggan/' . $id, $data);

        if ($response->successful()) {
            return redirect()->route('custommers')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('custommers')->with(['error_update' => "Gagal Update"]);
        }
    }

    public function delete_cust($id)
    {
        $response = Http::delete('http://127.0.0.1:8000/api/pelanggan/' . $id);
        if ($response->successful()) {
            return redirect()->route('custommers')->with(['success_update' => "Success"]);
        } else {
            return redirect()->route('custommers')->with(['error_update' => "Gagal Update"]);
        }
    }
}
