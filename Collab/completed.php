<?php require_once '../app/views/header.php'; ?>
<?php

if (isset($_GET['list'])) {
	$id = htmlspecialchars($_GET['list']);
	$rows = showDetailsYourMovie($id);
  $data = showMedia($id);
}
 ?>
 <div class="hero sr-single-hero sr-single">
  <div class="container">
 	 <div class="row">
 		 <div class="col-md-12">
 			 <!-- <h1> movie listing - list</h1>
 			 <ul class="breadcumb">
 				 <li class="active"><a href="#">Home</a></li>
 				 <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
 			 </ul> -->
 		 </div>
 	 </div>
  </div>
 </div>
 <div class="page-single movie-single movie_single">
  <div class="container">
 	 <div class="row ipad-width2">
 		 <div class="col-md-4 col-sm-12 col-xs-12">
 			 <div class="movie-img">
 				 <img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $id; ?>" alt="">
 			 </div>
 		 </div>
 		 <div class="col-md-8 col-sm-12 col-xs-12">
 			 <div class="movie-single-ct main-content">
 				 <h1 class="bd-hd"><?= $rows['judul']; ?> <span>Harga : Rp. <?= number_format($rows['T_anggaran'], 0, ",", "."); ?>/ Rp. <?= number_format($rows['anggaran_T'], 0, ",", ".") ?></span></h1>
 				 <div class="movie-rate">
 				 </div>
 				 <div class="movie-tabs">
 					 <div class="tabs">
 						 <ul class="tab-links tabs-mv tabs-series">
 							 <li class="active"><a href="#overview">Overview</a></li>
							 <li><a href="#media"> Media</a></li>
 						 </ul>
 							 <div class="tab-content">
 									 <div id="overview" class="tab active">
 											 <div class="row">
 												 <div class="col-md-8 col-sm-12 col-xs-12">
 													 <p><?= $rows['sinopsis']; ?></p>
 										 <div class="title-hd-sm">
 											 <h4>CAST</h4>
 										 </div>
 										 <!-- movie cast -->
										 <div class="mvcast-item">
											<?php
											$cast = explode(",",$rows['cast']);
											$rowcast = count($cast);
											 for ($i=0; $i < $rowcast; $i++) {

												echo '<div class="cast-it">
	 												<div class="cast-left">
	 													<a href="#">' . $cast[$i] . '</a>
	 												</div>
	 											</div>';

											}
											$dua5 = ($rows['T_anggaran'] * 25) / 100;
											$lima10 = ($rows['T_anggaran'] * 50) / 100;
											$val5 = encrypt($dua5);
											$vallima = encrypt($lima10);
											?>
 										</div>
											</div>
 												 <div class="col-md-4 col-xs-12 col-sm-12">
 													 <div class="sb-it">
 														 <h6>Owner of Story Ideas: </h6>
 														 <p><a href="#"><?= $rows['pemilik']; ?></a></p>
 													 </div>
 													 <div class="sb-it">
 														 <h6>Genres:</h6>
 														 <p><a href="#"><?= $rows['category']; ?></a></p>
 													 </div>
													 <div class="sb-it">
														 <h6>Status:</h6>
														 <p><a href="#"><?= $rows['decision']; ?></a></p>
													 </div>
 												 </div>
 											 </div>
 									 </div>
									 <div id="media" class="tab">
										 <div class="row">
											 <div class="rv-hd">
													 <div>
														 <h3>Videos & Photos of</h3>
													 <h2>The Big Bang Theory</h2>
													 </div>
												 </div>
									 <div class="title-hd-sm">
										 <h4>Photos</h4>
									 </div>
									 <div class="mvsingle-item">
										 <?php for ($i=0; $i < $data; $i++) { ?>
										<div class="row">
											<div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_satu=<?= $id; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_satu=<?= $id; ?>" alt=""></a>
									 </div>
									 <div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_dua=<?= $id; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_dua=<?= $id; ?>" alt=""></a>
									 </div>
									 <div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_tiga=<?= $id; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_tiga=<?= $id; ?>" alt=""></a>
									 </div>
									<div class="col">
											 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_empat=<?= $id; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_empat=<?= $id; ?>" alt=""></a>
										 </div>
									 </div>
									 <?php } ?>
									 </div>
										 </div>
									 </div>
 							 </div>
 					 </div>
 				 </div>
 			 </div>
 		 </div>
 	 </div>
  </div>
 </div>
 <?php
 require_once '../app/views/footer.php';
  ?>
