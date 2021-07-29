<?php
// USER function
function Login($username, $password)
{
  session_start();
  require_once '../app/init.php';
  $con_croudUser = croudUser();
  $username = mysqli_escape_string($con_croudUser, $username);
  $password = mysqli_escape_string($con_croudUser, $password);
  $qr = "SELECT * FROM user WHERE username = '$username' AND status != '0'";
  $ex = mysqli_query($con_croudUser, $qr);
  $result = mysqli_fetch_assoc($ex);
  if (!is_null($result)) {
    if (sha1($password) === $result['password']) {
      $_SESSION['user'] = $username;
      header('Location:' . BASEURL . 'Collab/movie_coll.php');
    }else {
      header('Location:'.BASEURL.'regist/Signin.php?status=denied');
    }
  }else {
    header('Location:'.BASEURL.'regist/Signin.php?status=notregister');
}
}
function Regist($full, $user, $email, $pass)
{
  $con_croudUser = croudUser();
  $user = mysqli_escape_string($con_croudUser, $user);
  $pass = mysqli_escape_string($con_croudUser, $pass);
  $email = mysqli_escape_string($con_croudUser, $email);
  $full = mysqli_escape_string($con_croudUser, $full);
  $cek = mysqli_query($con_croudUser, "SELECT user_details.id, user_details.email, user.username FROM user_details INNER JOIN user ON user_details.username=user.username WHERE user_details.email = '$email' AND user.username = '$user'");
  $result = mysqli_num_rows($cek);
  if ($result > 0) {
      $error = 1;
      return $error;
  }else {
    $pass = sha1($pass);
    $insertUser = mysqli_query($con_croudUser, "INSERT INTO user (username, password, status) VALUES ('$user','$pass', '0')");
    $insertUserDetails = mysqli_query($con_croudUser, "INSERT INTO user_details (id, full_name, company, divition, email, phone, company_address, username)
    VALUES ('','$full', 'NULL', 'NULL', '$email', 'NULL', 'NULL', '$user')");

    if ($insertUser && $insertUserDetails) {
      $slt_id = mysqli_query($con_croudUser, "SELECT id FROM user_details WHERE username = '$user'");
      $resultid = mysqli_fetch_assoc($slt_id);
      $id = encrypt($resultid['id']);
      header('location:'. BASEURL .'Confirm/email_activated.php?name=' . $id);
    }
  }
}

function chpass($pass)
{
  $con_croudUser = croudUser();
  $user = htmlspecialchars($_SESSION['user']);
  $pass = mysqli_escape_string($con_croudUser, $pass);
  $pass = sha1($pass);
  $user = mysqli_escape_string($con_croudUser, $user);
  $error = mysqli_query($con_croudUser, "UPDATE user SET password = '$pass' WHERE username = '$user'");
  if ($error) {
    $data = 0;
    return $data;
  }else {
    // echo "<h1>GAGAL</h1>";
    // die;
    $data = 1;
    return $data;
  }
}
function Activated($id)
{
  session_start();
  $con_croudUser = croudUser();
    $id = decrypt($id);
    $id = mysqli_escape_string($con_croudUser, $id);
    $cek = mysqli_query($con_croudUser, "SELECT user_details.email, user.username FROM user_details INNER JOIN user ON user_details.username=user.username WHERE user_details.id = '$id'");
    $result = mysqli_num_rows($cek);
    if ($result > 0) {
      $resultuser = mysqli_fetch_assoc($cek);
      $username = $resultuser['username'];
      mysqli_query($con_croudUser,"UPDATE user SET status = '1' WHERE username = '$username'");
      if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = $username;
      }else {
        if ($_SESSION['user'] != $username) {
          session_destroy();
          $_SESSION['user'] = $username;
      }
    }
  }else {
    header('location:' . BASEURL);
  }
}

function Logout()
{
  require_once '../app/init.php';
  session_destroy();
  header('location:' . BASEURL . 'Collab/movie_coll.php');
}
function showProfile()
{
  $con_croudUser = croudUser();
  $user = $_SESSION['user'];
  $cek = mysqli_escape_string($con_croudUser, $user);
  $qr = "SELECT * FROM user_details WHERE username = '$cek'";
  $ex = mysqli_query($con_croudUser, $qr);
  $result = mysqli_fetch_assoc($ex);
  if (!is_null($result)) {
    return $result;
  }
}
function rowProfileNull($value='')
{
  $con_croudUser = croudUser();
  $user = $_SESSION['user'];
  $cek = mysqli_escape_string($con_croudUser, $user);
  $ex = mysqli_query($con_croudUser, "SELECT full_name, company, divition, phone, company_address FROM user_details WHERE full_name='NULL' OR company='NULL' OR divition='NULL' OR phone='NULL' OR company_address='NULL' AND username = '$cek'");
  $row = mysqli_num_rows($ex);
  if ($row > 0) {
    return $row;
  }
}

function editProfile($full, $phone, $company, $company_address, $divition, $city, $postal, $username, $ppTmp, $ppName, $ppSize, $ppError)
{
    $con_croudUser = croudUser();
    if ($ppError == 4) {
      $updatemypp = mysqli_query($con_croudUser, "UPDATE user_details SET full_name='$full', company='$company', divition='$divition', phone='$phone', company_address='$company_address', city='$city', postal='$postal' WHERE username='$username'");
      if ($updatemypp) {
        $error = 0;
        return $error;
      }
    }else {
      if ($ppSize < 10000000) {
      $extpp= strtolower(pathinfo($ppName,PATHINFO_EXTENSION));
      $extppValid = ['jpg', 'jpeg', 'png'];
      if (in_array($extpp, $extppValid)) {
        $pp = addslashes(file_get_contents($ppTmp));
        $updatemypp = mysqli_query($con_croudUser, "UPDATE user_details SET full_name='$full', company='$company', divition='$divition', phone='$phone', company_address='$company_address', city='$city', postal='$postal', pp='$pp' WHERE username='$username'");
        if ($updatemypp) {
          $error = 0;
          return $error;
        }
    }
  }else {
    $error = 1;
    return $error;
  }
}
}
// End of user funtion



