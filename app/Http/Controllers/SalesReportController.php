<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Spatie\Permission\Models\Role;
use Alert;
use Carbon\Carbon;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;



class SalesReportController extends Controller
{
       public function index()
        {   
            $area = auth()->user()->area;
            $last30Days = Carbon::now()->subDays(120)->toDateTimeString();
            
            $customer = DB::table('customer')
                ->select(
                    DB::raw('ROW_NUMBER() OVER(ORDER BY customer.created_at ASC) as row_number'),
                    'customer.id',
                    'customer.name',
                    'customer.telp',
                    'customer.jenis_kelamin',
                    'customer.umur',
                    'customer.id_user',
                    'customer.pekerjaan',
                    'customer.rokok',
                    'customer.rasadip',
                    'customer.hargadip',
                    'customer.akanbeli',
                    'customer.alasan',
                    'customer.created_at',
                    'customer.jml_beli',
                    'customer.area',
                    'customer.rayon',
                    'customer.tempatbeli',
                    'customer.kab',
                    'customer.venue',
                    'customer.open',
                    'customer.kemasan',
                    'users.name AS namasales',
                    'users.id AS idsales',
                    'b.name AS spg',
                    'c.name AS teamleader'
                )
                ->leftJoin('users', 'users.id', '=', 'customer.id_user')
                ->leftJoin('users AS b', 'b.tl', '=', 'users.id')
                ->leftJoin('users AS c', 'c.id', '=', 'users.tl');
            
            if (auth()->user()->hasRole('adminarea')) {
                $customer->where('customer.area', auth()->user()->area);
            }
            
            $customer = $customer
                ->where('customer.created_at', '>=', $last30Days)
                ->orderBy('customer.created_at', 'asc') // Corrected position of orderBy
                ->groupBy('customer.id')
                ->paginate(10);
            
            // The rest of your code...
            
            return view ('salesreport.salesreport',['area'=>$area,'customer'=>$customer]);
            
        }

        public function loadData(Request $request)
        {
            
            $area = $request->get('area');
            $tanggalawal = date('Y-m-d H:i:s', strtotime($request->input('tanggalawal')));
            $tanggalakhir = date('Y-m-d 23:59:59', strtotime($request->input('tanggalakhir')));
            
            $customer = DB::table('customer')
                ->select(
                    DB::raw('ROW_NUMBER() OVER(ORDER BY customer.created_at ASC) as row_number'),
                    'customer.id', 'customer.name', 'customer.telp', 'customer.jenis_kelamin', 'customer.umur',
                    'customer.id_user', 'customer.pekerjaan', 'customer.rokok', 'customer.rasadip', 
                    'customer.hargadip', 'customer.akanbeli', 'customer.alasan', 'customer.open as open','customer.kemasan','customer.created_at', 'customer.jml_beli', 
                    'customer.area', 'customer.rayon', 'customer.kab', 'customer.venue', 'users.name AS namasales', 
                    'users.id AS idsales','b.name AS spg', 'c.name AS teamleader','customer.tempatbeli',
                )
                ->leftJoin('users', 'users.id', '=', 'customer.id_user')
                ->leftJoin('users AS b', 'b.tl', '=', 'users.id')
                ->leftJoin('users AS c', 'c.id', '=', 'users.tl')
                ->where('customer.area', '=', $area)
                ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
                ->orderBy('customer.created_at', 'asc')
                ->groupBy('customer.id');
            
            $customer = $customer->paginate(10);
            
            
                    
                
            return view ('salesreport.salesreport',['area'=>$area,'customer'=>$customer]);
    
    }

        
    public function export(Request $request)
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}