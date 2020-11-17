<?php
include "components/connection.php";

$emailLogin = $passwordLogin = "";
$emailErrLogin = $passwordErrLogin = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//check email
	if (empty($_POST["emailLogin"])) {
		$emailErrLogin = "* Email is required";
	  } else {
		$emailLogin = test_input_login($_POST["emailLogin"]);
		if (!filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
		  $emailErrLogin = "* Invalid email format";
		}
	  }
	//check password
	if (empty($_POST["passwordLogin"])) {
		$passwordErrLogin = "* Password is required";
	} else {
		$passwordLogin = test_input_login($_POST["passwordLogin"]);
	}
	
	if (!empty($emailLogin) && !empty($passwordLogin)) {
		
		$sql = "SELECT id FROM users WHERE email='$emailLogin', password='$passwordLogin'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			header("Location: /prax3/timeline.php"); /* Redirect browser */
			exit();
		} else {
		  $loginErr = "* Account with this email or password doesn't exist";
		}
		$conn->close();
	}
}

function test_input_login($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>