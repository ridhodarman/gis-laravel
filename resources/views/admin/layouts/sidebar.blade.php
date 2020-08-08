<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 09</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/preloader/default-css.css">
    <link rel="stylesheet" href="assets/preloader/responsive.css">
    <style>
        @font-face {
            font-family: Poppins;
            src: url('{{ url("assets/fonts/Poppins-Regular.ttf") }}');
        }
    </style>
    <link rel="stylesheet" href="assets/admin/css/style.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
     -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style2.css">

    <link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.css">
    <link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.min.css">
    <script type="text/javascript" src="assets/fontawesome-free-5.6.3-web/js/all.js"></script>
    <script type="text/javascript" src="assets/fontawesome-free-5.6.3-web/js/all.min.js"></script>

    <link rel="stylesheet" href="assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="assets/alertify/lib/alertify.min.js"></script>

    <style>
        .tombol-atas {
            width: 90%;
            border-color: #e8e8e8;
        }

        .tombol-sidebar {
            opacity: 0.6;
            font-weight: lighter;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tombol-sidebar:hover {
            opacity: 1;
        }
    </style>

</head>

<body style="background-color:#fafafa;">
    <div id="preloader">
        <div class="wrapper">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
        <h1 style="font-size: 200%">Loading&hellip;</h1>
    </div>

    <div class="wrapper2 d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">

                </button>
            </div>
            <div class="img bg-wrap text-center py-4" style="background-image: url(assets/admin/images/bg_1.jpg);">
                <div class="user-logo">
                    <div class="img" style="background-image: url(assets/admin/images/user.png);"></div>
                    <h3>{{ Auth::user()->name }}</h3>
                    <a href="{{ route('index') }}" target="_blank" class="tombol-sidebar">
                        <span class="badge btn-primary"><i class="fas fa-solar-panel"></i> User Page</span>
                    </a>
                    <a href="#" class="tombol-sidebar">
                        <span class="badge btn-warning"><i class="fas fa-user-cog"></i> Setting</span>
                    </a>
                    <a href="#" class="tombol-sidebar">
                        <span class="badge badge-secondary"><i class="fas fa-sign-out-alt"></i> Logout</span>
                    </a>
                </div>
            </div>
            <ul class="list-unstyled components mb-5">
                <li id="databangunan">
                    <a href="{{ route('bangunan') }}">
                        <i class="fas fa-city mr-3"></i> Manage Building Data
                    </a>
                </li>
                <li id="keluarga">
                    <a href="keluarga">
                        <i class="fas fa-user-friends mr-3"></i><span style="font-size: 94%;">Manage Population
                            Data&emsp;</span>
                    </a>
                </li>
                <li id="datuk">
                    <a href="datuk">
                        <i class="ti-pie-chart mr-3"></i><span style="font-size: 94%;">Manage Datuk & Tribe Data</span>
                    </a>
                </li>
                <li id="aksessuper">
                    <a href="user" aria-expanded="true">
                        <i class="fas fa-users-cog mr-3"></i><span>Manage Admin Nagari</span>
                    </a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5 mb-3">
            @yield('content')
        </div>
        <style>
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 150%;
                height: 40px;
                color: black;
                text-align: center;
                z-index: -1;
                margin-left: -300px;
            }
        </style>
        <div class="mt-5">
            <div class="footer">
                <p style="padding-left: 150px; color: gray;">
                    © Ridho Darman | Jurusan Sistem Informasi Universitas Andalas 2019.
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>

    <script src="assets/admin/js/popper.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/main.js"></script>
    <!-- bootstrap 4 js -->


    <!-- <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
     -->
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/preloader/plugins.js"></script>
    <script src="assets/preloader/scripts.js"></script>
</body>

</html>