<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <title>@yield('title')</title> -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('inc.head')
    <link rel="stylesheet" href="assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="assets/alertify/lib/alertify.min.js"></script>
    <style>
        .tombol {
            background-color: #fafafa;
        }

        .tombol:hover {
            background-color: #ededed;
        }
    </style>

    <script>
        function reset() {
            $("#toggleCSS").attr("href", "../../assets/alertify/themes/alertify.default.css");
            alertify.set({
                labels: {
                    ok: "OK",
                    cancel: "Cancel"
                },
                delay: 5000,
                buttonReverse: false,
                buttonFocus: "ok"
            });
        }

        $("#geom").on('click', function () {
            reset();
            alertify.alert('<img src="../../inc/poligon.gif" width="150px"><br/>please draw the area with polygon on the map');
            return false;
        });

        function geom2() {
            if (!$("#geojson").is(':checked')) {
                reset();
                alertify.alert(`
                        <img src="../../inc/poligon.gif" width="150px">
                        <br/><b>Please draw a polygon area on the map</b>
                        <br/><font color=blue>or enable GeoJSON input,</font>
                        <font color=gray>example data:</font>
                        <font color=lightgray>MULTIPOLYGON(((
                        <br/>100.11 -0.11,100.22 -0.22,100.33 -0.33)))</font>
                        `);
                return false;
                $(".readonly").on('keydown paste', function (e) {
                    e.preventDefault();
                });
            }
        }

        function geojson2() {
            if ($('#geojson').is(":checked")) {
                $("#geom").attr("readonly", false);
            }
            else {
                $("#geom").attr("readonly", true);
            }
        }

        function capitalize(inputField) {
            inputField.value = inputField.value.replace(/\b[a-z](?=[a-z]{0})/gi, function (letter) {
                return letter.toUpperCase();
            });
        }

        function escapeHtml(unsafe) {
            return unsafe
                .replace('&amp;', "&")
                .replace('&lt;', "<")
                .replace('&gt;', ">")
                .replace('&quot;', "\"")
                .replace('&#039;', "'");
        }
    </script>
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
                                <li><button class="btn btn-outline btn-primary" onclick="location.href = '/';"><i
                                            class="ti-direction-alt"></i> Back To Dashboard</button></li>
                                <li class="user-name dropdown-toggle" data-toggle="dropdown"><i class="ti-settings"></i>
                                    <div class="dropdown-menu">
                                        <div class="icon-container" onclick="pengaturan()" style="font-size: 90%"><span
                                                class="icon-name">&emsp;<i class="fas fa-wrench"></i> Account
                                                Setting</span></div>
                                        <div class="icon-container" onclick="logout()" style="font-size: 90%"><span
                                                class="icon-name">&emsp;<i class="fas fa-sign-out-alt"></i> Log
                                                Out</span></div>
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

                function pengaturan() {
                    window.location.href = "setting/akun.php";
                }

                function logout() {
                    window.location.href = "../act/logout.php";
                }
            </script>
            <!-- header area end -->

            <br />

            <!-- page title area start -->
            <!-- page title area end -->

            <div class="main-content-inner">
                <div class="card" id="konten">
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
<div class="modal fade" id="sukses">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <div>
                        <p style="font-size: 400%; color: green"><i class="ti-check"></i></p>
                        <p id="pesan-sukses"></p>
                        <br />
                    </div>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </center>
            </div>
        </div>
        </form>
    </div>
</div>

</html>

<div class="modal fade" id="sukses-hapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <div>
                        <p style="font-size: 400%; color: green"><i class="fa fa-calendar-check"></i></p>
                        <br />
                        <p id="pesan-hapus"></p>
                        <br />
                    </div>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </center>
            </div>
        </div>
        </form>
    </div>
</div>

</html>

<div class="modal fade" id="warning">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <div>
                        <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                        <p id="pesan-warning"></p>
                        <br />
                    </div>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                </center>
            </div>
        </div>
        </form>
    </div>
</div>