@extends('layout')
@section('layout')

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="/home">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <!-- Customers Card -->
    <div class="col-xxl-4 col-xl-12">

      <div class="card info-card customers-card">
        <div class="card-body">
          <h1 class="card-title" style="align-items: center; font-size: 25px">Selamat Datang, {{Auth::user()->username}}!</h1>
          </div>

        </div>
      </div>

    </div><!-- End Customers Card -->
    </section>

  </main><!-- End #main -->
 @endsection
