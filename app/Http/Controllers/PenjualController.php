<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Exports\PenjualExport;
use Maatwebsite\Excel\Facades\Excel;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $penjualan = Penjual::with('pelanggan') // Melakukan query untuk mendapatkan data Penjual dengan memuat relasi 'pelanggan'
            // Memuat kondisi pada relasi 'pelanggan'
            ->whereHas('pelanggan', function ($query) use ($search) {
                $query->where('NamaPelanggan', 'LIKE', '%' . $search . '%'); // Melakukan pencarian berdasarkan nama pelanggan
            })->get();
        $data = [];


        foreach ($penjualan as $jual) {
            $pelanggan = Pelanggan::find($jual->PelangganID);
            $user = $jual->createdBy;
            $data[] = [
                'penjualan' => $jual,
                'pelanggan' => $pelanggan,
                'created_by_username' => $user,
            ];
        }
        return view('Penjualan.index', compact('data'));
    }


    public function cetakpenjualan($id)
    {
        $penjualan = Penjual::findOrFail($id);

        $pelanggan = Pelanggan::find($penjualan->PelangganID);

        $detailPenjualan = DetailPenjualan::where('PenjualanID', $id)->get();

        $pdf = PDF::loadView('Penjualan.cetakpenjualan', compact('penjualan', 'pelanggan', 'detailPenjualan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Bukti-Data-Penjualan-' . $id . '.pdf');
    }

    // public function excel()
    // {
    //     return Excel::download(new PenjualExport, 'Laporan Pembelian.xlsx');
    // }

    public function excel(Request $request)
    {
        $search = $request->search;

        if (!empty($search)) {
            $penjualan = Penjual::with('pelanggan')
                ->whereHas('pelanggan', function ($query) use ($search) {
                    $query->where('NamaPelanggan', 'LIKE', '%' . $search . '%');
                })->get();
        } else {
            $penjualan = Penjual::with('pelanggan')->get();
        }

        return Excel::download(new PenjualExport($search), 'Laporan Penjualan.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::orderBy('created_at', 'DESC')->get();
        return view('Penjualan.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'JumlahPenjualan' => 'required|array',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->NamaPelanggan = $request->input('NamaPelanggan');
        $pelanggan->Alamat = $request->input('Alamat');
        $pelanggan->NomorTelepon = $request->input('NomorTelepon');
        $pelanggan->save();

        $penjualan = new Penjual();
        $penjualan->TanggalPenjualan = Carbon::now('Asia/Jakarta');
        $totalHarga = 0;

        foreach ($request->input('produk_id') as $key => $produkId) {
            $jumlahProduk = $request->input('JumlahPenjualan.' . $key);
            if ($jumlahProduk !== null && $jumlahProduk > 0) {
                $produk = Produk::find($produkId);
                $subtotal = $produk->Harga * $jumlahProduk;
                $totalHarga += $subtotal;
            }
        }

        $bayar = $request->input('Bayar');
        $penjualan->Bayar = $bayar;
        $penjualan->Kembalian = $bayar - $totalHarga;

        $penjualan->TotalHarga = $totalHarga;

        $penjualan->PelangganID = $pelanggan->id;
        $penjualan->created_by = auth()->user()->id;
        $penjualan->save();

        foreach ($request->input('produk_id') as $key => $produkId) {
            $jumlahProduk = $request->input('JumlahPenjualan.' . $key);
            $subtotal = null;
            if ($jumlahProduk !== null && $jumlahProduk > 0) {
                $detailPenjualan = new DetailPenjualan();
                $detailPenjualan->PenjualanID = $penjualan->id;
                $detailPenjualan->ProdukID = $produkId;
                $detailPenjualan->JumblahProduk = $jumlahProduk;

                $produk = Produk::find($produkId);
                $subtotal = $produk->Harga * $jumlahProduk;
                $detailPenjualan->Subtotal = $subtotal;

                if ($subtotal !== null && $subtotal > 0) {
                    $detailPenjualan->save();
                    $produk->Stock -= $jumlahProduk;
                    $produk->save();
                }
            }
        }

        return redirect('/penjualan')->with('successPenjualan', 'Penjualan berhasil.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Penjual $penjual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjual $penjual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjual $penjual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjual::findOrFail($id);

        $penjualan->detailPenjualan()->delete();

        $pelanggan = Pelanggan::findOrFail($penjualan->PelangganID);
        $pelanggan->delete();

        $penjualan->delete();

        return redirect('/penjualan')->with('successDelete', 'Penjualan dan detail anda berhasil dihapus.');
    }
}
