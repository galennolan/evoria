<?php

namespace App\Http\Controllers;
use App\Kabupaten;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class SpgReportController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $kabupaten = \App\kabupaten::All();
        $user = \App\Models\User::All();
        $customer = \App\Models\Customer::All();
        // Retrieve the selected user name from the request
        
        $today = date('Y-m-d');
        $idcustomer = DB::table('customer')
                ->whereRaw('DATE(created_at) = CURDATE()')
                ->count();;

        $customers =DB::table('customer')->pluck('created_at');
        $jumlah_lokasi=DB::table('customer')
                        ->select('created_at', DB::raw('count(*) as total'))
                        ->groupBy('created_at')
                        ->get();
        return view ('spgreport.index',['kabupaten'=>$kabupaten,'user'=>$user,'customer'=>$customer,'customers'=>$customers,'jumlah_lokasi'=>$jumlah_lokasi,'idcustomer'=>$idcustomer]);
    }

    public function penjualan(Request $request)
    {
       
        $tanggalawal = strtotime($request->input('tanggalawal'));
        $tanggalakhir = strtotime($request->input('tanggalakhir'));
        $location = $request->get('location');

        if (empty($tanggalawal)) {
            // Set $tanggalawal to today if it is empty
            $tanggalawal = strtotime(date('Y-m-d 00:00:00'));
        }
        
        if (empty($tanggalakhir)) {
            // Set $tanggalakhir to today if it is empty
            $tanggalakhir = strtotime(date('Y-m-d 23:59:59'));
        }
        
        if ($tanggalakhir < $tanggalawal) {
            return response()->json([
                'error' => 'Tanggal akhir harus lebih besar atau sama dengan tanggal awal'
            ]);
        }
        
        $salespilihannama = $request->input('nama_user');
        
        if ($location === 'all') {
            $location = null;
        }
        
        // Query the sales data and count the number of sales made on a given date by the selected user
        $jumlahpenjualanpersales = DB::table('customer')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS date'), DB::raw('count(*) as jumlah_penjualan'))
            ->where('id_user', User::where('name', $salespilihannama)->value('id'))
            ->when($tanggalawal === $tanggalakhir, function ($query) use ($tanggalawal) {
                return $query->whereDate('created_at', date('Y-m-d H:i:s', $tanggalawal));
            }, function ($query) use ($tanggalawal, $tanggalakhir) {
                return $query->whereBetween('created_at', [date('Y-m-d H:i:s', $tanggalawal), date('Y-m-d H:i:s', $tanggalakhir+ 86399)]);
            })
            ->when($location, function ($query, $location) {
                return $query->where('area', $location);
            })
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        
        $chartData = [
            $labels = [],
            $data = []
        ];
        
        foreach ($jumlahpenjualanpersales as $p) {
            $chartData['labels'][] = date('d-m-Y', strtotime($p->date)); 
            $chartData['data'][] = $p->jumlah_penjualan;
        }
        
        // Return the sales count as a response
        return response()->json($chartData);
        
    }

    
   
}
