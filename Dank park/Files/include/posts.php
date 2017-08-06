<?php
include('dbcon.php');

//From ajax request
$type = $_POST['type'];
$tofrom = $_POST['tofrom'];
$requestid = $_POST['id'];
$hashtag = $_POST['hashtag'];
$query = $_POST['query'];

//Generate message for new post box
if ($type == 'profile') {
	$newpostmessage = 'Write on ';
	if ($tofrom==$sesuser['id']) {
		$newpostmessage = $newpostmessage.'your';
	} else {
		$string = getInfo((int) $tofrom, 'first_name');
		$newpostmessage = $newpostmessage.$string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');
	}
	$newpostmessage = $newpostmessage.' profile';
} else if ($type == 'help') {
	$newpostmessage = 'Ask for help';
} else if ($type == 'classroom') {
	$newpostmessage = 'Post to this class';
}
$newpostmessage = $newpostmessage.'...';

?>
<style>

	.grid {
		width: 100%;
	}

	/* clearfix */
	.grid:after {
		content: '';
		display: block;
		clear: both;
	}

	.grid-item {
		float: left;
		transition: .3s ease-in-out all;
		/* vertical gutter */
		margin-bottom: 10px;
	}

	.grid-sizer,
	.grid-item { width: 48.5%; }

	@media ( max-width: 900px ) {
		.grid-item {
			width: 100%;
		}
	}

	@media ( max-width: 700px ) {
		.main {
			width: 100%;
		}
		#tabcontainer {
			padding: 5px 0px;
		}
		#profileavatar {
			width: 100px;
		}
		#coverphoto {
			height: 320px;
		}
		#name { font-size: 22pt; }
	}
	
	textarea {
		transition: .2s ease-in-out all;
		-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.1);
		   -moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.1);
				box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.1);
	} /* Write post box inactive */
	
	textarea:focus { 
		outline: none !important;
		-webkit-box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.2);
		   -moz-box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.2);
				box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.2);
	} /* Write post box active */

	#posttextarea {
		<?php if($sesuser['theme']=='light'):?> border: solid 1px #E0E0E0;
		<?php else:?> border: solid 1px #313131;
		<?php endif;?>
		border-radius: 4px;
		resize: none;
		background: #<?php if($sesuser['theme']=='dark'){echo'4c4c4c';}else{echo'fff';} ?>;
		height: 87px;
	}
	
	#submitpostbtn {
		height: 24px;
		line-height: 0px;
		padding: 0px;
	}
	#submitpostbtn:focus { background: rgba(0,0,0,0) }
	
	.postavatar { width: 50px; }
	
	.postinfo {
		display: inline-block;
		position: relative;
		bottom: 4px;
		left: 11px;
		overflow: visible;
	}
	.postinfo .postname {
		font-weight: 500;
	}
	
	.posttimestamp {
		position: relative;
		bottom: 5px;
	}

	#postcontent {
		line-height: 2rem;
	}
	
	.postactions .material-icons {
		cursor: pointer;
		margin: 12px 10px 0px 0px;
		-moz-user-select: none; -webkit-user-select: none; -ms-user-select: none;
	}
	
	.attatchments {
		margin: 0px 7px;
		opacity: .6;
	}
	
	.like { cursor: pointer; }
	
	[data-liked=false] .like-filled {
		opacity: 0;
		transform: scale(0,0);
	}
	
	[data-liked=false] .like-outline {
		opacity: 1;
		transform: scale(1,1);
	}
	
	[data-liked=true] .like-filled {
		opacity: 1;
		transform: scale(1,1);
	}
	
	[data-liked=true] .like-outline {
		opacity: 0;
		transform: scale(0,0);
	}
	
	.like-filled, .like-outline {
		-webkit-transition: all 300ms cubic-bezier(0.175, 0.2, .3, 1.5); 
		   -moz-transition: all 300ms cubic-bezier(0.175, 0.2, .3, 1.5); 
			 -o-transition: all 300ms cubic-bezier(0.175, 0.2, .3, 1.5); 
				transition: all 300ms cubic-bezier(0.175, 0.2, .3, 1.5);
	}

	.like-filled {
		cursor: pointer;
		position: absolute;
		opacity: 0;
		transform: scale(0, 0);
		color: #E91E63;
	}
	
	.post.comments { padding: 15px 20px; }
	
	.loadcomments {
		transition: .3s ease-in-out all;
		position: absolute;
		right: 10px;
		margin-top: 3px;
		cursor: pointer;
	}
	
	.commentscontainer {
		max-height: 300px;
		overflow: scroll;
	}
	
	.comment {
		margin: 8px 0px;
		list-style-type: none;
	}

	.comment:nth-last-of-type(n+3) {
		display: none;
	}
	
	.commentname {
		position: relative;
		bottom: 10px;
		left: 7px;
		display: inline;
	}
	
	.commentavatar {
		color: #000;
		text-transform: none;
		margin: 0px 3px 0px 0px;
	}
	
	.commentavatar img {
		width: 30px;
		height: 30px;
		border-radius: 50%;
	}
	
	.commentform {
		margin: 0 auto;
	}
	
	#commentinput {
		display: block;
		border-radius: 2px;
		width: 100%;
		height: 20px;
		margin-top: 2px;
		font-size: 10pt;
		resize: none;
		box-sizing: border-box;
		padding: 16px;
		<?php if($sesuser['theme']=='light'):?> border: solid 1px #E0E0E0;
		<?php else:?> border: solid 1px #313131;
		<?php endif;?>
		background: #<?php if($sesuser['theme']=='dark'){echo'4c4c4c';}else{echo'fff';} ?>;
	}
	#commentinput:focus { box-shadow: none; }
