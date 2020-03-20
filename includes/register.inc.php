<?php
if (isset($_POST['submitBtn'])) {

  include 'dbh.inc.php';

  $cs = $_POST['callsign'];
  $mail = $_POST['email'];
  $base = $_POST['base'];
  $country = $_POST['country'];
  $pwd = $_POST['pwd'];
  $repwd = $_POST['repwd'];

  if (empty($cs) || empty($mail) || empty($pwd) || empty($repwd)) {
    header("Location: ../register.php?error=emptyfields&cs=".$callsign."&mail=".$mail);
    exit();

  } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmail&cs=".$cs);
    exit();

  } else if (!preg_match("/^[a-zA-Z0-9]*$/", $cs)) {
    header("Location: ../register.php?error=invallidCS&mail=".$mail);
    exit();

  } else if ($pwd !== $repwd) {
    header("Location: ../register.php?error=nomatchpwd&cs=".$cs."&mail=".$mail);
    exit();

  } else {
    $sql = "SELECT callsign FROM actualuser WHERE callsign=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../register.php?error=SQlerror&cs=".$cs."&mail=".$mail);
      exit();

    } else {
      mysqli_stmt_bind_param($stmt, "s", $cs);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultcheck = mysqli_stmt_num_rows($stmt);
      if ($resultcheck >  0) {
        header("Location: ../register.php?error=multiCS&mail=".$mail);
        exit();

      } else {
        $sql = "INSERT INTO actualuser (callsign, email, password, base, currentAirport, country) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../register.php?error=SQLerror&cs=".$cs."&mail=".$mail);
          exit();

        } else {
          $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssssss", $cs, $mail, $hashpwd, $base, $base, $country);
          mysqli_stmt_execute($stmt);
          header("Location: ../register.php?registration=success");
          exit();

        }
      }
    }
  }

  //mysqli_stmt_close();
}

else {
  header("Location: ../register.php?error=nosubmission");
  exit();
}
