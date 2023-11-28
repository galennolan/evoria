<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CustomerExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        $area = request()->get('area');
        $start_date = date('Y-m-d H:i:s', strtotime(request()->input('tanggalawal')));
        $end_date = date('Y-m-d 23:59:59', strtotime(request()->input('tanggalakhir')));

        return Customer::query()
        ->select(
            DB::raw('ROW_NUMBER() OVER(ORDER BY customer.created_at ASC) as No'),
            DB::raw("DATE_FORMAT(customer.created_at, '%d/%m/%y') as Tanggal"), 
            'customer.area as Area', 
            'customer.rayon as Rayon', 
            'customer.kab as Kab/Kec', 
            'customer.venue as Venue', 
            'users.name as namasales', 
            'c.name AS teamleader',
            'customer.name as Nama Pelanggan', 
            'customer.telp as Telp', 
            'customer.IG as IG', 
            'customer.email as email', 
            'customer.jenis_kelamin as Gender', 
            'customer.umur as Umur', 
            'customer.pekerjaan as Pekerjaan', 
            'customer.rokok as `Rokok yg dikonsumsi`',
            'customer.jml_beli as pack', 
            'customer.open as open', 

            'customer.rasadip as `Komentar Rasa Rokok`', 
            DB::raw('(CASE WHEN customer.hargadip = 0 THEN "Mahal" ELSE "Terjangkau" END) as `Harga Diplomat`'),
            'customer.kemasan as `kemasan`', 
            'customer.tempatbeli as tempatbeli ', 
            DB::raw('(CASE WHEN customer.akanbeli = 0 THEN "Tidak" ELSE "Ya" END) as `Beli Lagi`'),
            'customer.alasan as `Alasan Beli Lagi`',
            'customer.alasan as alasan '
        )
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->leftJoin('users AS b', 'b.tl', '=', 'users.id')
            ->leftJoin('users AS c', 'c.id', '=', 'users.tl')
            ->groupBy('customer.id')
        ->where('customer.area', '=', $area)
        ->whereBetween('customer.created_at', [$start_date, $end_date])->orderBy('customer.created_at', 'asc');
       
    
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Area',
            'Rayon',
            'Kab/Kec',
            'Venue',
            'Female Presenter',
            'Team Leader',
            'Nama Pelanggan',
            'Telp',
            'IG',
            'Email',
            'Gender',
            'Umur',
            'Pekerjaan',
            'Rokok yg dikonsumsi',
            'Pack',
            'open',
           
            'Rasa',
            'Harga Diplomat',
            'Kemasan Diplomat',
            'Tempat Beli',
            'Beli Lagi',
            'Alasan Beli Lagi'
        ];
    }

}
