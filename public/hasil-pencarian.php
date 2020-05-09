<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    
    <?php include('inc/head.php') ?>

    <script src="//maps.google.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE"></script>
    
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="script_rumah.js"></script>
    <script type="text/javascript" src="script_umkm.js"></script>
    <script type="text/javascript" src="script_ibadah.js"></script>
    <script type="text/javascript" src="script_office.js"></script>
    <script type="text/javascript" src="script_pendidikan.js"></script>
    <script type="text/javascript" src="script_kesehatan.js"></script>
    <script type="text/javascript">
        tunggu=true;
    </script>
</head>
<style type="text/css">
      #legend {
    background-color: white;
    padding: 10px;
    margin: 5px;
    font-size: 12px;
    font-color: blue;
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
</style>
<body>
    <div id="legend" class="panel panel-primary">
        <div style="text-align: center;"><h6>LEGEND</h6></div>
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
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"><img src="inc/m.png" width="50px" /><h6 style="color: white;">GIS KOTO GADANG</h6></a>
                </div>
            </div>
            <?php include ('inc/sidebar-cari.php') ?>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
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
                            <div name="akses-admin" style="font-size: 120%; padding-left: 10%; padding-top: 2%"><label>Welcome <?php echo $_SESSION['username']; ?> !</label>
                            </div>
                            <ridho id='ajax-wait2' style="z-index: 999; position: fixed;">
                                  <font color="#5186db" size="3pt" style="text-shadow: #ffffff 0 0 30px;"><b> Loading...</b></font>
                            </ridho>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-8 col-sm-4 clearfix">
                            <ul class="notification-area pull-right" style="padding-right: 32%">
                                <li id="tombol-login"><button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt"></i> Login</button></li>
                                <li><button class="btn btn-outline btn-primary" onclick="back()"><i class="ti-arrow-left"></i> Back</button></li>
                                <li name="akses-admin"><button class="btn btn-outline btn-primary" onclick="keloladata()"><i class="ti-settings"></i> Manage Data</button></li>
                                <li name="akses-admin" class="user-name dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings"></i>
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

            <style type="text/css">
                .gambarlogin {
                    background-image: url('inc/bg.jpg');
                     -webkit-background-size: 100% 100%;
                    -moz-background-size: 100% 100%;
                    -o-background-size: 100% 100%;
                    background-size: 100% 100%;
                    }
                .tulisan {
                    text-shadow: #ff0000 0 0 10px;
                    color: white;
                    font-weight : bold; 
                }
                .form-transparan {
                    background: rgba(0, 0, 0, 0.59);
                    color: lightgray;
                }

                .tombol-login {
                    background: rgba(0, 93, 199, 0.68);
                }

                .tombol-kensyel {
                    background: rgba(0, 12, 26, 0.68)
                }
            </style>
            <div class="modal fade" id="login">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content gambarlogin">
                        <div class="modal-header">
                            <h5 class="modal-title tulisan">L o g i n</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" action="act/login.php" style="width: 90%">
                        <div class="modal-body">
                            <font class="tulisan">Username:</font>
                            <input type="text" class="form-control form-transparan" name="username" placeholder="username..." required>
                            <font class="tulisan">Password:</font>
                            <input type="password" class="form-control form-transparan" name="password" placeholder="password..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary tombol-kensyel" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary tombol-login"><i class="fas fa-sign-in-alt"></i> Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="belakang" style="z-index: 0; visibility: hidden;"></div>
            <script type="text/javascript">
                $("#tampilan-header").clone().prependTo("#belakang");

                function pengaturan () {
                     window.location.href="pages/setting/akun.php";
                }

                function logout () {
                     window.location.href="act/logout.php";
                }

                function keloladata () {
                     window.location.href="pages";
                }
            </script>
            <!-- header area end -->
            <!-- page title area start -->

            <!-- page title area end -->
            <div class="main-content-inner">
                <?php if (is_null(($_GET['nik'])) || empty($_GET['no']) ) { 
                    echo '<script>window.location="pencarian.php"</script>';
                 }  
                else{
                    $nomor = $_GET['no'];
                    $nik = $_GET['nik'];
                    $querysearch = "SELECT S.national_identity_number_of_applicant, S.serial_number, S.name_of_applicant, J.job_name, S.phone_number, S.address, S.necessary, S.search_type, S.search_value, S.access_time, S.username
                        FROM search_history AS S
                        LEFT JOIN job AS J ON J.job_id=S.job_id
                                WHERE S.serial_number='$nomor' and S.national_identity_number_of_applicant='$nik'
                            ";

                    $hasil = pg_query($querysearch);
                    while ($row = pg_fetch_array($hasil)) {
                        $nama = $row['name_of_applicant'];
                        $nik = $row['national_identity_number_of_applicant'];
                        $nomor = $row['serial_number'];
                        $kerja = $row['job_name'];
                        $nohp = $row['phone_number'];
                        $alamat = $row['address'];
                        $kebutuhan = $row['necessary'];
                        $cari = $row['search_type'];
                        $value = $row['search_value'];
                        $waktu = $row['access_time'];
                        $username = $row['username'];
                    }
                ?>
                <br/><br/>
                <div class="card"><div class="card-body"><div class="media"><div class="media-body">
                        <center><h6><i class="fab fa-searchengin"></i> Search Information</h6></center><br/>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Name:</b>
                                    <?php echo $nama ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>National Identity Number:</b>
                                    <?php echo $nik ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Job:</b>
                                    <?php echo $kerja ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Phone Number:</b>
                                    <?php echo $nohp ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Address:</b>
                                    <?php echo $alamat ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Necessary:</b> 
                                    <?php echo $kebutuhan ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Account Used:</b>
                                    <?php echo $username ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Access Time:</b> 
                                    <?php echo date('l, d F Y - H:i:s', strtotime($waktu)); // Friday, 20 January 2017 ?>
                                </div>
                            </div>
                            <b>Information Needs:</b> 
                            <?php echo $cari ?> = <font color="blue"> <?php echo $value ?> </font>
                    </div></div></div></div>
                <input type="hidden" name="" id="jr" style="width: 50px">
                <input type="hidden" name="" id="lat" style="width: 5px">
                <input type="hidden" name="" id="lng" style="width: 5px">
                <!-- sales report area start -->
                <br />
                <button class="btn btn-default" title="current position" onclick="aktifkanGeolocation()"><i class="fas fa-map-marker-alt"></i></button>
                <button class="btn btn-default" title="manual position" onclick="manualLocation()"><i class="fas fa-map-marked-alt"></i></button>

                <a id="legenda">
                    <button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>
                </a>

                <?php include('inc/aturlayer.php') ?>
                <p/>

                <div class="row">
                    <div id="peta" style="width: 100%">
                        <br />
                        <div style="width:100%; height: 450px;" id="map"></div>
                    </div>

                    <div class="col-md-3" id="detail-informasi-pencarian">
                        <button class="btn btn-default btn-xs" onclick="sembunyikancari()" id="hidecari" style="float: right;"><i
                                class="fa fa-times-circle"></i> Close Result</button>
                        <div class="panel-body table-responsive card" id="rute">
                            <!-- <div id="detailrute"></div> -->
                        </div>
                        <font id="found"></font>
                        <div class="panel-body table-responsive" id="panjangtabel">
                            <table class="table table-striped table-bordered table-hover" id="tampilanpencarian" style="background-color: white; border-radius: 7%">
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
                <!-- SAMPAI DISINI -->
                <?php } ?>
            </div>
        </div>

        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Ridho Darman | Jurusan Sistem Informasi Universitas Andalas - Copyright 2018. All right reserved. Template by Colorlib. </p>
            </div>
        </footer>
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
        <?php
            if ($cari=="Search house by National ID Number of Householder") {?>
                console.log('act/rumah_cari-nikpenghuni.php?nik=' + <?php echo $value; ?>)
                    $.ajax({
                      url: 'act/rumah_cari-nikpenghuni.php?nik=' + <?php echo $value; ?>,
                      data: "",
                      dataType: 'json',
                      success: function (rows) {
                        cari_rumah(rows);
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                        $('#gagal').modal('show');
                        $('#notifikasi').empty();$('#notifikasi').append(xhr.status);
                        $('#notifikasi').append(thrownError);
                      }
                    });
            <?php }
        ?>
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
                                <p>Oopss..,  Something went wrong!</p>
                                <div id="notifikasi"><?php  ?></div>
                            </div>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

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
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
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
<?php
    if ($akses==true) {
        echo '
            <script>
                $("[name='."'".'akses-admin'."'".']").show();
                $("#tombol-login").hide();
            </script>
        ';
    }
    else {
        echo '
            <script>
                $("[name='."'".'akses-admin'."'".']").hide();
                $("#tombol-login").show();
            </script>
        ';
    } 
