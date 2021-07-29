<?php
require_once '../app/init.php';
$feedback = FinishTransaction();
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

  <!-- CSS files -->
  <!-- <script src="https://kit.fontawesome.com/d8b23fe4ca.js" crossorigin="anonymous"></script> -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">
   <link rel="icon" type="image/png" sizes="32x32" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">
   <link rel="icon" type="image/png" sizes="16x16" href="<?= BASEURL; ?>assets/img/favicons/header_logo.png">

  <!-- CSS files -->
  <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/plugins_movie.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/style_movie.css">
  <link href="<?= BASEURL; ?>assets/css/theme.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

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
      <div class="container-fluid align-items-center py-2"><a class="navbar-brand flex-center" href="" style="color: #ffffff;"><img class="logo" src="<?= BASEURL; ?>assets/img/iconspfn.png" alt="open enterprise" /><span class="ms-2 d-none d-sm-block fw-bold">Produksi Film Negara</span></a>
      </div>
    </nav>
  </div>
 </header>
 <!-- END | Header -->

 <div class="slider movie-items">
  <div class="container">
    <div class="row">
      </div>
  </div>
 </div>
 <?php if ($feedback == 0): ?>
   <div class="movie-items">
    <h1 class="text-center" style="color: #FFFFFF;">Sorry Your Order id is not found</h1>
    <p class="text-center">Please make a transaction first</p>
    <div class="row">
      <div class="position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x">
    <a href="<?= BASEURL; ?>Collab/movie_coll.php" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Make transaction</a>
   </div>
   </div>
    </div>
   </div>
   <?php else: ?>
     <?php if ($feedback == 1): ?>
     <div class="movie-items">
       <h1 class="text-center" style="color: #FFFFFF;">Thanks for start invest With Us</h1>
       <p class="text-center">If you want to check your order status you can click this button</p>
       <div class="row">
         <div class="position-relative">
           <div class="position-absolute top-0 start-50 translate-middle-x">
             <a href="<?= BASEURL; ?>Dashboard/user_das.php?order" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Journey</a>
           </div>
         </div>
       </div>
     </div>
   <?php endif; ?>
<?php
  if ($feedback > 1) {
    header("Location:" . BASEURL . "Collab/movie_coll.php");
  }
 ?>
 <?php endif; ?>
 <!-- footer section-->
 <footer class="ht-footer">
  <div class="container">
    <div class="flex-parent-ft">
      <div class="flex-child-ft item1">
         <a href="index-2.html"><img class="logo" src="<?= BASEURL; ?>assets/img/iconspfn.png" width="50px" alt=""></a>
         <p>Jl. Otista Raya No.125-127,<br>
         RT.9/RW.8, Bidara Cina, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13330</p>
        <p>Call us: <a href="#">(+62) 218192508</a></p>
      </div>

    </div>
  </div>
  <div class="ft-copyright">
    <div class="ft-left">
      <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
    </div>
    <div class="backtotop">
      <p><a href="#" id="back-to-top">Back to top  <i class="ion-ios-arrow-thin-up"></i></a></p>
    </div>
  </div>
 </footer>
 <!-- end of footer section-->

 <script src="<?= BASEURL; ?>assets/js/jquery_movie.js"></script>
 <script src="<?= BASEURL; ?>assets/js/plugins_movie.js"></script>
 <script src="<?= BASEURL; ?>assets/js/plugins2_movie.js"></script>
 <script src="<?= BASEURL; ?>assets/js/custom_movie.js"></script>
 <script src="<?= BASEURL; ?>assets/vendors/swiper/swiper-bundle.min.js"> </script>
 <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
 <script src="<?= BASEURL; ?>assets/js/theme.js"></script>

 </body>

 <!-- index14:58-->
 </html>
