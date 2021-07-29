<!-- index admin -->
<?php require_once '../app/views/header.php'; ?>
<?php
if ($_SESSION['admin'] != null) {
  $params = $_SESSION['admin'];
  $cek = mysqli_escape_string($conn, $params);
}else {
  header('Location:' . BASEURL);
  return false;
}
 ?>
<body class="nav-md">
  <!-- awal container -->
  <div class="container body">
    <div class="main_container">

      <!-- menu samping -->
      <?php require_once 'header.php'; ?>

      <!-- awal isi halaman -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Dashboard</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="">
                <div class="x_content">
                  <div class="row">

                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon">
                        <i class="fas fa-file-invoice"></i>
                      </div>
                      <?php
                      $qrOncoming = "SELECT * FROM transaksi";
                      $ex = mysqli_query($conn, $qrOncoming);
                      $result = mysqli_num_rows($ex);
                      ?>
                      <div class="count"><?= $result; ?></div>
                      <h3><a href="transaksi.php">Jumlah Transaksi</a></h3>
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
      <!-- akhir isi halaman -->

      <!-- footer -->
      <?php require_once 'footer.php'; ?>

    </div>
  </div>
  <!-- akhir container -->

<?php require_once 'foot.php'; ?>
