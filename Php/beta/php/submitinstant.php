<?php 

include('../include/dbcon.php');
$userid = $sesuser['id'];
$userid2 = $_SESSION['user2'];
$message = $_POST['message'];

if (strlen($message) > 0) {
	$db->query("INSERT INTO instant (userid, userid2, message,timestamp) VALUES ('$userid','$userid2','$message', NOW())");
} else {
	echo 'empty';
}

?>