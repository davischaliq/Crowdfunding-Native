<?php
require_once '../init.php';
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    if (isset($_GET['list']) && $_GET['list'] != '') {
      $id = htmlspecialchars($_GET['list']);
      $movie_id = decrypt($id);
      $con_croudInvest = croudInvest();
      $con_croudContent = croudContent();

      $kegiatan_satu_Tmp = $_FILES['kegiatan_satu']['tmp_name'];
      $kegiatan_satu_Name = $_FILES['kegiatan_satu']['name'];
      $kegiatan_satu_type = $_FILES['kegiatan_satu']['type'];
      $kegiatan_satu_size = $_FILES['kegiatan_satu']['size'];

      $kegiatan_dua_Tmp = $_FILES['kegiatan_dua']['tmp_name'];
      $kegiatan_dua_Name = $_FILES['kegiatan_dua']['name'];
      $kegiatan_dua_type = $_FILES['kegiatan_dua']['type'];
      $kegiatan_dua_size = $_FILES['kegiatan_dua']['size'];

      $kegiatan_tiga_Name = $_FILES['kegiatan_tiga']['name'];
      $kegiatan_tiga_tmp = $_FILES['kegiatan_tiga']['tmp_name'];
      $kegiatan_tiga_type = $_FILES['kegiatan_tiga']['type'];
      $kegiatan_tiga_size = $_FILES['kegiatan_tiga']['size'];

      $kegiatan_empat_Name = $_FILES['kegiatan_empat']['name'];
      $kegiatan_empat_tmp = $_FILES['kegiatan_empat']['tmp_name'];
      $kegiatan_empat_type = $_FILES['kegiatan_empat']['type'];
      $kegiatan_empat_size = $_FILES['kegiatan_empat']['size'];

      $laporan_Name = $_FILES['laporan']['name'];
      $laporan_tmp = $_FILES['laporan']['tmp_name'];
      $laporan_type = $_FILES['laporan']['type'];
      $laporan_size = $_FILES['laporan']['size'];

      $status = htmlspecialchars($_POST['status']);
      $linkYT = 'kosong';
      if (isset($_POST['link'])) {
        $linkYT = htmlspecialchars($_POST['link']);
      }

      if ($status == 'Pilih Status...') {
        $qrCekstatus = mysqli_query($con_croudContent, "SELECT decision FROM movieoncoming WHERE id_movie='$movie_id'");
        $Result_status = mysqli_fetch_assoc($qrCekstatus);
        $status = $Result_status['decision'];
      }
      if ($kegiatan_satu_size < 1000000 AND $kegiatan_dua_size < 10000000 AND $kegiatan_tiga_size < 10000000 AND $kegiatan_empat_size < 10000000 AND $laporan_size < 2000000) {
        $ext_kegiatan_satu = strtolower(pathinfo($kegiatan_satu_Name,PATHINFO_EXTENSION));
        $ext_kegiatan_dua = strtolower(pathinfo($kegiatan_dua_Name,PATHINFO_EXTENSION));
        $ext_kegiatan_tiga = strtolower(pathinfo($kegiatan_tiga_Name,PATHINFO_EXTENSION));
        $ext_kegiatan_empat = strtolower(pathinfo($kegiatan_empat_Name,PATHINFO_EXTENSION));
        $ext_laporan = strtolower(pathinfo($laporan_Name,PATHINFO_EXTENSION));
        $extReportValid = ['pdf'];
        $extImgValid = ['jpg', 'jpeg', 'png'];
          if (in_array($ext_kegiatan_satu, $extImgValid) && in_array($ext_kegiatan_dua, $extImgValid) && in_array($ext_kegiatan_tiga, $extImgValid) && in_array($ext_kegiatan_empat, $extImgValid) && in_array($ext_laporan, $extReportValid)) {
            $NameReport	= "Report" . uniqid();
            $NameReport .= '.';
            $NameReport .= $ext_laporan;
            $date = date('d/m/Y');
            $kegiatan_dua = addslashes(file_get_contents($kegiatan_dua_Tmp));
            $kegiatan_satu = addslashes(file_get_contents($kegiatan_satu_Tmp));
            $kegiatan_tiga = addslashes(file_get_contents($kegiatan_tiga_tmp));
            $kegiatan_empat = addslashes(file_get_contents($kegiatan_empat_tmp));
            $laporan = addslashes(file_get_contents($laporan_tmp));
            $qrinsert = "INSERT INTO gambarKegiatan(movie_id, tgl, kegiatan_satu, kegiatan_dua, kegiatan_tiga, kegiatan_empat) VALUES('$movie_id', '$date', '$kegiatan_satu', '$kegiatan_dua', '$kegiatan_tiga', '$kegiatan_empat')";
            mysqli_query($con_croudInvest, $qrinsert);
            $qrlaporan= "INSERT INTO laporan(movie_id, tgl, laporan_name, laporan_file, laporan_type, laporan_size) VALUES('$movie_id', '$date', '$NameReport', '$laporan', '$laporan_type', '$laporan_size')";
            mysqli_query($con_croudInvest, $qrlaporan);
            mysqli_query($con_croudContent, "UPDATE movieoncoming SET decision='$status', linkYT='$linkYT' WHERE id_movie='$movie_id'");
            header('location:' . BASEURL . 'Dashboard/history.php?success&list=' . $id);
          }else {
             header("Location:" . BASEURL . "Dashboard/history.php?error&list=" . $id);
          }
        }else {
           header("Location:" . BASEURL . "Dashboard/history.php?error&list=" . $id);
      }
    }
  }else {
    header('Location:' . BASEURL . 'Collab/movie_coll.php');
  }

 ?>
