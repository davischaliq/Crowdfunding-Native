<?php require_once '../app/views/header.php'; ?>
<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="social-link">
				<p>Follow us: </p>
				<a href="#"><i class="ion-social-facebook"></i></a>
				<a href="#"><i class="ion-social-twitter"></i></a>
				<a href="#"><i class="ion-social-googleplus"></i></a>
				<a href="#"><i class="ion-social-youtube"></i></a>
			</div>
	    	<div  class="slick-multiItemSlider">
					<?php $dataColl = showColl(); ?>
					<?php if ($dataColl != 0): ?>
						<?php $dataCollCount = count($dataColl); ?>
						<?php
						for ($i=0; $i < $dataCollCount; $i++) {
							// $encriptColl[$i] = encrypt($dataColl[$i]['id_movie']);
							$showRateAllColl[$i] = showRateAll($dataColl[$i]['id_movie']);
							?>
					<div class="movie-item">
						<div class="mv-img">
							<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $dataColl[$i]['id_movie']; ?>" alt="" width="285" height="437"></a>
						</div>
						<div class="title-in">
							<div class="cate">
								<span class="blue"><a href="#"><?= $dataColl[$i]['category']; ?></a></span>
							</div>
							<h6><a href="<?= BASEURL; ?>Collab/invest.php?list=<?= $dataColl[$i]['id_movie']; ?>"><?= $dataColl[$i]['judul']; ?></a></h6>
							<p><i class="ion-android-star"></i><span><?= $showRateAllColl[$i] ?></span> /10</p>
							</div>
						</div>
					<?php } ?>
				<?php else: ?>
			<?php endif; ?>
	    	</div>
	    </div>
	</div>
</div>
<div class="movie-items">
	<div class="container">
		<div class="row ipad-width">
			<div class="title-hd">
				<h2>Realised Collaboration</h2>
			</div>
			<div class="tab-content">
			    <div id="tab1" class="tab active">
			        <div class="row">
								<div class="slick-multiItem">
									<?php $dataRelease = showRelease(); ?>
									<?php if ($dataRelease != 0): ?>
										<?php $dataCountRealise = count($dataRelease); ?>
									<?php
										for ($u=0; $u < $dataCountRealise; $u++) {
											// $movie_idEncR[$u] = encrypt($dataRelease[$u]['id_movie']);
											$showRateAllRelease[$u] = showRateAll($dataRelease[$u]['id_movie']);
									 	?>
									<div class="movie-item">
										<div class="mv-img">
											<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $dataRelease[$u]['id_movie']; ?>" alt="" width="285" height="437"></a>
										</div>
										<div class="title-in">
											<div class="cate">
												<span class="green"><a href="#"><?= $dataRelease[$u]['category']; ?></a></span>
											</div>
											<h6><a href="<?= BASEURL; ?>Collab/release.php?list=<?= $dataRelease[$u]['id_movie']; ?>"><?= $dataRelease[$u]['judul']; ?></a></h6>
											<p><i class="ion-android-star"></i><span><?= $showRateAllRelease[$u] ?></span> /10</p>
											</div>
										</div>
									<?php } ?>
									<?php else: ?>
								<?php endif; ?>
								</div>
			        </div>
			    </div>
			</div>
			<div class="movie-items">
				<div class="container">
					<div class="row ipad-width">
						<div class="title-hd">
							<h2>Collaboration</h2>
						</div>
						<div class="slick-multiItem">
							<?php $data = showColl(); ?>
							<?php if ($data != 0): ?>
								<?php $dataCount = count($data); ?>
							<?php
								for ($i=0; $i < $dataCount; $i++) {
										// $encript[$i] = encrypt($data[$i]['id_movie']);
										$showRateAll[$i] = showRateAll($data[$i]['id_movie']);
									?>
							<div class="movie-item">
								<div class="mv-img">
									<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $data[$i]['id_movie']; ?>" alt="" width="285" height="437"></a>
								</div>
								<div class="title-in">
									<div class="cate">
										<span class="blue"><a href="#"><?= $data[$i]['category']; ?></a></span>
									</div>
									<h6><a href="<?= BASEURL; ?>Collab/invest.php?list=<?= $data[$i]['id_movie']; ?>"><?= $data[$i]['judul']; ?></a></h6>

									<p><i class="ion-android-star"></i><span><?= $showRateAll[$i] ?></span> /10</p>
									</div>
								</div>
							<?php } ?>
						<?php else: ?>
					<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="movie-items">
					<div class="container">
						<div class="row ipad-width">
							<div class="title-hd">
								<h2>On Production</h2>
							</div>
							<div class="slick-multiItem">
								<?php $dataCompleted = showComplited(); ?>
								<?php if ($dataCompleted != 0): ?>
									<?php $dataCountcompleted = count($dataCompleted); ?>
								<?php
									for ($s=0; $s < $dataCountcompleted; $s++) {
										// $movie_idEnc[$s] = encrypt($dataCompleted[$s]['id_movie']);
										$showRateAllProduction[$s] = showRateAll($dataCompleted[$s]['id_movie']);
									?>
									<div class="movie-item">
										<div class="mv-img">
											<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $dataCompleted[$s]['id_movie']; ?>" alt="" width="285" height="437"></a>
										</div>
										<div class="title-in">
											<div class="cate">
												<span class="green"><a href="#"><?= $dataCompleted[$s]['category']; ?></a></span>
											</div>
											<h6><a href="<?= BASEURL; ?>Collab/invest.php?list=<?= $dataCompleted[$s]['id_movie']; ?>"><?= $dataCompleted[$s]['judul']; ?></a></h6>
											<p><i class="ion-android-star"></i><span><?= $showRateAllProduction[$s] ?></span> /10</p>
											</div>
										</div>
								<?php } ?>
							<?php else: ?>
						<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>

