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
	<title>Start your invest</title>
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
        <h2>Let's make your idea as a film</h2>
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
                   1. identity card bertipe jpg/jpeg dan berat file maksimal 1MB<br>
                 2. company profile bertipe pdf dan berat file maksimal 2MB<br>
               3. Your script film bertipe pdf/pptx/pdf dan berat file maksimal 10MB</p>
              </div>
            </div>
          <?php endif; ?>
          <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              <strong>Pengajuan anda sudah di kirimkan</strong><br>
              <p>Pengajuan anda berhasil di kirim, untuk info di setujui atau tidaknya anda bisa menunggu 1x24 jam kerja pemberitahuan akan kami kirimkan melalui email yang terdaftar</p>
            </div>
          </div>
        <?php endif; ?>
            <form action="<?= BASEURL; ?>app/function/edit.php?invest" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">Full Name</label>
                  <input type="text" name="full" class="form-control" required>
                    </div>
                      <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">Your Company</label>
                  <input type="text" name="company" class="form-control" required>
                    </div>
                      <div class="mb-3">
                          <label for="formFile" class="form-label">Your identity card</label>
                            <input class="form-control" name="identity" type="file" id="formFile" required>
                          </div>
                          <div class="mb-3">
                              <label for="formFile" class="form-label">Your compaany profile</label>
                                <input class="form-control" name="compro" type="file" id="formFile" required>
                              </div>
                              <div class="mb-3">
                                  <label for="formFile" class="form-label">Your script film</label>
                                    <input class="form-control" name="script" type="file" id="formFile" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">Your movie title</label>
                                      <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">Your movie category</label>
                                            <input type="text" name="category" class="form-control" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">Your movie caster</label>
                                                  <input type="text" name="caster" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="exampleInputEmail1" class="form-label text-light" style="color: #000000;">How much budget do you need ?</label>
                                                        <input type="text" name="budget" class="form-control" required>
                                                    </div>
                                                  <div class="mb-3">
                                                <label for="formFile" class="form-label">Your movie banner</label>
                                              <input class="form-control" name="movieBanner" type="file" id="formFile" required>
                                            </div>
                                          <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Your movie sinopsis</label>
                                      <textarea class="form-control" name="sinopsis" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
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
