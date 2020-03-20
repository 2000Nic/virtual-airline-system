<?php
//start session
session_start();

//connect to db
include 'dbh.inc.php';

//fetch flight data
$sql = "SELECT COUNT(actualpireps.pirep_id) AS flights, SUM(actualpireps.flight_time) as timeflown, actualuser.currentAirport FROM actualpireps, actualuser WHERE actualpireps.user_id = ? AND actualpireps.submission_status = 1 AND actualuser.id = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "failed to prepare statements";
} else {
  mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userid'], $_SESSION['userid']);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    $flights = $row['flights'];
    $timeflown = $row['timeflown'];
    $currentAirport = $row['currentAirport'];
  } else {
    echo "something went wrong";
  }
}
