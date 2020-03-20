<?php

if (isset($_GET['reject'])) {
  include 'dbh.inc.php';
  $sql = "UPDATE actualpireps SET submission_status = 2 WHERE pirep_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "something stupid happened";
  } else {
    mysqli_stmt_bind_param($stmt, "i", $_GET['reject']);
    mysqli_stmt_execute($stmt);
    header("Location: ../admin/index.php?rejection=success");
    exit();
  }
}
