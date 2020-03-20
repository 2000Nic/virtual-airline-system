<div class="filepirep" id="pirep">
  <h2>File PIREP</h2>
  <p <?php if ($_GET['submission'] == "success") {echo 'class="green"';} ?>><?php if ($_GET['submission'] == "success") {echo "Your pirep has been filed.";} else {echo "You can file your pirep here!";} ?></p>
  <form class="pirep" action="includes/filepirep.inc.php" method="post">
    <table>
    <tr><td>Callsign:</td><td class="data"><input type="text" name="callsign" value="<?php echo $_SESSION['callsign']; ?>"></td></tr>
    <tr><td>Dep airport:</td><td class="data"><input type="text" name="departure" value="<?php echo $currentAirport; ?>"></td></tr>
    <tr><td>Arr airport:</td><td class="data"><input type="text" name="arrival"></td></tr>
    <tr><td>Takeoff time:</td><td class="data"><input type="time" name="atd"> Z</td></tr>
    <tr><td>Arrival time:</td><td class="data"><input type="time" name="ata"> Z</td></tr>
    <tr><td>Remarks:</td><td class="data"><input type="text" name="remarks"></td></tr>
    <tr><td colspan="2"><input type="submit" name="submit-pirep" value="File Pirep"></td></tr>
    </table>
  </form>
</div>
