<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "components/menu.php"; ?>
<div class="content">
<?php
$searchparam = $_GET["searchparam"];

$sqlPost = "SELECT * FROM users WHERE firstname LIKE '%$searchparam%' OR lastname LIKE '%$searchparam%' OR location LIKE'%$searchparam%';";
$resultPost = $conn->query($sqlPost);

if (!empty($resultPost) && $resultPost->num_rows > 0) {
	session_start();
	while($row = $resultPost->fetch_assoc()) {
		if ($row["email"] !== $_SESSION["email"]) {
			echo '<a class="postDiv postButton" href="user.php?user='.$row["id"].'"><p>'.$row["firstname"]." ".$row["lastname"].'</p></a><br>';
		}
	}
} else {
	echo "No users found with this name or location";
}
?>

</div>

</body>
</html>