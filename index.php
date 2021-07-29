<?php
require_once 'app/init.php';
 ?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Produksi Film Negara</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <!-- fontawesome kits -->
    <script src="https://kit.fontawesome.com/d8b23fe4ca.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/header_logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/header_logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/header_logo.png">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?= BASEURL; ?>assets/css/theme.css" rel="stylesheet" />

    <link href="<?= BASEURL; ?>assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  </head>


  <body data-bs-spy="scroll" data-bs-target="#navbar" style="background-color: #023b59;">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-xl navbar-light fixed-top px-0 pb-0 mb-2" id="navbar" data-navbar-darken-on-scroll="#57565">
        <div class="container-fluid align-items-center py-2"><a class="navbar-brand flex-center" href="index.php" style="color: #ffffff;"><img class="logo" src="assets/img/iconspfn.png" alt="open enterprise" /><span class="ms-2 d-none d-sm-block fw-bold">Produksi Film Negara</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars" style="color: #FFFFFF;"></i></button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mt-3 mt-xl-0">
              <li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="<?= BASEURL; ?>" style="color: #ffffff;">Home</a></li>
              <li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="<?= BASEURL; ?>Collab/movie_coll.php" style="color: #ffffff;">Movie Collaboration</a></li>
              <li class="nav-item ps-0 ps-xl-4 ms-2"><a class="nav-link fs-2 fw-medium mt-2" href="#rea" style="color: #ffffff;">Mulai Berkarya</a></li>
            </ul>
          </div>
        </div>
      </nav>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-8 py-lg-0" id="hero">

        <div class="container-xxl">
          <div class="row align-items-center min-vh-lg-100">
            <div class="col-lg order-lg-1 text-center"><img class="img-fluid" src="assets/img/illustrations/new.jpg" alt="" /></div>
            <div class="col-lg mt-5 mt-lg-0">
              <h1 class="lh-sm font-cursive fw-medium fs-6 fs-sm-8 fs-md-11 fs-lg-9 fs-xl-11 fs-xxl-12" style="color: #ffffff;">Produksi Film Negara <br class="d.none d-xl-block" /> Let's Start</h1>
              <p class="mt-4 fs-2 fs-md-4 lh-sm" style="color: #ffffff;">Join with us and make your idea as a film, and improved your skill as film maker, did you know us ?<br> No ? read our company profile</p>
              <a class="btn btn-success mt-4" href="About.php" role="button">Let's Started</a>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-xxl-0" id="features">

        <div class="container-xxl">
          <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-8">
              <h1 class="display-6 font-cursive" style="color: #ffffff;">Requirements to apply</h1>
              <p class="fs-md-1 mt-4" style="color: #ffffff;">Hows you can apply your idea in produksi film negara ?</p>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-xl-3 g-4 mt-3 text-center">
            <div class="col-12 col-md-6">
              <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                <div class="card-body"><i class="far fa-id-card" style="font-size: 90px;color: #000000;"></i>
                  <h3 class="py-3">Upload Your Personal Data</h3>
                  <p class="lead mb-0" style="color: #000000;">We need to verification your personal data it's look likes (identity card/passport, your address, your company/organization, and etc)</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                <div class="card-body"><i class="fas fa-scroll" style="font-size: 90px; color: #000000;"></i>
                  <h3 class="py-3">Upload Your Doocument</h3>
                  <p class="lead mb-0" style="color: #000000;">we need to assess the proposal you make, as well as the film script that you make</p>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card py-md-6 px-md-4 mt-3 h-100 box-shadow-all border-0">
                <div class="card-body"><i class="far fa-smile-beam" style="font-size: 90px;color: #000000;"></i>
                  <h3 class="py-3">Keep your smile</h3>
                  <p class="lead mb-0" style="color: #000000;">And then after you completed all Requirements, we should tell you if all your requirements aproved so keep your smile and wait until that news come to you</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section id="rea">
        <div class="container-xxl">
          <div class="row align-items-center">
            <div class="col-lg mt-5 mt-lg-0">
              <h1 class="lh-sm font-cursive fw-medium display-5" style="color: #ffffff;">Let's start production</h1>
              <p class="mt-4 fs-1" style="color: #ffffff;">If you can’t wait to run a new or existing organization on Open Enterprise and are willing to explore and navigate the beta, we’d love to get you started.</p>
              <a class="btn btn-success" href="Invest/start.php" role="button">Getting started</a>
            </div>
            <div class="col-lg order-lg-1 text-center">
              <img class="img-fluid" src="assets/img/illustrations/director.jpg" alt="" />
            </div>
          </div>
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-4">
        <div class="container-xxl">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 text-sm-center text-lg-start">
              <h2 class="mb-lg-0 text-white">Produksi Film Negara</h2>
            </div>
            <div class="col-lg-6 text-sm-center text-lg-end">
              <p class="mb-0 text-white">&copy; 2021 by <a class="text-white"href="https://themewagon.com/">DavDc</a></p>
            </div>
          </div>
        </div>
        <!-- end of .container-->
      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?= BASEURL; ?>assets/vendors/@popperjs/popper.min.js"></script>
    <script src="<?= BASEURL; ?>assets/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?= BASEURL; ?>assets/vendors/is/is.min.js"></script>
    <script src="<?= BASEURL; ?>assets/vendors/swiper/swiper-bundle.min.js"> </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>

    <script src="<?= BASEURL; ?>assets/js/theme.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&amp;family=Roboto:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet">
  </body>

</html>
