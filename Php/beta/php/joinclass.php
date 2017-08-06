<?php

require('../include/dbcon.php');
$studentid = $sesuser['id'];
$code = $_POST['code'];
$codeinfo = $db->select("SELECT * FROM classcodes WHERE code = '$code'");
$classid = $codeinfo[0]['classid'];
$studentinfo = $db->select("SELECT * FROM students WHERE studentid = '$studentid' AND classid = '$classid'");

if (strlen($code) != 0) { 
	if (isset($_SESSION['id'])) {
		if (count($studentinfo[0]) == 0) {
			if (count($codeinfo) != 0) {
				if ($db->query("INSERT INTO students (studentid, classid) VALUES ('$studentid','$classid')")) {
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