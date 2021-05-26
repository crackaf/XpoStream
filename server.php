<?php
require 'server_definition.php';
require 'server_functions.php';

//Database Connection
$conn = new mysqli(SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
  die("Failed to connect to the database: " . $conn->connect_error);
};

$current_time = time();

session_name("ACPortal");

// EOF
