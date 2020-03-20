<?php
//start session
session_start();

//include database
include 'dbh.inc.php';

//fetch all pireps flown by user
$sql = "SELECT * FROM actualpireps WHERE user_id =".$_SESSION['userid'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($row['submission_status'] == 2) {
        $substat = "Rejected";
      } else if ($row['submission_status'] == 1) {
        $substat = "Accepted";
      } else if ($row['submission_status'] == 0) {
        $substat = "Not validated yet";
      }

      $t = $row['flight_time'];
      echo "<tr><td>".$row['pirep_id']."</td><td>".$row["flight_callsign"]."</td><td>".$row["dep_airport"]."</td><td>".$row["arr_airport"]."</td><td>".sprintf("%d:%02d", floor($t/60), $t%60)."</td><td>".$row["dep_time"]."</td><td>".$row["arr_time"]."</td><td>".$row["remarks"]."</td><td>".$row["submission_time"]."</td><td>".$substat."</td></tr>";
    }
} else {
    echo "There are no flights, go fly one";
}
