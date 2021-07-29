<?php require_once '../app/views/header.php'; ?>
<?php
// require_once '../app/init.php';
// session_start();
if (!isset($_SESSION['user'])) {
	header("Location:" . BASEURL . "regist/Signin.php");
}else {
	if (isset($_GET['list'])) {
			$id = htmlspecialchars($_GET['list']);
			$CekuserT = CekTransaksi($id);
			if ($CekuserT > 0) {
				updateAnggaran($id);
			}else {
			}
			$rows = showDetails($id);
			$blocked = blockedAksesInvest($id);
			$data = showMedia($id);
			$rate_content = showRatingContent($id);
			if ($rate_content != 0) {
				$Count_rate_content = count($rate_content);
			}else {
				$Count_rate_content = 0;
			}
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
					 <div class="rate">
						 <i class="ion-android-star"></i>
						 <p><span class="averange_rating">0.0</span> /10<br>
							 <span class="rv" id="total_rating">0</span><span class="rv"> Reviews</span>
						 </p>
					 </div>
					 <div class="rate-star">
						 <i class="ion-ios-star-outline main_star"></i>
						 <i class="ion-ios-star-outline main_star"></i>
						 <i class="ion-ios-star-outline main_star"></i>
						 <i class="ion-ios-star-outline main_star"></i>
						 <i class="ion-ios-star-outline main_star"></i>
					 </div>
 				 </div>
 				 <div class="movie-tabs">
 					 <div class="tabs">
 						 <ul class="tab-links tabs-mv tabs-series">
 							 <li class="active"><a href="#overview">Overview</a></li>
							 <li><a href="#media">Media</a></li>
							 <li><a href="#reviews"> Reviews</a></li>
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
											$dua5 = ($rows['T_anggaran'] - $rows['anggaran_T']) * 0.25;
											$lima10 = ($rows['T_anggaran'] - $rows['anggaran_T']) * 0.5;
											$val5 = encrypt($dua5);
											$vallima = encrypt($lima10);
											?>
 										</div>
 										<div class="title-hd-sm">
 											<h4>Invest</h4>
 										</div>
										<div class="movie-items">
												<div class="row ipad-width">
														    <div class="tab-content">
														        <div id="tab1" class="tab active">
														            <div class="row">
																					<?php if ($blocked > 0 OR $rows['T_anggaran'] == $rows['anggaran_T']): ?>
																						<h1 class="text-center" style="color: #FFFFFF;">Sorry you can't start invest in this movie</h1>
																								<div class="position-relative">
																									<div class="position-absolute top-0 start-50 translate-middle-x">
																								<a href="<?= BASEURL; ?>Collab/movie_coll.php" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Journey</a>
																							</div>
																						</div>
																						<?php else: ?>
																							<div class="slick-multiItem">
																								<div class="slide-it">
																									<div class="movie-item">
																										<div class="mv-img">
																											<img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $id; ?>" alt="" width="185" height="284">
																										</div>
																										<div class="hvr-inner">
																											<a class="loginLink">Invest</a>
																										</div>
																										<div class="title-in">
																											<h6><a href="#"><?= $dua5; ?></a></h6>
																										</div>
																									</div>
																								</div>
																								<div class="slide-it">
																									<div class="movie-item">
																										<div class="mv-img">
																											<img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $id; ?>" alt="" width="185" height="284">
																										</div>
																										<div class="hvr-inner">
																											<a class="signupLink">Invest</a>
																										</div>
																										<div class="title-in">
																											<h6><a href="#"><?= $lima10; ?></a></h6>
																										</div>
																									</div>
																								</div>
																							</div>
																					<?php endif; ?>
														        </div>
							 										</div>
																</div>
															</div>
														</div>
													<div class="login-wrapper"  id="signup-content">
																<div class="login-content">
																		<a href="#" class="close">x</a>
																				<div class="row">
																					<h1 class="text-center" style="color: #FFFFFF;">you will invest 50%</h1>
																					<p class="text-center">if you invest in this film for 50% of the total budget requirement, you will get 10% of the profit from the sale of cinema tickets</p>
																					<div class="position-relative">
																						<div class="position-absolute top-0 start-50 translate-middle-x">
																							<a href="<?= BASEURL; ?>Checkout/checkout-process.php?movie=<?= $id; ?>&val=<?=$vallima;?>" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Invest</a>
																						</div>
																				</div>
																		</div>
																	</div>
															</div>
															<div class="login-wrapper"  id="login-content">
																	<div class="login-content">
																			<a href="#" class="close">x</a>
																					<div class="row">
																						<h1 class="text-center" style="color: #FFFFFF;">you will invest 25%</h1>
																						<p class="text-center">if you invest in this film for 25% of the total budget requirement, you will get 5% of the profit from the sale of cinema tickets</p>
																						<div class="position-relative">
																							<div class="position-absolute top-0 start-50 translate-middle-x">
																								<a href="<?= BASEURL; ?>Checkout/checkout-process.php?movie=<?= $id; ?>&val=<?= $val5; ?>" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Invest</a>
																							</div>
																					</div>
																			</div>
																		</div>
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
														 <h6>Compro:</h6>
														 <p><a href="<?= BASEURL ?>app/function/download.php?compro=<?= $id ?>">Download</a></p>
													 </div>
 												 </div>
 											 </div>
 									 </div>
									 <div id="media" class="tab">
										 <div class="row">
											 <div class="rv-hd">
													 <div>
														 <h3>Photos of</h3>
													 <h2><?= $rows['judul']; ?></h2>
													 </div>
												 </div>
									 <div class="title-hd-sm">
										 <h4>Photos</h4>
									 </div>
									 <div class="mvsingle-item">
										 <?php
										 if ($data != 0) {
											 			$dataCount = count($data);
										 for ($i=0; $i < $dataCount; $i++) {
											 // $movie_id[$i] = encrypt($data[$i]['movie_id']);
											 // $tgl[$i] = encrypt($data[$i]['tgl']);
											  ?>
										<div class="row">
											<div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_satu=<?= $data[$i]['movie_id']; ?>&tgl=<?= $data[$i]['tgl']; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_satu=<?= $movie_id[$i]; ?>&tgl=<?= $tgl[$i]; ?>" alt=""></a>
									 </div>
									 <div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_dua=<?= $data[$i]['movie_id']; ?>&tgl=<?= $data[$i]['tgl']; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_dua=<?= $movie_id[$i]; ?>&tgl=<?= $tgl[$i]; ?>" alt=""></a>
									 </div>
									 <div class="col">
										 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_tiga=<?= $data[$i]['movie_id']; ?>&tgl=<?= $data[$i]['tgl']; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_tiga=<?= $movie_id[$i]; ?>&tgl=<?= $tgl[$i]; ?>" alt=""></a>
									 </div>
									<div class="col">
											 <a class="img-lightbox"  data-fancybox-group="gallery" href="<?= BASEURL; ?>app/function/view_image.php?media_empat=<?= $data[$i]['movie_id']; ?>&tgl=<?= $data[$i]['tgl']; ?>" ><img src="<?= BASEURL; ?>app/function/view_image.php?media_empat=<?= $movie_id[$i]; ?>&tgl=<?= $tgl[$i]; ?>" alt=""></a>
										 </div>
									 </div>
									 <?php } ?>
								 <?php }else { ?>
								<?php } ?>
									 </div>
										 </div>
									 </div>
									 <div id="reviews" class="tab review">
											<div class="row">
												 <div class="rv-hd">
													 <div class="div">
														 <h3>Related Movies To</h3>
													 <h2><?= $rows['judul']; ?></h2>
													 </div>
												 </div>
												 <div class="topbar-filter">
										 <p>Found <span id="total_rating_overview">0</span> reviews in total</p>
									 </div>
 						 	</div>
							<?php if ($Count_rate_content == 0): ?>
								<h1 class="text-center" style="color: #FFFFFF;">Sorry not anyone review this movie</h1>
										<div class="position-relative">
											<div class="position-absolute top-0 start-50 translate-middle-x">
									</div>
								</div>
							<?php else: ?>
							<?php for ($i=0; $i < $Count_rate_content; $i++) { ?>
							<div class="mv-user-review-item">
								<div class="user-infor">
									<img src="<?= BASEURL; ?>app/function/view_image.php?imgRate=<?=$rate_content[$i]['username']; ?>" alt="">
									<div>
										<h3><?= $rate_content[$i]['judul'] ?></h3>
										<div class="no-star">
											<?php
											 $rate = intval($rate_content[$i]['rating']);
											 for ($s=0; $s < $rate; $s++) { ?>
												 <i class="ion-android-star"></i>
											 <?php } ?>
										</div>
										<p class="time">
											<?= $rate_content[$i]['tgl'] ?> by <a href="#"> <?= $rate_content[$i]['username']; ?></a>
										</p>
									</div>
								</div>
								<p><?= $rate_content[$i]['comment'] ?></p>
							</div>
						<?php } ?>
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
 <?php
 require_once '../app/views/footer.php';
  ?>
	<script type="text/javascript">
		function load_rating_data()
		{
			var movieId = "<?= $id ?>";
			$.ajax({
				url: "<?= BASEURL ?>app/function/edit.php?showRate",
				method: "POST",
				data:{movieId: movieId},
				dataType: "JSON",
				success: function(data)
				{
					// console.log(data);
					$('.averange_rating').text(data.averange_rating);
					$('#total_rating').text(data.total_review);
					$('#total_rating_overview').text(data.total_review);
					var count_star = 0;
					$('.main_star').each(function(){
						count_star++;
						if (Math.ceil(data.averange_rating) >= count_star) {
							$(this).addClass('ion-ios-star');
						}else {
							$(this).addClass('ion-ios-star-outline');
						}
					});

				}
			})
		}
		load_rating_data();
	</script>
