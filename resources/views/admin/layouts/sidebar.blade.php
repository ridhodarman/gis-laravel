<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 09</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/admin/css/style.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    
    <link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.css">
    <link rel="stylesheet" href="assets/fontawesome-free-5.6.3-web/css/all.min.css">
    <script type="text/javascript" src="assets/fontawesome-free-5.6.3-web/js/all.js"></script>
    <script type="text/javascript" src="assets/fontawesome-free-5.6.3-web/js/all.min.js"></script>

    <link rel="stylesheet" href="assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="assets/alertify/lib/alertify.min.js"></script>

</head>

<body style="background-color:#fafafa">

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                </button>
            </div>
            <div class="img bg-wrap text-center py-4" style="background-image: url(assets/admin/images/bg_1.jpg);">
                <div class="user-logo">
                    <div class="img" style="background-image: url(assets/admin/images/user.png);"></div>
                    <h3>the hash slinging slasher</h3>
                </div>
            </div>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="#"><span class="fa fa-home mr-3"></span> Home</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-download mr-3 notif"><small
                                class="d-flex align-items-center justify-content-center">5</small></span> Download</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-gift mr-3"></span> Gift Code</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-trophy mr-3"></span> Top Review</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-cog mr-3"></span> Settings</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-support mr-3"></span> Support</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    
    
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>