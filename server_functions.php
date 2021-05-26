<?php
function runSQLCommand($sql)
{
  global $conn;
  if (!($result = $conn->query($sql))) {
    die($conn->error);
  }
  return $result;
}

function logoutRedirect()
{
  $logout_url = LOGOUT_URL;
  if (!isset($red)) {
    echo "<script>setTimeout(function(){ window.location = '$logout_url'; }, 200);</script>";
  }
  die();
};
//Classes

// EOF
