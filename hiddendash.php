<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="public/css/master.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/dash.css">
    <link rel="stylesheet" href="public/css/stats.css">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/eiy7ugg.css">
    <script src="https://kit.fontawesome.com/47757d73c8.js"></script>
  </head>
  <body>
    <?php include 'public/objects/dash-navbar.php'; ?>
    <div class="container">
      <h1>Welcome, <?php echo $_SESSION['callsign']; ?>,</h1>
    </div>
    <?php include 'public/objects/dash-stats.php'; ?>
    <?php include 'public/objects/pirep.php'; ?>
    <?php include 'public/objects/community.php'; ?>
    <?php include 'public/objects/footer.php'; ?>
  </body>
</html>
