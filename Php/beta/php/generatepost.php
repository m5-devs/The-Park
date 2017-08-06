<?php

require_once("../include/dbcon.php");

if(!isset($postids)) { $postids = $_GET['postids']; } //Get request for post ids
$postids = "'".implode("','",$postids)."'"; //Create comma separated list
$posts = $db->select("SELECT * FROM posts WHERE id in ($postids)"); //Get info about posts

if (count($posts) == 0) {
	exit(); //Stop script if not signed in or there are no posts
}

//Loop through array
foreach ($posts as $post) {
	$postuserid = $post['userid']; //Get poster's user id
	$userinfo = getInfo((int) $postuserid); //Get user info from id
	$userid = $_SESSION['id']; //Get signed in user's id
	$postid = $post['id']; //Get post id
	$commentsql = $db->select("SELECT * FROM (SELECT * FROM comments WHERE post_id = '$postid' ORDER BY timestamp DESC LIMIT 4) g ORDER BY g.timestamp ASC"); //Get comments
	$likedquery = $db->select("SELECT * FROM likes WHERE postid = '$postid' AND userid = '$userid'"); //Get likes
	if (isset($likedquery[0]['type'])) {
		if (isset($likedquery[0]['type'])) {
			$like = 'true'; //Upvote
		} else {
			$like = 'down'; //Downvote
		}
	} else {
		$like = 'false'; //Null
	}
	?>

	<div class="grid-item card post" data-id="<?php echo $post['id'];?>">
		<div class="card-content">
			<div>
				<div class="right">
					<span class="activator" style="cursor: pointer;"><i class="material-icons right">more_vert</i></span>
				</div>
			<a href="profile.php?u=<?php echo $userinfo['id'];?>">
				<img src="<?php echo $userinfo['avatar'];?>" class="postavatar circle">
				<div class="postinfo">
					<span class="postname"><?php echo filter($userinfo['first_name']).' '.filter($userinfo['last_name']);?></span>
			</a>
					<p class="posttimestamp"><?php echo date('M j',strtotime($post['timestamp']));?></p>
				</div>
			</div>
			<div>
				<p id="postcontent"><?php echo filter($post['message']);?></p>
			</div>
			<div class="postactions">
				<span class="like" data-postid="<?php echo $postid;?>" data-liked="<?php echo $like;?>">
					<i class="material-icons like-filled">favorite</i>
					<i class="material-icons like-outline">favorite_border</i>
					<?php
						//Get likes
						$likesquery = $db->select("SELECT * FROM likes WHERE postid= '$postid'");
						$likes = count($likesquery);
					?>
					<span id="post-likes" style="position: relative; bottom: 7px; right: 8px;">
						<?=$likes?>
					</span>
				</span>
				<i class="material-icons" style="transform: scale(-1, 1);">reply</i>
			</div>
		</div>

		<div class="card-reveal theme-1">
			<span class="card-title"><i class="material-icons right">close</i></span>
			<ul>
				<?php if ($userinfo['id']==$sesuser['id']) { ?>
					<li><i class="material-icons">edit</i>Edit post</li>
					<li><i class="material-icons">delete</i>Delete post</li>
				<?php } else { ?>
					<li><i class="material-icons">flag</i>Report abuse</li>
				<?php } ?>
				<br/>
				<li>(Btw these options don't work yet)</li>
			</ul>
		</div>

		<div class="comments post theme-dark-2">
			<div class="commentscontainer">
				<i class="material-icons loadcomments" data-open="false" style="<?php if(count($commentsql)<=2){echo'display:none;';}?>">keyboard_arpost_down</i>

				<?php //Create comments
				foreach($commentsql as $commentinfo) {
					$userinfo = getInfo((int) $commentinfo['userid']);?>
					<li class="comment">
						<a href="profile.php?u=<?php echo $userinfo['id'];?>" class="commentavatar" title="<?php echo filter($userinfo['username']);?>"><img src="<?php echo $userinfo['avatar'];?>"/>    
						<p class="commentname"><b><?php echo filter($userinfo['first_name']).' '.filter($userinfo['last_name']);?> -</b></a><span><?php echo filter($commentinfo['comment']);?></span></p>
					</li>
				<?php
				}

				//Comment input box 
				 ?></div><?php

			if (isset($sesuser['id'])) { ?>

			<form class="commentform" class="comment" onsubmit="submitComment('<?php echo $post['id'];?>'); return false;">
				<input type="text" id="commentinput" placeholder="Add a comment..."></input>
			</form>
			<?php } ?>
		</div>
	</div>
<?php } ?>

