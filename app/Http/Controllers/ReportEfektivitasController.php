<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth; 

class ReportEfektivitasController extends Controller
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
        $targetecc = 120;
        $targetcc = 165;
        $area = [];
        $last30Days = now()->subDays(30)->toDateTimeString();
        $user = \App\Models\User::All();
        $customer = \App\Models\Customer::All();

        $ccData = [];
        $eccData = [];
        $packData = [];
        $createdDate = [];
        // Retrieve the selected user name from the request
        $customer = DB::table('customer')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->select(DB::raw('COUNT(customer.id) AS CC, customer.area,COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell, DATE_FORMAT(customer.created_at, "%d/%m") AS created_date, users.tim AS area'))
        ->groupBy(DB::raw('users.tim, DATE_FORMAT(customer.created_at, "%d/%m")'))
        ->where('customer.created_at', '>=', $last30Days)
        ->orderBy('customer.created_at', 'asc');

        if (auth()->user()->hasRole('adminarea')) {
            $customer->where('customer.area', auth()->user()->area);
        }

        $customer=$customer->get();

          // Iterate through the customer data and add it to the CC and ECC arrays
        foreach ($customer as $data) {
            $ccData[] = $data->CC;
            $eccData[] = $data->ECC;
            $packData[] = $data->packsell;
            $createdDate[] = $data->created_date. '-'. substr($data->area, 0, 11);
        }

        $today = date('Y-m-d');

            // Call the function to generate chart data
    
        return view ('admspgreport.reportefektivitas',['targetecc'=>$targetecc,'targetcc'=>$targetcc,'area'=>$area,'customer'=>$customer,'user'=>$user,'ccData' => json_encode($ccData),
        'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate)]);
    }

    public function loadData(Request $request)
    {
        $targetecc = 120;
        $targetcc = 165;
        $user = \App\Models\User::all();
        $area = $request->get('area');
        $tanggalawal = date('Y-m-d H:i:s', strtotime($request->input('tanggalawal')));
        $tanggalakhir = date('Y-m-d 23:59:59', strtotime($request->input('tanggalakhir')));

        $ccData = [];
        $eccData = [];
        $packData = [];
        $createdDate = [];

        // Query the data based on the selected area and date range
        $customer = DB::table('customer')
        ->select(DB::raw('COUNT(customer.id) AS CC, customer.area, COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell, DATE_FORMAT(customer.created_at, "%d/%m") AS created_date, users.tim AS area'))
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->where('users.tim', '=', $area)
        ->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
        ->groupBy('users.tim', DB::raw('DATE_FORMAT(customer.created_at, "%d/%m")'))
        ->orderBy('customer.created_at', 'asc')  // Order by the original 'created_at' column
        ->get(['CC', 'ECC', 'namasales', 'created_date', 'area']);
    
         // Iterate through the customer data and add it to the CC and ECC arrays
         foreach ($customer as $data) {
            $ccData[] = $data->CC;
            $eccData[] = $data->ECC;
            $packData[] = $data->packsell;
            $createdDate[] = $data->created_date;
        }
        // Return the view with the chart and table data
        return view('admspgreport.reportefektivitas', [
            'targetecc'=>$targetecc,'targetcc'=>$targetcc,'area' =>$area,
            'customer' => $customer,
            'ccData' => json_encode($ccData),
            'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate),
        ]);
    }




   
}