// encription
function encrypt($s)
{
  $ciper_method = "camellia-256-cbc";
  $option = 0;
  $iv = 9475839857374673;
  $key = sha1("Ng");
  return openssl_encrypt($s, $ciper_method, $key, $option, $iv);
}
function decrypt($s)
{
  $ciper_method = "camellia-256-cbc";
  $option = 0;
  $iv = 9475839857374673;
  $key = sha1("Ng");
  return openssl_decrypt($s, $ciper_method, $key, $option, $iv);
}
// function encryptUser($s)
// {
//   $ciper_method = "aes-128-cbc";
//   $option = 0;
//   $iv = 9475839857374673;
//   $key = sha1("PFNUSER");
//   return openssl_encrypt($s, $ciper_method, $key, $option, $iv);
// }
// function decryptUser($s)
// {
//   $ciper_method = "aes-128-cbc";
//   $option = 0;
//   $iv = 9475839857374673;
//   $key = sha1("PFNUSER");
//   return openssl_decrypt($s, $ciper_method, $key, $option, $iv);
// }
// end of encryption



// Invest function
function sendInvest()
{
  if (isset($_POST['submit'])) {
    if ($_FILES['identity']['size'] > 1000000 OR $_FILES['compro']['size'] > 2000000 OR $_FILES['script']['size'] > 10000000 ) {
      $error = 1;
      return $error;
    }else {
      $user = htmlspecialchars($_SESSION['user']);
      $con_croudInvest = croudInvest();
      $con_croudContent = croudContent();
      $user = mysqli_escape_string($con_croudInvest, $user);
      $fullname = htmlspecialchars($_POST['full']);
      $fullname = mysqli_escape_string($con_croudInvest, $fullname);
      $company= htmlspecialchars($_POST['company']);
      $company = mysqli_escape_string($con_croudInvest, $company);
      $movietitle = htmlspecialchars($_POST['title']);
      $movietitle = mysqli_escape_string($con_croudInvest, $movietitle);
      $category = htmlspecialchars($_POST['category']);
      $category = mysqli_escape_string($con_croudInvest, $category);
      $caster = htmlspecialchars($_POST['caster']);
      $caster = mysqli_escape_string($con_croudInvest, $caster);
      $budget = htmlspecialchars($_POST['budget']);
      $budget = mysqli_escape_string($con_croudInvest, $budget);
      $sinopsis = htmlspecialchars($_POST['sinopsis']);
      $sinopsis = mysqli_escape_string($con_croudInvest, $sinopsis);

      $identityTmp = $_FILES['identity']['tmp_name'];
      $identityName = $_FILES['identity']['name'];
      $identitytype = $_FILES['identity']['type'];
      $identitysize = $_FILES['identity']['size'];

      $comproTmp = $_FILES['compro']['tmp_name'];
      $comproName = $_FILES['compro']['name'];
      $comprotype = $_FILES['compro']['type'];
      $comprosize = $_FILES['compro']['size'];

      $scriptName = $_FILES['script']['name'];
      $Scripttmp = $_FILES['script']['tmp_name'];
      $Scripttype = $_FILES['script']['type'];
      $Scriptsize = $_FILES['script']['size'];

      $movieBannername = $_FILES['movieBanner']['name'];
      $movieBannertmp = $_FILES['movieBanner']['tmp_name'];
      $movieBannertype = $_FILES['movieBanner']['type'];

      $extIdentity = strtolower(pathinfo($identityName,PATHINFO_EXTENSION));
      $extCompro = strtolower(pathinfo($comproName,PATHINFO_EXTENSION));
      $extScript = strtolower(pathinfo($scriptName,PATHINFO_EXTENSION));
      $extmovieBanner= strtolower(pathinfo($movieBannername,PATHINFO_EXTENSION));

      $extComproValid = ['pdf'];
      $extIdentityValid = ['jpg', 'jpeg'];
      $extScriptValid = ['ppt', 'pptx', 'pdf'];
      $extmovieBannerValid = ['jpg', 'jpeg'];

      if (in_array($extIdentity, $extIdentityValid) && in_array($extCompro, $extComproValid) && in_array($extScript, $extScriptValid) && in_array($extmovieBanner, $extmovieBannerValid)) {
        $NameCompro	= "Compro" . uniqid();
        $NameCompro .= '.';
        $NameCompro .= $extCompro;

        $NameIdentity	= "Identity" . uniqid();
        $NameIdentity .= '.';
        $NameIdentity .= $extIdentity;

        $NameScript	= "Script" . uniqid();
        $NameScript .= '.';
        $NameScript .= $extScript;

        $movie_id	= "Movie" . rand();

        $compro = addslashes(file_get_contents($identityTmp));
        $script = addslashes(file_get_contents($comproTmp));
        $identity = addslashes(file_get_contents($Scripttmp));
        $movieBanner = addslashes(file_get_contents($movieBannertmp));

        $qrinsert = "INSERT INTO investDocument(id, movie_id, identity_name, identity_file, identity_type, identity_size, compro_name, compro_file, compro_type, compro_size, script_name, script_file, script_type, script_size, username) VALUES ('', '$movie_id', '$NameIdentity', '$identity', '$identitytype', '$identitysize', '$NameCompro', '$compro', '$comprotype', '$comprosize', '$NameScript', '$script', '$Scripttype', '$Scriptsize', '$user')";
        $insert = mysqli_query($con_croudInvest, $qrinsert);
        if ($insert) {
          $insertmovie = "INSERT INTO movieoncoming(id_movie, judul, img, pemilik, company, category, cast, T_anggaran, anggaran_T, sinopsis, decision, labels, linkYT, username) VALUES ('$movie_id','$movietitle','$movieBanner','$fullname','$company','$category','$caster','$budget','0','$sinopsis','pending','NULL','NULL','$user')";
          $insertmo = mysqli_query($con_croudContent, $insertmovie);
          if ($insertmo) {
            $error = 0;
            return $error;
            // echo "error : " . mysqli_error($con_croudContent);
          }
          }else {
            $error = 1;
            return $error;
          }
      }else {
        $error = 1;
        return $error;
      }
    }
  }
}

