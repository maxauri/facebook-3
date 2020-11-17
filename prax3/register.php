<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body> 
<?php
include "components/connection.php";

$firstname = $lastname = $username = $email = $password = $password1 = $password2 = "";
$created_at = new DateTime();
$created_at = $created_at->format('Y-m-d H:i:s');
$nameErr1 = $nameErr2 = $emailErr = $passwordErr1 = $passwordErr2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//check name
	if (empty($_POST["firstname"])) {
		$nameErr1 = "* First name is required";
	  } else {
		$firstname = test_input($_POST["firstname"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
		  $nameErr1 = "* Only letters and white space allowed";
		}
	  }
	  
	if (empty($_POST["lastname"])) {
		$nameErr2 = "* Last name is required";
	} else {
		$lastname = test_input($_POST["lastname"]);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
			$nameErr2 = "* Only letters and white space allowed";
		}
	}
	//check email
	if (empty($_POST["email"])) {
		$emailErr = "* Email is required";
	  } else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "* Invalid email format";
		}
	  }
	//check password
	if (empty($_POST["password1"])) {
		$passwordErr1 = "* Password is required";
	} else {
		if (strlen(test_input($_POST["password1"])) < 8) {
			$passwordErr1 = "* Password has to be at least 8 characters long";
		} else if (empty($_POST["password2"])) {
			$passwordErr2 = "* Repeat password";
		} else if ($_POST["password1"] === $_POST["password2"]) {
			$password = test_input($_POST["password1"]);
		} else {
			$passwordErr2 = "* Passwords don't match";
		}
	}
	
	if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
		
		$sql = "SELECT id FROM users WHERE email='$email';";
		$result = $conn->query($sql);

		if (!empty($result) && $result->num_rows > 0) {
			$emailErr = "* An account with this email already exists";
		} else {
			$sql = "SELECT username FROM users WHERE firstname='$firstname' AND lastname='$lastname';";
			$result = $conn->query($sql);

			if (!empty($result) && $result->num_rows > 0) {
				$counter = 0;
				while($row = $result->fetch_assoc()) {
					$counter += 1;
				}
				$username = $firstname.".".$lastname.".".$counter;
			} else {
				$username = $firstname.".".$lastname;
			}
			$hash = password_hash($password, PASSWORD_DEFAULT); 
			$sql = "INSERT INTO users (firstname, lastname, username, email, password, created_at)
			VALUES ('$firstname', '$lastname', '$username', '$email', '$hash', '$created_at')";
			if ($conn->query($sql) === FALSE) {
			  echo "Error: " . $conn->error;
			}
			$conn->close();
			session_start();
			$_SESSION["email"] = $email;
			header("Location: /prax3/timeline.php"); /* Redirect browser */
			exit();
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?> 

<div class="signup">
	<h2 class="signupH2">Sign up</h2>
	<form class="signupForm" action="register.php" method="post">
	  <p>First name:</p><input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>">
	  <span class="error"><?php echo $nameErr1;?></span>
	  <br><br>
	  <p>Last name:</p><input type="text" id="lastname" name="lastname" value="<?php echo $lastname;?>">
	  <span class="error"><?php echo $nameErr2;?></span>
	  <br><br>
	  <p>E-mail:</p><input type="text" id="email" name="email" value="<?php echo $email;?>">
	  <span class="error"><?php echo $emailErr;?></span>
	  <br><br>
	  <p>Password:</p><input type="password" id="password1" name="password1">
	  <span class="error"><?php echo $passwordErr1;?></span>
	  <br><br>
	  <p>Repeat password:</p><input type="password" id="password2" name="password2">
	  <span class="error"><?php echo $passwordErr2;?></span>
	  <br><br>
	  <button class="signupButton" type="submit" name="submit" value="Submit">Submit</button>  
	</form>
</div>

</body>
</html>