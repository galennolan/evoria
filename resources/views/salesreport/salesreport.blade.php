@extends('layouts.layouts')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Customer</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a ">Dashboard</a></li>
                <li class="breadcrumb-item active">Sales Reports</li>
            </ol>

            <form id="dailyreport-form" method="GET" action="{{ route('salesreport.penjualan') }}">
                @csrf

                <div class="card mb-2">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-table me-1"></i>
                        Laporan dari Sales
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control" name="area" id="area">
                                        <option value="" selected>Please select</option>
                                        @foreach(['Semarang', 'Solo', 'Yogyakarta'] as $areaOption)
                                            <option value="{{ $areaOption }}" {{ $area == $areaOption ? 'selected' : '' }}>
                                                {{ $areaOption }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="font-weight-bold" for="area">Area</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="date" min="1" name="tanggalawal" id="tanggalawal" class="form-control" required>
                                    <label for="tanggalawal">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="date" min="1" name="tanggalakhir" id="tanggalakhir" class="form-control" required>
                                    <label for="tanggalakhir">Tanggal Selesai</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="submit-btn" type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('salesreport.export', ['area' => request()->input('area'), 'tanggalawal' => request()->input('tanggalawal'), 'tanggalakhir' => request()->input('tanggalakhir')]) }}"
                              class="btn btn-success">Export to Excel</a>
                        </div>
                    </div>
                </div>

                
            </form>

            <div class="col">
            <div class="card mb-2">
            <div class="card-header bg-primary text-white">
                        <i class="fas fa-table me-1"></i>
                        Laporan dari Sales
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: xx-small; width: 100%; color:black">
                            <thead class="thead-dark">
                                <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Area</th>
                                <th>Rayon</th>
                                <th>Kab/Kec</th>
                                <th>Venue</th>
                                <th>Female Presenter</th>
                                <th>Team Leader</th>
                                <th>Nama Pelanggan</th>
                                <th>Telp</th>
                                <th>Gender</th>
                                <th>Umur</th>
                                <th>Pekerjaan</th>
                                <th>Rokok yg dikonsumsi</th>
                                <th>Pack</th>
                                <th>Open Teartape</th>
                                <th>Rasa</th>
                                <th>Harga Diplomat</th>
                                <th>Kemasan Diplomat</th>
                                <th>Tempat Beli</th>
                                <th>Beli Lagi</th>
                                <th>Alasan Beli Lagi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer as $data)
                                    <tr>
                                    <td>{{ $data->row_number }}</td>
                                    <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ $data->area }}</td>
                                    <td>{{ $data->rayon }}</td>
                                    <td>{{ $data->kab }}</td>
                                    <td>{{ $data->venue }}</td>
                                    <td>{{ $data->namasales}}</td>
                                    <td>{{ $data->teamleader}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->telp }}</td>
                                    <td>{{ $data->jenis_kelamin }}</td>
                                    <td>{{ $data->umur }}</td>
                                    <td>{{ $data->pekerjaan }}</td>
                                    <td>{{ $data->rokok }}</td>
                                    <td>{{ $data->jml_beli }}</td>
                                    <td>{{$data->open }}</td>

                                    <td>{{ $data->rasadip }}</td>
                                    <td>{{ $data->hargadip  == 0 ? 'Mahal' : 'Terjangkau'}}</td>
                                    <td>{{ $data->kemasan }}</td>   
                                    <td>{{ $data->tempatbeli }}</td>             
                                    <td>{{ $data->akanbeli == 0 ? 'Tidak' : 'Ya' }}</td>
                                    <td>{{ $data->alasan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $customer->appends(request()->except('page'))->links('vendor.sb') }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
