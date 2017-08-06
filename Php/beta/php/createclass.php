<?php

require_once('../include/dbcon.php');

$teacherid = $_SESSION['id'];
$name = $_POST['name'];
$period = $_POST['period'];
if (is_null($_POST['ab'])) { $ab = 'NULL'; } else { $ab = "'".$_POST['ab']."'"; }
$cover = $_POST['cover'];

if (strlen($name) != 0) {
	if (strlen($name) > 5) {
		if (isset($period) and $period) {
			if (strlen($cover) > 0) {
				if ($db->query("INSERT INTO classes VALUES ('','$teacherid','$name','$period',$ab,'$cover')")) {
					$classid = $db->select("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'classes'");
					$classid = ((int) $classid[0]['auto_increment'])-1;
					$code = generateCode();
					$db->query("INSERT INTO classcodes (code, classid) VALUES ('$code','$classid')");
					echo (int) $classid;
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