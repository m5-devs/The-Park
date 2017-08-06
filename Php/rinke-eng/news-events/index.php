<!DOCTYPE html>
<html>

<head>
	<title>News &amp; Events</title>
	<?php require_once('../include/import.php');?>

	<style>
		/* CSS */
		#jumbo {
			height: 500px;
			width: 100%;
			background-image: url('http://imgur.com/m1Q7znt.jpg');
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
		
		#overview { margin-top: 440px; }
		
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

<body>
	<?php require_once('../include/header.php');?>
	
	<div id="jumbo"></div>
	
	<div class="accent">
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">News &amp; Events</h4>
					<p>
						Throughout the year, Rinke Engineering is involved in supporting renewable energy conferences around the world. Look for us the next time you travel to a conference in search of inspiration and solutions. We are always eager to welcome you to our booth and to make an appointment with you to answer your questions.
					</p>
                </div>
            </div>
        </div>
    </div>

	<div class="accent">
		<div class="container">
			<div class="section">
				<div class="row">
					<div class="col s12">
						<h3 class="white-text slab light">News</h3>
					</div>
				</div>
				<?php
					$events = json_decode(file_get_contents("../res/data/events.json"), true);
					foreach ($events as $event) {
				?>
				<div class="row card" style="position: relative;">
					<div class="col s9 push-s3 card-content">
						<h4 class="slab"><?=$event['title']?></h4>
						<h5 class="slab"><?=$event['description']?></h5>
						<p class="noindent"><?=$event['text']?></p>
					</div>
					<a href="<?=$event['link']?>" /><div class="col s3 pull-s9" style="background-image: url('<?=$event['img']?>'); padding: 0; height: 100%; position: absolute;"></div></a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
		
	<div style="background-color: white;">
		<div class="container">
			<div class="section">
				<div class="row">
					<div class="col s12">
						<h3 class="accent-text slab light">Events</h3>
						<?php
							$events = json_decode(file_get_contents("../res/data/events.json"), true);
							foreach ($events as $event) {
						?>
						<div class="row card accent" style="position: relative;">
							<div class="col s9 push-s3 card-content">
								<h4 class="slab white-text"><?=$event['title']?></h4>
								<h5 class="slab white-text"><?=$event['description']?></h5>
								<p class="noindent white-text"><?=$event['text']?></p>
							</div>
							<a href="<?=$event['link']?>" /><div class="col s3 pull-s9" style="background-image: url('<?=$event['img']?>'); padding: 0; height: 100%; position: absolute;"></div></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('../include/footer.php');?>
	<script>
		//Javascript
	</script>
</body>

</html>