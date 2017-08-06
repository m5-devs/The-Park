<?php

//Selects all of user's friends
$userid = $currentuser['id'];
$friends = $db->select("SELECT user_from FROM friends WHERE user_to = '$userid' UNION SELECT user_to FROM friends WHERE user_from = '$userid' LIMIT 10");
$friendId = '';

//Create frienders avatars
foreach ($friends as $friend) {
	//Get friend's info from users table and store as array
	$friendId = $friend['user_from'];
	$friendInfo = $db->select("SELECT id, username, first_name, last_name, avatar FROM users WHERE id = '$friendId'");
	$friendInfo = $friendInfo[0];

	//Check if the friend request has been confirmed
	$accepted = $db->select("SELECT accepted FROM friends WHERE user_from = '$friendId' AND user_to = '$userid' OR user_to = '$friendId' AND user_from = '$userid'");
	//Create boolean value for accepted or not accepted
	$accepted = (bool) $accepted['accepted'];


	if ($accepted==true) { ?>
		<a href="profile.php?u=<?php echo $friendInfo['id'];?>">
			<img src="<?php echo $friendInfo['avatar'];?>"
				 style="width: 50px; margin: 0px 4px;"
				 class="tooltipped z-depth-1 avatar-circle"
				 data-position="bottom" data-delay="50" data-tooltip="<?php echo $friendInfo['first_name'].' '.$friendInfo['last_name'];?>"/>
		</a>
	<?php }
}
?>