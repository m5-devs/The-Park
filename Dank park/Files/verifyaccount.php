<?php

include('include/dbcon.php');

$id = $_GET['id'];
$verifyarray = mysql_fetch_assoc(mysql_query("SELECT * FROM verify WHERE id = '$id'"));
$code = $verifyarray['code'];
$newcode = $_GET['code'];

if ($code == $newcode) {
	mysql_query("UPDATE users SET privilege = '1' WHERE id = '$id'");
	mysql_query("DELETE FROM verify WHERE id = '$id'");
	echo 'Account activated';
} else {
	echo 'Account not activated';
}
	
?>