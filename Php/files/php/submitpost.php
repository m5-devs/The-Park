<?php

require_once('../include/dbcon.php');

$userid = $_SESSION['id'];
if (!isset($userid)) { echo 'Sign in to write a post'; exit; }
$type = $_POST['type'];
$message = $_POST['message'];
$ip = $_SERVER['REMOTE_ADDR'];
$iplong = ip2long($ip);

$escapemessage = mysql_real_escape_string($message);
$tofrom = $_POST['tofrom'];
$user_info = getInfo((int) $userid);

if ($type == 'profile') {
	$tofromtype = 'profile_to';
} else if ($type == 'private') {
	$tofromtype = 'private_to';
} else if ($type == 'profile') {
	$tofromtype = 'profile_to';
} else if ($type == 'classroom') {
	$tofromtype = 'classroom_to';
} else if ($type == 'help') {
	$tofromtype = 'category';
} else if ($type == 'reshare') {
	$tofromtype = 'reshare_from';
} else {
	echo 'Please specify the type of posts you want and an id to source them from';
}

if (strlen($message) != 0) {
	if (strlen($message) > 8) {
		mysql_query("INSERT INTO posts (userid, type, message, $tofromtype, ip) VALUES ('$userid','$type','$escapemessage','$tofrom','$iplong')");
		$postid = mysql_insert_id(); //Get id of post submitted

		?>
			<div class="grid-item card post" id="post'.$postid.'">
				<div class="card-content">
					<div>
						<div class="right">
							<i class="material-icons grey-text hover-icon">flag</i>
						</div>
					<a href="profile.php?u=<?=$user_info['id']?>">
						<img src="<?=$user_info['avatar']?>" class="postavatar circle">
							<div class="postname">
							<span class="title black-text"><?=filter($user_info['first_name']).' '.filter($user_info['last_name'])?></span>
					</a>
							<p class="posttimestamp">Just now</p>
						</div>
					</div>
					<div>
						<p id="postcontent"><?=filter($message)?></p>
					</div>
				</div>
				<div class="comments post grey lighten-5">
					<div class="commentscontainer">
					</div>

					<form class="commentform" onsubmit="submitComment(\'4\'); return false;">
						<input type="text" id="commentinput" placeholder="Add a comment...">
					</form>

				</div>
			</div>
		<?php
	} else {
		echo 'short';
	}
} else {
	echo 'empty';
}

?>