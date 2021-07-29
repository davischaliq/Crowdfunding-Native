<?php
session_start();
require_once '../app/init.php';
if (!isset($_SESSION['user'])) {
 header("Location:" . BASEURL . "Collab/movie_coll.php");
}
if (isset($_GET['list']) and $_GET['list'] != '') {
  $id = htmlspecialchars($_GET['list']);
  $status = showStatusMovieforHistory($id);
}else {
  header("Location:" . BASEURL . "Collab/movie_coll.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<!-- index14:58-->
<head>
	<!-- Basic need -->
	<title>Send your history report</title>
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
<!-- <div id="preloader">
    <img class="logo" src="<?= BASEURL; ?>assets/img/iconspfn.png" alt="" width="90">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div> -->
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
						<li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="" style="color: #ffffff;">Mulai Berkarya</a></li>
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
      <div class="title-hd">
        <h2>Send your activity history every month</h2>
      </div>
	    </div>
	</div>
</div>
<div class="movie-items">
  <div class="container">
    <div class="row ipad-width">
      <div class="tab-content">
        <div class="row">
          <div class="col-md-5">
            <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
                <strong>Gagal upload file</strong><p>Silahkan upload file berikut ini : <br>
                   1. photo kegiatan bertipe jpg/jpeg dan berat file maksimal 1MB<br>
                 2. file report laporan bertipe pdf/word dan berat file maksimal 2MB<br>
              3. tolong pilih status anda denngan benar<br>
            </div>
          </div>
          <?php endif; ?>
          <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              <strong>Laporan anda sudah dikirim</strong><br>
              <p>Admin akan melakukan pengecekan laporan bulanan anda harap terus melakukan upload laporan bulanan</p>
            </div>
          </div>
        <?php endif; ?>
            <form action="<?= BASEURL; ?>app/function/edit.php?lastreport=<?= $id ?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="formFile" class="form-label">Link Video Trailler Youtube</label>
                  <input class="form-control" name="photo_satu" type="text" id="formFile" required>
                    <div id="emailHelp" class="form-text">please upload photo with resolution 1504x1000px.</div>
                      </div>
                        <div class="mb-3">
                          <label for="formFile" class="form-label">laporan Akhir</label>
                            <input class="form-control" name="report" type="file" id="formFile" required>
                          </div>
                        <div class="input-group mb-3">
                      <select class="form-select" name="status" id="inputGroupSelect01" required>
                    <option selected>Pilih Status...</option>
                  <option value="1">realise</option>
                </select>
              </div>
            <?php endif; ?>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
      </div>
        </div>
      </div>
    </div>
<?php
require_once '../app/views/footer.php';
 ?>
