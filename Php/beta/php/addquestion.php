<?php

require_once('../include/dbcon.php');

//Response variables
$questionSuccess = false;
$choicesSuccess = false;
$success = false;
$message = $errormsg;

//Only let teachers and admins make tests
// if (!isset($_SESSION['id'])) { header('Location: index.php'); exit(); }
// if (!$sesuser['privilege'] == '2' or $sesuser['privilege'] == '4') { header('Location: index.php'); exit(); }/////////////////////////////////// Still need to validate users

//Get user data
$data = $_POST['data'];
$testid = (int) $data['testid'];
$question = $db->quote($data['question']);
$points = (int) $data['points'];

//Boot user if they aren't the owner of the test that they are adding a question to
$verify = $db->select("SELECT creatorid FROM tests WHERE id = '$testid'");
if (count($verify) == 0) {
	$message = "The test you are attempting to modify doesn't exist";
	finish();
}
$verifyCreator = (int) $verify[0]['creatorid'];
if ($verifyCreator != (int) $_SESSION['id']) {
	$message = "You aren't the owner of the test that you are attempting to modify";
	finish();
}

if (strlen($question) == 0) {
	$message = "Enter a question";
	finish();
}

//Create question in database
if ($db->query("INSERT INTO testquestions (testid, question, points) VALUES ('$testid', $question, '$points')")) {
	//Get id of question that was just inserted
	$auto_increment = $db->select("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'testquestions'");
	$questionid = ((int) $auto_increment[0]["auto_increment"]) - 1;

	//Update response variables
	$questionSuccess = true;
	$message = "Question added";

	//Create array of answers
	$csAnswers = array();
	foreach ($data['answers'] as $answer) {
		if (trim($answer['value']) == '') {
			$message = "One or more answer choices are blank";
			finish();
		}
		$csAnswer = "(".implode(",", array($questionid, $db->quote($answer["value"]),$db->quote($answer["correct"]))).")";
		array_push($csAnswers, $csAnswer);
	}
	//Create comma separated values string that is ready for sql query
	$csAnswers = implode(",", $csAnswers);

	//Insert choices in database
	if ($db->query("INSERT INTO testchoices (questionid, value, correct) VALUES $csAnswers")) {
		$choicesSuccess = true;
	} else {
		$choicesSuccess = false;
		$message .= " but couldn't add answer choices";
	}
} else {
	$questionSuccess = false;
	$message = "Database query failed, couldn't add quesiton";
}

finish();

function finish() {
	global $success, $message, $questionSuccess, $choicesSuccess;
	if ($questionSuccess == true and $choicesSuccess == true) {
		$success = true;
	}
	echo json_encode(array("success"=>$success, "message"=>$message));
	exit();
};

?>