<div class="trailers">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-12">
				<div class="title-hd">
					<h2>in theater</h2>
					<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
				</div>
				<div class="videos">
				 	<div class="slider-for-2 video-ft">
				 		<div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/1Q8fG0TtVAY"></iframe>
					    </div>
					    <div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/w0qQkSuWOS8"></iframe>
					    </div>
					    <div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/44LdLqgOpjo"></iframe>
					    </div>
					    <div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/gbug3zTm3Ws"></iframe>
					    </div>
					    <div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/e3Nl_TCQXuw"></iframe>
					    </div>
					    <div>
					    	<iframe class="item-video" src="#" data-src="https://www.youtube.com/embed/NxhEZG0k9_w"></iframe>
					    </div>


					</div>
					<div class="slider-nav-2 thumb-ft">
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer7.jpg"  alt="photo by Barn Images" width="4096" height="2737">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Wonder Woman</h4>
	                        	<p>2:30</p>
	                        </div>
						</div>
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer2.jpg"  alt="photo by Barn Images" width="350" height="200">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Oblivion: Official Teaser Trailer</h4>
	                        	<p>2:37</p>
	                        </div>
						</div>
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer6.jpg" alt="photo by Joshua Earle">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Exclusive Interview:  Skull Island</h4>
	                        	<p>2:44</p>
	                        </div>
						</div>
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer3.png" alt="photo by Alexander Dimitrov" width="100" height="56">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Logan: Director James Mangold Interview</h4>
	                        	<p>2:43</p>
	                        </div>
						</div>
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer4.png"  alt="photo by Wojciech Szaturski" width="100" height="56">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Beauty and the Beast: Official Teaser Trailer 2</h4>
	                        	<p>2: 32</p>
	                        </div>
						</div>
						<div class="item">
							<div class="trailer-img">
								<img src="<?= BASEURL; ?>assets/images/uploads/trailer5.jpg"  alt="photo by Wojciech Szaturski" width="360" height="189">
							</div>
							<div class="trailer-infor">
	                        	<h4 class="desc">Fast&Furious 8</h4>
	                        	<p>3:11</p>
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
