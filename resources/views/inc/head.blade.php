<meta name="viewport" content="width=device-width, initial-scale=1') }}">
<!-- <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/icon/favicon.ico') }}"> -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
<!-- amchart css -->
<!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
<!-- others css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
<link rel="stylesheet" href="{{ asset('assets/preloader/default-css.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/preloader/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
<!-- modernizr css -->
<!-- <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script> -->

<link rel="stylesheet" href="{{ asset('assets/fontawesome-free-5.6.3-web/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome-free-5.6.3-web/css/all.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/fontawesome-free-5.6.3-web/js/all.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/fontawesome-free-5.6.3-web/js/all.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<!-- untuk keperluan slideshow -->
<!-- <script src="{{ asset('js/slideshow/jquery.resize.js') }}') }}"></script>
<script src="{{ asset('js/slideshow/jquery.waitforimages.min.js') }}') }}"></script>
<script src="{{ asset('js/slideshow/modernizr.js') }}') }}"></script>
<script src="{{ asset('js/slideshow/jquery.carousel-3d.js') }}') }}"></script>
<link rel="stylesheet" href="{{ asset('js/slideshow/jquery.carousel-3d.default.css') }}') }}"> -->

<!-- untuk select cari -->
<!-- <link rel="stylesheet" href="{{ asset( 'assets/dist/css/bootstrap-select.css') }}') }}">
<meta name="viewport" content="width=device-width') }}"> -->


<script type="text/javascript') }}">
	function hanyaAngka(event, id) {
		var charCode = (event.which) ? event.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			$(id).css('color', 'red');
			$(id).html("Only Numbers!").show().fadeOut("slow");
			return false;
		}
		else {
			return true
		}
	}

	$(function () {
		$("input:text").keyup(function () {
			$(this).val($(this).val().replace("`", "'"));
		});
	});

</script>