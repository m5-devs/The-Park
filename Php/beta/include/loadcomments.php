<?php
    include('../include/dbcon.php');
    $postid = $_POST['id'];
    $commentsql = $db->select("SELECT * FROM comments WHERE post_id = '$postid' ORDER BY timestamp");

    while ($commentinfo = mysqli_fetch_assoc($commentsql)) {
		getInfo((int) $commentinfo['userid']);
		echo '
			<div class="comment" style="margin: 8px 0px; display: block;">
				<a href="profile.php?u='.$user_info['id'].'" title="'.filter($user_info['username']).'"style="color: #000; text-transform: none; margin: 0px 3px 0px 0px;"><img src="'.filter($user_info['avatar']).'" style="width: 30px; height: 30px; border-radius: 50%;"/>    
				<p style="position: relative; bottom: 10px; left: 7px; display: inline;"><b>'.filter($user_info['first_name']).' '.filter($user_info['last_name']).' </b></a><span id="cmtstring">'.filter($commentinfo['comment']).'</span></p>
			</div>
		';
	}
?>