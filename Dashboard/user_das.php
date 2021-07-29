<?php
session_start();
require_once '../app/init.php';
if (!isset($_SESSION['user'])) {
 header("Location:" . BASEURL . "Collab/movie_coll.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<!-- index14:58-->
<head>
	<!-- Basic need -->
	<title>Open Pediatrics</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
  <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<!-- Mobile specific meta -->
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">

	<!-- CSS files -->
	<link rel="stylesheet" href="<?= BASEURL; ?>assets/css/plugins_movie.css">
	<link rel="stylesheet" href="<?= BASEURL; ?>assets/css/style_movie.css">
	<link href="<?= BASEURL; ?>assets/css/theme.css" rel="stylesheet">
	<link href="<?= BASEURL; ?>assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- fontawesome kits -->
  <script src="https://kit.fontawesome.com/d8b23fe4ca.js" crossorigin="anonymous"></script>

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="<?= BASEURL; ?>assets/img/iconspfn.png" alt="" width="90">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->
<!-- BEGIN | Header -->
<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-expand-xl navbar-light fixed-top px-0 pb-0 mb-2" id="navbar" data-navbar-darken-on-scroll="#57565">
			<div class="container-fluid align-items-center py-2"><a class="navbar-brand flex-center" href="<?= BASEURL; ?>" style="color: #ffffff;"><img class="logo" src="../assets/img/iconspfn.png" alt="open enterprise" /><span class="ms-2 d-none d-sm-block fw-bold">Produksi Film Negara</span></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars" style="color: #FFFFFF;"></i></button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto mt-3 mt-xl-0">
						<li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="<?= BASEURL; ?>" style="color: #ffffff;">Home</a></li>
						<li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="<?= BASEURL; ?>Collab/movie_coll.php" style="color: #ffffff;">Movie Collaboration</a></li>
						<li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="<?= BASEURL; ?>Invest/start.php" style="color: #ffffff;">Mulai Berkarya</a></li>
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] != ""): ?>
              <li class="nav-item ps-0 ps-xl-4 ms-2 dropdown"><a class="nav-link fs-2 fw-medium mt-2 dropdown-toggle" href="" style="color: #ffffff;"><i class="fas fa-user"></i></a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="<?= BASEURL; ?>Dashboard/user_das.php">Dashboard</a></li>
                  <li><a class="dropdown-item" href="?log">Logout</a></li>
                </ul>
              </li>
              <?php else: ?>
                <li class="nav-item ps-0 ps-xl-4 ms-2"><a href="<?= BASEURL; ?>regist/Signin.php" class="btn btn-outline-danger btn-lg" tabindex="-1" role="button" aria-disabled="true">Login/Signup</a></li>
            <?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
<!-- END | Header -->
<?php
if (isset($_GET['log'])) {
  Logout();
}

 ?>
<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="card">
			  <div class="card-body">
					<div class="row">
						<div class="col">
							<img class="float-start" src="<?= BASEURL; ?>app/function/view_image.php?user" width="100px" height="100px" class="img-thumbnail" alt="...">
              <?php
                $nama = showProfile();
               ?>
              <span><h1 class="float-start" ><?= $nama['full_name'] ?></h1><i class="far fa-user"></i></span>
					</div>
				</div>
				<div class="row">
					<ul class="nav nav-tabs">
  					<li class="nav-item">
							<?php if (isset($_GET['profile']) or !$_GET): ?>
								<a class="nav-link active" aria-current="page" href="?profile">Profile</a>
								<?php else: ?>
									<a class="nav-link" aria-current="page" href="?profile">Profile</a>
							<?php endif; ?>
  					</li>
  				<li class="nav-item">
							<?php if (isset($_GET['order'])): ?>
    					<a class="nav-link active" href="?order">Your Order</a>
							<?php else: ?>
								<a class="nav-link" href="?order">Your Order</a>
							<?php endif; ?>
  				</li>
					<li class="nav-item">
						<?php if (isset($_GET['change'])): ?>
							<a class="nav-link active" href="?change">Change Password</a>
						<?php else: ?>
							<a class="nav-link" href="?change">Change Password</a>
						<?php endif; ?>
					</li>
          <li class="nav-item">
            <?php if (isset($_GET['movie'])): ?>
              <a class="nav-link active" href="?movie">Your Movie</a>
            <?php else: ?>
              <a class="nav-link" href="?movie">Your Movie</a>
            <?php endif; ?>
          </li>
		</ul>
				</div>
			  </div>
			</div>
	    </div>
	</div>
</div>
<div class="movie-items">
<?php
if (isset($_GET['profile']) or !$_GET) {
	require_once '../app/views/dashboard/profile.php';
}

if (isset($_GET['order'])) {
	require_once '../app/views/dashboard/order.php';
}

if (isset($_GET['change'])) {
	require_once '../app/views/dashboard/change_password.php';
}
if (isset($_GET['movie'])) {
	require_once '../app/views/dashboard/movie.php';
}
 ?>
</div>
<?php
require_once '../app/views/footer.php';
 ?>
