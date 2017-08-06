<?php

class db {
	// The database connection
	protected static $connection;

	// Connect to the database 
	// @return bool false on failure / mysqli MySQLi object instance on success
	public function connect() {    
		// Try and connect to the database
		if (!isset(self::$connection)) {
			/*Load configuration as an array. Use the actual location of your configuration file (Ini file isn't working for now)
			$config = parse_ini_file('C:/wamp/www/database/config.ini'); 
			self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);*/
			self::$connection = new mysqli('thepark.db.5969281.hostedresource.com','thepark','OIZtRQmFhopZnGgPOofbLGQbENlVcTk6BOQCNX6PgmaunxRqVO@','thepark');
		}

		// If connection was not successful, handle the error
		if (self::$connection === false) {
			// Handle error by notifiying admin and taking user to error page
			mail('alexwohlbruck@gmail.com','Database connection error','A tried to load a page and the database connection failed');
			header('Location: ../error.php');
			exit();
		}
		return self::$connection;
	}

	// Query the database
	public function query($query) {
		// Connect to the database
		$connection = $this -> connect();

		// Query the database
		$result = $connection -> query($query);

		return $result;
	}

	 // Fetch rows from the database (SELECT query)
	 // @return bool False on failure / array Database rows on success
	public function select($query, $type='assoc') {
		$rows = array();
		$result = $this -> query($query);
		if($result === false) {
			return false;
		}
		if ($type=='assoc') {
			while ($row = $result -> fetch_assoc()) {
				$rows[] = $row;
			}
		} else {
			while ($row = $result -> fetch_array()) {
				$rows[] = $row;
			}
		}
		return $rows;
	}

	 // Fetch the last error from the database
	 // @return string Database error message
	public function error() {
		$connection = $this -> connect();
		return $connection -> error;
	}

	 // Quote and escape value for use in a database query
	public function quote($value) {
		$connection = $this -> connect();
		return "'" . $connection -> real_escape_string($value) . "'";
	}
}

$db = new db();

//Start session
session_start();

//Make user info arrays globally accessible
global $currentuser;
global $sesuser;

//Set $sesuser to id of person logged in
$sesuser = @$_SESSION['id'];

//Get current user's row and covert to array
$currentuser = $db->select("SELECT * FROM users WHERE id = '$currentuser'")[0];
//Get logged in user's row and convert to array
$sesuser = $db->select("SELECT * FROM users WHERE id = '$sesuser'")[0];

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

require_once('functions.php');

?>
