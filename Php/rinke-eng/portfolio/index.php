<!DOCTYPE html>
<html>

<head>
	<title>Portfolio</title>
	<?php require_once('../include/import.php');?>

	<style>
		/* CSS */
		.card-plant {
			overflow: visible;
		}
				#jumbo {
			height: 500px;
			width: 100%;
			background-image: url('../res/img/logispan_truck.jpg');
			background-position: center;
			background-size: cover;
			z-index: 0;
			position: absolute;
			top: 0;
		}
		
		.container .section p:not(.noindent) {
			line-height: 1.9em;
			text-indent: 20px;
		}
		
		#overview { margin-top: 330px; }
		
		.person {
			cursor: pointer;
			border: 4px white solid;
			margin: 0px 5px;
		}
		.exec-desc {
			text-indent: 0px !important;
			text-align: justify;
		}
		
		@media (min-width: 600px) {
			.col.m2-4 {
				width: 20% !important;
				margin-left: auto !important;
				left: auto !important;
				right: auto !important;
			}
		}
	</style>
</head>

<body class="spaced">
	<?php require_once('../include/header.php');?>
	
	    <div id="jumbo"></div>
	
	
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">Our Potential</h4>
                    <p>As you&#39;ll see from our portfolio, we&#39;ve worked with companies and government leaders in all kinds of places with a wide variety of challenges. In each instance, our customers have confidence that we will consider every factor that could possibly impact a project, taking into account customer needs, community needs, vendor collaboration and regulatory requirements.</p>
                </div>
            </div>
        </div>
    </div>

	<div class="container">
		<?php
			$planttypes = json_decode(file_get_contents("../res/data/planttypes.json"), true);
			foreach ($planttypes as $plant) {
		?>
		<a href="references.php" class="card-plant black-text"><div class="card waves-effect waves-dark">
			<div class="card-content">
				<div class="row">
					<div class="col s12 m3">
						<img src="<?=$plant['img']?>"/>
					</div>
					<div class="col s12 m9">
						<h4 class="slab light"><?=$plant['name']?></h4>
						<p>
							<?=$plant['description']?>
						</p>
					</div>
				</div>
			</div>
		</div></a>
		<?php } ?>
	</div>

	<?php require_once('../include/footer.php');?>
	<script>
		//Javascript
	</script>
</body>

</html>