<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
	<meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
	<meta name="author" content="pixelstrap">
	<link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
	<title>Siadnan <?= isset($page_name) ? '| ' . $page_name : '' ?></title>
	<!-- Google font-->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
	<!-- ico-font-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
	<!-- Themify icon-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
	<!-- Flag icon-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
	<!-- Feather icon-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
	<!-- Plugins css start-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
	<?php $this->addons->css() ?>
	<!-- Plugins css Ends-->
	<!-- Bootstrap css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
	<!-- App css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
	<!-- Responsive css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>

<body>
	<!-- loader starts-->
	<div class="loader-wrapper">
		<div class="loader-index"> <span></span></div>
		<svg>
			<defs></defs>
			<filter id="goo">
				<fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
				<fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
			</filter>
		</svg>
	</div>
	<!-- loader ends-->
	<!-- tap on top starts-->
	<div class="tap-top"><i data-feather="chevrons-up"></i></div>
	<!-- tap on tap ends-->
	<!-- page-wrapper Start-->
	<div class="page-wrapper horizontal-wrapper material-type" id="pageWrapper">
		<!-- Page Header Start-->
		<div class="page-header">
			<div class="header-wrapper row m-0">
				<form class="form-inline search-full col" action="#" method="get">
					<div class="form-group w-100">
						<div class="Typeahead Typeahead--twitterUsers">
							<div class="u-posRelative">
								<input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
								<div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
							</div>
							<div class="Typeahead-menu"></div>
						</div>
					</div>
				</form>

				<div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
					<div class="notification-slider">
						<a class="logo text-start" href="javascript:void(0)">
							<img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="looginpage">
							<img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage">
						</a>
					</div>
				</div>
				<!-- <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
					<div class="notification-slider">
						<div class="d-flex h-100"> <img src="../assets/images/giftools.gif" alt="gif">
							<h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light">Out new update has been release.</span></h6><i class="icon-arrow-top-right f-light"></i>
						</div>
						<div class="d-flex h-100"><img src="../assets/images/giftools.gif" alt="gif">
							<h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
						</div>
					</div>
				</div> -->
				<?= $this->load->component('user_bar') ?>
				<script class="result-template" type="text/x-handlebars-template">
					<div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
				<script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
			</div>
		</div>
		<!-- Page Header Ends                              -->
		<!-- Page Body Start-->
		<div class="page-body-wrapper horizontal-menu">
			<!-- Page Sidebar Start-->
			<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
				<div>
					<div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
						<div class="back-btn"><i class="fa fa-angle-left"></i></div>
						<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
					</div>
					<div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a></div>
					<?= $this->load->component('nav') ?>
				</div>
			</div>
			<!-- Page Sidebar Ends-->

			<!-- Container-fluid starts-->
			<?= $page ?>
			<!-- Container-fluid Ends-->
			<!-- footer start-->
			<?= $this->load->component('footer') ?>
		</div>
	</div>
	<!-- latest jquery-->
	<script src="../assets/js/jquery.min.js"></script>
	<!-- Bootstrap js-->
	<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
	<!-- feather icon js-->
	<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
	<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
	<!-- scrollbar js-->
	<script src="../assets/js/scrollbar/simplebar.js"></script>
	<script src="../assets/js/scrollbar/custom.js"></script>
	<!-- Sidebar jquery-->
	<script src="../assets/js/config.js"></script>
	<!-- Plugins JS start-->
	<script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
	<script src="../assets/js/support-ticket-custom.js"></script>
	<?php $this->addons->js() ?>
	<!-- Plugins JS Ends-->
	<!-- Theme js-->
	<script src="../assets/js/script.js"></script>
</body>

</html>