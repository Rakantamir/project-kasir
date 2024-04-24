@extends('layout')
@section('layout')

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="/home">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="/produk">
        <i class="bi bi-box-seam"></i><span>Produk</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link " href="/penjualan">
        <i class="bi bi-cart4"></i><span>Penjualaan</span>
      </a>
    </li>

      @if(Auth::user()->role == 'administrator')
      <li class="nav-item">
        <a class="nav-link collapsed" href="/user">
          <i class="bi bi-person"></i><span>User</span>
        </a>
      </li>
      @endif

</aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Penjualan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Penjualan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

    <form action="{{ route('storepenjualan') }}" method="POST">
      @csrf
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Penjualan Form</h5>
     <div class="row mb-3">
          <label for="NamaPelanggan">Nama Pelanggan:</label>
          <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" required>
      </div>
     <div class="row mb-3">
          <label for="Alamat">Alamat:</label>
          <input type="text" class="form-control" id="Alamat" name="Alamat" required>
      </div>
     <div class="row mb-3">
          <label for="NomorTelepon">Nomor Telepon:</label>
          <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" required>
      </div>
      </div>
      </div>

      <div class="chart-area d-flex flex-row flex-wrap">
          @foreach ($produks as $produk)
          <div class="card text-center mb-3 mr-3" style="width: 22rem;">
              <img class="card-img-top" src="data:image/png;base64,{{ $produk->Image }}" alt="img produk" width="80" height="200">
              <div class="card-body">
                  <h5 class="card-title font-weight-bold text-dark">{{ $produk->NamaProduk }}</h5>
                  <p class="card-text">Stock {{ $produk->Stock }}</p>
                  <p class="font-weight-bold text-dark">RP. {{ number_format($produk->Harga, 0,',','.' )}}</p>
                  <div class="product-quantity mb-3">
                      <button class="minus-btn mr-2" type="button">-</button>
                      <input class="quantity mr-2" type="text" name="JumlahPenjualan[]" value="0">
                      <button class="plus-btn" type="button">+</button>
                  </div>
                  <p class="subtotal">Subtotal: Rp.  {{ number_format($produk->subtotal, 0, '.','.')}}</p>
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold text-dark">
                        {{ $sl->product_deskripsi }}
                    </h5>
                  <input type="hidden" name="produk_id[]" value="{{ $produk->id }}">
                  <input type="hidden" class="harga" name="Harga[]" value="{{ $produk->Harga }}">
              </div>
          </div>
          @endforeach
      </div>
      <h5 id="total-harga">Total Harga: Rp. 0</h5>
      <br>
     <div class="row mb-3">
          <label for="Bayar"><h5>Bayar</h5></label>
          <input type="number" class="form-control" id="Bayar" name="Bayar" required>
      </div>
      <h5 id="Kembalian">Kembalian:</h5>
      <br>
      <!-- Tombol submit -->
      <button type="submit" style="float: right; margin-right: 1px" class="btn btn-primary">Pesan</button>
      <a href="/penjualan"><button type="button" class="btn btn-primary float-left">Kembali</button></a>
  </form>
    </section>
  </main><!-- End #main -->
 @endsection
