<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "<script>setTimeout(function(){ window.location = 'login.php'; }, 10);</script>";
  die();
}

// EOF
