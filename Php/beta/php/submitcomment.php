<?php

include('../include/dbcon.php');
$postid = $_POST['post'];
$userid = $sesuser['id'];
$comment = $_POST['comment'];

$escapecomment = mysqli_real_escape_string($comment);
$postinfo = mysqli_fetch_assoc($db->select("SELECT * FROM posts WHERE id = '$postid'")); //Get info about post
$postuserid = $postinfo['userid'];
$user_info = getInfo((int) $userid); //Get info about user who submitted comment

if (strlen($comment) == 0) {
	echo 'short';
} else {
	if ($db->select("INSERT INTO comments (post_id, userid, comment) VALUES ('$postid','$userid','$escapecomment')")) {
		echo '
			<div class="comment" style="margin: 8px 0px;">
				<a href="profile.php?u='.$user_info['id'].'" title="'.filter($user_info['username']).'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.htmlspecialchars($user_info['avatar']).'" style="width: 30px; height: 30px; border-radius: 50%;"/>    
				<p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.filter($user_info['first_name']).' '.filter($user_info['last_name']).' </b></a><span id="cmtstring">'.filter($comment).'</span></p>
			</div>
		';
		//Send notification to user
		if ($postuserid != $_SESSION['id']) {
			$db->select("INSERT INTO notifications (userid, type, user_from, id_from) VALUES ('$postuserid','comment','$userid','$postid')");
		}
	} else {
		echo 'fail';
	}
}

?>