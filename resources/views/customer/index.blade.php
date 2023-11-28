@extends('layouts.layouts')
@section('content')
@include('sweetalert::alert')
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Customer </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a>Dashboard</a></li>
        <li class="breadcrumb-item active">Sales Reports </li>
    </ol>
</div>

<hr>

@if(!auth()->user()->hasRole('admin'))
    <div class="card-header py-3" align="right">
        <a href="{{ route('sales.index') }}" class="btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
        </a>
    </div>
@endif


    <div class="card mb-2">
        <div class="card-header d-flex justify-content-between bg-primary text-white align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Customer 3 Hari Terakhir
            </div>
    
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Cust</th>
                            <th>No Hp</th>
                            <th>Sales</th>
                            <th>Jenis Kelamin</th>
                            @if(!auth()->user()->hasRole('user'))
                                <th>Ubah</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $cust)
                            <tr>
                                <td>{{ date('d/m/y', strtotime($cust->created_at)) }}</td>
                                <td>{{ $cust->namacust}}</td>
                                <td>{{ $cust->telp}}</td>
                                <td>{{ $cust->namasales}}</td>
                                <td>{{ $cust->jenis_kelamin}}</td>
                                @if(!auth()->user()->hasRole('user'))
                                    <td align="center">
                                        <a href="{{ route('customer.edit', [$cust->idcust]) }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/customer/hapus/{{ $cust->idcust }}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> 
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </main>




@endsection
