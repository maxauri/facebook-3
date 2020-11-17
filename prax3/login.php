<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body> 
<?php
include "components/connection.php";

$emailLogin = $passwordLogin = "";
$emailErrLogin = $passwordErrLogin = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//check email
	if (empty($_POST["email"])) {
		$emailErrLogin = "* Email is required";
	  } else {
		$emailLogin = test_input_login($_POST["email"]);
		if (!filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
		  $emailErrLogin = "* Invalid email format";
		}
	  }
	//check password
	if (empty($_POST["password"])) {
		$passwordErrLogin = "* Password is required";
	} else {
		$passwordLogin = test_input_login($_POST["password"]);
	}
	
	if (!empty($emailLogin) && !empty($passwordLogin)) {
		$sql = "SELECT email, password FROM users WHERE email='$emailLogin';";
		$result = $conn->query($sql);

		if (!empty($result) && $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$verify = password_verify($passwordLogin, $row["password"]); 
			    if ($verify) { 
				    session_start();
					$_SESSION["email"] = $emailLogin;
					header("Location: /prax3/timeline.php"); /* Redirect browser */
					$conn->close();
					exit();
			    }
			}
		}
		$loginErr = "* Account with this email or password doesn't exist";
	}
	
}

function test_input_login($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?> 

<div class="login">
	<h2 class="loginH2">Log in</h2>
	<form class="loginForm" action="login.php" method="post">
	  <p>E-mail:</p><input type="text" id="email" name="email" value="<?php echo $emailLogin;?>">
	  <span class="error"><?php echo $emailErrLogin;?></span>
	  <br><br>
	  <p>Password:</p><input type="password" id="password" name="password">
	  <span class="error"><?php echo $passwordErrLogin;?></span>
	  <br><br>
	  <button class="loginButton" type="submit" name="submit" value="Submit">Submit</button>  
	  <br><br>
	  <span class="error"><?php echo $loginErr;?></span>
	</form>
	
</div>

</body>
</html>
