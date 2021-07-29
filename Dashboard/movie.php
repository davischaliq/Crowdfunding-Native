<?php require_once '../app/views/header.php'; ?>
<?php
if (!isset($_SESSION['user'])) {
	header("Location:" . BASEURL . "regist/Signin.php");
}else {
	if (isset($_GET['list'])) {
			$id = htmlspecialchars($_GET['list']);
			$rows = showDetailsYourMovie($id);
			// var_dump($rows);
			// die;
	}
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
							 <?php if ($rows['decision'] == 'preproduction' OR $rows['decision'] == 'onproduction'): ?>
								 <li><a href="<?= BASEURL; ?>Dashboard/history.php?list=<?= $id ?>">History</a></li>
							 <?php endif; ?>
							 <?php if ($rows['decision'] == 'accepted'): ?>
								 <li><a href="<?= BASEURL; ?>Dashboard/Agrement.php?list=<?= $id ?>">Agrement</a></li>
							 <?php endif; ?>
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
													 <div class="sb-it">
														 <h6>Dana yang di setujui:</h6>
														 <?php if ($rows['labels'] === 'NULL' ): ?>
															 <p><a href="#">Tidak Ada</a></p>
															 <?php else: ?>
															<p><a href="#"><?= $rows['labels']; ?></a></p>
														 <?php endif; ?>
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
 </div>
 <?php
 require_once '../app/views/footer.php';
  ?>
