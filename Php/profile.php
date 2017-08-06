<?php
	include('include/dbcon.php');

	//Redirect user if not logged in and did not specify user id
	if (!isset($_GET['u'])) {
		if (!isset($_SESSION['id'])) {
			header('Location: index.php');
			exit();
		}
	}

	//Redirect user to main page if requested user doesn't exist
	$currentuserid = $currentuser['id'];
	$sql_find_id = mysql_query("SELECT id FROM users WHERE id = '$currentuserid'");
	if (mysql_num_rows($sql_find_id) == 0) {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>

<title><?php if($currentuser['id']==$sesuser['id']){echo'Profile';}else{echo $currentuser['first_name'].'\'s Profile';}?></title>
<?php include('include/import.php'); ?>

<style>

.main {
	transition: ease-in-out all .3s;
}

#coverphoto {
	height: 470px;
	background-image: url(<?php echo $currentuser['cover'];?>);
	background-size: cover;
	background-position: 50% 50%;
	transition: .3s ease-in-out all;
}

#gradient {
	height: inherit;
	background: rgba(0,0,0,.5);
	background: linear-gradient(0deg, rgba(0,0,0,.6), rgba(0,0,0,.1), rgba(0,0,0,0));
	position: relative;
}

#info {
	color: #FFF;
	width: 100%;
	text-align: center;
	position: absolute;
	bottom: 0;
	padding: 25px;
}

#profileavatar {
	width: 150px; border-radius: 50%;
	transition: ease-in-out all .3s;
	-webkit-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
	   -moz-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
			box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.6);
}

#name { font-size: 27pt; font-weight: 300; }

#bio { font-size: 14pt; position: relative; bottom: 8px; }

#tabcontainer {
	padding: 5px 30px;
}

.friendbtn {
	display: inline;
	padding: 0;
}

</style>

</head>
<body style=" height: 100%;">

<?php include('include/header.php'); ?>

<div class="container main" style="background: #f9f9f9;">

	<!-- Cover photo -->
	<div id="coverphoto">
		<div id="gradient">
			<div id="info">
				<img id="profileavatar" src="<?php echo $currentuser['avatar'];?>"/>
				<h3 id="name" class="white-text"><?php echo $currentuser['first_name'].' '.$currentuser['last_name'];?></h3>
				<h5 id="bio" class="white-text"><?php echo '@'.$currentuser['username'];?></h5>
			</div>
		</div>
	</div>

	<!-- Tabs and content -->
	<div id="tabs" class="theme-2" style="min-height: 534px;">
		<div class="s12 z-depth-1-half" style="margin-bottom: 12px;">
			<ul class="tabs theme-3" style="width: 100px;">
				<li class="tab"><a href="#about">About</a></li>
				<li class="tab"><a class="active" href="#posts">Posts</a></li>
			</ul>
		</div>

		<div id="tabcontainer"><!-- Container for content -->

			<!-- About tab -->
			<div id="about">
				<div class="row">
					<div class="masonry-container">
						<div class="grid">
							<div class="grid-sizer"></div>

							<!-- Friends card -->
							<div class="card grid-item">
								<div class="card-content">
									<span class="card-title">Friends</span>
									<br/>
									<style> #avatar { margin: 5px 5px 0px 5px; } </style>
									<span style="overflow: hidden; height: 40px;">
										<?php include('include/friends/all.php');?>
									</span>
								</div>

								<div class="card-action" style="padding: 14px 20px;">
									<!-- Links -->
									<a href="#friendsmodal" class="modal-trigger">
										<button class="accent-text  btn-flat" style="padding: 0;">See all friends</button>
									</a>
									<!-- send friend request -->
									<?php
										$friendButton = '';
										if ($currentuser['id'] != $sesuser['id']) {
											if (checkFriends($sesuser['id'],$currentuser['id'])) {
												if (checkAccepted($sesuser['id'],$currentuser['id'])) {
													//If the two users are already friends, create remove friend button
													$friendButton = '<button id="remove" class="friendbtn accent-text btn-flat">Unfriend</button>';
												} else {
													//If the other friend hasn't accepted yet, create cancel request button
													$friendButton = '<button id="remove" class="friendbtn accent-text btn-flat">Cancel Request</button>';
												}
											} else {
												//If they are not friends, create add friend button
												$friendButton = '<button id="add" class="friendbtn accent-text btn-flat">Add Friend</button>';
											}
										}
                    					echo $friendButton;
									?>

								</div>

								<!-- All friends modal -->
								<div id="friendsmodal" class="modal modal-fixed-footer">
									<div class="modal-content">
										<!-- Title -->
										<h5><?php $string = $currentuser['first_name']; echo $string.'\''.($string[strlen($string) - 1] != 's' ? 's' : '');?> friends</h5>
										<br/>
										<?php include('include/friends/formatted.php');?>
									</div>
									<div class="modal-footer">
										<a href="#!" class="modal-action accent-text waves-effect waves-dark btn-flat" onmouseup="$('#friendsmodal').closeModal();">Done</a>
									</div>
								</div>
							</div>

							<!-- Bio card -->
							<div class="grid-item card">
								<div class="card-content">
									<span class="card-title">Bio</span>
									<br/>
									<?php echo filter($currentuser['bio']);?>
								</div>
							</div>
							
							<!-- Badges card -->
							<div class="grid-item card">
								<div class="card-content">
									<?php include("badges.php"); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Posts tab -->
			<div id="posts">
				<script>
					$.post('include/posts.php',{
						type: 'profile',
						tofrom: <?php echo $currentuser['id'];?>
					}, function(data) {
						$('#posts').html(data);
						loadMsnry();
					});
				</script>
			</div>
		</div>
	</div>
</div>

<script>

$('.loadcomments').click(function() {
	loadMsnry();
});

//Reset masonry layout when changing tabs
$('.tab').click(function() {
	setTimeout(function() {
		loadMsnry();
	}, 1);
});
	
//Friend request
$('.friendbtn').click(function() {
	var userto = '<?php echo $currentuser['id'];?>';
	var userfrom = '<?php echo $sesuser['id'];?>';
	var type = $(this).attr('id');
	$.post('php/friend.php',{
		to: userto,
		from: userfrom,
		type: type
	},function(data) {
		Materialize.toast(data, 5000);
	});
	return false;
});

</script>

</body>
</html>