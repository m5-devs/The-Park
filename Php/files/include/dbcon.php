<?php

//Connect to database and select database
mysql_connect("","","") or die("Couldn't connect to sql server"); //Fill in your own damn credentials
mysql_select_db("thepark") or die("Couldn't select DB");

//Start session
session_start();

//Make user info arrays globally accessible
global $currentuser;
global $sesuser;

//Get id from either session variable or url and set as $currentuser
if (@$_GET['u']) {
    $currentuser = $_GET['u'];
} else if (@$_SESSION['id']) {
    $currentuser = $_SESSION['id'];
}

//Set $sesuser to id of person logged in
$sesuser = @$_SESSION['id'];

//Get current user's row and covert to array
$currentuser = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '$currentuser'"));
//Get logged in user's row and convert to array
$sesuser = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '$sesuser'"));

if (isset($sesuser['id'])) {
    $colorname = $sesuser['color'];
	if ($colorname == 'red') {
		$color = 'F44336';
	} else if ($colorname == 'deeporange') {
		$color = 'FF5722';
	} else if ($colorname == 'orange') {
		$color = 'EF6C00';
	} else if ($colorname == 'amber') {
		$color = 'FFA000';
	} else if ($colorname == 'lightgreen') {
		$color = '689F38';
	} else if ($colorname == 'green') {
		$color = '43A047';
	} else if ($colorname == 'teal') {
		$color = '009688';
	} else if ($colorname == 'cyan') {
		$color = '0097A7';
	} else if ($colorname == 'lightblue') {
		$color = '039BE5';
	} else if ($colorname == 'blue') {
		$color = '1976D2';
	} else if ($colorname == 'indigo') {
		$color = '3F51B5';
	} else if ($colorname == 'deeppurple') {
		$color = '673AB7';
	} else if ($colorname == 'purple') {
		$color = '9C27B0';
	} else if ($colorname == 'pink') {
		$color = 'E91E63';
	} else if ($colorname == 'brown') {
		$color = '795548';
	} else if ($colorname == 'grey') {
		$color = '607D8B';
	}
} else { 
    $color = '009688';
}

$errormsg = "Error occured, please try again later";

require('functions.php');

?>
