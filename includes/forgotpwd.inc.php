<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submitBtn'])) {
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  //get the main url and mail settings
  include 'conf.inc.php';
  include 'mailconf.inc.php';

  $url = $main_url."/newpwd.php?selector=".$selector."&validator=".bin2hex($token);

  $expires = date("U") + 1800;

  include 'dbh.inc.php';
  include '../PHPMailer/src/Exception.php';
  include '../PHPMailer/src/PHPMailer.php';
  include '../PHPMailer/src/SMTP.php';

  $usermail = $_POST['email'];

  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Something went wrong";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $usermail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Rip, Something went wrong";
    exit();
  } else {
    $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $usermail, $selector, $hashedtoken, $expires);
    mysqli_stmt_execute($stmt);

      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        //mail stuff
        $mail->isSMTP();                                           
        $mail->Host       = $smtp_host;                    
        $mail->SMTPAuth   = true;                         
        $mail->Username   = $smtp_user;                   
        $mail->Password   = $smtp_pass;                       
        $mail->SMTPSecure = 'tls';      
        $mail->Port       = $smtp_port;                    

        $mail->setFrom($mail_from);
        $mail->addAddress($usermail);  

        $mail->isHTML(true);                          
        $mail->Subject = 'Reset you password';
        $mail->Body    = "<p>Here is a link for you to reset you password, if you don't know what this is for, just ignore it.</p><br> <a href=\"$url\">$url</a>";
        $mail->AltBody = 'Due to problems we had issues sending a link to you, contact an admin instead';

        $mail->send();

        header("Location: ../forgotpwd.php?reset=success");
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
  }


  mysqli_stmt_close($stmt);


  header("Location: ../forgotpwd.php?reset=success");
} else {
  header("Location: ../index.php?error=nopleaseno");
}
