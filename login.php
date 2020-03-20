<?php
session_start();

if (!empty($_SESSION['callsign'])) {
  header("Location: dashboard.php");
  exit();
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your airline name here</title>
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/eiy7ugg.css">
    <script src="https://kit.fontawesome.com/47757d73c8.js"></script>
  </head>
  <body>
    <img src="public/img/logo.png" alt="logo">
    <div class="form">
      <form class="login-form" action="includes/login.inc.php" method="post">
        <input type="text" name="email" placeholder="E-mailaddress"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submitBtn">Login</button>
      </form>
      <a href="forgotpwd.php">Forgot password?</a>
    </div>
  </body>
</html>
