<div class="stats">
  <ul class="widget">
    <?php include 'includes/refresh.inc.php'; ?>
    <?php echo $error; ?>
    <li><div class="stat"><i class="fas fa-paper-plane"></i><br>Number of flights:<br><?php echo $flights; ?></div></li>
    <li><div class="stat"><i class="fas fa-user-clock"></i><br>Total time flown:<br><?php $t = $timeflown; echo  sprintf("%d:%02d", floor($t/60), $t%60);?></div></li>
    <li><div class="stat"><i class="fas fa-map-marker-alt"></i><br>Current location:<br><?php echo $currentAirport;?></div></li>
  </ul>
</div>
