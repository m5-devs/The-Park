<?php

include('../include/dbcon.php');

$colorchoice = $_POST['color'];
$censor = $_POST['censor'];
$password = $_POST['password'];
$userid = $_SESSION['id'];
$oldpass = $_POST['old'];
$newpass = $_POST['new'];
$confirmpass = $_POST['confirm'];
$avatar = $_POST['avatar'];
$cover = $_POST['cover'];
$theme = $_POST['theme'];

if (isset($colorchoice)) {
	$db->select("UPDATE users SET color = '$colorchoice' WHERE id = '$userid'");
}
if (isset($censor)) {
	if ($censor == 'false') {
		$censorval = '0';
	} else {
		$censorval = '1';
	}
	$db->select("UPDATE users SET filter = '$censorval' WHERE id = '$userid'");
	echo $censorval;
}
if (isset($password)) {
	if (strlen($password) > 0) {
		if (verifyPass($sesuser['username'], $password)) {
			//Proceed to delete account
			$id = $sesuser['id'];
			$db->select("DELETE FROM users WHERE id = '$id'");
			mail($sesuser['email'],'Account Deleted',"Your account on The Park has been deleted. We're sorry to see you go!");
		} else {
			echo 'wrong';
		}
	} else {
		echo 'empty';
	}
}
if (isset($oldpass) && isset($newpass) && isset($confirmpass)) {
	if (verifyPass($sesuser['username'],$oldpass)) {
		if ($newpass == $confirmpass) {
			if ($newpass != $oldpass) {
				if (strlen($newpass) > 7) {
					$userid = $sesuser['id'];
					$salt = uniqid(mt_rand(), true); //Create random salt
					$hash = crypt($newpass, '$6$rounds=5000$'.$salt.'$'); //Hash password
					if ($db->select("UPDATE users SET password = '$hash', salt = '$salt' WHERE id = '$userid'")) {
						echo 'changed';
					} else {
						echo 'Error occured, try again later';
					}
				} else {
					echo 'New password is too short';
				}
			} else {
				echo 'New password is the same as old one';
			}
		} else {
			echo 'New passwords do not match';
		}
	} else {
		echo 'Incorrect Password';
	}
}

if (isset($theme)) {
	if ($theme == 'false') {
		$themeval = 'light';
	} else {
		$themeval = 'dark';
	}
	
	if (!$db->select("UPDATE users SET theme = '$themeval' WHERE id = '$userid'")) {
		echo 'fail';
	}
}


//Temporary settings
//Avatar and cover photo
if (strlen($avatar) > 0) { $db->select("UPDATE users SET avatar = '$avatar' WHERE id = '$userid'"); }
if (strlen($cover) > 0) { $db->select("UPDATE users SET cover = '$cover' WHERE id = '$userid'"); }

?>