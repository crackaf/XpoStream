<?php
include_once 'server.php';
session_start();

$id1 = $conn->real_escape_string($_GET['id'] ?? null);
$id2 = $_SESSION['user_id'];

$sql = "DELETE FROM stream_subscriptions WHERE stream_id = $id1 AND user_id = $id2";
$result = runSQLCommand($sql);

echo "<script>setTimeout(function(){ window.location = 'view_stream.php?id=$id1'; }, 0);</script>";
die();

// EOF
