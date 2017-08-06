<?php

require('../include/dbcon.php');
$studentid = $sesuser['id'];
$code = $_POST['code'];
$codeinfoquery = mysql_query("SELECT * FROM classcodes WHERE code = '$code'");
$codeinfo = mysql_fetch_assoc($codeinfoquery);
$classid = $codeinfo['classid'];
$studentinfoquery = mysql_query("SELECT * FROM students WHERE studentid = '$studentid' AND classid = '$classid'");
$classid = $codeinfo['classid'];

if (strlen($code) != 0) { 
	if (isset($_SESSION['id'])) {
		if (mysql_num_rows($studentinfoquery) == 0) {
			if (mysql_num_rows($codeinfoquery) != 0) {
				if (mysql_query("INSERT INTO students (studentid, classid) VALUES ('$studentid','$classid')")) {
					echo true;
				} else {
					echo $errormsg;
				}
			} else {
				echo 'Invalid code';
			}
		} else {
			echo 'You are already in this class!';
		}
	} else {
		echo 'Not signed in';
	}
} else {
	echo 'Enter a code';
}

?>