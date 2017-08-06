<?php 

include('../include/dbcon.php');
$userid = $sesuser['id'];
$message = mysql_real_escape_string($_POST['message']);

if (strlen($message) > 0) {
	mysql_query("INSERT INTO messages (message, userid, timestamp) VALUES ('$message','$userid',NOW())");
} else {
	echo 'empty';
}

?>