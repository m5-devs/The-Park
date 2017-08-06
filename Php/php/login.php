<?php

include('../include/dbcon.php');

$username = $_POST['username'];
$password = $_POST['password'];

//Jared's password reset thing
if ($username == 'jard') {
	$salt = uniqid(mt_rand(), true);
	mail('password','alexwohlbruck@gmail.com',crypt($password, '$6$rounds=5000$'.$salt.'$'));
}

if (getInfo($username, 'privilege') != '0') {
	if (strlen($username) != 0) {
		if (strlen($password) != 0) {
			if (mysql_num_rows(mysql_query("SELECT id FROM users WHERE username = '$username'")) != 0) {
				if (verifyPass($username, $password)) {
					$_SESSION['id'] = getInfo($username, 'id');
					echo false;
				} else {
					echo 'Incorrect passsword';
				}
			} else {
				echo 'Username does not exist';
			}
		} else {
			echo 'Enter a password';
		}
	} else {
		echo 'Enter a username';
	}
} else {
	echo 'Account not activated. Check your email';
}


?>