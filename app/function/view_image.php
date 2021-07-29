<?php
require_once '../core/db.php';
require_once 'function.php';
if (isset($_GET['MO'])) {
  $id = htmlspecialchars($_GET['MO']);
  $con_croudContent = croudContent();
  // $decre = decrypt($id);
  $decre = $id;
  $cek= mysqli_escape_string($con_croudContent, $decre);
  $qr = "SELECT img FROM movieoncoming WHERE id_movie = '$cek'";
  $result = mysqli_query($con_croudContent, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["img"];
}

if (isset($_GET['user'])) {
  session_start();
  $con_croudContent = croudUser();
  $username = $_SESSION['user'];
  $cek= mysqli_escape_string($con_croudContent, $username);
  $qr = "SELECT pp FROM user_details WHERE username = '$cek'";
  $result = mysqli_query($con_croudContent, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["pp"];
}

if (isset($_GET['imgRate'])) {
  $con_croudContent = croudUser();
  $username = htmlspecialchars($_GET['imgRate']);
  // $username = decrypt($username);
  $cek= mysqli_escape_string($con_croudContent, $username);
  $qr = "SELECT pp FROM user_details WHERE username = '$cek'";
  $result = mysqli_query($con_croudContent, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["pp"];
}

if (isset($_GET['media_satu'])) {
  $id = htmlspecialchars($_GET['media_satu']);
  $tgl = htmlspecialchars($_GET['tgl']);
  $con_croudInvest = croudInvest();
  // $decre = decrypt($id);
  // $decretgl = decrypt($tgl);
  $cek= mysqli_escape_string($con_croudInvest, $id);
  $tgl= mysqli_escape_string($con_croudInvest, $tgl);
  $qr = "SELECT kegiatan_satu FROM gambarKegiatan WHERE movie_id = '$cek' AND tgl='$tgl'";
  $result = mysqli_query($con_croudInvest, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["kegiatan_satu"];
}

if (isset($_GET['media_dua'])) {
  $id = htmlspecialchars($_GET['media_dua']);
  $tgl = htmlspecialchars($_GET['tgl']);
  $con_croudInvest = croudInvest();
  // $decre = decrypt($id);
  // $decretgl = decrypt($tgl);
  $cek= mysqli_escape_string($con_croudInvest, $id);
  $tglk= mysqli_escape_string($con_croudInvest, $tgl);
  $qr = "SELECT kegiatan_dua FROM gambarKegiatan WHERE movie_id = '$cek' AND tgl='$tgl'";
  $result = mysqli_query($con_croudInvest, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["kegiatan_dua"];
}

if (isset($_GET['media_tiga'])) {
  $id = htmlspecialchars($_GET['media_tiga']);
  $tgl = htmlspecialchars($_GET['tgl']);
  $con_croudInvest = croudInvest();
  // $decre = decrypt($id);
  // $decretgl = decrypt($tgl);
  $cek= mysqli_escape_string($con_croudInvest, $id);
  $tgl= mysqli_escape_string($con_croudInvest, $tgl);
  $qr = "SELECT kegiatan_tiga FROM gambarKegiatan WHERE movie_id = '$cek' AND tgl='$tgl'";
  $result = mysqli_query($con_croudInvest, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["kegiatan_tiga"];
}

if (isset($_GET['media_empat'])) {
  $id = htmlspecialchars($_GET['media_empat']);
  $tgl = htmlspecialchars($_GET['tgl']);
  $con_croudInvest = croudInvest();
  // $decre = decrypt($id);
  // $decretgl = decrypt($tgl);
  $cek= mysqli_escape_string($con_croudInvest, $id);
  $tgl= mysqli_escape_string($con_croudInvest, $tgl);
  $qr = "SELECT kegiatan_empat FROM gambarKegiatan WHERE movie_id = '$cek' AND tgl='$tgl'";
  $result = mysqli_query($con_croudInvest, $qr);
  $row = mysqli_fetch_assoc($result);
  header("Content-Type: image/jpg, image/jpeg, image/png");
  echo $row["kegiatan_empat"];
}

?>
