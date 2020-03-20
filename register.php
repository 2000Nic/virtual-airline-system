<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>you airline name here</title>
    <link rel="stylesheet" href="public/css/register.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/eiy7ugg.css">
    <script src="https://kit.fontawesome.com/47757d73c8.js"></script>
  </head>
  <body>
    <?php include 'public/objects/navbar.php'; ?>
    <form class="registerform" action="includes/register.inc.php" method="post">
      <h2>Register</h2>
      <p>Callsign</p>
      <input type="text" name="callsign">
      <p>Mail address</p>
      <input type="email" name="email">
      <p>Hub</p>
      <select class="select" name="base">
        <option value="EHAM">EHAM - Amsterdam Airport Schiphol</option>
        <option value="EHBK">EHBK - Maastricht Aachen Airport</option>
        <option value="EHEH">EHEH - Eindhoven Airport</option>
        <option value="EHGG">EHGG - Eelde Groningen Airport</option>
        <option value="EHHV">EHHV - Hilversum Airport</option>
        <option value="EHKD">EHKD - De Kooy Aiport</option>
        <option value="EHLE">EHLE - Lelystad Airport</option>
        <option value="EHMZ">EHMZ - Midden-Zeeland Airport</option>
        <option value="EHRD">EHRD - Rotterdam The Hague Airport</option>
        <option value="EHSE">EHSE - Breda International Airport</option>
        <option value="EHTE">EHTE - Teuge Airport</option>
        <option value="EHTX">EHTX - Texel Airport</option>
      </select>
      <p>Country</p>
      <select class="selec" name="country">
        <?php include 'public/objects/countrylist.php'; ?>
      </select>
      <p>Password</p>
      <input type="password" name="pwd">
      <p>Repeat password</p>
      <input type="password" name="repwd">
      <h3>Terms</h3>
      <textarea name="name" width="100%" readonly><?php include 'public/objects/conditionstext.php'; ?></textarea>
      <div class="inline"><input type="checkbox" name="read" onchange="document.getElementById('submit').disabled = !this.checked;">
        <label for="read">I agree to the terms of use.</label></div><br>
      <input type="submit" name="submitBtn" id="submit" value="Register" disabled="disabled">
    </form>
  </body>
</html>
