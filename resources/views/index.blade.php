<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GIS Koto Gadang</title>

    @include('inc.head')

    <script src="//maps.google.com/maps/api/js?key={{$api}}"></script>
    <script type="text/javascript" src="{{ asset('script/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_rumah.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_umkm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_ibadah.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_kantor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_pendidikan.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script/script_kesehatan.js') }}"></script>
    <script type="text/javascript">
        tunggu = true;
    </script>
</head>
<style type="text/css">
    #legend {
        color: black;
        background-color: white;
        padding: 10px;
        margin: 5px;
        font-size: 12px;
        font-family: Arial, sans-serif;
        opacity: 1;
    }

    .digit {
        border: 1px solid;
        height: 12px;
        width: 12px;
        margin-right: 3px;
        float: left;
        border-color: white;
    }

    .batas {
        border: 1px solid;
        height: 12px;
        width: 12px;
        margin-right: 3px;
        float: left;
        border-radius: 2px;
    }

    .nagari {
        border-color: red;
    }

    .gantiang {
        background: #C2DBC0;
    }

    .koto {
        background: #F6F6C3;
    }

    .sutijo {
        background: #D0DEF5;
    }

    .rumah {
        background: #CE9077;
    }

    .ibadah {
        background: #7BBB62;
    }

    .kantor {
        background: #7B7BA7;
    }

    .umkm {
        background: #B66C9C;
    }

    .pendidikan {
        background: gray;
    }

    .kesehatan {
        background: #FB7B62;
    }

    #map {
        height: 71vh;
        width: 99%;
        background-color: #222;
        color: #eee;
        font-family: monospace;
        padding: 2rem;
        margin: 5px;
    }
</style>

