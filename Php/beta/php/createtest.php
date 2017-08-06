<?php

require_once('../include/dbcon.php');

//Response variables
$success = false;
$message = $errormsg;
$testid = null;

//Boot user if not allowed to create tests
$acceptedPermissions = array('2','4');
if (!isset($_SESSION['id']) or !in_array($sesuser['privilege'], $acceptedPermissions)) {
	$success = false;
	$message = "You don't have permission to create a test";
	finish();
}

//Store info as variables
$creatorid = $_SESSION['id'];
$data = $_POST['data'];
$testName = $db->quote($data['test-name']);
$randomize = checkboxToBool($data['randomize']);
$textSelect = checkboxToBool($data['text-select']);
$copyPaste = checkboxToBool($data['copy-paste']);
$lockTest = checkboxToBool($data['lock-test']);
$classes = $data['classes'];

//Run query
if ($db->query("INSERT INTO tests VALUES ('','$creatorid',$testName,'$randomize','$textSelect','$copyPaste','$lockTest')")) {
	$success = true;
	$message = 'Test created';
	$auto_increment = $db->select("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'tests'");
	$testid = ((int) $auto_increment[0]["auto_increment"]) - 1;
	$csClasses = array();

	//Create comma separated list that is ready for sql query
	foreach ($classes as $classid) {
		//Check numeric id
		if (is_numeric($classid)) {
			//Check ownership of classroom
			$idCheck = $db->select("SELECT teacherid FROM classes WHERE id = '$classid'");
			if ((int) $idCheck[0]['teacherid'] == (int) $_SESSION['id']) {
				//Add to array
				array_push($csClasses, "(".$testid.",".$classid.")");
			}
		}
	}
	$csClasses = implode(",", $csClasses);

	//Add test to class
	if (!$db->query("INSERT INTO testshare (testid, classid) VALUES $csClasses")) {
		$plural = '';
		if (count($classes) > 1) { $plural = 's'; }
		$message .= " but we couldn't add it to your classroom".$plural;
	}
} else {
	$success = false;
	$message = 'Database query failed';
}

finish();

//Create JSON and exit script
function finish() {
	global $success, $message, $testid;
	echo json_encode(array("success"=>$success, "message"=>$message, "testid"=>$testid));
	exit();
}

//Convert "on" to true and null to false
function checkboxToBool($value) {
	if ($value == 'on') {
		return 1;
	} else {
		return 0;
	}
}

?>