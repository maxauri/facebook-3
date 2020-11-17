<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body> 
<?php
include "components/connection.php";

if (isset($_POST['search'])) {
	if (!empty($_POST["search"])) {
		header("Location: /prax3/search.php?searchparam=".$_POST["search"]); /* Redirect browser */
	}
}
?>
<div class="topnav">
	<a href="profile.php">Profile</a>
	<a href="timeline.php">Timeline</a>
	<a href="index.php">Logout</a>
	<div class="search-container">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input class="searchForm" type="text" id="search" name="search" placeholder="Search by name or location">
			<button class="searchButton" type="submit">Search</button>
		</form>
	</div>
</div>

</body>
</html>
