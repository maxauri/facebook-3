<?php
$servername = "localhost";
$serverusername = "s_pikoiv";
$serverpassword = "oXH5VUIv";
$dbname = "pikoiv";

// Create connection
$conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>