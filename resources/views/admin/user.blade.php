@extends('layouts.layouts')
@section('content')
@include('sweetalert::alert')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen SDM Pixel</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }} {{ Auth::user()->tim }} </li>
            </ol>
<hr>


<div class="card">
    <div class="card-body">
        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
        </a>
    </div>

<div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Data SDM Pixel 
                </div>
    <div class="card-body">
   
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="datatable" width="20%" cellspacing="0" style="font-size: 12px; width: 100%; color:black">
                <thead>
                    <tr align="center">
                        <th width="2%">No</th>
                        <th width="4%">User</th>
                        <th width="4%">Area</th>
                        <th width="4%">Tim</th>
                        <th width="4%">Role</th>
                        <th width="4%">TIm Leader</th>
                        <th width="20%">Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td style="text-align:center">{{$row->area}}</td>

                        <td>{{$row->tim}} </td>
                        
                        <td>
                     
                        @if($row->hasRole('admin'))
                            <i class="fas fa-user-tie" style="color: #ff0000; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @elseif($row->hasRole('adminarea'))
                        <i class="fas fa-user" style="color: #fffffff; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @elseif($row->hasRole('TL'))
                        <i class="fas fa-user-friends" style="color: #5cb85c; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @else
                        @foreach ($row->roles as $r)
                        {{ $r->name === 'user' ? 'SPG' : $r->name }}
                        @endforeach
                        @endif
                        </td>
                        
                        <td>{{$row->teamleader}}
                        @if($row->hasRole('admin')||$row->hasRole('adminarea')||$row->hasRole('TL'))
                            <i class="fas fa-window-close" style="color: #0275d8; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @endif
                        </td>
                       
                        <td align="center">
                            <a href="{{route( 'admin.edit',[$row->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                <i class="fas fa-edit fa-sm text-white-50"></i>
                            </a>
                            @if($row->hasRole('user'))
                            <a href="/admin/hapus/{{ $row->id }}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                <i class="fas fa-trash-alt fa-sm text-white-50"></i> 
                            </a>    @endif
                        </td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#roles').change(function() {
            var selectedRole = $(this).val();
            if (selectedRole === 'USER') {
                $('#nama-team-group').show();
                $('#tim-lbl').show();
                $('#tim-lbl2').hide();
            } else {
                $('#nama-team-group').hide();
                $('#tim-lbl').hide();
                $('#tim-lbl2').show();
            }
        });
    });
</script>
