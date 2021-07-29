<?php
require_once '../app/init.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Main css -->
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/regist.css">
  </head>
  <body>
    <div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signin-content">
                <div class="signin-form">
                    <h2 class="form-title">Sign up</h2>
                    <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                      Password do not match
                    </div>
                  <?php endif; ?>
                  <?php if (isset($_GET['registered'])): ?>
                  <div class="alert alert-danger" role="alert">
                    Account you entered, account already exists
                  </div>
                <?php endif; ?>
                    <form method="POST" action="<?= BASEURL; ?>app/function/edit.php?regist" class="register-form" id="register-form">
                      <div class="form-group">
                          <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                          <input type="text" name="name" id="name" placeholder="Your fullname"/ required>
                      </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="user" id="name" placeholder="username"/ required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/ required>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password"/ required>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/ required>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <br>
                <div class="">
                    <figure><img class="img-fluid" width="720px" style="margin-top: 85px;"src="<?= BASEURL; ?>assets/img/illustrations/regist.png" alt=""></figure>
                    <a href="<?= BASEURL; ?>regist/Signin.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
    </div>
    <script src="<?= BASEURL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
  </body>
</html>
