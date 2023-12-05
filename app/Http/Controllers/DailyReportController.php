<?php

namespace App\Http\Controllers;
use App\Models\Kabupaten;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth; 

class DailyReportController  extends Controller
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
        $targetecc = 35;
        $targetcc = 45;
        $targetps = 40; 

        $zz ="Last 30 Days";
        $last30Days = Carbon::now()->subDays(30)->toDateTimeString();
        $ccData = [];
        $eccData = [];
        $packData = [];
        $packDatadm = [];
        $packDatadmm = [];
        $createdDate = [];
        $customer = \App\Models\Customer::All();
        // Retrieve the selected user name from the request
        $customer = DB::table('customer')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->select(DB::raw('COUNT(customer.id) AS CC, customer.area,users.tim as tim,users.name as namasales,COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell ,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'))
        ->where('customer.created_at', '>=', $last30Days);
        if (auth()->user()->hasRole('TL')) {
            $customer->where('users.tim', '=', Auth::user()->tim);
        }elseif (auth()->user()->hasRole('user'))
            {$customer->where('customer.id_user', auth()->user()->id);
        }else{ $customer->where('users.id', '=',  Auth::user()->id);}
        $customer = $customer
        ->groupBy('users.name', DB::raw('DATE_FORMAT(customer.created_at, "%d/%m")'))
        ->orderBy('customer.created_at', 'asc')
        ->get();

        $today = date('Y-m-d');
        foreach ($customer as $data) {
            $ccData[] = $data->CC;
            $eccData[] = $data->ECC;
            $packData[] = $data->packsell;

            $createdDate[] = $data->created_date;
        }
        
        return view ('sales.dailyreport',['zz'=>$zz,'targetecc'=>$targetecc,'targetcc'=>$targetcc,'targetps'=>$targetps,'customer'=>$customer,'ccData' => json_encode($ccData),
        'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate)]);
    }

        public function loadData(Request $request)
        {
            $zz ="";
            $tanggalawal = date('Y-m-d H:i:s', strtotime($request->input('tanggalawal')));
            $tanggalakhir = date('Y-m-d 23:59:59', strtotime($request->input('tanggalakhir')));
            // Query the data based on the selected date range

            $targetecc = 35;
            $targetcc = 45;
            $targetps = 40;

            $ccData = [];
            $eccData = [];
            $packData = [];
            $packDatadm = [];
            $packDatadmm = [];
            $createdDate = [];
            $customer = DB::table('customer')
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->select(DB::raw('COUNT(customer.id) AS CC, customer.area,users.tim as tim,users.name as namasales,COUNT(CASE WHEN customer.jml_beli > 0 THEN customer.id END) AS ECC, SUM(customer.jml_beli) AS packsell,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'));
            if (auth()->user()->hasRole('TL')) {
                $customer->where('users.tim', '=', Auth::user()->tim);
            }else{ $customer->where('users.id', '=',  Auth::user()->id);}
            $customer =$customer->whereBetween('customer.created_at', [$tanggalawal, $tanggalakhir])
            ->groupBy('users.name', 'customer.area', DB::raw('DATE_FORMAT(customer.created_at, "%d/%m")'))
            ->get(['CC', 'ECC', 'namasales', 'created_date', 'area']);

            foreach ($customer as $data) {
                $ccData[] = $data->CC;
                $eccData[] = $data->ECC;
                $packData[] = $data->packsell;


                $createdDate[] = $data->created_date;
            }
            // Pass the data to the view
            return view('sales.dailyreport', ['zz'=>$zz,'targetecc'=>$targetecc,'targetcc'=>$targetcc,'targetps'=>$targetps,'customer'=>$customer,'ccData' => json_encode($ccData),
             'eccData' => json_encode($eccData),'packData' => json_encode($packData),'createdDate'=> json_encode($createdDate)]);
        }



   
}
