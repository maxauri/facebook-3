<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
include "components/menu.php";
include "components/data.php";
include "components/connection.php";
$userId = $userFirstName = $userLastName = $username = $userDescription = $userCreatedAt = $userLocation = "";
$userId = $_GET["user"];
$friends = 0;

$sql = "SELECT id, firstname, lastname, username, description, location, created_at FROM users WHERE id='$userId'";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$userFirstName = $row["firstname"];
		$userLastName = $row["lastname"];
		$username = $row["username"];
		$userDescription = $row["description"];
		$userCreatedAt = $row["created_at"];
		$userLocation = $row["location"];
	  }
}
$conn->close();
?>

<div class="content">
<img src="profile-picture.png">
<h1><?php echo $userFirstName . " " . $userLastName; ?></h1>
<br><br>
Username: <?php echo $username; ?>
<br><br>
About me: <?php echo $userDescription; ?>
<br><br>
Location: <?php echo $userLocation; ?>
<br><br>
Account was created: <?php echo $userCreatedAt; ?>
<br><br>

<?php
include "components/connection.php";
$sql = "SELECT * FROM friends WHERE request_sender='$idData' AND request_receiver='$userId' OR request_sender='$userId' AND request_receiver='$idData';";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["accepted"] == 1) {
			$friends = 1;
			echo '<form method="post">
			<input class="friendRequest" type="submit" name="remove" value="Remove from friends";>
			</form>';
		} else if ($row["request_sender"] == $idData) {
			echo '<form method="post">
			<input class="friendRequest" type="submit" name="cancel" value="Cancel friend request";>
			</form>';
		} else if ($row["request_sender"] == $userId){
			echo '<form method="post">
			<input class="friendRequest" type="submit" name="accept" value="Accept friend request";>
			</form>';
		}
	}
} else {
	echo '<form method="post">
	<input class="friendRequest" type="submit" name="send" value="Send friend request";>
	</form>';
}

if (isset($_POST['send'])) {
	$sql= "INSERT INTO friends (request_sender, request_receiver, accepted) 
	SELECT '$idData', '$userId', 0 FROM DUAL
	WHERE NOT EXISTS 
	(SELECT * FROM friends WHERE request_sender=$idData AND request_receiver=$userId);";
	$result = $conn->query($sql);
	header("Refresh:0");
}
if (isset($_POST['remove']) || isset($_POST['cancel'])) {
	$sql = "DELETE from friends WHERE request_sender=$idData AND request_receiver=$userId OR request_sender=$userId AND request_receiver=$idData;";
	$result = $conn->query($sql);
	header("Refresh:0");
}
if (isset($_POST['accept'])) {
	$sql = "UPDATE friends SET accepted=1 WHERE request_sender=$userId AND request_receiver=$idData;";
	$result = $conn->query($sql);
	header("Refresh:0");
}

$conn->close();
?>

<?php
if ($friends == 1) {
	include "components/connection.php";
	
	//get posts
	$sqlPost = "SELECT * FROM posts WHERE poster_id=$userId ORDER BY created_at DESC;";
	$resultPost = $conn->query($sqlPost);
	if (!empty($resultPost) && $resultPost->num_rows > 0) {
		echo "<div class='post'> <h3>Posts:</h3>";
		while($row = $resultPost->fetch_assoc()) {
			$sql = "SELECT * FROM likes WHERE post_id=".$row["id"].";";
			$result = $conn->query($sql);
			$likes = 0;
			if (!empty($result) && $result->num_rows > 0) {
				while($rowLikes = $result->fetch_assoc()) {
					$likes += 1;
				}
			}
			echo '<a class="postButton" type="button "href="post.php?id='.$row["id"].'">';
			echo '<div class="postDiv">';
			echo '<h3>'.$row["name"].'</h3>';
			echo '<p>'.$row["text"].'</p>';
			echo '<p>'.$row["created_at"].'</p>';
			echo "Likes: ".$likes;
			echo '</div></a><br>';
		}
	}
	echo "</div>";
	
	//get reposts
	$sqlPost = "SELECT * FROM reposts WHERE reposter_id=$userId ORDER BY created_at DESC;";
	$resultPost = $conn->query($sqlPost);
	if (!empty($resultPost) && $resultPost->num_rows > 0) {
		echo "<div class='repost'> <h3>Reposts:</h3>";
		while($row = $resultPost->fetch_assoc()) {
			$sql = "SELECT * FROM likes WHERE post_id=".$row["post_id"].";";
			$result = $conn->query($sql);
			$likes = 0;
			if (!empty($result) && $result->num_rows > 0) {
				while($rowLikes = $result->fetch_assoc()) {
					$likes += 1;
				}
			}
			echo '<a class="postButton" type="button "href="post.php?id='.$row["post_id"].'">';
			echo '<div class="postDiv">';
			echo '<h3>'.$row["name"].'</h3>';
			echo '<p>'.$row["text"].'</p>';
			echo '<p>'.$row["created_at"].'</p>';
			echo "Likes: ".$likes;
			echo '</div></a><br>';
		}
	}
	echo "</div>";
	
	
	$conn->close();
}
?>

</div>


</body>
</html>