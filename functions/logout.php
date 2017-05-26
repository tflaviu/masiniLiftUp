<?php
function logout($loggedUser, $loggedIn) {
	
	session_start();
	unset ($_SESSION ['loggedUser'] );
	unset($_SESSION['loggedin']);

	header ('Location: admin.php');
}	