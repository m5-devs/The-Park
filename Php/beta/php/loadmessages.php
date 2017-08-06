<?php
include('../include/dbcon.php');

//Delete old messages
$db->query("DELETE FROM messages WHERE timestamp < (NOW() - INTERVAL 24 HOUR)");

$messages = $db->select("SELECT * FROM messages ORDER BY id ASC");
$time = '';
$id = '';

foreach ($messages as $message) {
	if ($message['userid']==$sesuser['id']) {
		//Load messages that were posted by you

		//Get info for last message in the loop
		$lastid = $message['id']-1;
		$lastmessage = mysqli_fetch_assoc($db->query("SELECT * FROM messages WHERE id = '$lastid'"));

		/*If the last message was not posted in the last minute or a different user sent it than the last,
		start a new message bubble*/
		if (strtotime($message['timestamp'])-strtotime($lastmessage['timestamp']) > 60 || $lastmessage['userid'] != $message['userid']) {
			echo '
			<div class="msgto">
				<span class="msgcontent">
			';
		} 	

		//Insert message text
		echo '
					<span class="string">'.filter($message['message']).'</span>
		';

		//Get info for next message in the loop
		$id = $message['id']+1;
		$nextmessage = mysqli_fetch_assoc($db->query("SELECT * FROM messages WHERE id = $id"));
		$nexttime = strtotime($nextmessage['timestamp']);

		/*If the next message was posted more than 60 seconds after the current one OR there are no more messages,
		end the current mesage bubble*/
		if ($nexttime-strtotime($message['timestamp']) > 60 || !$nexttime || $nextmessage['userid'] != $message['userid']) {
			echo '
				</span>
				<div class="info">
					'.easyTime($message['timestamp']).'
				</div>
				<a href="profile.php?u='.filter($sesuser['id']).'"><img class="avatar" src="'.$sesuser['avatar'].'"></a>
			</div>
			';
		}
		
		//Reset message timestamp for use in next part of loop
		$time = strtotime($message['timestamp']);

	} else {
		//Load messages that weren't posted by you

		//Get information about the user who posted the message
		$userinfo = getInfo((int) $message['userid']);

		//Get info for last message in the loop
		$lastid = $message['id']-1;
		$lastmessage = mysqli_fetch_assoc($db->query("SELECT * FROM messages WHERE id = '$lastid' ORDER BY timestamp"));

		/*If the last message was not posted in the last minute or a different user sent it than the last,
		start a new message bubble*/
		if (strtotime($message['timestamp'])-strtotime($lastmessage['timestamp']) > 60 || $lastmessage['userid'] != $message['userid']) {
			echo '
			<div class="msgfrom">
				<a href="profile.php?u='.filter($userinfo['id']).'"><img class="avatar" src="'.$userinfo['avatar'].'"></a>
				<span class="msgcontent">
			';
		} 	

		//Insert message text
		echo '
					<span class="string">'.filter($message['message']).'</span>
		';

		//Get timestamp for next message in the loop
		$nextid = $message['id']+1;
		$nextmessage = mysqli_fetch_assoc($db->query("SELECT * FROM messages WHERE id = $nextid"));

		/*If:
		The next message was posted more than 60 seconds after the current one,
		there are no more messages,
		next message and current message are posted by different users,
		end the current mesage bubble*/
		if (strtotime($nextmessage['timestamp'])-strtotime($message['timestamp']) > 60 || !$nextmessage['timestamp'] || $nextmessage['userid'] != $message['userid']) {
			echo '
				</span>
				<div class="info">
					'.filter($userinfo['first_name']).' - '.easyTime($message['timestamp']).'
				</div>
			</div>
			';
		}
	}
}

?>