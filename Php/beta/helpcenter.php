<?php

include('include/dbcon.php');

//Redirect user to main page if not signed in
if (!isset($_SESSION['id'])) {
	header('Location: index.php');
}

if (@$_GET['c']) {
	$category = $_GET['c'];
} else {
	$category = 'all';
}
$category = ucfirst($category); //Capitalize string

?>

<!DOCTYPE html>
<html>
<head>
	<title>Help Center</title>
	<?php require_once('include/import.php');?>
	<style>
		.masonry-grid:after { content: ''; display: block;  clear: both; } /* clearfix */
		.masonry-grid { margin: 0 auto; }
		.grid-item { width: 49%; float: left; margin-bottom: 8px; }
	</style>
</head>

<body class="spaced">
	<?php include('include/header.php'); ?>
	<div class="container">

	<?php /*
		 Dropdown Trigger 
		<a class='dropdown-button btn' href='#' data-activates='dropdown1'><?php echo $category;?></a>

		 Dropdown Structure 
		<ul id='dropdown1' class='dropdown-content'>
			<li><a href="helpcenter.php?c=all">All</a></li>
			<li><a href="helpcenter.php?c=math">Math</a></li>
			<li><a href="helpcenter.php?c=science">Science</a></li>
			<li><a href="helpcenter.php?c=english">English</a></li>
			<li><a href="helpcenter.php?c=history">History</a></li>
			<li><a href="helpcenter.php?c=foreign%20language">Foreign Language</a></li>
			<li><a href="helpcenter.php?c=health">Health</a></li>
			<li><a href="helpcenter.php?c=performing%20arts">Performing Arts</a></li>
			<li><a href="helpcenter.php?c=visual%20arts">Visual Arts</a></li>
			<li><a href="helpcenter.php?c=technology">Technology</a></li>
		</ul>
	*/ ?>
	
	<!-- Connect to post help -->
	<div id="posts">
	</div>
	
		<script>
			$.post('include/posts.php',{
				type: 'help',
				tofrom: '<?php echo $category;?>' 
			}, function(data) {
				$('#posts').html(data);
				loadMsnry();
			});
		</script>
	</div>
</body>

</html>
