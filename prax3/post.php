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
$id = $text = $name = $posterId = $reposterId = $createdAt = $comment = "";
$id = $_GET["id"];

//get post data
$sql = "SELECT * FROM posts WHERE id='$id'";
$result = $conn->query($sql);
if (!empty($result) && $result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$text = $row["text"];
		$name = $row["name"];
		$posterId = $row["poster_id"];
		$createdAt = $row["created_at"];
	}
}

//get likes
$sql = "SELECT * FROM likes WHERE post_id=".$id.";";
$result = $conn->query($sql);
$likes = 0;
if (!empty($result) && $result->num_rows > 0) {
	while($rowLikes = $result->fetch_assoc()) {
		$likes += 1;
	}
}
$conn->close();
?>

<div class="content">
<img src="profile-picture.png">
<h1><?php echo $name; ?></h1>
<br>
<?php echo $text; ?>
<br><br>
<?php echo $createdAt; ?>
<br><br>

<h4>Add comment:</h4>
<form method="post">  
  <textarea name="comment" id="comment" rows="5" cols="40"></textarea>
  <br><br>
  <input class="submitButtonProfile" type="submit" name="submit" value="Submit"> 
  <br>
</form>
<?php
include "components/connection.php";

echo '<form method="post">'."<h3>Likes: ".$likes.'</h3>
<input class="submitButtonProfile" type="submit" name="toggleLike" value="Like";>
</form><br>';
echo '<form method="post">
<input class="submitButtonProfile" type="submit" name="repost" value="Repost";>
</form><br>';


if (isset($_POST['submit'])) {
	if (!empty($_POST["comment"])) {
		$comment = $_POST["comment"];
	}
	$sql = "INSERT INTO comments (post_id, poster_id, name, comment)
	VALUES ('$id', '$idData', '$userNameData', '$comment')";
	if ($conn->query($sql) === FALSE) {
	  echo "Error: " . $conn->error;
	}
	header("Refresh:0");
}

if (isset($_POST['repost'])) {
	$sql = "INSERT INTO reposts (post_id, poster_id, reposter_id, name, text, created_at)
	VALUES ('$id', '$posterId', '$idData', '$name', '$text', '$createdAt')";
	if ($conn->query($sql) === FALSE) {
	  echo "Error: " . $conn->error;
	}
	header("Refresh:0");
}

$sql = "SELECT * FROM comments WHERE post_id='$id';";
$result = $conn->query($sql);
if (!empty($result) && $result->num_rows > 0) {
	echo '<h3>Comments:</h3>';
	while($row = $result->fetch_assoc()) {
		echo '<div class="postDiv"><p>'.$row["name"].'</p>';
		echo '<p>'.$row["comment"].'</p></div>';
	}
}

if (isset($_POST['toggleLike'])) {
	$sql = "SELECT liker_id FROM likes WHERE post_id=".$id." AND liker_id=$idData;";
	$result = $conn->query($sql);
	if (!empty($result) && $result->num_rows > 0) {
		$sqlLike = "DELETE FROM likes WHERE post_id=".$id." AND liker_id=$idData;";
		$resultLike = $conn->query($sqlLike);
	} else {
		$sqlLike = "INSERT INTO likes (liker_id, post_id)
		VALUES ('$idData', '".$id."')";
		$resultLike = $conn->query($sqlLike);
	}
	header("Refresh:0");
}

$conn->close();
?>
</div>
</body>
</html>