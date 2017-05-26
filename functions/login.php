<?php

function login ($username, $password, $db, $redirectPage) {
		 
	if (empty($username)) {
		$error = "Complete username field!";
	} 
	elseif (empty($password)) {
		$error = "Complete password field!";
	}
	else {
		$sql = "SELECT * FROM users WHERE UserName = '$username' and Password = '$password'";
		$result = $db->query($sql); 
		$row = mysqli_fetch_assoc($result);
		$active = $row['active'];
				  
		$count = mysqli_num_rows($result);
				  
		if($count == 1) {
			session_start();
			$_SESSION ['loggedUser'] = $username;
			$_SESSION ['loggedIn'] = true;
			header("location: $redirectPage");
		} else {
			$error = "Your email or password was entered incorrectly.";
		}
	}
	
	if (isset($error)) {
		echo $error;
	}
}
