@extends('layouts.layouts')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Management SDM</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a>Dashboard</a></li>
        <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }} {{ Auth::user()->tim }} </li>
    </ol>

    <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        <div class="card mb-2">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-table me-1"></i>
                Tambah Data User
            </div>
            <div class="card-body">
  
    @csrf
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    
                    <input type="text" name="username" required class="form-control">
                    <label class="control-label">Nama User</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    
                    <input type="email" name="email" required class="form-control">
                    <label class="control-label">Email User</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    <input id="password" required  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <label class="control-label">Password User</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                    
                    <select id="area" name="area" class="form-control" required>
                        <option value="Solo">Solo</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Semarang">Semarang</option>
                    </select>
                    <label for="akses">Tentukan Area</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    
                    <select id="tim" name="tim" class="form-control" required>
                        <option value="" selected>Pilih Tim</option>
                        <option value="Solo">Solo</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Semarang">Semarang</option>
                    </select>
                    <label for="tim-lbl2">Tentukan Tim</label>
                </div>
            </div>

            <div class="col-md-4">
             <div class="form-floating mb-3 mb-md-0">    
                    
             <select id="roles" name="roles" class="form-control" required>
                    <option value="">--Pilih Roles--</option>
                    @if(Auth::user()->hasRole('TL'))
                        <option value="user">SPG</option>
                    @elseif(Auth::user()->hasAnyRole(['admin', 'adminarea']))
                        <option value="admin">Admin</option>
                        <option value="adminarea">Admin Area</option>
                        <option value="tl">Team Leader</option>
                        <option value="user">SPG</option>
                    @endif
                </select>

                    <label class="control-label">Roles/Akses</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

        </div>
    </form>

    <hr>
</div>
@endsection
