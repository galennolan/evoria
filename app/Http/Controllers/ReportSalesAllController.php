<?php

namespace App\Http\Controllers;
use App\Models\Kabupaten;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class ReportSalesAllController  extends Controller
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


        $orang = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        $customer = \App\Models\Customer::All();
        $user = \App\Models\User::All();
        // Retrieve the selected user name from the request
        $customer = DB::table('customer')
        ->leftJoin('users', 'users.id', '=', 'customer.id_user')
        ->select(DB::raw('COUNT(customer.id) AS CC, SUM(customer.jml_beli) AS ECC, customer.rayon AS rayon, users.name AS namasales,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'))
        ->groupBy('users.id', 'users.name', 'customer.rayon')
        ->orderBy('customer.created_at', 'asc')
        ->get();

    
        $today = date('Y-m-d');
        
        return view ('admsales.reportsales',['orang' =>$orang,'customer'=>$customer,'user'=>$user]);
    }

    public function loadData(Request $request)
    {
        $orang = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        $rayon = $request->get('rayon');
        $namasales = $request->get('namasales');
        $user = \App\Models\User::All();
            
        // Query the data based on the selected area and date range
  
        $customer = DB::table('customer')
            ->leftJoin('users', 'users.id', '=', 'customer.id_user')
            ->select(DB::raw('COUNT(customer.id) AS CC, SUM(customer.jml_beli) AS ECC, customer.rayon AS rayon, users.name AS namasales,DATE_FORMAT(customer.created_at, "%d/%m") AS created_date'))
            ->where('customer.rayon', '=', $rayon)
            ->where('users.name', '=', $namasales)
            ->groupBy('users.id', 'users.name', 'customer.area')
            ->orderBy('customer.created_at', 'asc')
            ->get();
           
        // Pass the data to the view
        return view('admsales.reportsales', [ 'orang' =>$orang,'user'=>$user,'customer' => $customer
        ]);
    }



   
}
