<?php

require_once('../include/dbcon.php');

$userid = $_SESSION['id'];
if (!isset($userid)) { echo 'Sign in to write a post'; exit; }
$type = $_POST['type'];
$message = $_POST['message'];
$ip = $_SERVER['REMOTE_ADDR'];
$iplong = ip2long($ip);

$message = $db->quote($message);
$tofrom = $_POST['tofrom'];
$user_info = getInfo((int) $userid);

switch ($type) {
	case 'profile':
		$tofromtype = 'profile_to';
		break;
	case 'private':
		$tofromtype = 'private_to';
		break;
	case 'classroom':
		$tofromtype = 'profile_to';
		break;
	case 'help':
		$tofromtype = 'classroom_to';
		break;
	case 'profile':
		$tofromtype = 'category';
		break;
	case 'reshare':
		$tofromtype = 'reshare_from';
		break;
	default:
		echo 'Please specify the type of posts you want and an id to source them from';
		break;
}

if (strlen($message) != 0) {
	if (strlen($message) > 8) {
		$db->query("INSERT INTO posts (userid, type, message, $tofromtype, ip) VALUES ('$userid','$type','$message','$tofrom','$iplong')");
		$postid = $db->select("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'posts'");
		$postid = ((int) $postid[0]['auto_increment'])-1;

		$postids = array($postid);
		include('../php/generatepost.php');
	} else {
		echo 'short';
	}
} else {
	echo 'empty';
}

?>