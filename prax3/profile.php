<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
include "components/menu.php";
include "components/data.php";
?>
<div>

	<div class="content">
		<img src="profile-picture.png">
		<h1><?php echo $firstNameData . " " . $lastNameData; ?></h1>
		<br><br>
		Username: <?php echo $userNameData; ?>
		<br><br>
		About me: <?php echo $descriptionData; ?>
		<br><br>
		Location: <?php echo $locationData; ?>
		<br><br>
		Account was created: <?php echo $createdAtData; ?>
		<br><br>

		<h3>Edit description:</h3>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		  <textarea name="description" id="description" rows="2" cols="40"></textarea>
		  <br><br>
		  <input class="descriptionButton" type="submit" name="submitDescription" value="Submit"> 
		</form>

		<h3>Edit location:</h3>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		  <textarea name="location" id="location" rows="2" cols="40"></textarea>
		  <br><br>
		  <input class="locationButton" type="submit" name="submitLocation" value="Submit"> 
		</form>
		
		<?php 
		include "components/connection.php";
		$description = $location = "";
		if (isset($_POST['submitDescription'])) {
			if (!empty($_POST["description"])) {
				$description = $_POST["description"];
				$sql = "UPDATE users SET description='$description' WHERE id=$idData;";
				if ($conn->query($sql) === FALSE) {
				  echo "Error: " . $conn->error;
				}
				header("Refresh:0");
			}
		}
		if (isset($_POST['submitLocation'])) {
			if (!empty($_POST["location"])) {
				$location = $_POST["location"];
				$sql = "UPDATE users SET location='$location' WHERE id=$idData;";
				if ($conn->query($sql) === FALSE) {
				  echo "Error: " . $conn->error;
				}
				header("Refresh:0");
			}
		}
		?>

		<h2>Post something:</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		  <textarea name="postText" id="postText" rows="5" cols="40"></textarea>
		  <br><br>
		  <input class="submitButtonProfile" type="submit" name="submit" value="Submit"> 
		</form>

		<?php
		$postText = "";
		$posterID = $posterName = "";
		$created_at = new DateTime();
		$created_at = $created_at->format('Y-m-d H:i:s');
		$emailData = $_SESSION["email"];

		//get user id
		$sql = "SELECT id, firstname, lastname FROM users WHERE email='$emailData'";
		$result = $conn->query($sql);
		if (!empty($result) && $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$posterID = $row["id"];
				$posterName = $row["firstname"]." ".$row["lastname"];
			}
		}

		//add new post
		if (isset($_POST['submit'])) {
			if (!empty($_POST["postText"])) {
				$postText = $_POST["postText"];
			}
			$sql = "INSERT INTO posts (name, text, poster_id, created_at)
			VALUES ('$posterName', '$postText', '$posterID', '$created_at')";
			if ($conn->query($sql) === FALSE) {
			  echo "Error: " . $conn->error;
			}
		}

		//get posts
		$sqlPost = "SELECT id, name, text, poster_id, created_at FROM posts WHERE poster_id=$posterID ORDER BY created_at DESC;";
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
		$sqlPost = "SELECT * FROM reposts WHERE reposter_id=$posterID ORDER BY created_at DESC;";
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
		?>
		
	</div>
	
	<div class="requests">
		<?php
		include "components/connection.php";
		$sql = "SELECT * FROM friends WHERE request_receiver=$idData AND accepted=1 OR request_sender=$idData AND accepted=1;";
		$result = $conn->query($sql);
		if (!empty($result) && $result->num_rows > 0) {
			echo '<h2>Friends</h2>';
			while($row = $result->fetch_assoc()) {
				$sqlSender = "SELECT * FROM users WHERE id=".$row["request_sender"]." OR id=".$row["request_receiver"].";";
				$resultSender = $conn->query($sqlSender);
				if (!empty($resultSender) && $resultSender->num_rows > 0) {
					while($rowSender = $resultSender->fetch_assoc()) {
						if ($rowSender["id"] != $idData) {
							echo '<a class="friends" type="button "href="user.php?user='.$rowSender["id"].'">'.$rowSender["firstname"].' '.$rowSender["lastname"].'</a><br>';
						}
					}
				}					
			}
		}
		?>

		<?php
		include "components/connection.php";
		$sql = "SELECT * FROM friends WHERE request_receiver=$idData AND accepted=0;";
		$result = $conn->query($sql);
		if (!empty($result) && $result->num_rows > 0) {
			echo '<h2>Friend requests</h2>';
			while($row = $result->fetch_assoc()) {
				$sqlSender = "SELECT * FROM users WHERE id=".$row["request_sender"].";";
				$resultSender = $conn->query($sqlSender);
				if (!empty($resultSender) && $resultSender->num_rows > 0) {
					while($rowSender = $resultSender->fetch_assoc()) {
						echo '<a class="friends" type="button "href="user.php?user='.$rowSender["id"].'">'.$rowSender["firstname"].' '.$rowSender["lastname"].'</a>';
					}
				}					
			}
		}
		?>
	</div>
</div>
</body>
</html>