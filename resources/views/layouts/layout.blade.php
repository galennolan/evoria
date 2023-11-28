
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pixel Diplomat</title>

    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon"/>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{ asset('asset/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- RawGit CDN chart.css -->
    <link rel="stylesheet" href="https://cdn.rawgit.com/theus/chart.css/v1.0.0/dist/chart.css" />
  
    <style>
		.navbar .nav-item .active {
			color: black !important;
		}
	</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="{{route('home')}}"><div class="sidebar-brand-icon rotate-n-0">
                    <img src="{{asset('asset/img/pixel-putih.png')}}" width="60">
                </div></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs">
                    @role('user|admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('customer')}}"><small>Customer</small></a>                     
                    </li>
                    @endrole

                    @hasanyrole('user|TL')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('sales.index')}}"><small>Sales<br> Report SPG</small></a>                     
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('dailyreport')}}"><small>Daily Report</small></a>                     
                    </li>
                    @endhasanyrole

                    @hasanyrole('admin|adminarea')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('salesreport')}}"><small>Sales <br>Report</small></a>                     
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('dailyreportall')}}"><small>Daily Report<br> All</small></a>                     
                    </li>
                    @endhasanyrole
                    
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('reportefektivitas')}}"><small>SPG<br> Team Report</small></a>                     
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('customerreport')}}"><small>Customer<br> Report</small></a>                     
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('reportsalesall')}}"><small>Report<br> per Rayon</small></a>                     
                    </li>
                    @endrole

                    @hasanyrole('admin|TL')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('admin.index')}}"><small>ADMIN</small></a>                     
                    </li>  
                    @endhasanyrole
                </ul>
                </div>
                <ul class="navbar-nav ml-auto">
                   
                       
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{asset('asset/img/image2.png')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModals">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

            </nav>


                    <!-- Topbar Search -->
               

                    <!-- Topbar Navbar -->
\
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Diplomat MILD Marketing Team</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar aplikasi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" apabila ingin keluar aplikasi</div>
                <div class="modal-footer">
                  <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
 <script src="asset/vendor/chart.js/Chart.min.js"></script> 
    <script src="asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="asset/js/demo/chart-area-demo.js"></script>
    <script src="asset/js/demo/chart-pie-demo.js"></script>
    <script src="asset/js/demo/datatables-demo.js"></script>


    <script>
    $(document).ready(function() {
        // Get the current URL without any parameters
        var currentUrl = window.location.href.split("?")[0];
        
        // Set the active class on the appropriate link based on the current URL
        $('ul.nav-tabs a[href="' + currentUrl + '"]').addClass('active');
        
        // Remove active class from home link if the current page is not the home page
        if (currentUrl !== "{{ route('home') }}") {
            $('ul.nav-tabs a[href="{{ route('home') }}"]').removeClass('active');
        }
    });
    
    // Set the color of the active link to blue
    $('ul.nav-tabs a.active').css('color', 'black');
</script>



</body>

</html>