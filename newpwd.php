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
      <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
          echo "You moron!";
        } else {
          if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>
            <form class="login-form" action="includes/resetpwd.inc.php" method="post">
              <input type="hidden" name="selector" value="<?php echo $selector; ?>">
              <input type="hidden" name="validator" value="<?php echo $validator; ?>">
              <input type="password" name="pwd" placeholder="Nieuwe wachtwoord"><br>
              <input type="password" name="repwd" placeholder="Herhaal uw nieuwe wachtwoord"><br>
              <button type="submit" name="submitBtn">Reset password</button>
            </form>
            <?php
          }
        }
       ?>
      <a href="login.php">Login</a>
    </div>
  </body>
</html>
