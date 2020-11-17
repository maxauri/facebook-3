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
<div class="container">

<div class="content">

<?php
include "components/connection.php";
$sql = "SELECT * FROM friends WHERE request_sender=$idData AND accepted=1 OR request_receiver=$idData AND accepted=1;";
$result = $conn->query($sql);
if (!empty($result) && $result->num_rows > 0) {
	$poster = 0;
	while($row = $result->fetch_assoc()) {
		if ($row["request_sender"] === $idData) {
			$poster = $row["request_receiver"];
		} else {
			$poster = $row["request_sender"];
		}
	}
	$sqlPost = "SELECT id, name, text, poster_id, created_at FROM posts WHERE poster_id=$poster ORDER BY created_at DESC;";
	$resultPost = $conn->query($sqlPost);
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
		echo '</div></a>';
	}
} else {
	echo '<h2>No posts yet!</h2>';
}

?>
</div>
</div>
</body>
</html>