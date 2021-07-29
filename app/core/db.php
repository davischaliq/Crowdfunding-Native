<?php
require_once 'config.php';
function croudUser()
{
  // code...
  require_once 'config.php';
  $servername = DB_HOST;
  $database = CROUD_USER;
  $username = DB_USER;
  $pass = DB_PASS;

  // Create connection
  $con_croudUser = mysqli_connect($servername, $username, $pass, $database);
  // Check connection

  if (!$con_croudUser) {
    die("<script>

    alert('Connection failed');

    </script>" . mysqli_connect_error());
  }else {
    return $con_croudUser;
  }
}


function croudContent()
{
  // code...
  require_once 'config.php';
  $servername = DB_HOST;
  $database = CROUD_CONTENT;
  $username = DB_USER;
  $pass = DB_PASS;

  // Create connection
  $con_croudContent = mysqli_connect($servername, $username, $pass, $database);
  // Check connection

  if (!$con_croudContent) {
    die("<script>

    alert('Connection failed');

    </script>" . mysqli_connect_error());
  }else {
    return $con_croudContent;
  }
}

function croudTransaksi()
{
  // code...
  require_once 'config.php';
  $servername = DB_HOST;
  $database = CROUD_TRANSAKSI;
  $username = DB_USER;
  $pass = DB_PASS;

  // Create connection
  $con_croudTransaksi = mysqli_connect($servername, $username, $pass, $database);
  // Check connection

  if (!$con_croudTransaksi) {
    die("<script>

    alert('Connection failed');

    </script>" . mysqli_connect_error());
  }else {
    return $con_croudTransaksi;
  }
}

function croudInvest()
{
  // code...
  require_once 'config.php';
  $servername = DB_HOST;
  $database = CROUD_INVEST;
  $username = DB_USER;
  $pass = DB_PASS;

  // Create connection
  $con_croudInvest = mysqli_connect($servername, $username, $pass, $database);
  // Check connection

  if (!$con_croudInvest) {
    die("<script>

    alert('Connection failed');

    </script>" . mysqli_connect_error());
  }else {
    return $con_croudInvest;
  }
}
