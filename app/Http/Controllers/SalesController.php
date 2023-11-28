<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Customer;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index(){
        $area = auth()->user()->area;
        $customer = DB::table('customer')
        ->select('*')
        ->selectRaw('users.name as namasales,customer.name as namacust')
        ->selectRaw('users.id as idsales,customer.id as idcust')
        ->leftJoin('users','users.id', '=','customer.id_user')
        ->get();
        //get data from table
        return view('sales.sales', compact('area','customer'));//sent data to view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'area' => 'required',
            'rayon' => 'required',
            'kab' => 'required',
            'cust-data' => 'required',
            // 'tanggal' => 'required',
            'telp' => 'nullable|unique:customer,telp',
            'IG' => 'nullable|unique:customer,IG',
            'email' => 'nullable|unique:customer,email',
            // Add validation rules for other fields as needed
        ], [
            'telp.unique' => 'Nomor Telepon sudah ada di database, masukkan nomor yang lain.',
            'IG.unique' => 'Username Instagram sudah ada di database, masukkan username yang lain.',
            'email.unique' => 'Alamat email sudah ada di database, masukkan alamat email yang lain.',
            // Add custom error messages for other fields as needed
        ]);
       
        $tambah_cust = new \App\Models\Customer;
        $tambah_cust->name = $request->name;
        $tambah_cust->area = $request->area;
        $tambah_cust->rayon = $request->rayon;
        $tambah_cust->kab = $request->kab;
        $tambah_cust->telp = $request->telp;
        $tambah_cust->IG = $request->IG;
        $tambah_cust->email = $request->email;
        $tambah_cust->id_user = Auth::user()->id;
        $tambah_cust->venue = $request->venue;
        $tambah_cust->jenis_kelamin = $request->jenis_kelamin;
        $tambah_cust->umur = $request->umur;
        $tambah_cust->pekerjaan = $request->pekerjaan;
        $tambah_cust->rokok = $request->rokok;
        // $tambah_cust->pernahrasa = $request->pernahrasa;
        $tambah_cust->open = $request->open;
        $tambah_cust->alasan = $request->alasan;
        $tambah_cust->kemasan = $request->kemasan;
        $tambah_cust->rasadip = $request->rasadip;
        $tambah_cust->akanbeli = $request->akanbeli;
        $tambah_cust->hargadip = $request->hargadip;
        $tambah_cust->tempatbeli = $request->tempatbeli; 
        $tambah_cust->jml_beli = $request->jml_beli;
        $tambah_cust->created_at = now();



        $tambah_cust->save();
        Alert::success('Pesan', 'Data berhasil disimpan');

        return redirect('/customer');
    }

   
}
