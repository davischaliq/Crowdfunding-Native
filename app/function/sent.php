<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function EmailSend($email, $user, $id)
{
  //Load Composer's autoloader
  require_once 'function.php';
  require '../app/lib/PHPMailer/src/Exception.php';
  require '../app/lib/PHPMailer/src/PHPMailer.php';
  require '../app/lib/PHPMailer/src/SMTP.php';
//Instantiation and passing `true` enables exceptions
// $emailEncryp = encrypt($email);
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 0;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'mail.davdc.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'support@davdc.com';                     //SMTP username
  $mail->Password   = 'Diana500009';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->setFrom('support@davdc.com', 'Produksi Film Negara');
  $mail->addAddress($email, $user);     //Add a recipient
  // $mail->addAddress('');               //Name is optional
  // $mail->addReplyTo('', '');
  // $mail->addCC('');
  // $mail->addBCC('');

  //Attachments
  // $mail->addAttachment('../app/dt/dt.csv');         //Add attachments
  // $mail->addAttachment('', '');    //Optional name

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Activated Email';
  $mail->Body    = '<img src="https://davdc.com/assets/img/PFN_2014.png" class="rounded float-start" alt="...">
  <h1>Dear '. $user .'</h1>
  <p>Thank you for registering in Produksi Film Negara</p><br>
  <p>You Must activated your account with click this buttons</p>
  <p>if you have a question you can send an email to support@davdc.com we will respons your email quickly</p>
  <a class="btn btn-danger" href="https://davdc.com/Confirm/Activated.php?name='. $id .'" role="button">Activated Your Account</a>
  ';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
