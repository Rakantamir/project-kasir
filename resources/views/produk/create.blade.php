@extends('layout')
@section('layout')

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/">
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

      <li class="nav-item">
        <a class="nav-link collapsed" href="/user">
          <i class="bi bi-person"></i><span>User</span>
        </a>
      </li>

</aside><!-- End Sidebar-->
<main id="main" class="main">

    @if ($errors->any())
        <ul style="width: 100%; background:red; padding: 10px; ">
            @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
            @endforeach
        </ul>
     @endif

     @if (Session::get('gagal'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <i class="bi bi-exclamation-octagon me-1"></i>
       {{(Session::get('gagal'))}}
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    @endif

    <section class="section">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Produk Form</h5>

                <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                      <input type="text"  name="NamaProduk" id="NamaProduk" class="form-control"  placeholder="Nama Produk">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                      <input type="number" name="Harga" id="Harga" class="form-control"  placeholder="Harga">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Stock" class="col-sm-2 col-form-label">Stock</label>
                    <div class="col-sm-10">
                      <input type="number" name="Stock" id="Stock" class="form-control"  placeholder="Stock">
                    </div>
                  </div>


                 <div class="col-12">
                    <label for="product_deskripsi" class="form-label">deskripsi <span style="color: red">*</span></label>
                    <input type="text" name="product_deskripsi" class="form-control" placeholder="masukan deskripsi pada barang" required>
                </div>


                  <div class="row mb-3">
                    <label for="Image" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" id="Image" name="Image" accept="image/*">
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <div class="col-sm-10">
                      <button type="submit" style="float: right; margin-right: -150px" class="btn btn-success">Submit</button>
                      <a href="/produk"><button type="button" class="btn btn-primary float-left">Kembali</button></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </section>
</main>
@endsection
