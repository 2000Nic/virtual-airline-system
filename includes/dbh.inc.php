<?php

$server = "localhost"; #change server address if needed
$dbuser = ""; #insert database username here
$dbpass = ""; #insert database password here
$dbname = ""; #insert database name here

#establishing connection to the database
$conn = mysqli_connect($server, $dbuser, $dbpass, $dbname);

if (!$conn) {
  die(mysqli_connect_error());
}
