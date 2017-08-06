<?php

require("../include/dbcon.php");

if (!isset($_SESSION['id'])) {
	echo 'Sign in first';
	exit();
}

$userid = $_SESSION['id'];
$postid = $_POST['postid'];
$action = $_POST['action'];

if ($action == 'like') {
	if (mysql_num_rows(mysql_query("SELECT * FROM likes WHERE postid = '$postid' AND userid = '$userid' AND type = 'up'")) == 0) {
		mysql_query("INSERT INTO likes (postid, userid, type) VALUES ('$postid','$userid','up')");
	} else {
		echo $errormsg;
	}
} else if ($action == 'dislike') {
	mysql_query("INSERT INTO likes (postid, userid, type) VALUES ('$postid','$userid','down')");
} else if ($action == 'revoke') {
	mysql_query("DELETE FROM likes WHERE postid = '$postid' AND userid = '$userid'");
} else {
	echo $errormsg;
}
	
?>