<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Female Presenter EVO</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link defer href="https://tampilandiplomat.vercel.app/css/styles.css" rel="stylesheet" />
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
        <script  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{route('home')}}"><img src="{{asset('asset/img/logo.png')}}" alt="Logo" height="30" class="d-inline-block align-text-top">
                eVORIA</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                    </a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{route('home')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>                            
                            <div class="sb-sidenav-menu-heading">Menu Utama</div>
                            @role('user')
                            <a class="nav-link" href="{{route('customer')}}">
                                <div class="sb-nav-link-icon"><i class="far fa-address-card"></i></div>
                                 Customer
                            </a>
                            @endrole
                            @hasanyrole('user')
                            <a class="nav-link" href="{{route('sales.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-archive"></i></div>
                                Customer Contact
                            </a>
                            <a class="nav-link" href="{{route('dailyreport')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Daily Report 
                            </a>
                            @endhasanyrole

                            @hasanyrole('admin|TL|adminarea')
                            <a class="nav-link" href="{{route('salesreport')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Sales Report
                            </a>
                            <a class="nav-link" href="{{route('dailyreportall')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Daily Report All
                            </a>
                            @endhasanyrole
                            
                            @role('admin')
                            <a class="nav-link" href="{{route('reportefektivitas')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-poll"></i></div>
                                SPG Team Report
                            </a>
                            <a class="nav-link" href="{{route('customerreport')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                                Customer Report
                            </a>
                            <a class="nav-link" href="{{route('reportsalesall')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                                Report per Rayon
                            </a>
                            @endrole

                            @hasanyrole('admin|adminarea')
                            <a class="nav-link" href="{{route('admin.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-nib"></i></div>
                                ADMIN
                            </a>
                            @endhasanyrole
   
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login Sebagai:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    

                    <!-- DataTales Example -->
                    <!-- Page Heading -->
                    @yield('content')

                    
                    </div> 
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Pixel Marketing Team 2023</div>
                            <div class="text-muted">
                                <a > Senyum adalah senjata terbaik </a>
                                &middot;
  
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://tampilandiplomat.vercel.app/js/scripts.js"></script>
        
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script defer src="https://tampilandiplomat.vercel.app/assets/demo/chart-area-demo.js"></script>
        <script defer src="https://tampilandiplomat.vercel.app/assets/demo/chart-bar-demo.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="https://tampilandiplomat.vercel.app/js/datatables-simple-demo.js"></script>
    </body>
</html>