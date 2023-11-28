<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Customer extends Model
{
    
    
    protected $table = "customer";
    protected $fillable=['area','rayon','name','telp','id_user','kab','venue','jenis_kelamin','umur','pekerjaan','rokok','jml_beli','tempatbeli','alasan','akanbeli','hargadip','rasadip','IG','email','kemasan','open'];

    
}
