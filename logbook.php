<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <link rel="stylesheet" href="public/css/stats.css">
    <script src="https://kit.fontawesome.com/47757d73c8.js"></script>
    <title>Your airline name here</title>
  </head>
  <body class="admin">
    <?php include 'public/objects/dash-navbar.php'; ?>
    <?php include 'public/objects/dash-stats.php'; ?>
    <table>
      <tr><th>Pirep ID</th><th>Flight Callsign</th><th>Dep airport</th><th>Arr airport</th><th>Flight time</th><th>Dep time</th><th>Arr Time</th><th>Remarks</th><th>Time of submission</th><th>Pirep status</th></tr>
      <?php include 'includes/flightfetch.inc.php'; ?>
    </table>
  </body>
</html>
