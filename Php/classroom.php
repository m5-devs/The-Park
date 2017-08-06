<?php
	require('include/dbcon.php');

	$classid = $_GET['id'];
	$userid = $sesuser['id'];
	$classinfoquery = mysql_query("SELECT * FROM classes WHERE id='$classid'");
	$classinfo = mysql_fetch_assoc($classinfoquery);
	$studentinfoquery = mysql_query("SELECT * FROM students WHERE studentid='$userid' AND classid='$classid'");
	
	//Redirect student if not in class and user is not the teacher, if class doesn't exist, or if not signed in
	if (mysql_num_rows($studentinfoquery) == 0 and $classinfo['teacherid'] != $userid or !isset($_SESSION['id']) or mysql_num_rows($classinfoquery) == 0) {
		header("Location: /index.php");
		exit();
	}

	$studentinfo = mysql_fetch_assoc($studentinfoquery);
	$teacherinfo = getInfo((int)$classinfo['teacherid']);
?>

<!DOCTYPE html>
<html>
<head>

<title>Classroom</title>
<?php require('include/import.php'); ?>

<style>

.main {
	transition: ease-in-out all .3s;
}

#coverphoto {
	height: 470px;
	background-image: url(<?php echo $classinfo['cover'];?>);
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

.friendbtn {
	display: inline;
	padding: 0;
}

</style>

</head>
<body style=" height: 100%;">

<?php require('include/header.php'); ?>

<div class="container main" style="background: #f9f9f9;">

	<!-- Cover photo -->
	<div id="coverphoto">
		<div id="gradient">
			<div id="info">
				<img id="profileavatar" src="<?=$teacherinfo['avatar']?>"/>
				<h3 id="name" class="white-text"><?=$classinfo['name']?></h3>
				<h5 id="bio" class="white-text">
					<a class="white-text" href="/profile.php?u=<?=$teacherinfo['id']?>">
						<?=formalName($teacherinfo['last_name'],$teacherinfo['gender'])?>
					</a>
					<?=' - '.formatPeriod($classinfo['period'],$classinfo['ab'])?>
				</h5>
			</div>
		</div>
	</div>

	<!-- Tabs and content -->
	<div id="tabs" class="theme-2" style="min-height: 534px;">
		<div class="s12 z-depth-1" style="margin-bottom: 12px;">
			<ul class="tabs theme-3" style="width: 100px;">
				<li class="tab"><a href="#feed">Feed</a></li>
				<li class="tab"><a href="#resources">Resources</a></li>
			</ul>
		</div>

		<div id="tabcontainer"><!-- Container for content -->

			<!-- Posts tab -->
			<div id="feed">
				<script>
					$.post('include/posts.php',{
						type: 'classroom',
						tofrom: <?=$_GET['id']?>
					}, function(data) {
						$('#feed').html(data);
						loadMsnry();
					});
				</script>
			</div>

			<!-- Resources tab -->
			<div id="resources">
			</div>
		</div>
	</div>
</div>
	
<script>
	//Reset masonry layout when changing tabs
	$('.tab').click(function() {
		setTimeout(function() {
			loadMsnry();
		}, 1);
	});
</script>

</body>
</html>