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
@if (Session::has('successAddUser'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ Session::get('successAddUser') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('successEditUser'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ Session::get('successEditUser') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (Session::has('successDeleteUser'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ Session::get('successDeleteUser') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">User</li>
      </ol>
    </nav>
  </div>
<div style="margin-bottom: 10px">
  <a href="{{route('createUser')}}"><button type="button" class="btn btn-success"><i class="bi bi-plus-lg"></i>&nbsp;Create</button></a>
</div>
<section class="section">
        <div class="card">
          <div class="card-body">
            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                 $no = 1;
                @endphp
                @foreach ($users as $us)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$us['username']}}</td>
                    <td>{{$us['email']}}</td>
                    <td>{{$us['role']}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <form>
                          <a href="{{ route('editUser', $us->id) }}" class="btn btn-primary">Edit</a>
                        </form>
                        <span>&nbsp;</span>
                        <form action="{{ route('deleteUser', $us->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
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
