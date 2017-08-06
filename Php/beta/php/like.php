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
	if (count($db->select("SELECT * FROM likes WHERE postid = '$postid' AND userid = '$userid' AND type = 'up'")) == 0) {
		$db->query("INSERT INTO likes (postid, userid, type) VALUES ('$postid','$userid','up')");
	} else {
		echo $errormsg;
	}
} else if ($action == 'dislike') {
	$db->query("INSERT INTO likes (postid, userid, type) VALUES ('$postid','$userid','down')");
} else if ($action == 'revoke') {
	$db->query("DELETE FROM likes WHERE postid = '$postid' AND userid = '$userid'");
} else {
	echo $errormsg;
}
	
?>