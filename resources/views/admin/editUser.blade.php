@extends('layouts.layouts')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Management SDM</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a>Dashboard</a></li>
        <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }} {{ Auth::user()->tim }} </li>
    </ol>

    <form action="{{ route('admin.update', [$user->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <fieldset>
            <div class="card mb-2">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Ubah Akses User
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" type="text" name="kode" value="{{ $user->id }}" readonly>
                                <label for="kode">Kode User</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input id="name" type="text" name="uname" class="form-control" value="{{ $user->name }}" readonly>
                                <label for="user">Nama User</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input id="email" type="text" name="email" class="form-control" value="{{ $user->email }}" >
                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input id="password" type="password"  name="password" class="form-control" required>
                                <label for="Password">Password User</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                @foreach ($user->roles as $role)
                                    <input id="akses" type="text" name="akses" class="form-control" value="{{ $role->id }}" readonly>
                                    <label for="akses">Akses</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select id="role" name="role" class="form-control" required>
                                @if(Auth::user()->hasAnyRole(['admin', 'adminarea']))

                                    <option value="admin" {{  $role->name  == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="adminarea" {{ $role->name == 'adminarea' ? 'selected' : '' }}>Admin Area</option>
                                    <option value="TL" {{ $role->name == 'TL' ? 'selected' : '' }}>Team Leader</option>
                                    <option value="user" {{ $role->name == 'user' ? 'selected' : '' }}>SPG</option>
                                @elseif(Auth::user()->hasRole('TL'))
                                    <option value="user" {{ $role == '2' ? 'selected' : '' }}>SPG</option>
                                    <option value="TL" {{ $role == '4' ? 'selected' : '' }}>Team Leader</option>
                                @endif
                            </select>
                            <label for="akses">Ubah Akses</label>
                        </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select id="area" name="area" class="form-control" required {{ $role->id == '1' ? 'disabled' : '' }}>
                                    <option value="Solo" {{ $user->area == 'Solo' ? 'selected' : '' }}>Solo</option>
                                    <option value="Yogyakarta" {{ $user->area == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                                    <option value="Semarang" {{ $user->area == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                                </select>
                                <label for="akses">Tentukan Area</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select id="tim" name="tim" class="form-control" required {{ in_array($role->id, [1, 3]) ? 'disabled' : '' }}>
                                    <option value="{{ $user->tim }}" selected>{{ $user->tim }}</option>
                                    <option value="Solo" {{ $user->tim == 'Solo1' ? 'selected' : '' }}>Solo </option>
                                    <option value="Yogyakarta" {{ $user->tim == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta </option>
                                    <option value="Semarang" {{ $user->tim == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                                </select>
                                <label for="akses">Tentukan Tim</label>
                            </div>
                        </div>
                    </div>

                    @if (!in_array($role->id, [1, 3, 4]))
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select id="tl" name="tl" class="form-control" required>
                                        @php
                                            $tl_name = DB::table('users')->select('name')->where('id', $user->tl)->first()->name ?? '';
                                        @endphp
                                        <option value="{{ $user->tl }}">{{ $tl_name }} -{{ $user->tim }}</option>
                                        @foreach($teamleader  as $tl_user)
                                            <option value="{{ $tl_user->id }}">{{ $tl_user->name }} -{{ $tl_user->tim }}</option>
                                        @endforeach
                                    </select>
                                    <label for="akses">Tim Leader</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-send">Ubah Akses</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-danger btn-send">Kembali</a>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <hr>
</div>
@endsection
