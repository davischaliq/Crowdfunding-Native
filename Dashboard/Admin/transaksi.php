<!-- untuk bagian head -->
<?php include_once ('../app/views/head.php') ?>
<?php

if ($_SESSION['admin'] != null) {
  $user = $_SESSION['admin'];
  $cek = mysqli_escape_string($conn, $user);
  $ex = mysqli_query($conn, "SELECT user_details.nama, user_details.email, user_details.hp, user_details.perusahaan, user_details.alamat, user_details.city, user_details.state, user_details.zip, transaksi.order_id, transaksi.payment, transaksi.bank, transaksi.currency, transaksi.status, transaksi.paid, movieoncoming.id, movieoncoming.judul, movieoncoming.img FROM user_details INNER JOIN transaksi ON user_details.user=transaksi.username INNER JOIN movieoncoming ON movieoncoming.id=transaksi.id_film WHERE transaksi.status != 'Not Found'");
}else {
  header('Location:' . BASEURL);
  return false;
}
 ?>
<body class="nav-md">
  <!-- awal container -->
  <div class="container body">
    <div class="main_container">

      <!-- menu samp ing -->
      <?php include_once ('../app/views/header.php'); ?>

      <!-- awal isi halaman -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Transaksi</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <!-- untuk bagian tabel dan awal row tabel -->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Transaction</h2>
                  <div class="clearfix"></div>
                </div>
              <div class="x_content">

            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">No Handphone</th>
                  <th scope="col">Perusahaan</th>
                  <th scope="col">Alamat Perusahaan</th>
                  <th scope="col">Negara</th>
                  <th scope="col">Kota</th>
                  <th scope="col">Kode Pos</th>
                  <th scope="col">Order Id</th>
                  <th scope="col">Jenis Pembayaran</th>
                  <th scope="col">Nama Bank</th>
                  <th scope="col">Mata Uang</th>
                  <th scope="col">Status Transaksi</th>
                  <th scope="col">Tanggal Pembayaran</th>
                  <th scope="col">Judul Movie</th>
                </tr>
              </thead>
              <?php
              $no = 0;
              while ($result = mysqli_fetch_assoc($ex)) {
                $no++;
                ?>
            <tbody>
              <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $result['nama']; ?></td>
                <td><?= $result['email']; ?></td>
                <td><?= $result['hp']; ?></td>
                <td><?= $result['perusahaan']; ?></td>
                <td><?= $result['alamat']; ?></td>
                <td><?= $result['state']; ?></td>
                <td><?= $result['city']; ?></td>
                <td><?= $result['zip']; ?></td>
                <td><?= $result['order_id']; ?></td>
                <td><?= $result['payment']; ?></td>
                <td><?= $result['bank']; ?></td>
                <td><?= $result['currency']; ?></td>
                <?php if ($result['status'] == 'settlement'){
                  $statusT = 'succes';
                }else {
                  $statusT = $result['status'];
                } ?>
                <td><?= $statusT ?></td>
                <td><?= $result['paid']; ?></td>
                <td><?= $result['judul']; ?> <br> <img src="<?= BASEURL; ?>app/core/view_image?id_MO=<?= $result['id']; ?>" width="200px"></td>
              </tr>
             </tbody>
           <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
          <!-- akhir row tabel -->

        </div>
      </div>
      <!-- akhir isi halaman -->

      <!-- footer -->
      <?php include_once ('../app/views/footer.php'); ?>

    </div>
  </div>
  <!-- akhir container -->

<!-- untuk bagian foot -->
<?php include_once ('../app/views/foot.php'); ?>
