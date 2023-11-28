<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Users;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prodfunct(){
        
        $last30Days = Carbon::now()->subDays(30)->toDateTimeString();

        $customer = DB::table('customer')
        ->select('*')
        ->selectRaw('users.name as namasales,customer.name as namacust,customer.created_at',)
        ->selectRaw('users.id as idsales,customer.id as idcust')
        ->leftJoin('users','users.id', '=','customer.id_user')
        ->where('customer.created_at', '>=', $last30Days);
        if (auth()->user()->hasRole('user|tl')) {
            $customer->where('users.id', auth()->user()->id);
        } else {
        }
        $customer = $customer->orderBy('customer.created_at', 'asc')->get();
        return view('customer.index', compact( 'customer'));//sent data to view
    }

	public function findProductName(Request $request){

		
	    //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=kabupaten::select('nama_kabupaten','id')->where('id_provinsi',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function store(Request $request)
    {
        $tambah_cust=new \App\Models\Customer;
        #$tambah_cust->id = $request->id;
        $tambah_cust->name = $request->name;
        $tambah_cust->address = $request->address;
        $tambah_cust->no_hp = $request->no_hp;
        $tambah_cust->id_user =Auth::user()->id;
        $tambah_cust->venue = $request->venue;
        $tambah_cust->telp = $request->telp;
        $tambah_cust->IG = $request->IG;
        $tambah_cust->email = $request->email;
        $tambah_cust->jenis_kelamin = $request->jenis_kelamin;
        $tambah_cust->umur = $request->umur;
        $tambah_cust->pekerjaan = $request->pekerjaan;
        $tambah_cust->merk_rokok = $request->merk_rokok;
    
        $tambah_cust->alasan = $request->alasan;
        $tambah_cust->jml_beli = $request->jml_beli;
 
        $tambah_cust->save();
        Alert::success('Pesan','Data berhasil disimpan');
        return redirect ('/customer');
    }

	public function edit ($id)
    {
        $cust_edit=\App\Models\Customer::findorFail($id);
        return view ('customer.editCustomer', ['customer'=> $cust_edit]);

    }
    public function update (Request $request, $id)
    {
        $cust= \App\Models\Customer::findorFail($id);
        $cust->name = $request-> get ('name');
        $cust->area = $request-> get ('area');
        $cust->rayon = $request-> get ('rayon');
        $cust->created_at = $request-> get ('created_at');
        $cust->kab = $request->get ('kab');
        $cust->IG = $request->get ('IG');
        $cust->email = $request->get ('email');
        $cust->venue = $request->get ('venue');
        $cust->telp = $request->get ('telp');
        $cust->jenis_kelamin = $request->get ('jenis_kelamin');
        $cust->umur = $request->get ('umur');
        $cust->rasadip = $request->get ('rasadip');

        $cust->hargadip = $request->get ('hargadip');
        $cust->akanbeli = $request->get ('akanbeli');
        $cust->alasan = $request->get ('alasan');
        $cust->open = $request->get ('open');
        $cust->kemasan = $request->get ('kemasan');
        $cust->tempatbeli = $request->get ('tempatbeli');
        $cust->pekerjaan = $request->get ('pekerjaan');
        $cust->rokok = $request->get ('rokok');
        $cust->jml_beli = $request->get ('jml_beli');
        $cust -> save();

        return redirect ('/customer');

    }
    
    public function destroy($id)
    {
        $hapus= \App\Models\Customer::findorFail($id);
        $hapus->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('customer');
    }

}
