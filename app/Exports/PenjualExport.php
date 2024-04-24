<?php

namespace App\Exports;

use App\Models\Penjual;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenjualExport implements FromCollection, WithHeadings, WithEvents
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $penjualans = Penjual::latest();

        if (!empty($this->search)) {
            $penjualans->whereHas('pelanggan', function ($query) {
                $query->where('NamaPelanggan', 'LIKE', '%' . $this->search . '%');
            });
        }

        $penjualans = $penjualans->get();

        $data = collect([]);

        foreach ($penjualans as $penjualan) {
            $pelanggan = Pelanggan::find($penjualan->PelangganID);
            $detailPenjualan = DetailPenjualan::where('PenjualanID', $penjualan->id)->get();

            foreach ($detailPenjualan as $detail) {
                $data->push([
                    'Id' => $penjualan->id,
                    'Tanggal Penjualan' => $penjualan->TanggalPenjualan,
                    'Nama Pelanggan' => $pelanggan->NamaPelanggan,
                    'Username' => $penjualan->createdBy->username,
                    'Alamat' => $pelanggan->Alamat,
                    'Nomor Telepon' => $pelanggan->NomorTelepon,
                    'Nama Produk' => $detail->produk->NamaProduk, 
                    'deskripsi' => $detail->produk->product_deskripsi, 
                    'Jumlah Produk' => $detail->JumblahProduk,
                    'Subtotal' => $detail->Subtotal,
                    'Total Harga' => $penjualan->TotalHarga
                ]);
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tanggal Penjualan',
            'Nama Pelanggan',
            'Nama Petugas',
            'Alamat',
            'Nomor Telepon',
            'Nama Produk',
            'Jumlah Produk',
            'Subtotal',
            'Total Harga'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);
            },
        ];
    }
}
