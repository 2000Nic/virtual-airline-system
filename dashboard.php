<?php session_start();

if (isset($_SESSION['userid'])) {
  include 'hiddendash.php';
} else {
  header("Location: index.php?error=gtfooursystemhacker");
}
