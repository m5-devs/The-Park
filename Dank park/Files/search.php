<?php

include('include/dbcon.php');

$q = preg_replace('/[^A-Za-z0-9]/', '',$_GET['q']);
$userssql = mysql_query("SELECT * FROM users WHERE username LIKE '%$q%' OR first_name LIKE '%$q%' OR last_name LIKE '%$q%' ORDER BY points DESC, first_name, last_name LIMIT 50");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<?php include('include/import.php');?>
	
	<style>		
		.group .title { font-size: 23px; margin-left: 15px; padding: 8px; }
		
		#group-users {
    		overflow-x: auto;
			overflow-y: hidden;
			height: 264px;
    		white-space: nowrap;
		}
		
		.user {
			display: inline-block;
			width: 180px;
			margin: 5px 5px 5px 0px;
		}
		
		.user-cover {
			width: 100%; height: 130px;
			background-size: cover;
			background-position: center;
		}
		
		.user .avatar {
			position: absolute;
			width: 80px;
			left: 50%;
			top: 90px;
			margin-left: -40px;
		}
		
		.user .card-content {
			padding-top: 53px;
			text-align: center;
			line-height: 25px;
		}
		.user .fname { font-size: 22px; }
		.user .lname { font-size: 18px; }
}

	</style>
</head>
<body class="spaced">
	<?php include('include/header.php');?>
	
	<?php if (mysql_num_rows($userssql) > 0) { ?>
	<div class="group container">
		<h5 class="title"><strong>Users</strong></h5>
		<div id="group-users">
			<?php 
			while ($userinfo = mysql_fetch_array($userssql)) { ?>
			
			<a href="<?php echo '/profile.php?u='.$userinfo['id'];?>"><div class="card user waves-effect waves-light">
				<div class="user-cover" style="background-image: url('<?php echo $userinfo['cover'];?>');"></div>
				<img src="<?php echo $userinfo['avatar'];?>" class="avatar avatar-circle"/>
				<div class="card-content">
					<div class="fname"><?php echo $userinfo['first_name']?></div>
					<span class="lname" style="opacity: .7;"><?php echo $userinfo['last_name']?></span>
				</div>
			</div></a>
			
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	
	<?php if (mysql_num_rows(mysql_query("SELECT * FROM posts WHERE type != 'private' AND message LIKE '%".$_GET['q']."%' ORDER BY timestamp DESC")) > 0) { ?>
	<div class="group container">
		<h5 class="title"><strong>Posts</strong></h5>
		<div id="group-posts">
			<script>
				$.post('include/posts.php',{
					type: 'all',
					query: '<?php echo $_GET['q'];?>'
				}, function(data) {
					$('#group-posts').html(data);
					loadMsnry();
				});
			</script>
		</div>
	</div>
	<?php } ?>
	
	<script>
	
		$(function(){
			$('#searchinput').val('<?php echo $_GET['q'];?>');
		})
		
	</script>
</body>
</html>


