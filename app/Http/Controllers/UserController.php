<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $user = \App\Models\User::select('users.id', 'users.name', 'users.email', 'users.area', 'users.tim', 'c.name AS teamleader')
        ->leftJoin('users AS b', 'b.tl', '=', 'users.id')
        ->leftJoin('users AS c', 'c.id', '=', 'users.tl');

        $usertl = \App\Models\User::select('users.id', 'users.name','users.tim')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'TL','tim');
        })
        ->get();


        $role = Role::findByName('TL');
        if (auth()->user()->hasRole('TL')) {
            $user->where('users.tim', '=', auth()->user()->tim)->whereNotIn('users.id', [1, 3]);
        }elseif(auth()->user()->hasRole('adminarea')) {
            $user->where('users.area', '=', auth()->user()->area)->whereNotIn('users.id', [1]);}
        
        $user = $user->groupBy('users.id')->get();

        return view('admin.user', [
            'user' => $user, 'role' => $role,  'usertl' =>$usertl     ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save_user= new \App\Models\User;
        $save_user->name=$request->get('username');
        $save_user->email=$request->get('email');
        $save_user->password=bcrypt($request->get('password'));//ini dia yang dirubah
        $save_user->area=$request->get('area');
        $save_user->tl=$request->get('tl');
        $save_user->tim=$request->get('tim');
        if($request->get('roles')=='ADMIN'){
            $save_user->assignRole('admin');
        }
        else if ($request->get('roles') == 'adminarea')
        {
            $save_user->assignRole('adminarea');
        }
        else if ($request->get('roles') == 'tl')
        {
            $save_user->assignRole('tl');
        }
        else 
        {
            $save_user->assignRole('user');
        }
        
        $save_user->save();
        Alert::success('Tersimpan','Data Berhasil disimpan');
        return redirect()->route('admin.index');
    }
    
        


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = User::find($id);
        return view('admin.user',compact('admin'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUsersWithRole($roleName)
    {
        $teamleader = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', $roleName)
            ->select('users.*')
            ->get();
        return $teamleader;
    }
     public function edit($id)
    {
        $role = Role::findByName('TL');
        $teamleader = $this->getUsersWithRole($role->name);
        $user = User::find($id);
        $peran = $user->roles ;
        $password = $user->password ;
        $roles = Role::pluck('name')->all();
        $userRole = $peran->pluck('name')->all();
        return view ('admin.editUser',compact('teamleader','user','roles','userRole'));

      
    }
  


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('role'));
        $user->area = $request->area;
        $user->tim = $request->tim;
        $user->tl = $request->tl;
        $user->email = $request->email;

        // Check if a new password is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // Alert::success ('Update','Data Berhasil diupdate');
        return redirect()->route('admin.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = \App\Models\User::findOrFail($id);
        $hapus->delete();
        $hapus->removeRole('admin','user');
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('admin.index');
    }
}
