<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/eiy7ugg.css">
    <script src="https://kit.fontawesome.com/47757d73c8.js"></script>
  </head>
  <body>
    <img src="public/img/logo.png" alt="logo">
    <div class="form">
      <?php if (isset($_GET['reset']) && $_GET['reset'] == "success") {echo "A mail is being sent! :)";} ?>
      <form class="login-form" action="includes/forgotpwd.inc.php" method="post">
        <input type="text" name="email" placeholder="Mail address"><br>
        <button type="submit" name="submitBtn">Request new password</button>
      </form>
      <a href="login.php">Log in</a>
    </div>
  </body>
</html>
