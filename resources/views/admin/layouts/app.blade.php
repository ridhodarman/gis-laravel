<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    @include('inc.head')
</head>

<body>
    <div id="preloader">
          <div class="wrapper">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
          </div>
          <h1 style="font-size: 200%">Loading&hellip;</h1>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('admin.layouts.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div style="position: fixed; z-index: 1; width: 100%">
                <div class="header-area" id="tampilan-header">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="clearfix col-md-3 col-sm-8">
                            <ul class="notification-area pull-right">   
                                <li><button class="btn btn-outline btn-primary" onclick="dashboard()"><i class="ti-direction-alt"></i> Back To Dashboard</button></li>                     
                                <li class="user-name dropdown-toggle" data-toggle="dropdown"><i class="ti-settings"></i>
                                    <div class="dropdown-menu">
                                        <div class="icon-container" onclick="pengaturan()" style="font-size: 90%"><span class="icon-name">&emsp;<i class="fas fa-wrench"></i> Account Setting</span></div>
                                        <div class="icon-container" onclick="logout()" style="font-size: 90%"><span class="icon-name">&emsp;<i class="fas fa-sign-out-alt"></i> Log Out</span></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div style="visibility: hidden; z-index: 0" id="belakang"></div>
            <script type="text/javascript">
                $("#tampilan-header").clone().prependTo("#belakang");

                function pengaturan () {
                     window.location.href="setting/akun.php";
                }

                function logout () {
                     window.location.href="../act/logout.php";
                }
            </script>
            <!-- header area end -->

            <br/>

            <!-- page title area start -->
            <!-- page title area end -->
            
            <div class="main-content-inner">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>          
            </div>
            
            <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>

    <!-- page container area end -->
    <!-- offset area start -->

    <!-- offset area end -->

    @include('layouts.foot')
</body>
</html>