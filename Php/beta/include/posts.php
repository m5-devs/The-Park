<?php
include('dbcon.php');

//From ajax request
$type = strtolower($_POST['type']);
$tofrom = strtolower($_POST['tofrom']);
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

<?php echo '<style>'; include_once('../css/posts.css'); echo '</style>'; //Posts css (a link tag will apply css after html loads :/ ) ?>

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
					<?php /*
					<i class="material-icons attatchments">insert_photo</i>
					<i class="material-icons attatchments">link</i>
					<i class="material-icons attatchments">movie</i>
					<i class="material-icons attatchments">event</i>
					*/ ?>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>
	
	<div id="postscontainer">
		
	<?php
		//Create mysql query to get posts
		$typequery = "= '".$type."'";
		$andquery = '';
		$addition = '';
		$andquery2 = '';

		if (isset($requestid)){ $addition = $addition."AND id = '".$requestid."' "; } else if (isset($hashtag)){ $addition = "AND message LIKE '%#$hashtag%'"; } else { $addition = ''; }
		if (isset($query)) { $addition = $addition."AND message LIKE '%".$query."%'"; }
		
		switch ($type) {
			case 'all':
				$typequery = "!= 'private'";
				$andquery = "AND type != 'help'";
				break;
			case 'profile':
				$andquery = "AND profile_to = '$tofrom'";
				break;
			case 'private':
				$andquery = "AND profile_to = '$tofrom'";
				break;
			case 'classroom':
				$andquery = "AND classroom_to = '$tofrom'";
				break;
			case 'help':
				if ($tofrom != 'all') {
					//Specific category
					$andquery = "AND category = '$tofrom'";
				}
				break;
			case 'reshare':
				$andquery = "AND reshare_from = '$tofrom'";
				break;
			default:
				$message = "Please specify the type of posts you want and an id to source them from";
		}

		$query = "SELECT id FROM posts WHERE type $typequery $andquery $addition $andquery2 ORDER BY timestamp DESC";
		$getposts = $db->select($query);

		//Echo posts
		if (count($getposts) != 0 and $getposts) {
			$postids = array();
			foreach ($getposts as $post) { array_push($postids, $post['id']); }
			include('../php/generatepost.php');
		} ?>
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
		alert('test');
		var input = $('#posttextarea'),
			message = input.val();
			
		$.post('../php/submitpost.php',{
			type: '<?php echo $type;?>',
			tofrom: '<?php echo $tofrom;?>',
			message: message
		}, function(data) {
			console.log(data);
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