</style>

<div class="masonry-container">
<div class="grid">
	<div class="grid-sizer"></div>

	<?php if ($type != 'all' && isset($_SESSION['id'])) { ?>
	<!-- Write post card -->
	<div class="grid-item card theme-4">
		<form id="submitpost" style="margin-bottom: 0px;">
			<div class="card-content" id="newpost">            
				<textarea id="posttextarea" placeholder="<?php /*Placeholder message*/ echo $newpostmessage; ?>" style="padding: 8px;"></textarea>
			</div>
			<div class="card-action">
				<button id="submitpostbtn" type="submit" class="accent-text btn-flat">Post</button>
				<div class="right">
					<i class="material-icons attatchments">insert_photo</i>
					<i class="material-icons attatchments">link</i>
					<i class="material-icons attatchments">movie</i>
					<i class="material-icons attatchments">event</i>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>
	
	<div id="postscontainer">
		
	<?php
		//Create mysql query to get posts
		$addition = '';
		if (isset($requestid)){ $addition = $addition."AND id = '".$requestid."' "; } else if (isset($hashtag)){ $addition = "AND message LIKE '%#$hashtag%'"; } else { $addition = ''; }
		if (isset($query)) { $addition = $addition."AND message LIKE '%".$query."%'"; }

		if ($type == 'all') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type != 'private' AND type != 'help' $addition ORDER BY timestamp DESC");
		} else if ($type == 'profile') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type = '$type' AND profile_to = '$tofrom' $addition AND profile_to = '$tofrom' ORDER BY timestamp DESC") or die (mysql_error());
		} else if ($type == 'private') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type = '$type' AND private_to = '$tofrom' $addition ORDER BY timestamp DESC") or die (mysql_error());
		} else if ($type == 'profile') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type = '$type' AND profile_to = '$tofrom' $addition ORDER BY timestamp DESC") or die (mysql_error());
		} else if ($type == 'classroom') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type = '$type' AND classroom_to = '$tofrom' $addition ORDER BY timestamp DESC") or die (mysql_error());
		} else if ($type == 'help') {
				if ($tofrom == 'All') {
				//All help requests
				$getposts = mysql_query("SELECT * FROM posts WHERE type = 'help' $addition ORDER BY id DESC") or die (mysql_error());
			} else {
				//Specific category
				$getposts = mysql_query("SELECT * FROM posts WHERE type = 'help' AND category = '$tofrom' $addition ORDER BY timestamp DESC") or die (mysql_error());
			}
		} else if ($type == 'reshare') {
			$getposts = mysql_query("SELECT * FROM posts WHERE type = '$type' AND reshare_from = '$tofrom' $addition ORDER BY timestamp DESC") or die (mysql_error());
		} else {
			echo 'Please specify the type of posts you want and an id to source them from';
		}

		//Echo posts
		while ($row = mysql_fetch_assoc($getposts)) {
			$userid = $_SESSION['id'];
			$postuserid = $row['userid'];
			$userinfo = getInfo((int) $postuserid);
			$postid = $row['id'];
			$commentsql = mysql_query("SELECT * FROM (SELECT * FROM comments WHERE post_id = '$postid' ORDER BY timestamp DESC LIMIT 4) g ORDER BY g.timestamp ASC");
			$likedquery = mysql_fetch_assoc(mysql_query("SELECT * FROM likes WHERE postid = '$postid' AND userid = '$userid'"));
			if (isset($likedquery['type'])) {
				if (isset($likedquery['type'])) {
					$like = 'true';
				} else {
					$like = 'down';
				}
			} else {
				$like = 'false';
			}
			
			//Create posts
			?>
			<div class="grid-item card post" data-id="<?php echo $row['id'];?>">
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
							<p class="posttimestamp"><?php echo date('M j',strtotime($row['timestamp']));?></p>
						</div>
					</div>
					<div>
						<p id="postcontent"><?php echo filter($row['message']);?></p>
					</div>
					<div class="postactions">
						<span class="like" data-postid="<?php echo $postid;?>" data-liked="<?php echo $like;?>">
							<i class="material-icons like-filled">favorite</i>
							<i class="material-icons like-outline">favorite_border</i>
							<?php
								//Get likes
								$likesquery = mysql_query("SELECT * FROM likes WHERE postid= '$postid' ");
								$likes = mysql_num_rows($likesquery);
							?>
							<span id="post-likes" style="position: relative; bottom: 7px; right: 8px;">
								<?php echo $likes; ?>
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
						<i class="material-icons loadcomments" data-open="false" style="<?php if(mysql_num_rows($commentsql)<=2){echo'display:none;';}?>">keyboard_arrow_down</i>
						
						<?php //Create comments
						while ($commentinfo = mysql_fetch_assoc($commentsql)) {
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
					
					<form class="commentform" class="comment" onsubmit="submitComment('<?php echo $row['id'];?>'); return false;">
						<input type="text" id="commentinput" placeholder="Add a comment..."></input>
					</form>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script>

	var postid;
	
	$('.loadcomments').click(function() {
		var $this = $(this);
		if ($this.data('open') == false) {
			//Load all comments
			var $post = $(this).parent().parent(), // Find post
				postid = $post.attr('data-id'); //Get id of post
			
			$.post('php/loadcomments.php', {id: postid}, function(data) {
				$($post.find('.commentscontainer')).html(data);
				loadMsnry();
			});
			
			//Collapse/decollapse comments
			$(this).css({'transform':'rotate(180deg)'});
			$(this).parent().find('.comment').show();
			
			//Scroll to bottom of comments list
			var container = $(this).parent().find('.commentscontainer');
			container.scrollTop(container.height());
			$this.data('open') = true;
		} else {
			$(this).css({'transform':'rotate(0deg)'});
			$this.data('open') = false;
		}
		loadMsnry();
	})
	
	$('#submitpost').submit(function() {
		var input = $('#posttextarea'),
			message = input.val();
			
		$.post('../php/submitpost.php',{
			type: '<?php echo $type;?>',
			tofrom: '<?php echo $tofrom;?>',
			message: message
		}, function(data) {
			if (data == 'empty') {
				Materialize.toast('Post is empty', 5000);
			} else if (data == 'short') {
				Materialize.toast('Post is too short', 5000);
			} else {
				$('#postscontainer').prepend(data);
				input.val('');
				$('.grid').masonry('reloadItems');
				$('.grid').masonry('layout');
			}
		});
		
		return false;
	});

	function submitComment(number) {
		var post = $('.post[data-id="'+number+'"]'),
			input = post.find('#commentinput'),
			cmtcontainer = post.find('.commentscontainer'),
			comment = input.val(),
			postnumber = number; //Can't pass parameter directly into post request
		
        $.post('../php/submitcomment.php', {
			post: postnumber,
			comment: comment
		}, function(data) {
            if (data == 'fail') {
				Materialize.toast('Error occured, try again later', 5000);
			} else if (data == 'short') {
				Materialize.toast('Enter a comment', 5000);
			} else {
				input.val('');
				$(data)
					.hide()
					.appendTo(cmtcontainer)
					.slideDown(120, function(){ 
						loadMsnry();
					});
			}
        });
		//Show more comments button if there are enough
		var count = $('.post[data-id="'+number+'"] .comment').length;
		if (count >= 2) {
			$('.post[data-id="'+number+'"]').find('.loadcomments').css({'display':'block'});
		}
        return false;
    };
	
	$('.like').click(function() {
		var $post = $(this);
		var action,
			bool = $post.data('liked'),
			postid = $post.attr('data-postid'),
			$likes = $post.find('#post-likes'),
			likes = parseInt($likes.text());
			//$likes.data('count') = likes;
		if (bool) { action = 'revoke'; $likes.text(likes-1); } else { action = 'like'; $likes.text(likes+1); }
		$post.attr('data-liked', !bool); //Change css
		//Ajax request
		$.post('/php/like.php', { postid: postid, action: action }, function(data) {
			$post.data('liked', !bool);
			Materialize.toast(data, 5000); //Error
		});
	});

</script>