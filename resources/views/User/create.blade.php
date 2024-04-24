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
        <a class="nav-link collapsed" href="/produk">
          <i class="bi bi-box-seam"></i><span>Produk</span>
        </a>
      </li>
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="/penjualan">
          <i class="bi bi-cart4"></i><span>Penjualaan</span>
        </a>
      </li>
  
      <li class="nav-item">
        <a class="nav-link" href="/user">
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
                <h5 class="card-title">User Form</h5>
  
                <form action="{{route('storeUser')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text"  name="username" id="username" class="form-control"  placeholder="Username">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class=" col-sm-10">
                      <input type="email" name="email" id="email" class="form-control"  placeholder="Email">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Role" name="role">
                            <option selected disabled>Choose role</option>
                            <option value="administrator">Administrator</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>

                  <div class="row mb-3">
                    <div class="col-sm-10">
                      <button type="submit" style="float: right; margin-right: -150px" class="btn btn-primary">Submit</button>
                      <a href="/user"><button type="button" class="btn btn-primary float-left">Kembali</button></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </section>
</main>
@endsection