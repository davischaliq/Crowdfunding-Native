<?php
if (isset($_SESSION['user']) && $_SESSION != "") {
  $result = showProfile();
}
 ?>
<div class="container">
  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <div>
        <strong>Gagal upload file</strong><p>Format photo harus jpg/png/jpeg dan berat file maksimal 1MB</p>
        </div>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <div>
          <strong>Sucess</strong><br>
          <p>Update Data Berhasil</p>
        </div>
      </div>
    <?php endif; ?>
  <div class="row ipad-width">
    <div class="title-hd">
      <h2>Profile</h2>
    </div>
    <div class="tab-content">
      <div class="row">
    <h3  style="color: #FFFFFF;">Name : <?= $result['full_name']; ?></h3>
    <?php if ($result['company'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">Company : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">Company : <?= $result['company']; ?></h3>
    <?php endif; ?>
    <?php if ($result['divition'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">Divition : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">Divition : <?= $result['divition']; ?></h3>
    <?php endif; ?>
    <h3  style="color: #FFFFFF;">Email : <?= $result['email']; ?></h3>
    <?php if ($result['phone'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">Phone : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">Phone: <?= $result['phone']; ?></h3>
    <?php endif; ?>
    <?php if ($result['company_address'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">Company Address : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">Company Address : <?= $result['company_address']; ?></h3>
    <?php endif; ?>
    <?php if ($result['city'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">City : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">City : <?= $result['city']; ?></h3>
    <?php endif; ?>
    <?php if ($result['postal'] === 'NULL'): ?>
        <h3  style="color: #FFFFFF;">Postal : </h3>
      <?php else: ?>
        <h3  style="color: #FFFFFF;">Postal : <?= $result['postal']; ?></h3>
    <?php endif; ?>
  </div>
  <div class="row">
    <div class="col">
    <button class="btn btn-primary mt-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Edit
</button>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <div class="row">
          <div class="col-md-5">
            <form action="<?= BASEURL; ?>app/function/edit.php?profile" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="color: #000000;">Full Name</label>
                <input type="text" name="full" class="form-control" >
              </div>
            <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label" style="color: #000000;">Phone</label>
        <input type="text" name="phone" class="form-control">
      </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label" style="color: #000000;">Company</label>
            <input type="text" name="company" class="form-control">
              </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label" style="color: #000000;">City</label>
                    <input type="text" name="city" class="form-control">
                      </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label" style="color: #000000;">Postal</label>
                        <input type="text" name="postal" class="form-control">
                      </div>
                    <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label" style="color: #000000;">Company address</label>
                <textarea class="form-control" name="company_address" placeholder="Place your company address here" style="height: 100px"></textarea>
              </div>
            <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label" style="color: #000000;">Divition</label>
          <input type="text" name="divition" class="form-control">
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Change Profile</label>
              <input class="form-control" name="pp" type="file" id="formFile">
            </div>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
</div>
