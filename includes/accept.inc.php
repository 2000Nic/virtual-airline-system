<?php

if (isset($_GET['accept'])) {
  include 'dbh.inc.php';
  $sql = "UPDATE actualpireps SET submission_status = 1 WHERE pirep_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "something stupid happened";
  } else {
    mysqli_stmt_bind_param($stmt, "i", $_GET['accept']);
    mysqli_stmt_execute($stmt);

    $sql = "UPDATE actualuser SET currentAirport = ?, flights = flights + 1, timeflown = timeflown + ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "something even stupider happened";
    } else {
      mysqli_stmt_bind_param($stmt, "sii", $_GET['airport'], $_GET['timeflown'], $_GET['user']);
      mysqli_stmt_execute($stmt);

      header("Location: ../admin/index.php?accept=success");
      exit();
    }

  }
}
