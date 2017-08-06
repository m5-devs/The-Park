<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// Use this file for testing out different PHP scripts //////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('../include/dbcon.php');

//Only allow admins to view the page
$privilege = getInfo((int) $sesuser['id'], 'privilege');

if ($privilege != '4') {
	//header('Location: http://thepark.site');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<?php require_once('../include/import.php');?>

	<style>
		/* CSS */
		div {
			width: 200px; height: 200px; background: #000;
		}
	</style>
</head>
	
<body class="spaced">
	<?php require_once('../include/header.php');?>

	<!-- HTML -->

	<div id="element"></div>
	<div id="childelement"></div>

	<script>
		//JS
		var foo = {
	        bar: $('#element'),
	        //baz: this.bar.find('#childelement'), // <- jQuery .find() not working
	        hideBaz: function() {
	            this.bar.hide();
	        }
	    }

	    $(function() {
	    	foo.hideBaz();
	    })
	</script>
</body>
</html>