?>
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
                      <img alt='loading...' src='inc/loading-x.gif' width='65' height='65'/>
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
    function detailumkm(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-store-alt'></i> Micro, Small, Medium, Enterprise Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-umkm.php?id="+id);
    }

    function detailibadah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-mosque'></i> Worship Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-ibadah.php?id="+id);
    }

    function detailpendidikan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-school'></i> Educational Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-pendidikan.php?id="+id);
    }

    function detailkesehatan(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-hospital-alt'></i> Health Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-kesehatan.php?id="+id);
    }

    function detailkantor(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fa fa-bank'></i> Office Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-kantor.php?id="+id);
    }

    function detailrumah(id) {
        load_popup();
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='ti-home'></i> House Building Info")
        $('#info-bang').modal('show');
        $('#konten-bang').load("info-rumah.php?id="+id);
    }

    function load_popup(){
        $( document ).ajaxStart( function() {
            $( "#ajax-wait" ).css({
            left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
            top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
            display: "block"
          })
        }).ajaxComplete( function() {
          $( "#ajax-wait" ).fadeOut();
        });
    }

    
        $( document ).ajaxStart( function() {
            $( "#ajax-wait2" ).fadeIn();
                $( "#ajax-wait2" ).css({
                left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
                top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
                display: "block"
              })
        }).ajaxComplete( function() {
          $( "#ajax-wait2" ).fadeOut();
        });
        if (tunggu==true) {
            $( "#ajax-wait2" ).fadeOut();
            tunggu=false;
        }

    function back() {
        window.location.href="riwayat_pencarian.php";
    }
</script>
