<?php
include_once 'server.php';

session_start();

if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach ($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    setcookie($name, '', time() - 1000);
    setcookie($name, '', time() - 1000, '/');
  }
}

session_destroy();
echo "<script>setTimeout(function(){ window.location = 'index.php'; }, 10);</script>";
die();

// EOF
