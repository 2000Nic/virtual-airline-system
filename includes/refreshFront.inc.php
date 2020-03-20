<?php
//GET DB CONNECTION
include 'dbh.inc.php';

//FETCH DATA
//$sql = "SELECT timeflown, flights, currentAirport FROM actualuser WHERE id = ?";
$sql = "SELECT COUNT(actualpireps.pirep_id) AS flights, SUM(actualpireps.flight_time) AS timeflown, COUNT(actualuser.id) AS pilots FROM actualpireps, actualuser WHERE actualuser.id > ? AND actualpireps.submission_status = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "RIP YOU";
} else {
  $one = 1;
  $zero = 0;
  mysqli_stmt_bind_param($stmt, "ii", $zero, $one);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    $flights = $row['flights'];
    $timeflown = $row['timeflown'];
    $pilots = $row['pilots'];
  } else {
    $error = "TRUEEEEE";
  }
}
