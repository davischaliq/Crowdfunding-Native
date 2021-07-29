<?php
  $movie_id = showOrderAll();
  if ($movie_id > 0) {
    $dataTransaksiUser = showMovieTransaksi($movie_id);
  }else {

  }
   ?>
   <div class="movie-items">
   	<div class="container">
   		<div class="row ipad-width">
   			<div class="title-hd">
   				<h2>Your Order</h2>
   			</div>
   			<div class="tab-content">
   			    <div id="tab1" class="tab active">
   			        <div class="row">
                  <?php if ($movie_id != 0): ?>
   								<div class="slick-multiItem">
                    <?php
                    $countT = count($dataTransaksiUser);
                    for ($i=0; $i < $countT; $i++) {
                      $id_movie[$i] = encrypt($dataTransaksiUser[$i]['id_movie']);
                      ?>
   									<div class="movie-item">
   										<div class="mv-img">
   											<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $id_movie[$i]; ?>" alt="" width="285" height="437"></a>
   										</div>
   										<div class="title-in">
   											<div class="cate">
   												<span class="blue"><a><?= $dataTransaksiUser[$i]['category']; ?></a></span>
   											</div>
   											<h6><a href="<?= BASEURL; ?>Collab/order_details.php?list=<?= $id_movie[$i]; ?>"><?= $dataTransaksiUser[$i]['judul']; ?></a></h6>
   											</div>
   										</div>
                      <?php }?>
   								</div>
                  <?php else: ?>
                    <div class="movie-items">
                      <h1 class="text-center" style="color: #FFFFFF;">You don't have movie order</h1>
                      <p class="text-center">Let's start to choose movie, what do you like to invest</p>
                      <div class="row">
                        <div class="position-relative">
                          <div class="position-absolute top-0 start-50 translate-middle-x">
                            <a href="<?= BASEURL; ?>Collab/movie_coll.php" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Journey</a>
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
  </div>
