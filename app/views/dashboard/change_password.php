<div class="container">
  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <div>
        <strong>Gagal ganti password</strong><p>Mohon perhatikan kembali password yang di masukan</p>
        </div>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success d-flex align-items-center" role="alert">
        <div>
          <strong>Sucess</strong><br>
          <p>Berhasil ganti password</p>
        </div>
      </div>
    <?php endif; ?>
  <div class="row ipad-width">
    <div class="title-hd">
      <h2>Change your password</h2>
    </div>
    <div class="tab-content">
      <div class="row">
        <div class="col-md-5">
        <form method="POST" action="<?= BASEURL; ?>app/function/edit.php?chpass">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm password</label>
            <input type="password" name="repass" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
   </div>
 </div>
</div>
