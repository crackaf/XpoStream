<?php
include_once 'server.php';
session_start();

$id1 = $conn->real_escape_string($_GET['id'] ?? null);
$id2 = $_SESSION['user_id'];

if ($id1 != $id2) {
  $sql = "INSERT INTO host_subscribers VALUES($id1,$id2)";
  $result = runSQLCommand($sql);
}

echo "<script>setTimeout(function(){ window.location = 'profile.php?id=$id1'; }, 0);</script>";
die();

// EOF
