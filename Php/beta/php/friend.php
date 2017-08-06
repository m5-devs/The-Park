<?php

include ('../include/dbcon.php');

$user_to = $_POST['to'];
$user_from = $_POST['from'];
$type = $_POST['type'];
$userid = $sesuser['id'];

if (checkAccepted($user_to,$user_from)) {
	$accepted = true;
} else {
	$accepted = false;
}

if ($user_to != $user_from) {
	if ($type == 'add') {
		if ($db->select("INSERT INTO friends (user_to, user_from) VALUES ('$user_to','$user_from')")) {
			$db->select("INSERT INTO notifications (userid, type, user_from) VALUES ('$user_to', 'friend_request', '$userid')");
			echo 'Request sent';
		} else {
			echo $errormsg;
		}
	} else {
		if ($db->select("DELETE FROM friends WHERE user_from = '$userid' OR user_to = '$userid'")) {
			if ($accepted == true) {
				echo 'Unfriended';
			} else {
				echo 'Cancelled friend request';
				$db->select("DELETE FROM notifications WHERE userid = '$user_to' AND user_from = '$user_from' AND type = 'friend_request'");
			}
		} else {
			echo $errormsg;
		}
	}
} else {
   echo "You can't friend yourself";
}

?>