// function sendReport($id)
// {
//   if (isset($_POST['submit'])) {
//     if ($_FILES['photo_satu']['size'] > 1000000 OR $_FILES['photo_dua']['size'] > 1000000 OR $_FILES['photo_tiga']['size'] > 10000000 OR $_FILES['photo_empat']['size'] > 10000000 OR $_FILES['report']['size'] > 50000000 ) {
//       $error = 1;
//       return $error;
//     }else {
//       $user = htmlspecialchars($_SESSION['user']);
//       $con_croudInvest = croudInvest();
//       $movie_id = decrypt($id);
//
//       $photo_satu_Tmp = $_FILES['photo_satu']['tmp_name'];
//       $photosatuName = $_FILES['photo_satu']['name'];
//       $photosatutype = $_FILES['photo_satu']['type'];
//       $photosatusize = $_FILES['photo_satu']['size'];
//
//       $photo_dua_Tmp = $_FILES['photo_dua']['tmp_name'];
//       $photoduaName = $_FILES['photo_dua']['name'];
//       $photoduatype = $_FILES['photo_dua']['type'];
//       $photoduasize = $_FILES['photo_dua']['size'];
//
//       $phototigaName = $_FILES['photo_tiga']['name'];
//       $photo_tiga_Tmp = $_FILES['photo_tiga']['tmp_name'];
//       $phototigatype = $_FILES['photo_tiga']['type'];
//       $phototigasize = $_FILES['photo_tiga']['size'];
//
//       $photoempatName = $_FILES['photo_empat']['name'];
//       $photo_empat_Tmp = $_FILES['photo_empat']['tmp_name'];
//       $photoempattype = $_FILES['photo_empat']['type'];
//       $photoempatsize = $_FILES['photo_empat']['size'];
//
//       $reportName = $_FILES['report']['name'];
//       $report_tmp = $_FILES['report']['tmp_name'];
//       $reporttype = $_FILES['report']['type'];
//       $reportsize = $_FILES['report']['size'];
//
//       $status = htmlspecialchars($_POST['status']);
//       if (isset($_POST['linkyt'])) {
//         // code...
//         $link = htmlspecialchars($_POST['linkyt']);
//       }else {
//         $link = 'null';
//       }
//
//       if ($status == 'Pilih Status...') {
//         $status = 'preproduction';
//       }else {
//       $extphotosatu = strtolower(pathinfo($photosatuName,PATHINFO_EXTENSION));
//       $extphotodua = strtolower(pathinfo($photoduaName,PATHINFO_EXTENSION));
//       $extphototiga = strtolower(pathinfo($phototigaName,PATHINFO_EXTENSION));
//       $extphotoempat = strtolower(pathinfo($photoempatName,PATHINFO_EXTENSION));
//       $extReport= strtolower(pathinfo($reportName,PATHINFO_EXTENSION));
//
//       $extPhotoValid = ['jpg', 'jpeg', 'png'];
//       $extReportValid = ['pdf', 'doc', 'docx'];
//
//       if (in_array($extphotosatu, $extPhotoValid) && in_array($extphotodua, $extPhotoValid) && in_array($extphototiga, $extPhotoValid) && in_array($extphotoempat, $extPhotoValid) && in_array($extReport, $extReportValid)) {
//         $NameReport	= "Report" . uniqid();
//         $NameReport .= '.';
//         $NameReport .= $extReport;
//
//         $date = date('d/m/Y');
//         $satu = addslashes(file_get_contents($photo_satu_Tmp));
//         $dua = addslashes(file_get_contents($photo_dua_Tmp));
//         $tiga = addslashes(file_get_contents($photo_tiga_Tmp));
//         $empat = addslashes(file_get_contents($photo_empat_Tmp));
//         $report = addslashes(file_get_contents($report_tmp));
//
//         $qrinsert = "INSERT INTO history(id, movie_id, tgl, image_satu, image_dua, image_tiga, image_empat) VALUES ('', '$movie_id', '$date', '$satu', '$dua', '$tiga', '$empat')";
//         $insert = mysqli_query($con_croudInvest, $qrinsert);
//         if ($insert) {
//           $qrmo = "INSERT INTO report(id, movie_id, tgl, report_name, report_file, report_type, report_size) VALUES ('', '$movie_id', '$date', '$NameReport', '$report', '$reporttype', '$reportsize')";
//           $insertmo = mysqli_query($con_croudInvest, $qrmo);
//           if ($insertmo) {
//             $qrmi = "UPDATE SET decision='$status', linkYT='$link' FROM movieoncoming WHERE id_movie='$movie_id'";
//             $insert_movieo = mysqli_query($con_croudInvest, $qrmi);
//             if ($insert_movieo) {
//               $error = 0;
//               return $error;
//             }
//           }else {
//             echo "gagal" . mysqli_error($con_croudInvest);
//             return false;
//           }
//         }else {
//           echo "gagal" . mysqli_error($con_croudInvest);
//           return false;
//         }
//       }else {
//         $error = 1;
//         return $error;
//       }
//     }
//   }
// }
// }


function sendAgrement($id)
{
  if (isset($_POST['submit'])) {
    if ($_FILES['agrement']['size'] > 2000000) {
      $error = 1;
      return $error;
    }else {
      $user = htmlspecialchars($_SESSION['user']);
      $con_croudInvest = croudInvest();
      $movie_id = decrypt($id);

      $AgrementTmp = $_FILES['agrement']['tmp_name'];
      $AgrementName = $_FILES['agrement']['name'];
      $Agrementtype = $_FILES['agrement']['type'];
      $Agrementsize = $_FILES['agrement']['size'];

      $extAgrement = strtolower(pathinfo($AgrementName,PATHINFO_EXTENSION));

      $extAgrementValid = ['pdf'];
      $date = date('d/m/Y');

      if (in_array($extAgrement, $extAgrementValid)) {
        $NameAgrement	 = "agrement" . uniqid();
        $NameAgrement .= '.';
        $NameAgrement .= $extAgrement;

        $Agrement = addslashes(file_get_contents($AgrementTmp));

        $qrinsert = "INSERT INTO agrement(id, movie_id, Agrement_name, Agrement_file, Agrement_type, Agrement_size) VALUES ('', '$movie_id', '$NameAgrement', '$Agrement', '$Agrementtype', '$Agrementsize')";
        $insert = mysqli_query($con_croudInvest, $qrinsert);
        if ($insert) {
              $error = 0;
              return $error;
            }else {
            echo "gagal" . mysqli_error($con_croudInvest);
            return false;
          }
      }else {
        $error = 1;
        return $error;
      }
    }
  }
}

