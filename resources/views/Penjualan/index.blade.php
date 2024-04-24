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
                <a class="nav-link" href="/penjualan">
                    <i class="bi bi-cart4"></i><span>Penjualaan</span>
                </a>
            </li>

            @if (Auth::user()->role == 'administrator')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/user">
                        <i class="bi bi-person"></i><span>User</span>
                    </a>
                </li>
            @endif

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @if (Session::has('successPenjualan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ Session::get('successPenjualan') }}
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
            <h1>Penjualaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Penjualaan</li>
                </ol>
            </nav>
        </div>

        <form action="" method="GET">
            @csrf
            <input type="text" name="search" value="{{ request('search') }}" placeholder="cari berdasarkan nama ...">
            <button class="button-17" role="button" style="margin-left:5px;margin-top: -0.1px">Seacrh</button>
            <button class="button-17" role="button">Refresh</button>
        </form>
        </div><br>

        <div style="display: flex; justify-content: space-between;">
            <div style="margin-bottom: 10px">
                <form action="{{ route('penjualan.excel') }}" method="POST">
                    @csrf
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success">Export Penjualaan (.xlsx)</button>
                </form>

            </div>

            @if (Auth::user()->role == 'petugas')
                <div style="margin-bottom: 10px">
                    <a href="{{ route('createPenjualan') }}"><button type="button" class="btn btn-primary"><i
                                class="bi bi-plus-lg"></i>&nbsp;Tambahkan Penjualan</button></a>
                </div>
            @endif
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Tanggal Penjualan </th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Dibuat Oleh </th>
                                @if (Auth::user()->role == 'petugas')
                                    <th scope="col">action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item['pelanggan']->NamaPelanggan }}</td>
                                    <td>{{ $item['penjualan']->TanggalPenjualan }}</td>
                                    <td>Rp {{ number_format($item['penjualan']->TotalHarga, 0, ',', '.') }}</td>
                                    <td>{{ $item['created_by_username']->username }}</td>
                                    <td>
                                        <div style="margin-bottom: 10px">
                                            <a href="{{ route('cetakpenjualan', ['id' => $item['penjualan']->id]) }}">
                                                <button type="button" class="btn btn-warning">
                                                    <i class="bi bi-file-earmark-pdf"></i>&nbsp;Unduh Bukti
                                                </button>
                                            </a>
                                        </div>
                                        <br>
                                        @if (Auth::user()->role == 'petugas')
                                            <form action="{{ route('penjualan.destroy', $item['penjualan']->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </td>
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
