<?php require_once '../app/views/header.php'; ?>
<?php
if (!isset($_SESSION['user'])) {
	header("Location:" . BASEURL . "regist/Signin.php");
}else {
	if (isset($_GET['list'])) {
			$id = htmlspecialchars($_GET['list']);
			$false = updateTransaksi($id);
			if ($false = 0) {
			$rows = showDetails($id);
			$result = ShowOrder($id);
		}
		if ($false = 1) {
			$rows = showDetails($id);
			$result = ShowOrder($id);
		}
		// var_dump($rows);
		// die;
		// $rows = showDetails($id);
		// $result = ShowOrder($id);
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
          <h1 class="bd-hd"><?= $rows['judul']; ?> <span>Harga : <?= $result['currency']; ?><?= number_format($result['total'], 0, ",", "."); ?></span></h1>
          <div class="movie-rate">
          </div>
          <div class="movie-tabs">
            <div class="tabs">
              <ul class="tab-links tabs-mv tabs-series">
                <li class="active"><a href="#overview">Overview</a></li>
								<li><a href="#reviews"> Reviews</a></li>
              </ul>
                <div class="tab-content">
                    <div id="overview" class="tab active">
                        <div class="row">
                          <div class="col-md-8 col-sm-12 col-xs-12">
                            <p><?= $rows['sinopsis']; ?></p>
                      <div class="title-hd-sm">
                        <h4>Details Transaction</h4>
                      </div>
                      <!-- movie cast -->
                      <div class="mvcast-item">
                        <ul class="list-group">
                          <li class="list-group-item text-dark">Payment Type : <?= $result['payment']; ?></li>
                          <li class="list-group-item text-dark">Bank : <?= $result['bank']; ?></li>
													<?php if ($result['bank'] == 'mandiri'): ?>
														<li class="list-group-item text-dark">Biller Code : <?= $result['biller_code']; ?></li>
													<?php endif; ?>
                          <li class="list-group-item text-dark">Virtual Account : <?= $result['va']; ?></li>
                          <?php if ($result['status'] === 'settlement'): ?>
                            <li class="list-group-item text-dark">Status : PAID</li>
                            <?php else: ?>
                              <li class="list-group-item text-dark">Status : <?= $result['status']; ?></li>
                          <?php endif; ?>
                          <?php
                            if ($result['paid'] == "0000-00-00 00:00:00") {
                               $paid = "Not Paid";
                            }else {
                              $paid = $result['paid'];
                            }
                           ?>
                          <li class="list-group-item text-dark">Paid : <?= $paid; ?></li>
                        </ul>
                      </div>

                        </div>
                          <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="sb-it">
                              <h6>Director: </h6>
                              <p><a href="#"><?= $rows['pemilik']; ?></a></p>
                            </div>
                            <div class="sb-it">
                              <h6>Writer: </h6>
                              <p><a href="#"> Chuck Lorre,</a> <a href="#">Bill Prady</a></p>
                            </div>
                            <div class="sb-it">
                              <h6>Stars: </h6>
                              <p><?= '<a>'. $rows['cast'] .'</a>' ?></p>
                            </div>
                            <div class="sb-it">
                              <h6>Genres:</h6>
                              <p><a href="#"><?= $rows['category']; ?></a></p>
                            </div>
                            <div class="sb-it">
                              <h6>Status:</h6>
                              <p><?= $rows['decision']; ?></p>
                            </div>
                          </div>
                        </div>
                    </div>
										<div id="reviews" class="tab review">
											 <div class="row">
													<div class="rv-hd">
														<div class="div">
															<h3>Rate this movie</h3>
														<h2><?= $rows['judul']; ?></h2>
														</div>
													</div>
													<div class="topbar-filter">
										</div>
									<!-- <form> -->
										<div class="mb-3">
											<h1 class="text-center mt-2 mb-4">
												<i class="fas fa-star star-light submit_star" id="submit_star_0" data-rating="1"></i>
												<i class="fas fa-star star-light submit_star" id="submit_star_1" data-rating="2"></i>
												<i class="fas fa-star star-light submit_star" id="submit_star_2" data-rating="3"></i>
												<i class="fas fa-star star-light submit_star" id="submit_star_3" data-rating="4"></i>
												<i class="fas fa-star star-light submit_star" id="submit_star_4" data-rating="5"></i>
											</h1>
										</div>
  									<div class="mb-3">
    									<label for="exampleInputEmail1" class="form-label">Judul</label>
    									<input type="text" name="judul" class="form-control" id="judul" aria-describedby="emailHelp">
  									</div>
  									<div class="mb-3">
    									<label for="exampleInputPassword1" class="form-label">Comment</label>
    									<textarea type="text" name="comment" class="form-control" id="comment"></textarea>
  									</div>
  									<button type="submit" class="btn btn-primary" id="submit">Submit</button>
									<!-- </form> -->
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
	<script type="text/javascript">
		$(document).ready(function(){
			var rating_data = 0;
			function reset_background() {
				for (var i = 0; i <= 5; i++) {
					$('#submit_star_'+i).addClass('star_light');
					$('#submit_star_'+i).removeClass('text-warning');
				}
			}

			$(document).on('mouseenter', '.submit_star', function(){
				var rating = $(this).data('rating');
				reset_background();
				for (var i = 0; i < rating; i++) {
					$('#submit_star_'+i).addClass('text-warning');
				}
			});
			$(document).on('click', '.submit_star', function(){
				rating_data = $(this).data('rating');
				for (var i = 0; i < rating_data; i++) {
					$('#submit_star_'+i).addClass('text-warning');
				}
				// console.log(rating_data);
			});
			
		    $('#submit').click(function(){
		    	var judul = $('#judul').val();
		    	var comment = $('#comment').val();
		    	var movieId = "<?= $id ?>";
		    	if (judul == '' || comment == '') {
		    		alert("Tolong lengkapin input formnya");
		    		return false;
		    	}else {
		    		$.ajax({
		    			url: "<?= BASEURL; ?>app/function/edit.php?rate",
		    			method: "POST",
		    			data: {rating_data:rating_data, judul:judul, comment:comment, movieId:movieId},
		    			success:function(data)
		    			{
								$('#judul').val('');
								$('#comment').val('');
		    				alert(data);
		    			}
		    		})
		    	}
		    });

	});
	</script>
