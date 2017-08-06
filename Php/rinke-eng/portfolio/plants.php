<?php
	$type = $_GET['t'];
	$accepted = array('chp','heat','pellet');
	if (!in_array($type, $accepted)) {
		header('Location: portfolio.php');
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title><?=ucfirst($type)?> Plants</title>
	<?php require('../include/import.php');?>

	<style>
		#jumbo {
			height: 500px;
			width: 100%;
			background-image: url('http://www.seeger-greenenergy.com/assets/user/media/kraftwerk_18_kleinCHP_Plant.jpg');
			background-position: center;
			background-size: cover;
			z-index: 0;
			position: absolute;
			top: 0;
		}
		
		#list { margin-top: 330px; }
	</style>
</head>

<body class="spaced">
	<?php require('../include/header.php');?>
	
	<div id="jumbo"></div>

	<div id="list" class="container">
		<?php
			$plants = json_decode(file_get_contents("../res/data/plants.json"), true);
			foreach ($plants[$type] as $plant) {
		?>
		<a href="plant.php?id=<?=$plant['id']?>" class="card-plant black-text">
			<div class="card waves-effect waves-dark">
				<div class="card-content">
					<div class="row">
						<div class="col s12 m3">
							<img src="<?=$plant['img']?>"/>
						</div>
						<div class="col s12 m9">
							<h4 class="slab light"><?=$plant['type']?></h4>
							<p>
								<?=$plant['description']?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</a>
		<?php } ?>
	</div>
	
	</div>

	<?php require('../include/footer.php');?>
	<script>
		//Javascript
	</script>
</body>

</html>