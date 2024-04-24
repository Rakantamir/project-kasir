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
        <a class="nav-link" href="/produk">
          <i class="bi bi-box-seam"></i><span>Produk</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/penjualan">
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
@if (Session::has('successAdd'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ Session::get('successAdd') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('successEdit'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ Session::get('successEdit') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (Session::has('successEditStok'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ Session::get('successEditStok') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (Session::has('successDelete'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ Session::get('successDelete') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="pagetitle">
    <h1>Produk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Produk</li>
      </ol>
    </nav>
  </div>
@if(Auth::user()->role == 'administrator')
<div style="margin-bottom: 10px">
  <a href="{{route('create')}}"><button type="button" class="btn btn-success"><i class="bi bi-plus-lg"></i>&nbsp;Create</button></a>
</div>
@endif
<section class="section">
        <div class="card">
          <div class="card-body">
            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Gambar Produk</th>
                  @if(Auth::user()->role == 'administrator')
                  <th scope="col">action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @php
                 $no = 1;
                @endphp
                @foreach ($produks as $duk)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$duk['NamaProduk']}}</td>
                    <td>RP. {{ number_format($duk['Harga'],  0,',','.' )}}</td>
                    <td>{{$duk['Stock']}}</td>
                    <td>{{ $duk->product_deskripsi }}</td>
                    <td><img src="data:image/png;base64,{{$duk->Image}}" alt="Gambar Produk" style="width: 200px; height: auto;"></td>
                    <td>
                      @if(Auth::user()->role == 'administrator')
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <form>
                          <a href="{{ route('edit', $duk->id) }}" class="btn btn-primary">Edit</a>
                        </form>
                        <span>&nbsp;</span>
                        <form>
                          <a href="{{ route('editStok', $duk->id) }}" class="btn btn-primary">Update Stok</a>
                        </form>
                        <span>&nbsp;</span>
                        <form action="{{ route('delete', $duk->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @endif
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Default Table Example -->
          </div>
        </div>
  </section>
</main>
@endsection
