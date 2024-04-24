<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Bukti Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-image: url('background-kasir.jpg');
            background-size: cover;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 10px;
            background-image: url('background-kasir.jpg');
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: none;
            padding: 5px 0;
        }
        th {
            text-align: left;
        }
        .subtotal {
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Struk Bukti Penjualan</h2>
        </div>
        <hr>
        <table>
            <tr>
                <th>Date : </th>
                <td>{{ $penjualan->TanggalPenjualan }}</td>
            </tr>
            <tr>
                <th>Customer : </th>
                <td>{{ $pelanggan->NamaPelanggan }}</td>
            </tr>
            <tr>
                <th>Cashier :</th>
                <td>{{ $penjualan->createdBy->username }}</td>
            </tr>
            <tr>
                <th>Address : </th>
                <td>{{ $pelanggan->Alamat }}</td>
            </tr>
            <tr>
                <th>Phone number :</th>
                <td>{{ $pelanggan->NomorTelepon }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Product name</th>
                <th>Jumlah</th>
                <th class="subtotal">Subtotal</th>
            </tr>
            @foreach ($detailPenjualan as $detail)
            <tr>
                <td>{{ $detail->produk->NamaProduk }}</td>
                <td>{{ $detail->JumblahProduk }}</td>
                <td class="subtotal">RP. {{ number_format ($detail->Subtotal, 0,',','.') }}</td>
            </tr>
            @endforeach
        </table>
        <div class="footer">
            <p class="total">Total Harga: RP. {{ number_format($penjualan->TotalHarga, 0,',','.' )}}</p>
            <p class="bayar">Bayar : RP. {{ number_format($penjualan->Bayar, 0,',','.' )}}</p>
            <p class="kembalian">Kembalian: RP. {{ number_format($penjualan->Kembalian, 0,',','.' )}}</p>
            <hr>
            <h3>
                <p>Terima kasih telah berbelanja !</p>
            </h3>
        </div>
    </div>
</body>
</html>
