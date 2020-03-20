<div class="navbar">
  <ul class="menu-list">
    <li><a href="dashboard.php"><img src="public/img/logo.png" alt="logo"></a></li>
    <li><a href="dashboard.php#pirep">File pirep</a></li>
    <li><a href="dashboard.php#community">Community</a></li>
    <li><a href="logbook.php">Logbook</a></li>
    <?php /* check if user is admin */ if ($_SESSION['priv'] == 0) {echo '<li><a href="admin/index.php">Admin Panel</a></li>';} ?>
    <li class="float"><a href="includes/logout.inc.php">Log out</a></li>
  </ul>
</div>
