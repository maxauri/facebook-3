<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body> 
<?php
session_start();
session_destroy();
?>

<div class="index">
	<button class="indexButton" onclick='window.location.href = "login.php";'>Log in</button>
	<button class="indexButton" onclick='window.location.href = "register.php";'>Register</button>
</div>

</body>
</html>