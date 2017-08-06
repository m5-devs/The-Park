<?php

include('include/dbcon.php');

$id = $_GET['id'];
$verifyarray = $db->select("SELECT * FROM verify WHERE id = '$id'");
$code = $verifyarray[0]['code'];
$newcode = $_GET['code'];

if ($code == $newcode) {
	$db->query("UPDATE users SET privilege = '1' WHERE id = '$id'");
	$db->query("DELETE FROM verify WHERE id = '$id'");
	echo 'Account activated';
} else {
	echo 'Account not activated';
}
	
?>