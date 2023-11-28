@extends('layouts.layouts')
@section('content')
@include('sweetalert::alert')
<div class="container-fluid px-4">
<h1 class="mt-4">Rayon Report</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Report All Female Presenter</li>
            </ol>
<hr>
<form id="dailyreport-form" method="POST" action="{{ route('reportsalesall.penjualan') }}">
    @csrf 
    <div class="card mb-2">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-table me-1"></i>
            Laporan dari Sales
        </div>

        <div class="card-body">
            <div class="row g-2 bg-white">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="rayon" id="rayon" onchange="loadData()">
                            <option value="">Please select</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Gunung Kidul">Gunung Kidul</option>
                            <option value="Bantul">Bantul</option>
                            <option value="Kulon Progo">Kulon Progo</option>
                            <option value="Sleman">Sleman</option>
                        </select>
                        <label class="font-weight-bold" for="rayon">Rayon</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="namasales" id="namasales" onchange="loadData()">
                            <option value="">Please select</option>
                            @foreach($orang as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <label class="font-weight-bold" for="namasales">Nama Sales</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>



<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="datatablesSimple" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
    <thead class="thead-dark">
        <tr>
            <th>Tgl</th>
            <th>Rayon</th>
            <th>Nama Sales</th>
            <th>CC</th>
            <th>ECC</th>
            
        </tr>
        </thead>
        <tbody>
        @foreach($customer as $cust)
        <tr>
            <td>{{ $cust->created_date}}</td>
            <td>{{ $cust->rayon}}</td>
            <td>{{ $cust->namasales}}</td>
            <td>{{ $cust->CC}}</td>
            <td>{{ $cust->ECC}}</td>
           
            
        </tr>
    @endforeach
    </tbody>
        <tfoot class="table-dark">
        @php
            $total_cc = 0;
            $total_ecc = 0;
            foreach ($customer as $cust) {
                $total_cc += $cust->CC;
                $total_ecc += $cust->ECC;
            }
        @endphp
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>{{ $total_cc }}</strong></td>
            <td><strong>{{ $total_ecc }}</strong></td>
        </tr>
    </tfoot>
    </table>
</div>
</div>
</div>

<script>
function loadData() {
    // Get the selected area and sales name
    var area = document.getElementById("area").value;
    var namasales = document.getElementById("namasales").value;

    // Send an AJAX request to the controller to fetch the data
    $.ajax({
        url: "{{ route('reportsalesall.penjualan') }}",
        type: "POST",
        data: {
            area: area,
            namasales: namasales,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Clear the table body
            $("#penjualan-table tbody").empty();

            // Iterate through the response data and append it to the table
            $.each(response, function(index, data) {
                var row = $("<tr>");
                $("<td>").text(data.namasales).appendTo(row);
                $("<td>").text(data.created_date).appendTo(row);
                $("<td>").text(data.CC).appendTo(row);
                $("<td>").text(data.ECC).appendTo(row);
                $("#penjualan-table tbody").append(row);
            });

            $("#penjualan-table").show();
        },

        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


</script>




@endsection
