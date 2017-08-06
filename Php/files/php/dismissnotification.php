<?php

include('../include/dbcon.php');

$id = $_POST['id'];
$action = $_POST['action'];

$notinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM notifications WHERE id = '$id'"));
$friend1 = $notinfo['userid'];
$friend2 = $notinfo['user_from'];

//Delete notification from db
mysql_query("DELETE FROM notifications WHERE id = '$id'");

if ($action == 'accept') {
	if (mysql_query("UPDATE friends SET accepted = '1' WHERE user_to = '$friend1' AND user_from = '$friend2' OR user_from = '$friend1' AND user_to = '$friend2'")) {
		echo 'You are now friends';
		mysql_query("INSERT INTO notifications (username, type, user_from) VALUES ('$friend2','friend_accept','$friend1')");
	} else {
		echo $errormsg;
	}
} else if ($action == 'reject') {
	mysql_query("DELETE FROM friends WHERE user_to = '$friend1' AND user_from = '$friend2' OR user_from ='$friend1' AND user_to = '$friend2'");
	echo 'Ignored';
} else {
	//Simply dismiss the notification
}

?>