function rate($judul, $comment, $rating, $id)
{
  $id = decrypt($id);
  $con_croudContent = croudContent();
  $judul = mysqli_escape_string($con_croudContent, $judul);
  $comment = mysqli_escape_string($con_croudContent, $comment);
  $rating = mysqli_escape_string($con_croudContent, $rating);
  $date = date("Y-m-d");
  $username = $_SESSION['user'];
  $rating = mysqli_query($con_croudContent, "INSERT INTO rate(no, id_movie, rate_judul, user_rating, user_comment, tgl, username) VALUES('', '$id', '$judul', '$rating', '$comment', '$date', '$username')");
  if ($rating) {
    echo "Berhasil Memberikan Rating";
  }else {
    echo "gagal";
  }
}

function showRate($id)
{
  $con_croudContent = croudContent();
  $id = decrypt($id);
  $id = mysqli_escape_string($con_croudContent, $id);
  $result = mysqli_query($con_croudContent, "SELECT * FROM rate WHERE id_movie='$id'");
  $cekRow = mysqli_num_rows($result);
  if ($cekRow > 0) {
    $average_rating = 0;
    $total_review = 0;
    $total_user_rating = 0;
    while ($rate = mysqli_fetch_array($result)) {
     $total_review++;
     $user_rating = $rate['user_rating'];
     $total_user_rating = $total_user_rating + $user_rating;
     $averange_rating = $total_user_rating / $total_review;
    }
    $output = array(
      'averange_rating' => number_format($averange_rating, 1),
      'total_review'   => $total_review,
    );
    echo json_encode($output);
  }
}

function showRateAll($id)
{
  $con_croudContent = croudContent();
  // $id = decrypt($id);
  $id = mysqli_escape_string($con_croudContent, $id);
  $result = mysqli_query($con_croudContent, "SELECT * FROM rate WHERE id_movie='$id'");
  $cekRow = mysqli_num_rows($result);
  if ($cekRow > 0) {
    $average_rating = 0;
    $total_review = 0;
    $total_user_rating = 0;
    while ($rate = mysqli_fetch_array($result)) {
     $total_review++;
     $user_rating = $rate['user_rating'];
     $total_user_rating = $total_user_rating + $user_rating;
     $averange_rating = $total_user_rating / $total_review;
    }
    $averange_rating = number_format($averange_rating, 1);
    return $averange_rating;
  }
}

