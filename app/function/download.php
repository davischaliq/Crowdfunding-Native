<?php
session_start();
require_once '../init.php';
if (isset($_SESSION['user']) AND $_SESSION['user'] != "") {
  if (isset($_GET['compro']) AND $_GET['compro'] != "") {
  $movie_id = htmlspecialchars($_GET['compro']);
  $movie_id = decrypt($movie_id);
  $con_croudInvest = croudInvest();
  $qrdownload = mysqli_query($con_croudInvest, "SELECT compro_name, compro_file, compro_type, compro_size FROM investDocument WHERE movie_id = '$movie_id'");
  // $result = mysqli_fetch_assoc($qrdownload);
  list($filename, $file, $type, $size) = mysqli_fetch_array($qrdownload);
  header("Content-length: $size");
  header("Content-type: $type");
  header("Content-Disposition: attachment; filename=$filename");
  ob_clean();
  flush();
  $content = stripslashes($file);
  echo $content;
  mysqli_close($con_croudInvest);
  exit;
  }

}

 ?>