<body>
    <div id="legend" class="panel panel-primary">
        <div style="text-align: center;">
            <h6>LEGEND</h6>
        </div>
    </div>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->

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
        @include('layouts.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <ridho id='ajax-wait2' style="z-index: 999; position: fixed;">
                <font color="#5186db" size="3pt" style="text-shadow: #ffffff 0 0 30px;"><b> Loading...</b></font>
            </ridho>
            <!-- header area start -->
            <div style="position: fixed; z-index: 1; width: 100%">
                <div class="header-area" id="tampilan-header">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-4 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-8 col-sm-4 clearfix">
                            <ul class="notification-area pull-right" style="padding-right: 32%">
                                <li id="tombol-login"><button class="btn btn-outline btn-primary"
                                        onclick="location.href = 'login';"><i class="fas fa-sign-in-alt"></i>
                                        Login</button></li>
                                @if (Auth::user())
                                @if (Auth::user()->role==1)
                                <li name="terbatas"><button class="btn btn-outline btn-primary"><i
                                            class="fas fa-helicopter"></i> Super User Access</button></li>
                                @endif
                                @endif
                                <li name="terbatas"><button class="btn btn-outline btn-primary" onclick="search()"><i
                                            class="fas fa-dna"></i> Search Request</button></li>
                                <li name="terbatas"><button class="btn btn-outline btn-primary"
                                        onclick="keloladata()"><i class="fas fa-warehouse"></i> Manage Data</button>
                                </li>
                                <li name="terbatas" class="user-name dropdown-toggle" data-toggle="dropdown" id="logo-pengaturan">
                                    <i class="ti-settings"></i>
                                    <div class="dropdown-menu">
                                        <div style="text-align: center; font-weight: bold; cursor:vertical-text;">Hi,
                                            @if (Auth::user())
                                            {{Auth::user()->name}}
                                            @endif
                                            !</div>
                                        <div class="icon-container" onclick="pengaturan()" style="font-size: 90%"><span
                                                class="icon-name">&emsp;<i class="fas fa-wrench"></i> Account
                                                Setting</span></div>
                                        <div class="icon-container" style="font-size: 90%; font-weight: normal"><span
                                                class="icon-name">
                                                <a href="{{ route('logout') }}" style="color:black"
                                                    onMouseOver="this.style.color='#2374f7'"
                                                    onMouseOut="this.style.color='black'" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                    &emsp;<i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </span></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="belakang" style="z-index: 0; visibility: hidden;"></div>
            <script type="text/javascript">
                $( document ).ready(function() {
                    //$( "#logo-pengaturan" ).click();
                });

                $("#tampilan-header").clone().prependTo("#belakang");

                function pengaturan() {
                    window.location.href = "pages/setting/akun.php";
                }

                function keloladata() {
                    window.location.href = "{{ route('bangunan') }}";
                }
            </script>
            <!-- header area end -->
            <!-- page title area start -->

            <!-- page title area end -->
            <div class="main-content-inner">
                <input type="hidden" name="" id="jr">
                <input type="hidden" name="" id="lat">
                <input type="hidden" name="" id="lng">
                <br />
                <div class="row">
                    <div id="peta" style="width:100%; overflow: auto; background-color: white; border-radius: 6px;">
                        <button class="btn btn-default" title="current position" onclick="aktifkanGeolocation()"
                            style="margin-top: 5px; margin-left: 15px; margin-bottom: 5px"><i
                                class="fas fa-map-marker-alt"></i></button>
                        <button class="btn btn-default" title="manual position" onclick="manualLocation()"><i
                                class="fas fa-map-marked-alt"></i></button>
                        <a id="legenda">
                            <button class="btn btn-default" title="show legend" onclick="legenda()"><i
                                    class="fa fa-globe"></i></button>
                        </a>
                        <button class="btn btn-default" title="refresh" onclick="refresh()"><i
                                class="fa fa-sync"></i></button>
                        <?php include('inc/aturlayer.php') ?>
                        <div id="map"></div>
                    </div>

                    <div class="col-md-3" id="detail-informasi-pencarian" style="padding-left: 1%; width: 99%;">
                        <div style="background-color: white; border-radius: 5px">
                            <div class="panel-body table-responsive card" id="rute">
                                <!-- <div id="detailrute"></div> -->
                            </div>
                            <font id="found" style="padding-left: 5px"></font>
                            <div style="float: right">
                                <button class="btn btn-default btn-xs" onclick="sembunyikancari()" id="hidecari"><i
                                        class="fa fa-times-circle"></i> Close Result</button>
                            </div>
                            <div class="panel-body table-responsive" id="panjangtabel">
                                <table class="table table-striped table-bordered table-hover" id="tampilanpencarian">
                                    <thead>
                                        <tr style="background-color: #4336FB; color: white">
                                            <th colspan="2" style="text-align: center;">Result</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasilcari">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SAMPAI DISINI -->

            </div>
        </div>

        <!-- main content area end -->
        <!-- footer area start-->
        @include('layouts.foot')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->

    <script>
        var map;

        function initMap() {
            loadpeta();
            semuadigitasi();
        }

        initMap();
    </script>
    <!-- offset area end -->

    <!-- Notifikasi untuk klik pada peta -->
    <div class="modal fade" id="posisimanual">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <img src="inc/klikpeta.gif" style="width: 150px">
                            <p>Click on the map</p>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi untuk mengatur lokasi -->
    <div class="modal fade" id="atur-posisi">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <img src="inc/marker.gif" style="width: 150px">
                            <p>Click the current position or manual position button first!</p>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi pencarian tidak ditemukan -->
    <div class="modal fade" id="kosong">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-sm" style="width: 200%">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                                <p>Not Found</p>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="peringatan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-sm" style="width: 200%">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                                <div id="ket-p"></div>
                            </div>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gagal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: red"><i class="far fa-times-circle"></i></p>
                            <p>Oopss.., Something went wrong!</p>
                            <div id="notifikasi"></div>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
            </form>
        </div>
    </div>



    <!-- start chart js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->
    <!-- start highcharts js -->
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
    <!-- start zingchart js -->
    <!-- <script src="https://cdn.zingchart.com/zingchart.min.js"></script> -->
    <!-- <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script> -->
    <!-- all line chart activation -->
    <!-- <script src="assets/js/line-chart.js"></script> -->
    <!-- all pie chart -->
    <!-- <script src="assets/js/pie-chart.js"></script> -->
    <!-- others plugins -->

</body>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#tampilanpencarian').DataTable({
    //         responsive: true
    //     });
    // }); 289
    $('#tampilanpencarian').hide();
    $('#hidecari').hide();
    $('#legend').hide();
    $("#rute").hide();
</script>
@if (Auth::user())
<script>
    $(`[name="terbatas"]`).show();
    $("#tombol-login").hide();
</script>
@else
<script>
    $(`[name="terbatas"]`).hide();
    $("#tombol-login").show();
</script>
@endif

</html>
<div class="modal fade bd-example-modal-lg modal-xl" id="info-bang">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jenis-bang"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #eee">
                <div id='ajax-wait' style="z-index: 999; position: fixed;">
                    <center>
                        <img alt='loading...' src='inc/loading-x.gif' width='65' height='65' />
                        &emsp;
                        <font color="#5186db" size="5pt"><b> Loading...</b></font>
                    </center>
                </div>
                <div id="konten-bang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#detail-informasi-pencarian').hide();
    function detailumkm(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-store-alt'></i> Micro, Small, Medium, Enterprise Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`umkm/detail/${id}`);
    }

    function detailibadah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-mosque'></i> Worship Building Info")
        $('#info-bang').modal('show');
        //$('#konten-bang').load("inc/detail-ibadah.php?id="+id);
        //$('#konten-bang').load(`ibadah_detail/${id}`);
        $('#konten-bang').load(`ibadah/detail/${id}`);
    }

    function detailpendidikan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-school'></i> Educational Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`pendidikan/detail/${id}`);
    }

    function detailkesehatan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-hospital-alt'></i> Health Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`kesehatan/detail/${id}`);
    }

    function detailkantor(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fa fa-bank'></i> Office Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load(`kantor/detail/${id}`);
    }

    function detailrumah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='ti-home'></i> House Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-rumah.php?id=" + id);
    }

    function load_popup() {
        $(document).ajaxStart(function () {
            $("#ajax-wait").css({
                left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
                top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
                display: "block"
            })
        }).ajaxComplete(function () {
            $("#ajax-wait").fadeOut();
        });
    }


    $(document).ajaxStart(function () {
        $("#ajax-wait2").fadeIn();
        $("#ajax-wait2").css({
            left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
            top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
    }).ajaxComplete(function () {
        $("#ajax-wait2").fadeOut();
    });
    if (tunggu == true) {
        $("#ajax-wait2").fadeOut();
        tunggu = false;
    }

    function search() {
        window.location.href = "pencarian.php";
    }
</script>