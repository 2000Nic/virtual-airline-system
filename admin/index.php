<?php session_start(); if ($_SESSION['priv'] != 0 || !isset($_SESSION['userid'])) {header("Location: ../dashboard.php?no=thanks");} ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/admin.css">
    <title>Admin Panel</title>
  </head>
  <body class="admin">
    <?php include '../public/objects/admin-navbar.php'; ?>
    <table>
      <tr><th>Pirep ID</th><th>Pilot ID</th><th>Flt Callsign</th><th>Dep Airport</th><th>Arr Airport</th><th>Flt Time (min)</th><th>Dep Time</th><th>Arr Time</th><th>Remarks</th><th>Tijd van pirep</th><th>Pirep status</th><th>Actions</th></tr>
      <?php include '../includes/fetch.inc.php'; ?>
    </table>
    <script type="text/javascript">
      function accept(x) {
        console.log(x);
      }
    </script>
  </body>
</html>
