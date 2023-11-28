@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
@if(session('alert'))
    <script>
        Swal.fire({
            title: "{{ session('alert.title') }}",
            text: "{{ session('alert.message') }}",
            icon: "{{ session('alert.type') }}",
            confirmButtonText: "OK"
        });
    </script>
@endif

<div class="container-fluid">

                    <!-- DataTales Example -->
                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                      <h1 class="h2">Daily Report Performance Female Presenter</h1>            
                    </div>
                  <div class="row g-2">

                  <div class="col-md-6 mb-3">
                  <div class="form-floating">
                        <label class="font-weight-bold" for="exampleFormControlSelect1">Area</label>
                        <select class="form-control" name="area" id="area" onchange="loadData()">
                            <option value="all">All</option>
                            <option value="">Please select</option>
                            <option value="Semarang01">Semarang01</option>
                            <option value="Semarang02" >Semarang02</option>
                            <option value="Solo">Solo</option>
                        </select>
                    </div>
                    </div>
             

                    <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <label class="font-weight-bold" for="exampleFormControlSelect1">Female Presenter</label>
                        <select class="form-control" name="user-select" id="user-select">
                        @foreach($user as $user)
                        <option value="{{$user->name}}">{{$user->name}}</option>
                         @endforeach
                        </select>
                    </div>
                    </div>
                  </div>
          
                  <div class="row g-2">
                  <div class="col-md-6 mb-3">
                  <div class="form-floating">
                    <label for="exampleFormControlInput1">Tanggal Mulai</label>
                    <input type="date" min="1" name="tanggalawal" id="tanggalawal" class="form-control"  required >
                    </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="form-floating">
                        <label for="exampleFormControlInput1">Tanggal Selesai</label>
                        <input type="date" min="1" name="tanggalakhir" id="tanggalakhir" class="form-control"  id="exampleFormControlInput1" required >
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <div class="card h-100">
                        <canvas class="chart" id="myChart" width="600" height="200"></canvas>
                      </div>
                    </div>
                    </div>
          
                    <div class="row ">
                    <div class="col-md-6 mb-3">
                      <div class="card-body h-100">
                      <label class="control-label font-weight-bold" for="inputTableName">ECC (Efektivitas Customer Contact)</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered tables-striped" id="dataTable2" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                <th>Day</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                          
                                </tr>
                                </thead>
                                <tbody>
                               
                                  <td>7 Feb</td>
                                  <td>35</td>
                                  <td>109</td>
                                  <td>108%</td>
                                </tr>
                                <tr>
                                  <td>8 Feb</td>
                                  <td>35</td>
                                  <td>111</td>
                                  <td>108%</td>
                                </tr>
                                <tr>
                                  <td>9 Feb</td>
                                  <td>35</td>
                                  <td>100</td>
                                  <td>108%</td>
                                </tr>
                                <tr>
                                  <td>10 Feb</td>
                                  <td>35</td>
                                  <td>99</td>
                                  <td>108%</td>
                                </tr>
                            </tbody>
                            <tfoot class="thead-light">
                                <tr>
                                <th>Day</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                          
                                </tr>
                              </tfoot>
                            </table>
                        </div>
                  </div>
                      </div>
                      <div class="col-md-6 mb-3">
                      <div class="card-body ">
                        
                      <label class="control-label font-weight-bold" for="inputTableName">Pack Selling</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                <th>Day</th>
                                <th>Target</th>
                                <th>Achievement</th>
                                <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $cust)
                                <tr>
                                <td>{{ $cust->address}}</td>
                                <td>{{ $cust->name}}</td>
                                <td>{{ $cust->nama_kabupaten}}</td>
                               
                                </tr>
                            @endforeach
                            
                            </tbody>
                            <tfoot class="thead-light">
                                <tr>
                                <th>Total</th>
                                <th>600</th>
                                <th>679%</th>
                                <th>109%</th>
                          
                                </tr>
                            </tfoot>
                            </tbody>
                            </table>
                        </div>
                  </div>
                    </div>
                  
                    
                  
          
          <script>

            
          var  yValues = <?php echo $idcustomer; ?>;
          var  barColors = [
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(255, 205, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(54, 162, 235, 0.5)',];

                
               
                var userSelect  = document.getElementById('user-select');
                var beginDateInput = document.getElementById('tanggalawal');
                var endDateInput = document.getElementById('tanggalakhir');
                var locationSelect = document.getElementById('area');
                var ctx = document.getElementById('myChart').getContext('2d');
                
                // Define the chart data
                var chartData = {
                    labels: [new Date().toLocaleDateString('en-GB')],
                    datasets: [{
                        label: 'Silahkan pilih dulu',
                        data: [],
                        backgroundColor: barColors,
                    }]
                };
                let hasData = false; // variabel untuk data kalau tidak ada 
                
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: chartData,
                      options: {
                        scales: {
                         yAxes: [{
                              ticks: {
                          beginAtZero: true,
                          stepSize: 1
                      }
                    }]}

                  }});

                //perubahan untuk yValues
                userSelect.addEventListener('change', updateChart);
                locationSelect.addEventListener('change', updateChart);
                beginDateInput.addEventListener('change', updateChart);
                endDateInput.addEventListener('change', updateChart);
                
                function updateChart() {
                console.log(userSelect.value);
                console.log(locationSelect.value); 
                var beginDate = new Date(beginDateInput.value);
                var endDate = new Date(endDateInput.value);

                // Check if the begin date is greater than or equal to the end date
                if (beginDate > endDate) {
                    alert('Tanggal akhir harus lebih besar atau sama dengan tanggal awal');
                    return;
                }
                
                // Send an AJAX request to retrieve the sales data for the selected user
                fetch(`/spgreport/penjualan?nama_user=${userSelect.value}&location=${locationSelect.value === 'all' ? 'all' : locationSelect.value}&tanggalawal=${beginDateInput.value}&tanggalakhir=${endDateInput.value}`)
                  .then(response => {
                    if (!response.ok) {
                      throw new Error(response.statusText);
                      console.log(data);
                    }
                    return response.json();
                  })
                  .then(data => {
                 
                    if (data.labels.length > 0) { // check if there is data

                      // Update the chart with the retrieved sales data
                        console.log(data);
                        console.log(locationSelect.value);
                        console.log(beginDateInput.value);
                        console.log(endDateInput.value);

                        chartData.datasets[0].label = 'Jumlah Customer sales '+userSelect.value;
                        chartData.labels = data.labels;
                        chartData.datasets[0].data = data.data;
                        myChart.update();
                        hasData = true;
                     } else { // if there is no data
                        chartData.datasets[0].label = 'data tidak ada';
                        chartData.labels = [];
                        chartData.datasets[0].data = [];
                        myChart.update();
                        hasData = false;
                     }
                                      
                  })
                  .catch(error => {
                    chartData.datasets[0].label = 'Data tidak ditemukan';
                    chartData.labels = [];
                    chartData.datasets[0].data = [];
                    myChart.update();
                    hasData = false;
                    console.error(error);
                  });
              }
              
              // check if hasData is false and display "data tidak ada"
                Chart.plugins.register({
                  afterDraw: function(chart) {
                    if (!hasData) {
                      var ctx = chart.chart.ctx;
                      ctx.save();
                      ctx.font = "bold 16px Arial";
                      ctx.textAlign = "center";
                      ctx.fillStyle = "red";
                      ctx.fillText("Data tidak ditemukan", chart.chart.width / 2, chart.chart.height / 2);
                      ctx.restore();
                    }
                  }
                });

        
          </script>
          
          

            @endsection