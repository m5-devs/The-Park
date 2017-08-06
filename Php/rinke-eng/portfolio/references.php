<!DOCTYPE html>
<html>

<head>
	<title>References</title>
	<?php require_once('../include/import.php');?>

</head>

<body class="spaced">
	<?php require_once('../include/header.php');?>

	<div class="container">
    <ul class="collapsible popout" data-collapsible="accordion">
		<?php
			$references = json_decode(file_get_contents("../res/data/references.json"), true);
			foreach ($references as $reference) {
		?>
    <li>
      <div class="collapsible-header"><?=$reference['name']?><div style="float: right;"><?=$reference['date']?></div></div>
      <div class="collapsible-body"><p><?=$reference['desc']?></p></div>
    </li>
		<?php } ?>
  </ul>
	</div>

	<?php require_once('../include/footer.php');?>
</body>

</html>