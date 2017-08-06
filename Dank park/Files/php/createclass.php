<?php

require_once('../include/dbcon.php');

$teacherid = $_SESSION['id'];
$name = $_POST['name'];
$period = $_POST['period'];
if (!isset($ab) and $ab) { $ab = "'".$_POST['ab']."'"; } else { $ab = 'NULL'; }
$cover = $_POST['cover'];

if (strlen($name) != 0) {
	if (strlen($name) > 5) {
		if (isset($period) and $period) {
			if (strlen($cover) > 0) {
				if (mysql_query("INSERT INTO classes VALUES ('','$teacherid','$name','$period',$ab,'$cover')")) {
					$classid = mysql_insert_id();
					$code = generateCode();
					mysql_query("INSERT INTO classcodes (code, classid) VALUES ('$code','$classid')");
					echo $classid;
				} else {
					echo $errormsg;
				}
			} else {
				echo 'Choose a cover photo for your class';
			}
		} else {
			echo 'Choose a period for your class';
		}
	} else {
		echo 'Class name is too short';
	}
} else {
	echo 'Enter a name for your class';
}

?>