<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::orderBy('created_at','DESC')->get();
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'NamaProduk' => 'required',
            'Harga' => 'required',
            'Stock' => 'required|numeric',
            'product_deskripsi' => 'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imageData = file_get_contents($request->file('Image')->path());
        $base64Image = base64_encode($imageData);

        Produk::create([
            'NamaProduk' => $request->NamaProduk,
            'Harga' => $request->Harga,
            'Stock' => $request->Stock,
            'product_deskripsi' => $request->product_deskripsi,
            'Image' => $base64Image,
        ]);

        $request->flush();

        return redirect ('/produk')->with('successAdd', 'Anda Berhasil Menambahkan Produk Baru');

    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $produk = Produk::findOrFail($id);

    return view('produk.edit', compact('produk'));
}

public function editStok($id)
{
    $produk = Produk::findOrFail($id);

    return view('produk.editStok', compact('produk'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'NamaProduk' => 'required',
        'Harga' => 'required',
        'Image' => 'image|mimes:jpeg,png,jpg,gif',
        'product_deskripsi' => 'required',
    ]);


    $produk = Produk::findOrFail($id);

    // $produk->update([
    //     'NamaProduk' => $request->NamaProduk,
    //     'Harga' => $request->Harga,
    // ]);

    Produk::where('id', '=', $id)->update([
        'NamaProduk' => $request->NamaProduk,
        'Harga' => $request->Harga,
        'product_deskripsi' => $request->product_deskripsi,
    ]);

    if ($request->hasFile('Image')) {
        $imageData = file_get_contents($request->file('Image')->path());
        $base64Image = base64_encode($imageData);
        $produk->Image = $base64Image;
    }

    $produk->save();

    return redirect('/produk')->with('successEdit', 'Anda Berhasil Mengupdate Produk');
}

public function updateStok(Request $request, $id)
{
    $request->validate([
        'Stock' => 'required|numeric',
    ]);


    $produk = Produk::findOrFail($id);

    $produk->update([
        'Stock' => $request->Stock,
    ]);

    return redirect('/produk')->with('successEditStok', 'Anda Berhasil Mengupdate Stok');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    $data = Produk::where('id', $id)->firstOrFail();
    $data->delete();
      return redirect()->back()->with('successDelete', 'Anda Berhasil Mengdelete Produk');
    }
}
