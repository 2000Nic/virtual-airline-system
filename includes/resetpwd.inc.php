<?php

if (isset($_POST['submitBtn'])) {
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $pwd = $_POST['pwd'];
  $repwd = $_POST['repwd'];

  if (empty($pwd) || empty($repwd)) {
      header("Location: ../index.php?error=gtfooursystem");
      exit();
  } else if ($pwd != $repwd) {
    header("Location: ../index.php?error=badpass");
    exit();
  }

  $currentdate = date("U");

  include 'dbh.inc.php';

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "si", $selector, $currentdate);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
      header("Location: ../index.php?error=sqlerror2");
      exit();
    } else {
      $tokenbin = hex2bin($validator);
      $tokencheck = password_verify($tokenbin, $row['pwdResetToken']);

      if ($tokencheck === false) {
        header("Location: ../index.php?error=sqlerror3");
        exit();
      } else if ($tokencheck === true) {
        $tokenemail = $row['pwdResetEmail'];

        $sql = "SELECT * FROM actualuser WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror4");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenemail);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);

          if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: ../index.php?error=sqlerror5");
            exit();
          } else {
            $sql = "UPDATE actualuser SET password = ? WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../index.php?error=sqlerror6");
              exit();
            } else {
              $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $hashpwd, $tokenemail);
              mysqli_stmt_execute($stmt);

              $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror7");
                exit();
              } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                mysqli_stmt_execute($stmt);
                header ("Location: ../index.php?renew=success");
            }}
          }
        }
      }

    }
  }

} else {
  header("Location: ../index.php?error=gtfooursystem");
}
