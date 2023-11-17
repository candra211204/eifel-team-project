<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesananExport implements FromQuery, WithHeadings
{

    use Exportable;

    public function headings(): array
    {
        return[            
            'order id',
            'Nama',
            'Total',
            'Metode Pembayaran',
            'Status',
            'Tanggal'
            ];
    }

    public function query(){
        return Pesanan::select('order_id', 'users.name', 'total', 'metode_pembayaran', 'status', 'tanggal')->join('users', 'pesanans.user_id', 'users.id');
    }
}

