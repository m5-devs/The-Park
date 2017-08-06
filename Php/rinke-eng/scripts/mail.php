<?php

$success = false;
$message = "Whoops! Something went wrong with the server. Come back later.";

$fname = $_POST['fname'];
$lname = $_POST['lname']
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$mailMessage = $_POST['message'];

$to = 'gri@rinke-engineering.de';
$subject = $fname.' '.$lname." sent you an email from Rinke Engineering's home page";

$headers = "From: " . strip_tags($_POST['email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if (strlen($fname) === 0) {
	$message = "Enter your name";
	finish();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Validate email
	$message = "Invalid email";
	finish();
} else if (strlen($mailMessage) === 0) {
	$message = "Enter a message";
	finish();
}
	
if (mail('gri@rinke-engineering.de', $subject, $mailMessage, $headers)) {
	$message = "Message sent!";
	$success = true;
	finish();
} else {
	$message = "Couldn't send message";
	finish();
}


function finish() {
	global $success, $message;
	echo json_encode(array("success"=>$success, "message"=>$message));
	exit();
}

?>