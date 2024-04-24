<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kasir-App</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 13 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        {{-- <img src="assets/img/logo.png" alt=""> --}}
        <span class="d-none d-lg-block">Kasir  App</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->username}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->role}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('actionlogout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  @yield('layout')
  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.min.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        function calculateSubtotal(quantity, price) {
            return quantity * price;
        }

        $('.quantity').on('input', function() {
            var quantity = parseInt($(this).val());
            var price = parseFloat($(this).closest('.card-body').find('.harga').val());
            var subtotal = calculateSubtotal(quantity, price);
            $(this).closest('.card-body').find('.subtotal').text('Subtotal: Rp. ' + subtotal);
            updateTotal();
        });

        $('.plus-btn').click(function() {
            var input = $(this).siblings('.quantity');
            var quantity = parseInt(input.val());
            input.val(quantity + 1);
            input.trigger('input');
        });

        $('.minus-btn').click(function() {
            var input = $(this).siblings('.quantity');
            var quantity = parseInt(input.val());
            if (quantity > 0) {
                input.val(quantity - 1);
                input.trigger('input');
            }
        });

        $('#Bayar').on('input', function() {
            updateKembalian();
        });

        function updateTotal() {
            var total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text().replace('Subtotal: Rp. ', ''));
            });
            $('#total-harga').text('Total Harga: Rp. ' + total);
            updateKembalian();
        }

        function updateKembalian() {
            var totalHarga = parseFloat($('#total-harga').text().replace('Total Harga: Rp. ', ''));
            var bayar = parseFloat($('#Bayar').val());
            var kembalian = bayar - totalHarga;
            $('#Kembalian').text('Kembalian: Rp. ' + kembalian.toFixed(2));
        }

        function updateTotal() {
            var total = 0;
            $('.subtotal').each(function() {
                var subtotalText = $(this).text().replace('Subtotal: Rp. ', ''); // Menghapus teks 'Subtotal: Rp. ' dari teks subtotal
                var subtotalValue = parseFloat(subtotalText.replace(/\./g, '').replace(',', '.')); // Mengubah teks subtotal menjadi nilai floating point
                if (!isNaN(subtotalValue)) { // Memeriksa apakah nilai subtotal adalah angka yang valid
                    total += subtotalValue; // Menambahkan subtotal ke total jika nilai subtotal valid
                }
            });
            // Menampilkan total harga dengan format ribuan yang sesuai dengan pengaturan lokal Indonesia
            $('#total-harga').text('Total Harga: Rp. ' + total.toLocaleString('id-ID'));
            updateKembalian();
        }

        function updateKembalian() {
    var totalHargaText = $('#total-harga').text().replace('Total Harga: Rp. ', ''); // Menghapus teks 'Total Harga: Rp. ' dari teks total harga
    var totalHarga = parseFloat(totalHargaText.replace(/\./g, '').replace(',', '.')); // Mengubah teks total harga menjadi nilai floating point

    var bayarText = $('#Bayar').val(); // Mengambil nilai yang dimasukkan pengguna untuk jumlah yang dibayar
    var bayar = parseFloat(bayarText.replace(/\./g, '').replace(',', '.')); // Mengubah teks jumlah yang dibayar menjadi nilai floating point

    var kembalian = bayar - totalHarga; // Menghitung kembalian

    $('#Kembalian').text('Kembalian: Rp. ' + kembalian.toLocaleString('id-ID')); // Menampilkan kembalian dengan format ribuan yang sesuai dengan pengaturan lokal Indonesia
}

    });
</script>
</body>

</html>
