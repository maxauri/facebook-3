<?php
include "components/connection.php";

$idData = $firstNameData = $lastNameData = $userNameData = $descriptionData = $createdAtData = $locationData = "";
session_start();
if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
   header("Location: /prax3/index.php"); /* Redirect browser */
}
$emailData = $_SESSION["email"];

$sql = "SELECT id, firstname, lastname, username, description, location, created_at FROM users WHERE email='$emailData'";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$idData = $row["id"];
		$firstNameData = $row["firstname"];
		$lastNameData = $row["lastname"];
		$userNameData = $row["username"];
		$descriptionData = $row["description"];
		$locationData = $row["location"];
		$createdAtData = $row["created_at"];
	  }
}
$conn->close();

?>