function showRatingContent($id)
{
  $con_croudTransaksi = croudContent();
  // $id = decrypt($id);
  $id = mysqli_escape_string($con_croudTransaksi, $id);
  $qr = "SELECT * FROM rate WHERE id_movie = '$id' ORDER BY no DESC LIMIT 10";
  $ex = mysqli_query($con_croudTransaksi, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
    while ($result = mysqli_fetch_array($ex)) {
      $data[] = array(
        'judul' => $result['rate_judul'],
        'rating' => $result['user_rating'],
        'comment' => $result['user_comment'],
        'tgl' => $result['tgl'],
        'username' => $result['username'],
     );
    }
  }else {
    $data = 0;
    return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}
// End of invest function



// Databasess
function CekTransaksi($id)
{
  $con_croudTransaksi = croudTransaksi();
  // $id = decrypt($id);
  $id = mysqli_escape_string($con_croudTransaksi, $id);
  $qr = "SELECT * FROM userT WHERE movie_id = '$id' AND bank != 'unknown'";
  $ex = mysqli_query($con_croudTransaksi, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
    $data = $cekRow;
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }

}
// Bug harus kelar
function updateAnggaran($id)
{
  // $id = decrypt($id);
  $con_croudInvest = croudTransaksi();
  $con_croudContent = croudContent();
  $id = mysqli_escape_string($con_croudInvest, $id);
  $panggilOrderId = mysqli_query($con_croudInvest, "SELECT order_id FROM userT WHERE movie_id='$id'");
  $cekOrder = mysqli_num_rows($panggilOrderId);
  if ($cekOrder > 0) {
    while ($Order=mysqli_fetch_array($panggilOrderId)) {
      $order_id[] = $Order;
    }
  }else {
    return false;
  }
  $count = count($order_id);
  for ($i=0; $i < $count; $i++) {
    $queryBCA = "SELECT SUM(total) as TotalBca FROM Transaksibca WHERE order_id=" . "'" . $order_id[$i]['order_id'] . "'" . "AND status='settlement'";
    $resultBCA = mysqli_query($con_croudInvest, $queryBCA);
    while ($total_bca = mysqli_fetch_array($resultBCA)) {
        $totalBCA[$i] = $total_bca['TotalBca'];
        if (is_null($totalBCA[$i])) {
          $totalBCA[$i] = '0';
        }
      }
    $queryBNI = "SELECT SUM(total) as TotalBni FROM Transaksibni WHERE order_id=" . "'" . $order_id[$i]['order_id'] . "'" . "AND status='settlement'";
    $resultBNI = mysqli_query($con_croudInvest, $queryBNI);
    while ($total_bni = mysqli_fetch_array($resultBNI)) {
        $totalBNI[$i] = $total_bni['TotalBni'];
        if (is_null($totalBNI[$i])) {
          $totalBNI[$i] = '0';
        }
      }
    $queryMANDIRI = "SELECT SUM(total) as TotalMandiri FROM Transaksimandiri WHERE order_id=" . "'" . $order_id[$i]['order_id'] . "'" . "AND status='settlement'";
    $resultMANDIRI = mysqli_query($con_croudInvest, $queryMANDIRI);
      while ($total_mandiri = mysqli_fetch_array($resultMANDIRI)) {
        $totalMANDIRI[$i] = $total_mandiri['TotalMandiri'];
        if (is_null($totalMANDIRI[$i])) {
          $totalMANDIRI[$i] = '0';
        }
      }
    $queryBri = "SELECT SUM(total) as TotalBri FROM Transaksibri WHERE order_id=" . "'" . $order_id[$i]['order_id'] . "'" . "AND status='settlement'";
    $resultBri = mysqli_query($con_croudInvest, $queryBri);
      while ($total_bri = mysqli_fetch_array($resultBri)) {
        $totalBRI[$i] = $total_bri['TotalBri'];
        if (is_null($totalBRI[$i])) {
          $totalBRI[$i] = '0';
        }
      }
    $queryPERMATA = "SELECT SUM(total) as Totalpermata FROM Transaksipermata WHERE order_id=" . "'" . $order_id[$i]['order_id'] . "'" . "AND status='settlement'";
    $resultPermata = mysqli_query($con_croudInvest, $queryPERMATA);
      while ($total_permata = mysqli_fetch_array($resultPermata)) {
        $totalPERMATA[$i] = $total_permata['Totalpermata'];
        if (is_null($totalPERMATA[$i])) {
          $totalPERMATA[$i] = '0';
        }
      }
  }
  $arrayTransaksi = array($totalBCA,$totalBNI,$totalBRI,$totalMANDIRI,$totalPERMATA);
  // var_dump($arrayTransaksi);
  // die;
  $count_arrayTransaksi = count($arrayTransaksi);
  for ($s=0; $s < $count_arrayTransaksi; $s++) {
  $count_arrayTransaksidua = count($arrayTransaksi[$s]);
  for ($u=0; $u < $count_arrayTransaksidua; $u++) {
    if ($arrayTransaksi[$s][$u] != 0) {
      $newArrayTransaksi[$s] = $arrayTransaksi[$s][$u];
    }else {
      $newArrayTransaksi[$s] = '0';
    }
  }
}
$totalTransaksi = array_sum($newArrayTransaksi);
// var_dump($totalTransaksi);
// die;
$queryContent = mysqli_query($con_croudContent, "SELECT T_anggaran, labels FROM movieoncoming WHERE id_movie='$id'");
$result = mysqli_fetch_assoc($queryContent);
$anggaran_T = $result['T_anggaran'];
switch ($result['labels']) {
  case $result['labels'] == 'Dana 10%':
  $transaksiAkhir = ($anggaran_T * 0.1) + $totalTransaksi;
    break;

  case $result['labels'] == 'Dana 20%':
  $transaksiAkhir = ($anggaran_T * 0.2) + $totalTransaksi;
    break;

  case $result['labels'] == 'Dana 30%':
  $transaksiAkhir = ($anggaran_T * 0.3) + $totalTransaksi;
    break;
  case $result['labels'] == 'Dana 40%':
  $transaksiAkhir = ($anggaran_T * 0.4) + $totalTransaksi;
    break;
  case $result['labels'] == 'Dana 50%':
  $transaksiAkhir = ($anggaran_T * 0.5) + $totalTransaksi;
    break;
  case $result['labels'] == 'Dana 60%':
  $transaksiAkhir = ($anggaran_T * 0.6) + $totalTransaksi;
    break;
  case $result['labels'] == 'Dana 70%':
  $transaksiAkhir = ($anggaran_T * 0.7) + $totalTransaksi;
    break;
}
// var_dump($transaksiAkhir);
// die;
$idContent = mysqli_escape_string($con_croudContent, $id);
mysqli_query($con_croudContent, "UPDATE movieoncoming SET anggaran_T='$transaksiAkhir' WHERE id_movie='$idContent'");
}

function showColl()
{
  $con_croudContent = croudContent();
  $qr = "SELECT id_movie, category, judul,img FROM movieoncoming WHERE decision = 'preproduction'";
  $ex = mysqli_query($con_croudContent, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($ex)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}

function showMedia($id)
{
  // $id = decrypt($id);
  $con_croudInvest = croudInvest();
  $qr = "SELECT movie_id, tgl FROM gambarKegiatan WHERE movie_id='$id'";
  $ex = mysqli_query($con_croudInvest, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($ex)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}

function showComplited()
{
  $con_croudContent = croudContent();
  $qr = "SELECT id_movie, category, judul,img FROM movieoncoming WHERE decision = 'onproduction'";
  $ex = mysqli_query($con_croudContent, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($ex)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}
function showRelease()
{
  $con_croudContent = croudContent();
  $qr = "SELECT id_movie, category, judul,img FROM movieoncoming WHERE decision = 'release'";
  $ex = mysqli_query($con_croudContent, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($ex)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}
function showDetails($id)
{
  // $id = decrypt($id);
  $con_croudContent = croudContent();
  $cek = mysqli_escape_string($con_croudContent, $id);
  $qr = "SELECT judul, pemilik, category, cast, T_anggaran, anggaran_T, sinopsis,decision FROM movieoncoming WHERE id_movie = '$cek'";
  $ex = mysqli_query($con_croudContent, $qr);
  $result = mysqli_fetch_array($ex);
  if (!is_null($result)) {
    return $result;
  }
}
function showDetailsYourMovie($id)
{
  // $id = decrypt($id);
  $con_croudContent = croudContent();
  $cek = mysqli_escape_string($con_croudContent, $id);
  $qr = "SELECT judul, pemilik, category, cast, T_anggaran, anggaran_T, sinopsis, decision, labels FROM movieoncoming WHERE id_movie = '$cek'";
  $ex = mysqli_query($con_croudContent, $qr);
  $result = mysqli_fetch_array($ex);
  if (!is_null($result)) {
    return $result;
  }
}

function showDetailsRelease($id)
{
  // $id = decrypt($id);
  $con_croudContent = croudContent();
  $cek = mysqli_escape_string($con_croudContent, $id);
  $qr = "SELECT judul, pemilik, category, cast, T_anggaran, anggaran_T, sinopsis, decision, labels, linkYT FROM movieoncoming WHERE id_movie = '$cek' AND decision='release'";
  $ex = mysqli_query($con_croudContent, $qr);
  $result = mysqli_fetch_array($ex);
  if (!is_null($result)) {
    return $result;
  }
}

function ShowOrder($id)
{
  // $id = decrypt($id);
  $user = $_SESSION['user'];
  $con_croudTransaksi = croudTransaksi();
  $cek = mysqli_escape_string($con_croudTransaksi, $id);
  $qr = mysqli_query($con_croudTransaksi, "SELECT bank, order_id FROM userT WHERE movie_id ='$cek' AND username = '$user'");
  $row = mysqli_num_rows($qr);
  // var_dump($row);
  if ($row > 0) {
    $cekBank = mysqli_fetch_assoc($qr);
    if ($cekBank['bank'] != "") {
      switch ($cekBank['bank']) {
        case $cekBank['bank'] = "bca":
          // code...
          $qr = mysqli_query($con_croudTransaksi ,"SELECT * FROM Transaksibca WHERE order_id =" . "'" . $cekBank['order_id'] . "'");
          $result = mysqli_fetch_array($qr);
          if (!is_null($result)) {
            return $result;
          }
          break;
        case $cekBank['bank'] = "bni":
            // code...
            $qr = mysqli_query($con_croudTransaksi ,"SELECT * FROM Transaksibni WHERE order_id =" . "'" . $cekBank['order_id'] . "'");
            $result = mysqli_fetch_array($qr);
            if (!is_null($result)) {
              return $result;
            }
          break;
        case $cekBank['bank'] = "bri":
            // code...
            $qr = mysqli_query($con_croudTransaksi ,"SELECT * FROM Transaksibri WHERE order_id =" . "'" . $cekBank['order_id'] . "'");
            $result = mysqli_fetch_array($qr);
            if (!is_null($result)) {
              return $result;
            }
          break;
        case $cekBank['bank'] = "mandiri":
          // code...
          $qr = mysqli_query($con_croudTransaksi ,"SELECT * FROM Transaksimandiri WHERE order_id =" . "'" . $cekBank['order_id'] . "'");
          $result = mysqli_fetch_array($qr);
          if (!is_null($result)) {
            return $result;
          }
          break;
        case $cekBank['bank'] = "permata":
            // code...
          $qr = mysqli_query($con_croudTransaksi ,"SELECT * FROM Transaksipermata WHERE order_id =" . "'" . $cekBank['order_id'] . "'");
          $result = mysqli_fetch_array($qr);
            if (!is_null($result)) {
              return $result;
            }
          break;
      }
    }else {
      // code...
      $result = 0;
      return $result;
    }
  }else {
    // code...
    $result = 0;
    return $result;
  }
}
function showStatusMovieforHistory($id)
{
  // $id = decrypt($id);
  $con_croudContent = croudContent();
  $qr = "SELECT decision FROM movieoncoming WHERE id_movie = '$id'";
  $ex = mysqli_query($con_croudContent, $qr);
  $cekRow = mysqli_num_rows($ex);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($ex)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
}

function showOrderAll()
{
  $user = $_SESSION['user'];
  $con_croudTransaksi = croudTransaksi();
  $cekOrder = mysqli_query($con_croudTransaksi, "SELECT movie_id FROM userT WHERE username = '$user'");
  $cekRow = mysqli_num_rows($cekOrder);
  if ($cekRow > 0) {
  while ($result = mysqli_fetch_assoc($cekOrder)) {
    $data[] = $result;
  }
  }else {
  $data = 0;
  return $data;
  }
  if (!is_null($data) && isset($data)) {
    return $data;
  }else {
    $data = 0;
    return $data;
  }
  }
function showYourMovie()
  {
    $user = $_SESSION['user'];
    $con_croudContent = croudContent();
    $cekOrder = mysqli_query($con_croudContent, "SELECT id_movie, judul, category FROM movieoncoming WHERE username = '$user'");
    $cekRow = mysqli_num_rows($cekOrder);
    if ($cekRow > 0) {
    while ($result = mysqli_fetch_assoc($cekOrder)) {
      $data[] = $result;
    }
  }else {
    $data = 0;
    return $data;
  }
    if (!is_null($data) && isset($data)) {
      return $data;
    }else {
      $data = 0;
      return $data;
    }
}
function showMovieTransaksi($id)
{
  $con_croudContent = croudContent();
  $movie_id = count($id);
  for ($i=0; $i < $movie_id; $i++) {
    $sql = "SELECT id_movie, judul, category FROM movieoncoming WHERE id_movie =" . "'" . $id[$i]['movie_id'] . "'";
    $exe = mysqli_query($con_croudContent, $sql);
    $result[$i]= mysqli_fetch_array($exe);
    $data[] = $result[$i];
  }
  if (!is_null($data)) {
    return $data;
  }
}

function blockedAksesInvest($id)
{
    $user = $_SESSION['user'];
    $con_croudTransaksi = croudTransaksi();
    $id = decrypt($id);
    $id = mysqli_escape_string($con_croudTransaksi, $id);
    $cekOrder = mysqli_query($con_croudTransaksi, "SELECT order_id,bank FROM userT WHERE username = '$user' AND movie_id = '$id'");
    $row = mysqli_num_rows($cekOrder);
    if ($row > 0) {
      $cekBank = mysqli_fetch_assoc($cekOrder);
      $order_id = $cekBank['order_id'];
      if ($cekBank['bank'] != "") {
        switch ($cekBank['bank']) {
          case $cekBank['bank'] = "bca":
            $cekOrderbca = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibca WHERE username = '$user' AND order_id = '$order_id' AND status!='expire' AND status != 'deny'");
            $barisorderbca = mysqli_num_rows($cekOrderbca);
            if ($barisorderbca > 0) {
              // code...
              return $barisorderbca ;
            }else {
              $barisorderbca = 0;
              return $barisorderbca;
            }
            break;

          case $cekBank['bank'] = "bni":
            $cekOrderbni = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibni WHERE username = '$user' AND order_id = '$order_id' AND status!='expire' AND status != 'deny'");
            $barisorderbni = mysqli_num_rows($cekOrderbni);
            if ($barisorderbni > 0) {
              return $barisorderbni;
            }else {
              $barisorderbni = 0;
              return $barisorderbni;
            }
            break;

          case $cekBank['bank'] = "bri":
            $cekOrderbri = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibri WHERE username = '$user' AND order_id = '$order_id' AND status!='expire' AND status != 'deny'");
            $barisorderbri = mysqli_num_rows($cekOrderbri);
            if ($barisorderbri > 0) {
              // code...
              return $barisorderbri ;
            }else {
              $barisorderbri = 0;
              return $barisorderbri;
            }
            break;

          case $cekBank['bank'] = "mandiri":
            $cekOrdermandiri = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksimandiri WHERE username = '$user' AND order_id = '$order_id' AND status!='expire' AND status != 'deny'");
            $barisordermandiri = mysqli_num_rows($cekOrdermandiri);
            if ($barisordermandiri > 0) {
              // code...
              return $barisordermandiri ;
            }else {
              $barisordermandiri = 0;
              return $barisordermandiri;
            }
            break;

          default:
            // code...
            $cekOrderpermata = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksipermata WHERE username = '$user' AND order_id = '$order_id' AND status!='expire' AND status != 'deny'");
            $barisorderpermata = mysqli_num_rows($cekOrderpermata);
            if ($barisorderpermata> 0) {
              // code...
              return $barisorderpermata ;
            }else {
              $barisorderpermata = 0;
              return $barisorderpermata;
            }
            break;
        }
      }
    }
    return $row;
}
// end of databasess



// API function
function FunctionName($value='')
{
  // code...
}
// Update data transaksi from API
function updateTransaksi($id)
{
  // $id = decrypt($id);
  $user = $_SESSION['user'];
  $con_croudTransaksi = croudTransaksi();
  $con_croudContent = croudContent();
  $cek = mysqli_escape_string($con_croudTransaksi, $id);
  $qr = mysqli_query($con_croudTransaksi, "SELECT bank, order_id FROM userT WHERE movie_id ='$cek' AND username = '$user'");
  $cekBank = mysqli_fetch_array($qr);
  $order_id = $cekBank['order_id'];
    if ($cekBank['bank'] != "") {
      switch ($cekBank['bank']) {
        case $cekBank['bank'] = "bca":
        $queryBCA = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibca WHERE order_id = '$order_id'");
        $cekBCAstatus = mysqli_fetch_array($queryBCA);
        if ($cekBCAstatus['status'] == "settlement" OR $cekBCAstatus['status'] == "expire" OR $cekBCAstatus['status'] == "deny") {
          $false = 0;
          return $false;
        }
        if ($cekBCAstatus['status'] = 'pending') {
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => "TRUE",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
            ),
          ));
          $response = curl_exec($curl);
          $data = json_decode($response, TRUE);
          $status = $data['transaction_status'];
          $harga = $data['gross_amount'];
          if ($status === "pending") {
            $false = 0;
            return $false;
          }else {
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            mysqli_query($con_croudTransaksi , "UPDATE Transaksibca SET status = '$status', paid = '$settlement_time' WHERE order_id = '$order_id'");
          }
        }

          break;
        case $cekBank['bank'] = "bni":
        $queryBNI = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibni WHERE order_id = '$order_id'");
        $cekBNIstatus = mysqli_fetch_array($queryBNI);
        if ($cekBNIstatus['status'] == "settlement" OR $cekBNIstatus['status'] == "expire" OR $cekBNIstatus['status'] == "deny") {
          // code...
          $false = 0;
          return $false;
        }
        if ($cekBNIstatus['status'] = 'pending') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_RETURNTRANSFER => "TRUE",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
              ),
            ));
            $response = curl_exec($curl);
            $data = json_decode($response, TRUE);

            $status = $data['transaction_status'];
            if ($status === "pending") {
              $false = 0;
              return $false;
            }else {
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            mysqli_query($con_croudTransaksi , "UPDATE Transaksibni SET status = '$status', paid = '$settlement_time' WHERE order_id = '$order_id'");
          }
        }
          break;
        case $cekBank['bank'] = "bri":

        $queryBRI = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksibri WHERE order_id = '$order_id'");
        $cekBRIstatus = mysqli_fetch_array($queryBRI);
        if ($cekBRIstatus['status'] == "settlement" OR $cekBRIstatus['status'] == "expire" OR $cekBRIstatus['status'] == "deny") {
          // code...
          $false = 0;
          return $false;
        }
        if ($cekBRIstatus['status'] = 'pending') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_RETURNTRANSFER => "TRUE",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
              ),
            ));
            $response = curl_exec($curl);
            $data = json_decode($response, TRUE);

            $status = $data['transaction_status'];
            if ($status === "pending") {
              $false = 0;
              return $false;
            }else {
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            mysqli_query($con_croudTransaksi , "UPDATE Transaksibri SET status = '$status', paid = '$settlement_time' WHERE order_id = '$order_id'");
          }
        }
          break;
        case $cekBank['bank'] = "mandiri":
        $queryMANDIRI = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksimandiri WHERE order_id = '$order_id'");
        $cekMANDIRIstatus = mysqli_fetch_array($queryMANDIRI);
        if ($cekMANDIRIstatus['status'] == "settlement" OR $cekMANDIRIstatus['status'] == "expire" OR $cekMANDIRIstatus['status'] == "deny") {
          $false = 0;
          return $false;
        }
        if ($cekMANDIRIstatus['status'] = 'pending') {
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => "TRUE",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
            ),
          ));
          $response = curl_exec($curl);
          $data = json_decode($response, TRUE);

          $status = $data['transaction_status'];
          if ($status === "pending") {
            $false = 0;
            return $false;
          }else {
          if (isset($data['settlement_time'])) {
            $settlement_time = $data['settlement_time'];
          }else {
            $settlement_time = '';
          }
          mysqli_query($con_croudTransaksi , "UPDATE Transaksimandiri SET status = '$status', paid = '$settlement_time' WHERE order_id = '$order_id'");
        }
      }
          break;
        case $cekBank['bank'] = "permata":
        $queryPERMATA = mysqli_query($con_croudTransaksi, "SELECT status FROM Transaksipermata WHERE order_id = '$order_id'");
        $cekPERMATAstatus = mysqli_fetch_array($queryPERMATA);
        if ($cekPERMATAstatus['status'] == "settlement" OR $cekPERMATAstatus['status'] == "expire" OR $cekPERMATAstatus['status'] == "deny") {
          // code...
          $false = 0;
          return $false;
        }
        if ($cekPERMATAstatus['status'] = 'pending') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_RETURNTRANSFER => "TRUE",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
              ),
            ));
            $response = curl_exec($curl);
            $data = json_decode($response, TRUE);

            $status = $data['transaction_status'];
            if ($status === "pending") {
              $false = 0;
              return $false;
            }else {
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            mysqli_query($con_croudTransaksi , "UPDATE Transaksipermata SET status = '$status', paid = '$settlement_time' WHERE order_id = '$order_id'");
          }
          break;
    }
  }
}
}





