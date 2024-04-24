<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'NamaPelanggan' => 'required',
        //     'Alamat' => 'required',
        //     'NomorTelepon' => 'required|numeric',
        // ]);

        // Pelanggan::create([
        //     'NamaPelanggan' => $request->NamaPelanggan,
        //     'Alamat' => $request->Alamat,
        //     'NomorTelepon' => $request->NomorTelepon,
        // ]);

        // return redirect ('create')->with('successAdd', 'Berhasil menambahkan data baru');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        //
    }
}
