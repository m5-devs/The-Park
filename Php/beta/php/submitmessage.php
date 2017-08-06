<?php 

include('../include/dbcon.php');
$userid = $sesuser['id'];
$message = $_POST['message'];

if (strlen($message) > 0) {
	$db->query("INSERT INTO messages (message, userid, timestamp) VALUES ('$message','$userid',NOW())");
} else {
	echo 'empty';
}

?>