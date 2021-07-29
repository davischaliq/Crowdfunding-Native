<?php
  $data = showYourMovie();
   ?>
   <div class="movie-items">
   	<div class="container">
   		<div class="row ipad-width">
   			<div class="title-hd">
   				<h2>Your Movie</h2>
   			</div>
   			<div class="tab-content">
   			    <div id="tab1" class="tab active">
   			        <div class="row">
                  <?php if ($data != 0): ?>
   								<div class="slick-multiItem">
                    <?php
                    $dataMovieCount = count($data);
                    for ($i=0; $i < $dataMovieCount; $i++) {
                      // $id_movie[$i] = encrypt();
                      ?>
   									<div class="movie-item">
   										<div class="mv-img">
   											<a href="#"><img src="<?= BASEURL; ?>app/function/view_image.php?MO=<?= $data[$i]['id_movie']; ?>" alt="" width="285" height="437"></a>
   										</div>
   										<div class="title-in">
   											<div class="cate">
   												<span class="blue"><a><?= $data[$i]['category']; ?></a></span>
   											</div>
   											<h6><a href="<?= BASEURL; ?>Dashboard/movie.php?list=<?= $data[$i]['id_movie']; ?>"><?= $data[$i]['judul']; ?></a></h6>
   											</div>
   										</div>
                      <?php } ?>
   								</div>
                  <?php else: ?>
                    <div class="movie-items">
                      <h1 class="text-center" style="color: #FFFFFF;">You don't have film to invest</h1>
                      <p class="text-center">Let's start film production together with produksi film negara</p>
                      <div class="row">
                        <div class="position-relative">
                          <div class="position-absolute top-0 start-50 translate-middle-x">
                            <a href="<?= BASEURL; ?>Invest/start.php" class="btn btn-outline-danger btn-lg align-middle" tabindex="-1" role="button" aria-disabled="true">Start Your Journey</a>
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
