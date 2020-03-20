<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

    include '../PHPMailer/src/Exception.php';
    include '../PHPMailer/src/PHPMailer.php';
    include '../PHPMailer/src/SMTP.php';
    include 'mailconf.inc.php';

if (isset($_POST['submit-pirep'])) {
  //get database stuff
  include 'dbh.inc.php';

  //get form data
  $callsign = $_POST['callsign'];
  $departureAirport = $_POST['departure'];
  $arrivalAirport = $_POST['arrival'];
  $departureTime = $_POST['atd'];
  $arrivalTime = $_POST['ata'];
  $remarks = $_POST['remarks'];

  if (empty($callsign) || empty($departureAirport) || empty($arrivalAirport) || empty($departureTime) || empty($arrivalTime)) {
    header("Location: ../dashboard.php?error=emptyfields");
  }
  else {
    $newflighttime = abs((substr($departureTime, 0, 2) * 60 + substr($departureTime, 3, 2)) - (substr($arrivalTime, 0, 2) * 60 + substr($arrivalTime, 3, 2)));
    $sql = "INSERT INTO actualpireps (user_id, flight_callsign, dep_airport, arr_airport, flight_time, dep_time, arr_time, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../dashboard.php?error=SQLerror");
      exit();

    } else {
      //save pirep
      mysqli_stmt_bind_param($stmt, "isssisss", $_SESSION['userid'], $callsign, $departureAirport, $arrivalAirport, $newflighttime, $departureTime, $arrivalTime, $remarks);
      mysqli_stmt_execute($stmt);
      
      //send notification to admin
      $mail = new PHPMailer(true);

      try {
        #mail settings
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_user;
        $mail->Password   = $smtp_pass;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = $smtp_port;

        $mail->setFrom($mail_from);
        $mail->addAddress($your_mail);

        $mail->isHTML(true);
        $mail->Subject = 'New PIREP!';
        $mail->Body    = "<p>There is a new pirep. Go have a look, quickly!</p>";
        $mail->AltBody = 'There is a new pirep. Go have a look, quickly!';

        $mail->send();

        header("Location: ../dashboard.php?submission=success#pirep");
        exit();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      
      

    }
  }
}
