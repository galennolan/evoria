@extends('layouts.layouts')

@section('content')
    @include('sweetalert::alert')
    <main>
    <div class="container-fluid px-4">
    <h1 class="mt-4">Daily Report All</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Female Presenter {{ Auth::user()->name }} {{ Auth::user()->tim }} {{ $zz }}</li>
            </ol>
        
    </div>
    <hr>

    <form id="dailyreport-form" method="POST" action="{{ route('dailyreportall.penjualan') }}">
        @csrf
        <div class="card mb-2">
        <div class="card-header bg-primary text-white">
                        <i class="fas fa-table me-1"></i>
                        Laporan dari Sales
                    </div>

                    <div class="card-body">
                    <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                <select class="form-control" name="area" id="area" required>
                                    <option value="">Please select</option>
                                    @foreach(['Semarang', 'Solo', 'Yogyakarta'] as $areaOption)
                                        <option value="{{ $areaOption }}" {{ $area == $areaOption ? 'selected' : '' }}>
                                            {{ $areaOption }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="font-weight-bold" for="exampleFormControlSelect1">Area</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                <select class="form-control" name="namasales" id="namasales" required>
                                    <option value="">Please select</option>
                                    @foreach($orang as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <label class="font-weight-bold" for="exampleFormControlSelect1">Nama Sales</label>
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
            <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
        </div>
    </form>



        <div class="row">
                    <div class="col-md-12 mb-3">
                      <div class="card h-100">
                        <canvas class="chart" id="eccCcChart" width="900" height="200"></canvas>
                      </div>
                    </div>
        </div>
                  

<div class="d-sm-flex align-items-center justify-content-between mb-4">

<div class="card-body">
    
<div class="card-header ">
                        <i class="fas fa-table me-1"></i>
                        Report
                    </div>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="datatablesimple" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
    <thead class="thead-dark">
        <tr>
            <th>Tgl</th>
            <th>Nama Sales</th>
            <th>Area</th>
            <th>CC <small  style="font-size: 10px"> Target {{$targetcc}} </small></th>
            <th>ECC<small  style="font-size: 10px"> Target {{$targetecc}}</small></th></th>
            <th>Pack Selling<small  style="font-size: 10px"> Target {{$targetps}}</small></th></th>
            
        </tr>
        </thead>
        <tbody>
        @foreach($customer as $cust)
        <tr>
            <td>{{ $cust->created_date}}</td>
            <td>{{ $cust->namasales}}</td>
            <td>{{$cust->area }}</td>
            <td>
            @if ($cust->CC < $targetcc )
                <i class="fas fa-arrow-down text-danger"></i>
            @elseif ($cust->CC == $targetcc )
                    <i class="fas fa-check text-success"></i>
             @else
                    <i class="fas fa-arrow-up text-success"></i>
            @endif
            {{ $cust->CC }}
            </td>
            <td>@if ($cust->ECC < 120)
                <i class="fas fa-arrow-down text-danger"></i>
            @elseif ($cust->ECC == 120)
                    <i class="fas fa-check text-success"></i>
             @else
                    <i class="fas fa-arrow-up text-success"></i>
            @endif
            {{ $cust->ECC }}</td>
            <td>@if ($cust->packsell < 120)
                <i class="fas fa-arrow-down text-danger"></i>
            @elseif ($cust->packsell == 120)
                    <i class="fas fa-check text-success"></i>
             @else
                    <i class="fas fa-arrow-up text-success"></i>
            @endif
            {{ $cust->packsell }}</td>
           
            
        </tr>
    @endforeach
    </tbody>
        <tfoot class="table-dark">
        @php
            $total_cc = 0;
            $total_ecc = 0;
            $total_pack = 0;
            foreach ($customer as $cust) {
                $total_cc += $cust->CC;
                $total_ecc += $cust->ECC;
                $total_pack += $cust->packsell;
            }
        @endphp
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>{{ $total_cc }}</strong></td>
            <td><strong>{{ $total_ecc }}</strong></td>
            <td><strong>{{ $total_pack }}</strong></td>
        </tr>
    </tfoot>
    </table>
</div>
</div>
</div>

                    <div class="row ">
                    <div class="col-md-6 mb-3">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        ECC (Efektivitas Customer Contact)
                    </div>

                      <div class="card-body">
                      
                      <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="dataTable2" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
                            <thead class="thead-dark">
                                <tr>
                                <th>Day</th>
                                <th>Nama Sales</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total =0;
                                    $total_achievement = 0; 
                                    // Initialize a variable to hold the total achievement
                                    $total_percentage = 0; // Initialize a variable to hold the total percentage
                                @endphp
                                @foreach($customer as $cust)
                                <tr>
                                <td>{{ $cust->created_date}}</td>
                                <td>{{ $cust->namasales}}</td>
                                <td>{{$targetecc}}</td>
                                <td>@if ($cust->ECC < $targetecc)
                                    <i class="fas fa-arrow-down text-danger"></i>
                                @elseif ($cust->ECC == $targetecc)
                                        <i class="fas fa-check text-success"></i>
                                @else
                                        <i class="fas fa-arrow-up text-success"></i>
                                @endif
                                {{ $cust->ECC }}</td>
                                <td>
                                    {{ round(( $cust->ECC / $targetecc) * 100) }}%

                                </td>
                               
                                </tr>
                                @php
                                    $total += $targetecc;
                                    $total_achievement += $cust->ECC; // Add the current achievement to the total
                                    $total_percentage += ($cust->ECC / $targetecc) * 100; // Add the current percentage to the total
                                @endphp
                            @endforeach
                            
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                <td colspan="2"><strong>Total:</strong></td>
         
                                <th>{{$total}}</th>
                
                                <th>{{ $total_achievement }}</th>
                                <th>
                                    <!-- {{  round($total_percentage)}}% -->

                                 </th>
                          
                                </tr>
                            </tfoot>
                            </tbody>
                            </table>
                        </div>
                  </div>
                      </div>
                      <div class="col-md-6 mb-3">
                      <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        CC (Customer Contact)
                    </div>
                      <div class="card-body ">
                        
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
                            <thead class="thead-dark">
                                <tr>
                                <th>Day</th>
                                <th>Nama Sales</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                     $totalcc =0;
                                    $total_achievement = 0; 
                                    // Initialize a variable to hold the total achievement
                                    $total_percentage = 0; // Initialize a variable to hold the total percentage
                                @endphp
                                @foreach($customer as $cust)
                                <tr>
                                <td>{{ $cust->created_date}}</td>
                                <td>{{ $cust->namasales}}</td>
                                <td>{{$targetcc}}</td>
                                <td>@if ($cust->CC < $targetcc)
                                    <i class="fas fa-arrow-down text-danger"></i>
                                @elseif ($cust->CC == $targetcc)
                                        <i class="fas fa-check text-success"></i>
                                @else
                                        <i class="fas fa-arrow-up text-success"></i>
                                @endif
                                {{ $cust->CC }}</td>
                                <td>
                                    {{ round(( $cust->CC / $targetcc) * 100) }}%
                                </td>
                               
                                </tr>
                                @php
                                    $totalcc +=$targetcc;
                                    $total_achievement += $cust->CC; // Add the current achievement to the total
                                    $total_percentage += ($cust->CC / $targetcc) * 100; // Add the current percentage to the total
                                @endphp
                            @endforeach
                            
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                <td colspan="2"><strong>Total:</strong></td>
                                <th>{{$totalcc}}</th>
                                
                                <th>{{ $total_achievement }}</th>
                                <th>
                                    <!-- {{ round($total_percentage) }}% -->

                                 </th>
                          
                                </tr>
                            </tfoot>
                            </tbody>
                            </table>
                        </div>
   
                  </div>
                  
                    </div>
                       <!-- //table paling bawah                -->
                       <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card-body">
                    <label class="control-label font-weight-bold" for="inputTableName">Pack Selling</label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable4" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
                        <thead class="thead-dark">
                            <tr>
                                <th>Day</th>
                                <th>Nama Sales</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $cust)
                            <tr>
                                <td>{{ $cust->created_date}}</td>
                                <td>{{ $cust->namasales}}</td>
                                <td>
                               {{$targetps}}
                                </td>
                              
                                <td>@if ($cust->packsell < $targetps)
                                    <i class="fas fa-arrow-down text-danger"></i>
                                @elseif ($cust->packsell == $targetps)
                                        <i class="fas fa-check text-success"></i>
                                @else
                                        <i class="fas fa-arrow-up text-success"></i>
                                @endif
                                {{ $cust->packsell }}</td>
                                <td>{{ round(( $cust->packsell / $targetps) * 100) }}%</td>
                              
                                
                            </tr>
                        @endforeach
                        </tbody>
                            <tfoot class="table-dark">
                            @php
                       
                                $total_pack = 0;
                                $total_percentage=0;
                                $total_target=0;
                                foreach ($customer as $cust) {
                                   $total_target += $targetps;
                                    $total_pack += $cust->packsell;
                                    $total_percentage += ($total_pack / $total_target) * 100;
                                }
                            @endphp
                            <tr>
                                <td colspan="2"><strong>Total:</strong></td>
                                <td><strong>{{ $total_target }}</strong></td>
                                <td><strong>{{ $total_pack }}</strong></td>
                                <td><strong>
                                <!-- {{ round($total_percentage) }}% -->
                                </strong></td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>    

function createTable(responseData) {
  // Clear the table body
  $("#penjualan-table tbody").empty();

  // Create a table header row
  var headerRow = $("<tr>");
  $("<th>").text("Sales Name").appendTo(headerRow);
  $("<th>").text("Date").appendTo(headerRow);
  $("<th>").text("Number of Customers").appendTo(headerRow);
  $("<th>").text("Total Sales").appendTo(headerRow);
  $("#penjualan-table thead").html(headerRow);

  // Iterate through the response data and append it to the table
  $.each(responseData, function(index, data) {
    var row = $("<tr>");
    $("<td>").text(data.namasales).appendTo(row);
    $("<td>").text(data.created_date).appendTo(row);
    $("<td>").text(data.CC).appendTo(row);
    $("<td>").text(data.ECC).appendTo(row);
    $("#penjualan-table tbody").append(row);
  });

  $("#penjualan-table").show();
  console.log(ccData);
}
function fetchData() {
  // Get the selected area and date range
  var area = document.getElementById("area").value;
  var startDate = document.getElementById("tanggalawal").value;
  var endDate = document.getElementById("tanggalakhir").value;

  console.log({ area: area, tanggalawal: startDate, tanggalakhir: endDate });

  // Send an AJAX request to the controller to fetch the data
  $.ajax({
    url: "{{ route('reportefektivitas.penjualan') }}",
    type: "POST",
    data: {
      area: area,
      tanggalawal: startDate,
      tanggalakhir: endDate,
      _token: "{{ csrf_token() }}"
    },
    dataType: "json",
    success: function (response) {
      // Extract the chart data from the response

      var customerData = response.customerData;


      // Use the customer data to populate the table
      createTable(customerData);
    },
    error: function (response) {
      console.log(response.responseText);
    }
  });
}

</script>

<script>
    const ccData = {!! $ccData !!};
const eccData = {!! $eccData !!};
const packData = {!! $packData !!};
const createdDate = {!! $createdDate !!};


const data = {
    labels: createdDate,
    datasets: [{
        label: 'CC',
        data: ccData,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }, {
        label: 'ECC',
        data: eccData,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }, {
        label: 'Pack Selling',
        data: packData,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

const options = {
  animation: {
    duration: 1000,
    easing: 'easeInOutQuad'
  },
  maintainAspectRatio: false,
    scales: {
        yAxes: [{
          
            ticks: {
              suggestedMin: 0, // start at zero
                beginAtZero: true
            },
        }]
    },

    legend: {
        display: true,
        position: 'bottom'
    }
};

const eccCcChart = new Chart(document.getElementById('eccCcChart'), {
    type: 'bar',
    data: data,
    options: options
});

</script>




@endsection
