<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// Use this file for testing out different PHP scripts //////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('../include/dbcon.php');

//Only allow admins to view the page
$privilege = getInfo((int) $sesuser['id'], 'privilege');

if ($privilege != '4') {
	header('Location: http://thepark.site');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<?php require_once('../include/import.php');?>

	<style>
		/* CSS */
	</style>
</head>
	
<body class="spaced">
	<?php require_once('../include/header.php');?>

	<!-- HTML -->
	
	<script>
		//JS
	</script>
</body>
</html>