<?php

if (isset($_POST['submitBtn'])) {
  //include db handler
  include 'dbh.inc.php';
  //get form data
  $csmail = $_POST['email'];
  $pwd = $_POST['password'];

if (empty($csmail)/* || empty($pwd)*/) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  } else {
    $sql = "SELECT * FROM actualuser WHERE callsign=? OR email=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "ss", $csmail, $csmail);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwdcheck = password_verify($pwd, $row['password']);

        if ($pwdcheck == false) {
          header("Location: ../login.php?error=badpass");
          exit();
        } else if ($pwdcheck == true) {
          session_start();
          $_SESSION['userid'] = $row['id'];
          $_SESSION['callsign'] = $row['callsign'];
          $_SESSION['base'] = $row['base'];
          $_SESSION['priv'] = $row['priv'];
          $_SESSION['timeflown'] = $row['timeflown'];
          $_SESSION['flights'] = $row['flights'];
          $_SESSION['currentAirport'] = $row['currentAirport'];


          header("Location: ../dashboard.php?login=success");
          exit();
        } else {
          header("Location: ../login.php?error=badstuffhappened");
          exit();
        }

      } else {
        header("Location: ../login.php?error=nouser");
        exit();
      }
    }
  }

} else {
  header("Location: ../login.php?error=notsubmitted");
  exit();
}
