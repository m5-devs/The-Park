<?php

require_once('../include/dbcon.php');

$username = $_POST['username'];
$password = $_POST['password'];
$success = false;
$message = $errormsg;
$userinfoarray = $db->select("SELECT id, privilege FROM users WHERE username = '$username'");
$userinfo = $userinfoarray[0];

if (strlen($username) != 0) {
	if (strlen($password) != 0) {
		if (count($userinfoarray) != 0) {
			if ($userinfo['privilege'] != '0') {
				if (verifyPass($username, $password)) {
					$_SESSION['id'] = $userinfo['id'];
					$success = true;
				} else {
					$message = 'Incorrect passsword';
				}
			} else {
				$message = 'Account not activated. Check your email';
			}
		} else {
			$message = 'Username does not exist';
		}
	} else {
		$message = 'Enter a password';
	}
} else {
	$message = 'Enter a username';
}

//Return success boolean and message
echo json_encode(array('success'=>$success,'message'=>$message));

?>