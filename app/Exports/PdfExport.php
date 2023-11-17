<?php

namespace App\Exports;

use App\Models\Detailpesanan;
use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PdfExport implements FromQuery, WithHeadings
{

    use Exportable;

    public function idpesanan(int $idpesanan)
    {
        $this->idpesanan = $idpesanan;
        
        return $this;
    }

    public function headings(): array
    {
        return[            
            'order id',
            'Nama',
            'Total',
            'Metode Pembayaran',
            'Status',
            'Nama Barang',
            'Jumlah',
            'Harga',
            'Tanggal'
            ];
    }

    public function query(){
        return Detailpesanan::select('pesanans.order_id', 'users.name', 'pesanans.total', 'pesanans.metode_pembayaran', 'pesanans.status', 'bukus.judul', 'jumlah', 'detailpesanans.harga' ,'pesanans.tanggal')->join('pesanans', 'detailpesanans.pesanan_id', 'pesanans.id')->join('users', 'pesanans.user_id', 'users.id')->join('bukus', 'detailpesanans.buku_id', 'bukus.id')->where('pesanan_id', $this->idpesanan);
    }
}

