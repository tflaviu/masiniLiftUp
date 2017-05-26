<form action = "" method = "post">
    <label style = "display: block;" for = "username">User name:</label>
    <input style = "display: block;" class = "input" type = "text" name = "username" id = "username"/>
    <label style = "display: block;" for = "password">Password:</label>
    <input style = "display: block;" class = "input" type = "password" name = "password" id = "password"/>
    
    <input name = "submit" type = "submit" value = "Login"/>
</form>

<?php
include_once "./functions/connect.php";
include_once "./functions/login.php"; 

$db = dbConnect();
$redirectPage = "admin.php";
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];	
	login($username, $password, $db, $redirectPage);
}