<?php

include('../include/dbcon.php');
include('../include/functions.php');

$firstname = ucfirst(strtolower($_POST['firstname'])); //Get firstname
$lastname = ucfirst(strtolower($_POST['lastname'])); //Get lastname
$email = strtolower($_POST['email']); //Get email
$username = rtrim(strtolower($_POST['username'])); //Get username
$password = $_POST['password']; //Get password
$salt = uniqid(mt_rand(), true); //Create random salt
$hash = crypt($password, '$6$rounds=5000$'.$salt.'$'); //Hash password
$code = md5(openssl_random_pseudo_bytes(32)); //Generate email verification code
$covers = array('https://goo.gl/OFZ4L0','https://goo.gl/05ZAtu','https://goo.gl/Zjiqc2','https://goo.gl/3exoHX','https://goo.gl/p9IMj7','https://goo.gl/aINp0a','https://goo.gl/7tPzc5','https://goo.gl/n02BMT','https://goo.gl/1oAcXK','https://goo.gl/2sBgl9','https://goo.gl/wZsMXQ','https://goo.gl/Zqe8Vt','https://goo.gl/hM4HKv','https://goo.gl/fwtC0q','https://goo.gl/NqewQu','https://goo.gl/hJdhq7','https://goo.gl/7Ar60Y','https://goo.gl/2kQBFi','https://goo.gl/CyXCLf','https://goo.gl/c8pyWd','https://goo.gl/4Y4DuZ','https://goo.gl/BtuZd8','https://goo.gl/4K97ZL','https://goo.gl/abWYJg','https://goo.gl/xuuBfL','https://goo.gl/7v4D5L','http://goo.gl/g0zjZT','http://goo.gl/pns3DJ','http://i.imgur.com/YHtgbPE.jpg','http://i.imgur.com/9sFnXQS.jpg','http://i.imgur.com/bpy0dhK.jpg','http://i.imgur.com/bX8bdAA.jpg','http://i.imgur.com/yLdKGdO.jpg','http://i.imgur.com/XhN4il1.jpg','http://i.imgur.com/S7HKnnR.jpg','http://i.imgur.com/87wD3yV.jpg','http://i.imgur.com/0pZOZR5.jpg');
$cover = $covers[array_rand($covers, 1)]; //Generate random cover photo for user using the ^above^ links 

//SQL to insert new user into database
$insertsql = "INSERT INTO users (username, first_name, last_name, email, password, salt, cover) VALUES ('$username','$firstname','$lastname','$email','$hash','$salt','$cover')";

//Check database for existing information
$checkusername = count($db->select("SELECT * FROM users WHERE username = '$username'"));
$checkemail = count($db->select("SELECT * FROM users WHERE email = '$email'"));

//Validate information
if (strlen($firstname) != 0) { //Check empty field
	if (strlen($lastname) != 0) { //Check empty field
		if (ctype_alpha($firstname)) {  //Only allow letters in first name
			if (ctype_alpha($lastname)) { //Only allow letters in last name
				if (strlen($email) != 0) { //Check empty field
					if ($checkusername == 0) { //Check if username exists
						if (ctype_alnum($username)) { //Check for unwanted characters in username
							if ($checkemail == 0) { //Check if email exists
								if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //Validate email
									if (strlen($username) != 0) { //Check empty field
										if (strlen($username) > 3 ) { //Username has to be 4+ chars
											if (strlen($password) != 0) { //Check empty field
												if (strlen($password) > 7) { //Password has to be 8+ chars
													//if (!strpos($password, $username)) {
														if ($db->query($insertsql)) { //Create user
															$id = getInfo($username, 'id'); //Get id of user
															if ($db->query("INSERT INTO verify (id, code) VALUES ('$id','$code')")) { //Create verification row
																echo json_encode(array("msg" => "Check your email to verify your account", "close" => "true"));

																//Send email
		$message = 'To finish creating your account for The Park, click on the link below:

http://thepark.site/verifyaccount.php?id='.$id.'&code='.$code.'';
				mail($email, 'Activate your account', $message, 'From: <ThePark@p3nlhg982.shr.prod.phx3.secureserver.net>'
																);
																//Send email to ourselves notifying of new user
																$newuser = $firstname.' '.$lastname.' has joined the park. Username: '.$username.', Email: '.$email;
																mail('kasimirkhschulz@gmail.com','New user on The Park',$newuser);
																mail('alexwohlbruck@gmail.com','New user on The Park',$newuser);
															}
														} else {
															echo json_encode(array("msg" => "Failed to create account, try again later", "close" => "false"));
														}
													//} else {
														//echo 'Password cannot contain your username';		
													//}
												} else {
													echo json_encode(array("msg" => "Password must be at least 8 characters", "close" => "false"));
												}
											} else {
												echo json_encode(array("msg" => "Enter a password", "close" => "false"));
											}
										} else {
											echo json_encode(array("msg" => "Username must be at least 4 characters", "close" => "false"));
										}
									} else {
										echo json_encode(array("msg" => "Enter a username", "close" => "false"));
									}
								} else {
									echo json_encode(array("msg" => "Invalid email adress", "close" => "false"));
								}
							} else {
								echo json_encode(array("msg" => "This email has already been used", "close" => "false"));
							}
						} else {
							echo json_encode(array("msg" => "Username can only contain letters and numbers", "close" => "false"));
						}
					} else {
						echo json_encode(array("msg" => "This username is already being used", "close" => "false"));
					}
				} else {
					echo json_encode(array("msg" => "Enter an email", "close" => "false"));
				}
			} else {
				echo json_encode(array("msg" => "Your name can only contain letters", "close" => "false"));
			}
		} else {
			echo json_encode(array("msg" => "Your name can only contain letters", "close" => "false"));
		}
	} else {
		echo json_encode(array("msg" => "Enter a last name", "close" => "false"));
	}
} else {
	echo json_encode(array("msg" => "Enter a first name", "close" => "false"));
}

?>
