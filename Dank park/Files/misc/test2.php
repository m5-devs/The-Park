<?php require('../include/dbcon.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<?php require('../include/import.php');?>
	<link href="/css/jquery.gridster.min.css" type="text/css" rel="stylesheet"/>
	<script src="/js/jquery.gridster.min.js"></script>

	<style>
		.container {
			background: #000;
		}
		.gridster ul li {
			background: white;
		}
	</style>
</head>
	
<body class="spaced">
	<?php require('../include/header.php');?>

	<div class="container">
		<!-- HTML -->
			<div class="gridster">
    <ul>
        <li data-row="1" data-col="1" data-sizex="1" data-sizey="1"></li>
        <li data-row="2" data-col="1" data-sizex="1" data-sizey="1"></li>
        <li data-row="3" data-col="1" data-sizex="1" data-sizey="1"></li>

        <li data-row="1" data-col="2" data-sizex="2" data-sizey="1"></li>
        <li data-row="2" data-col="2" data-sizex="2" data-sizey="2"></li>

        <li data-row="1" data-col="4" data-sizex="1" data-sizey="1"></li>
        <li data-row="2" data-col="4" data-sizex="2" data-sizey="1"></li>
        <li data-row="3" data-col="4" data-sizex="1" data-sizey="1"></li>

        <li data-row="1" data-col="5" data-sizex="1" data-sizey="1"></li>
        <li data-row="3" data-col="5" data-sizex="1" data-sizey="1"></li>

        <li data-row="1" data-col="6" data-sizex="1" data-sizey="1"></li>
        <li data-row="2" data-col="6" data-sizex="1" data-sizey="2"></li>
    </ul>
</div>
	</div>

	<script>
		//Javascript
		$(function(){ //DOM Ready

    $(".gridster ul").gridster({
			.serialize_changed([{"col":3,"row":8,"size_x":2,"size_y":2},{"col":3,"row":1,"size_x":1,"size_y":2},{"col":4,"row":1,"size_x":1,"size_y":1},{"col":2,"row":3,"size_x":3,"size_y":1},{"col":1,"row":2,"size_x":1,"size_y":1},{"col":1,"row":1,"size_x":1,"size_y":1},{"col":2,"row":4,"size_x":1,"size_y":1},{"col":2,"row":5,"size_x":1,"size_y":1},{"col":7,"row":1,"size_x":1,"size_y":1},{"col":5,"row":1,"size_x":1,"size_y":3},{"col":1,"row":3,"size_x":1,"size_y":2},{"col":3,"row":4,"size_x":1,"size_y":2},{"col":4,"row":4,"size_x":1,"size_y":1},{"col":2,"row":6,"size_x":3,"size_y":1},{"col":5,"row":4,"size_x":1,"size_y":2},{"col":5,"row":6,"size_x":1,"size_y":1},{"col":3,"row":7,"size_x":1,"size_y":1}] );
    });
});
	</script>
</body>
</html>