function FinishTransaction()
{
  session_start();
  if (isset($_SESSION['user']) && !is_null($_SESSION['user'])) {
    if (isset($_GET['order_id']) && !is_null($_GET['order_id'])) {
      $user = $_SESSION['user'];
      $order_id = htmlspecialchars($_GET['order_id']);
      $status = htmlspecialchars($_GET['transaction_status']);
      $con_croudTransaksi = croudTransaksi();
      $query_transaksi = mysqli_query($con_croudTransaksi, "SELECT * FROM userT WHERE order_id = '$order_id'");
      $cek_userT = mysqli_num_rows($query_transaksi);
      if ($cek_userT > 0) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$order_id."/status",
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_RETURNTRANSFER => "TRUE",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic U0ItTWlkLXNlcnZlci00YzNYa2s5T04temlhdlphazRSbC1CdTA6"
          ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, TRUE);
        // var_dump($data);
        // die;
        //menangkap data json dari midtrans
          if ($data['payment_type'] == "bank_transfer") {
            if (!isset($data['permata_va_number'])) {
            switch ($data['va_numbers'][0]['bank']) {
              case $data['va_numbers'][0]['bank'] = "bca":
                    $payment = "Bank Transfer";
                    $status = $data['transaction_status'];
                    $jenis = $data['payment_type'];
                    $va = $data['va_numbers'][0]['va_number'];
                    $namabank = $data['va_numbers'][0]['bank'];
                    $harga = $data['gross_amount'];
                    $currency = $data['currency'];
                    if (isset($data['settlement_time'])) {
                      $settlement_time = $data['settlement_time'];
                    }else {
                      $settlement_time = '';
                    }
                  $resultupdate = mysqli_query($con_croudTransaksi,"INSERT INTO Transaksibca (id, order_id, payment, bank, va, currency, total, status, paid, username) VALUES('', '$order_id', '$payment', '$namabank', '$va', '$currency', '$harga', '$status', '$settlement_time', '$user')");
                  if ($resultupdate) {
                    $rows = mysqli_query($con_croudTransaksi, "UPDATE userT SET bank = '$namabank' WHERE order_id = '$order_id'");
                    $feedback = 1;
                    return $feedback;
                    }else {
                      echo "gagal" . mysqli_error($con_croudTransaksi);
                      return false;
                    }
                break;
              case $data['va_numbers'][0]['bank'] = "bri":
                  // code...
                  $payment = "Bank Transfer";
                  $status = $data['transaction_status'];
                  $jenis = $data['payment_type'];
                  $va = $data['va_numbers'][0]['va_number'];
                  $namabank = $data['va_numbers'][0]['bank'];
                  $harga = $data['gross_amount'];
                  $currency = $data['currency'];
                  if (isset($data['settlement_time'])) {
                    $settlement_time = $data['settlement_time'];
                  }else {
                    $settlement_time = '';
                  }
                $resultupdate = mysqli_query($con_croudTransaksi,"INSERT INTO Transaksibri (id, order_id, payment, bank, va, currency, total, status, paid, username) VALUES('', '$order_id', '$payment', '$namabank', '$va', '$currency', '$harga', '$status', '$settlement_time', '$user')");
                if ($resultupdate) {
                  mysqli_query($con_croudTransaksi, "UPDATE userT SET bank = '$namabank' WHERE order_id = '$order_id'");
                  $feedback = 1;
                  return $feedback;
                  }else {
                    echo "gagal" . mysqli_error($con_croudTransaksi);
                    return false;
                  }
                break;
              case $data['va_numbers'][0]['bank'] = "bni":
                  // code...
                  $payment = "Bank Transfer";
                  $status = $data['transaction_status'];
                  $jenis = "Bank Transfer";
                  $va = $data['va_numbers'][0]['va_number'];
                  $namabank = $data['va_numbers'][0]['bank'];
                  $harga = $data['gross_amount'];
                  $currency = $data['currency'];
                  if (isset($data['settlement_time'])) {
                    $settlement_time = $data['settlement_time'];
                  }else {
                    $settlement_time = '';
                  }
                $resultupdate = mysqli_query($con_croudTransaksi,"INSERT INTO Transaksibni (id, order_id, payment, bank, va, currency, total, status, paid, username) VALUES('', '$order_id', '$payment', '$namabank', '$va', '$currency', '$harga', '$status', '$settlement_time', '$user')");
                if ($resultupdate) {
                  mysqli_query($con_croudTransaksi, "UPDATE userT SET bank = '$namabank' WHERE order_id = '$order_id'");
                  $feedback = 1;
                  return $feedback;
                  }else {
                    echo "gagal" . mysqli_error($con_croudTransaksi);
                    return false;
                  }
                break;
            }
          }else {
            $va = $data['permata_va_number'];
            $status = $data['transaction_status'];
            $jenis = "Bank Transfer";
            $harga = $data['gross_amount'];
            $currency = $data['currency'];
            $namabank = 'permata';
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            $resultupdate = mysqli_query($con_croudTransaksi,"INSERT INTO Transaksipermata (id, order_id, payment, bank, va, currency, total, status, paid, username) VALUES('', '$order_id', '$jenis', '$namabank', '$va', '$currency', '$harga', '$status', '$settlement_time', '$user')");
            if ($resultupdate) {
              mysqli_query($con_croudTransaksi, "UPDATE userT SET bank = '$namabank' WHERE order_id = '$order_id'");
              $feedback = 1;
              return $feedback;
              }else {
                echo "gagal" . mysqli_error($con_croudTransaksi);
                return false;
              }
          }
        }



          if ($data['payment_type'] == "echannel") {
            // code...
            $va = $data['bill_key'];
            $biller = $data['biller_code'];
            $status = $data['transaction_status'];
            $jenis = $data['payment_type'];
            $harga = $data['gross_amount'];
            $currency = $data['currency'];
            $namabank = 'mandiri';
            if (isset($data['settlement_time'])) {
              $settlement_time = $data['settlement_time'];
            }else {
              $settlement_time = '';
            }
            $resultupdate = mysqli_query($con_croudTransaksi,"INSERT INTO Transaksimandiri (id, order_id, payment, bank, biller_code, va, currency, total, status, paid, username) VALUES('', '$order_id', '$jenis', '$namabank', '$biller', '$va', '$currency', '$harga', '$status', '$settlement_time', '$user')");
            if ($resultupdate) {
              mysqli_query($con_croudTransaksi, "UPDATE userT SET bank = '$namabank' WHERE order_id = '$order_id'");
              $feedback = 1;
              return $feedback;
              }else {
                echo "gagal" . mysqli_error($con_croudTransaksi);
                return false;
              }
          }
      }else {
        $feedback = 0;
        return $feedback;
      }
    }else {
      header('location:' . BASEURL);
    }
  }
}

// end of API Funtion
