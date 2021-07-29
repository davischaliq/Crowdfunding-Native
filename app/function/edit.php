<?php
session_start();
require_once '../init.php';
if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
if (isset($_GET['profile'])) {
    $con_croudUser = croudUser();
    $username = $_SESSION['user'];
    $full = htmlspecialchars($_POST['full']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $company_address = htmlspecialchars($_POST['company_address']);
    $divition = htmlspecialchars($_POST['divition']);
    $city = htmlspecialchars($_POST['city']);
    $postal = htmlspecialchars($_POST['postal']);
    $ppTmp = $_FILES['pp']['tmp_name'];
    $ppName = $_FILES['pp']['name'];
    $ppSize = $_FILES['pp']['size'];
    $ppError = $_FILES['pp']['error'];
    $ex = mysqli_query($con_croudUser, "SELECT full_name, company, divition, phone, company_address, city, postal FROM user_details WHERE username = '$username'");
    $result = mysqli_fetch_assoc($ex);
    if ($full == '') {
      $full = $result['full_name'];
    }
    if ($phone == '') {
      // code...
      $phone = $result['phone'];
    }
    if ($company == '') {
      // code...
      $company = $result['company'];
    }
    if ($company_address == '') {
      // code...
      $company_address = $result['company_address'];
    }
    if ($divition == '') {
      // code...
      $divition = $result['divition'];
    }
    if ($city == '') {
      // code...
      $city = $result['city'];
    }
    if ($postal === '') {
      // code...
      $postal = $result['postal'];
    }

    $updatepp = editProfile($full, $phone, $company, $company_address, $divition, $city, $postal, $username, $ppTmp, $ppName, $ppSize, $ppError);
    if ($updatepp < 1) {
      header('location:' . BASEURL . 'Dashboard/user_das.php?profile&success');
    }else {
      header('location:' . BASEURL . 'Dashboard/user_das.php?profile&error');
    }
}

if (isset($_GET['invest'])) {
  // sendInvest();
  $error = sendInvest();
  if ($error > 0) {
    header("Location:" . BASEURL . "Invest/start.php?error");
  }else {
    header("Location:" . BASEURL . "Invest/start.php?success");
  }
}
//
// if (isset($_GET['report'])) {
//   $id = htmlspecialchars($_GET['report']);
//   $error = sendReport($id);
//   if ($error > 0) {
//     header("Location:" . BASEURL . "Dashboard/history.php?error&list=" . $id);
//   }else {
//     header("Location:" . BASEURL . "Dashboard/history.php?success&list=" . $id);
//     }
//   }

  if (isset($_GET['agrement'])) {
    $id = htmlspecialchars($_GET['agrement']);
    $error = sendAgrement($id);
    if ($error > 0) {
      header("Location:" . BASEURL . "Dashboard/Agrement.php?error&list='$id'");
    }else {
      header("Location:" . BASEURL . "Dashboard/Agrement.php?success&list='$id'");
      }
    }
}

if (isset($_GET['regist'])) {
  if (isset($_POST['signup'])) {
    $full = htmlspecialchars($_POST['name']);
    $user = htmlspecialchars($_POST['user']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $repass = htmlspecialchars($_POST['re_pass']);
    if ($pass != $repass) {
      header("Location:" . BASEURL . "regist/Signup.php?error");
    }else {
      $error = Regist($full, $user, $email, $pass);
      if ($error > 0) {
        header("Location:" . BASEURL . "regist/Signup.php?registered");
      }
    }
  }
}


if (isset($_GET['rate'])) {
  $judul = htmlspecialchars($_POST['judul']);
  $comment = htmlspecialchars($_POST['comment']);
  $rating = htmlspecialchars($_POST['rating_data']);
  $id = htmlspecialchars($_POST['movieId']);
  rate($judul, $comment, $rating, $id);
}

if (isset($_GET['showRate'])) {
  $id = htmlspecialchars($_POST['movieId']);
  // $id = htmlspecialchars($_GET['showRate']);
  showRate($id);
}

if (isset($_GET['chpass'])) {
  $pass = htmlspecialchars($_POST['pass']);
  $re_pass = htmlspecialchars($_POST['repass']);
  // chpass($pass);
  if ($pass === $re_pass) {
    $error = chpass($pass);
    if ($error = 0) {
      header('Location:' . BASEURL . 'Dashboard/user_das.php?change&success');
    }else {
      header('Location:' . BASEURL . 'Dashboard/user_das.php?change&error');
    }
  }else {
    header('Location:' . BASEURL . 'Dashboard/user_das.php?change&error');
  }
}
