<?php

include('../include/dbcon.php');

$type = str_replace('radio','',$_POST['type']);
$message = $_POST['message'];
$userid = $_SESSION['id'];
$error = 'An error occured, try again later';

if (isset($_SESSION['id'])) {
	if (strlen($type) != 0) {
		if (strlen($message) != 0) {
			if (mysql_query("INSERT INTO feedback (userid, message, type) VALUES ('1','$message','$type')") && mysql_query("INSERT INTO notifications (userid, type, user_from) VALUES ('1','feedback','$userid'),('2','feedback','$userid')")) {;
				echo 'Feedback sent!';
			} else {
				echo $errormsg;
			}
		} else {
			echo $errormsg;
		}
	} else {
		echo $errormsg;
	}
} else {
	echo 'You are not logged in';
}

?>