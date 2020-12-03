<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>@yield('title')</title>
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
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        /* .tombol-atas {
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
        } */

        .kapital {
            text-transform:capitalize;
        }
    
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            }
            .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid rgb(236, 246, 255);
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: rgb(216, 241, 255) transparent transparent transparent;
            }
            .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
            }
            .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
            }
            .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
            }
            @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        function escapeHtml(unsafe) {
            return unsafe
                .replace("&amp;", `&`)
                .replace("&lt;", `<`)
                .replace("&gt;", `>`)
                .replace("&quot;", `"`)
                .replace("&#039;", `'`);
        }
    </script>
    @livewireStyles
  </head>
  <body style="background-color:#fafafa;">
    
    <div id="preloader" style="opacity: 0.2;">
        <div class="wrapper" style="z-index: 100; min-width: 500px;">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
        <h1 style="font-size: 150%; margin-top: -50px;">Loading&hellip;</h1>
    </div>

    <div id="loading-data" class="wrapper" style="z-index: 99; position: absolute; visibility: hidden;">
        <div class="lds-ring"><div></div><div></div><div></div></div>
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
                    <a href="{{ route('keluarga') }}">
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

    <div class="modal fade" id="sukses">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: green"><i class="fa fa-check"></i></p>
                                <p id="pesan-sukses"></p>
                            </div>
                            <br/>
                            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="warning">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-sm" style="width: 200%">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                                <p id="pesan-warning"></p>
                            </div>
                            <br/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sukses-hapus">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: green"><i class="fas fa-calendar-check"></i></p>
                                <p id="pesan-hapus"></p>
                            </div>
                            <br/>
                            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @livewireScripts

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

<div wire:loading>
    <script>
        $('#preloader').show();
        $(':button').prop('disabled', true);
        $(document).ready(function () {
            $('#preloader').hide();
        });
    </script>
</div>
<div wire:loading.table>...
    <script>
        $('#preloader').hide();
        document.getElementById("loading-data").style.visibility = "visible"; 
    </script>
</div>
<script>
    $( document ).on('turbolinks:load', function() {
        $(':button').prop('disabled', false);
        document.getElementById("loading-data").style.visibility = "hidden"; 
    })
</script>