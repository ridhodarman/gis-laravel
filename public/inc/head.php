<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/metisMenu.css">
<!-- <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/slicknav.min.css"> -->
<!-- amchart css -->
<!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
<!-- others css -->
<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/typography.css">
<link rel="stylesheet" href="assets/css/default-css.css">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" href="assets/css/style2.css">
<!-- modernizr css -->
<!-- <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script> -->

<link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.css">
<link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.min.css">
<link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/js/all.js">
<link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/js/all.min.js">

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>


<?php 
	include('inc/koneksi.php');
	//session_start();
	if(isset($_SESSION['username'])){
        $akses=true;
    }
    else {
        $akses=false;
    }
?>