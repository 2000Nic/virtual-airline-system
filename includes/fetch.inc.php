<?php

include 'dbh.inc.php';
$sql = "SELECT * FROM actualpireps ORDER BY pirep_id DESC";
$result = $conn->query($sql);

#check if there are any pireps
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['pirep_id']."</td><td>".$row["user_id"]."</td><td>".$row["flight_callsign"]."</td><td>".$row["dep_airport"]."</td><td>".$row["arr_airport"]."</td><td>".$row["flight_time"]."</td><td>".$row["dep_time"]."</td><td>".$row["arr_time"]."</td><td>".$row["remarks"]."</td><td>".$row["submission_time"]."</td>";
        if ($row['submission_status'] == 0) {echo '<td>Validatie nodig</td><td>';}
        else if ($row['submission_status'] == 1) {echo '<td>Geaccepteerd</td><td>';}
        else if ($row['submission_status'] == 2) {echo '<td>Afgekeurd</td><td>';}
        else {echo '<td>Error, webmaster nodig</td><td>';}
        if ($row['submission_status'] != 1) {echo '<a href="../includes/accept.inc.php?accept='.$row['pirep_id'].'&user='.$row['user_id'].'&airport='.$row['arr_airport'].'&timeflown='.$row['flight_time'].'">Accepteren</a> ';}
        
        if ($row['submission_status'] != 2) {echo '<a href="../includes/reject.inc.php?reject='.$row['pirep_id'].'">Afkeuren</button></td></tr>';}
    }
} else {
    echo "0 results";
}
