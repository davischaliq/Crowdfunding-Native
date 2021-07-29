<?php
namespace Midtrans;
session_start();
require_once '../app/init.php';
require_once '../app/lib/Midtrans/vendor/autoload.php';

if (isset($_SESSION['user']) && $_SESSION['user'] != '') {

  $user = $_SESSION['user'];
  $id = htmlspecialchars($_GET['movie']);
  $id = decrypt($id);
  $Price = htmlspecialchars($_GET['val']);
  $Price = decrypt($Price);
  $con_croudTransaksi = croudTransaksi();
  $con_croudContent = croudContent();
  $con_croudUser = croudUser();
  $order_id = rand();

  $cek = mysqli_query($con_croudContent, "SELECT judul FROM movieoncoming WHERE id_movie = '$id'");
  $result = mysqli_fetch_assoc($cek);

  $ex = mysqli_query($con_croudUser, "SELECT full_name, company_address, company, email, phone, city, postal FROM user_details WHERE username = '$user'");
  $result_user = mysqli_fetch_array($ex);

  $name = $result_user['full_name'];
  $address = $result_user['company_address'];
  $company = $result_user['company'];
  $email = $result_user['email'];
  $phone = $result_user['phone'];
  $city = $result_user['city'];
  $postal = $result_user['postal'];

  // var_dump($result);
  // var_dump($result_user);
  // die;

  //onprogress//
  //Set Your server key
  Config::$serverKey = "SB-Mid-server-4c3Xkk9ON-ziavZak4Rl-Bu0";
  // Veritrans_Config::$serverKey = "Mid-server-IZslTraRTveWW3Hi6v9TXZmO";

  // Uncomment for production environment
  // Veritrans_Config::$isProduction = true;

  //Uncomment to enable sanitization
  Config::$isSanitized = true;

  //Uncomment to enable 3D-Secure
  Config::$is3ds = true;

  // Required
  $transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $Price);

    // Optional
    $item1_details = array(
      'id' => 'Film' . rand(),
      'price' => $Price,
      'quantity' => '1',
      'name' => 'Film ' . $result['judul']);

      // Optional
      $item_details = array ($item1_details);

      // Optional
      $billing_address = array(
        'first_name' => $name,
        'last_name' => '',
        'address' => $address,
        'city' => $city,
        'postal' => $postal,
        'phone' => $phone,
        'country_code' => 'IND');

        // Optional
        $customer_details = array(
          'first_name'    => $name,
          'last_name'     => '',
          'email'         => $email,
          'phone'         => $phone,
          'billing_address'  => $billing_address);

          $enable_payments = array('bank_transfer');

          // Fill SNAP API parameter
          $params = array(
          'enabled_payments' => $enable_payments,
          'transaction_details' => $transaction_details,
          'customer_details' => $customer_details,
          'item_details' => $item_details,
          );
          $bill_query ="INSERT INTO userT (order_id,movie_id,name,address,city,postal,phone,counrty_code,bank,username) values ('$order_id','$id','$name','$address','$city','$postal','$phone','IDR','unknow','$user')";
          $insert = mysqli_query($con_croudTransaksi, $bill_query);
          if ($insert) {
          try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }
        }else {
            echo "gagal" . mysqli_error($con_croudTransaksi);
        }

}else {
  header('location:' . BASEURL . 'Collab/movie_coll.php');
}
