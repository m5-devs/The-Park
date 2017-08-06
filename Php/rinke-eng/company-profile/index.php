<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <?php require_once('../include/import.php');?>
    <style>
    /* CSS */
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
		.person.exec {
			width: 200px;
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

<body>
    <?php require_once('../include/header.php');?>
	
	<div id="toc" class="hide-on-med-and-down card">
		<ul class="section table-of-contents">
			<li><a data-scroll href="#overview">Overview</a></li>
			<li><a data-scroll href="#history">Company History</a></li>
<!-- 			<li><a data-scroll href="#leadership">Our Leadership</a></li> -->
			<li><a data-scroll href="#team">Our Team</a></li>
			<li><a data-scroll href="#alliance">Strategic Alliance</a></li>
		</ul>
	</div>
	
    <div id="jumbo"></div>
	
	<div class="accent">
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">Leading Renewable Energy Solutions</h4>
                    <p>Rinke Engineering GmbH is a German company acting in the biomass sector as consultant. Our founder and the organization is recognized as the international leader in providing renewable energy solutions for projects throughout the world.</p>
					<p>Valued by customers for expertise in energy recovery, as well as the knowledge and skills of our independent project managers, we offer a variety of services to large biomass heating and power plants, small decentralized biomass heating plants, and pellet and briquette production plants. Customers turn to us for project development, planning, and financing, as well as project supervision after plant commissioning.</p>
					<p>With a focus on all sectors of agricultural and forestry-derived bio-energy, steam exploded- and torrefied pellets,  Rinke Engineering is well-positioned to contribute solutions for a worldwide sustainable energy supply, now and in the future.</p>
                </div>
            </div>
        </div>
    </div>
	
	<div id="history" class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 m7">
					<h4 class="slab light white-text">Fifteen Years of Expertise in Biomass</h4>
					<p class="white-text">
						Our company based the knowledge one the experience of more than 15 years of work in the Biomass industry. The founder worked for one of the most known company&#39;s in the industry and installed successful more than 2 Mio tone of production capacity for wood pellets and many biomass to Energy plants as heat plants and CHPs
					</p>
					<p class="white-text">
					   For more than 15 years, Rinke has played a key role in the design, installation and construction supervision, or acted as a consultant, for many leading projects, including:
						<ul class="bulleted green-text text-darken-4" style="padding-left: 20px;">
							<li>Biomass CHP plants</li>
							<li>Biomass heat plants</li>
							<li>Pellet production plants</li>
							<li>Expert witness for Biomass plants</li>
						</ul>
					</p>
				</div>
				<div class="col s12 m5">
					<img src="../res/img/factory2.jpg" class="card" style="width: 100%;"/>
				</div>
			</div>
		</div>
	</div>
	</div>
	
<!-- 	<div id="leadership" class="container">
		<div class="section center-align">
			<h4 class="slab light accent-text">Leaders Dedicated to Partnerships</h4>
			<p>
				Rinke Engineering GmbH relies on the knowledge, expertise and talents of the funder who share a common desire to enhance the way the world views the economic viability and success of renewable energy.
			</p>
			<?php
				$people = json_decode(file_get_contents("../res/data/staff.json"), true);
				//Escape array
				function escape(&$item, $key) { $item = htmlentities($item); }
				array_walk_recursive($people,'escape');

				$staff = $people['staff'];
				foreach ($people['leadership'] as $person) {
			?>
				<img src="<?=$person['img']?>" class="circle person z-depth-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?=$person['fname'].' '.$person['lname'].' - '.$person['position']?>"/>
			<?php } ?>
		</div>
	</div> -->
	
	<div id="team" class="container">
		<div class="section">
			<h4 class="slab light center-align">Our Team</h4>
			<p class="center-align">
				When you work with Rinke Engineering GmbH, you benefit from great depth and breadth of experience, planning expertise and operational insights from leaders who understand renewable energy solutions from a global perspective.
			</p>
			<div class="row center-align">
				<div class="col s12 m12">
					<img src="<?=$staff[0]['img']?>" class="circle person exec z-depth-1"/>
					<h5 class="slab"><?=$staff[0]['fname'].' '.$staff[0]['lname']?></h5>
					<h6><?=$staff[0]['position']?></h6>
					<p class="exec-desc">
						<?=$staff[0]['description']?>
					</p>
				</div>
<!-- 				<div class="col s12 m6">
					<img src="<?=$staff[1]['img']?>" class="circle person exec z-depth-1"/>
					<h5 class="slab"><?=$staff[1]['fname'].' '.$staff[1]['lname']?></h5>
					<h6><?=$staff[1]['position']?></h6>
					<p class="exec-desc">
						<?=$staff[1]['description']?>
					</p>
				</div> -->
			</div>
		</div>
	</div>
	
	<div id="alliance" class="container">
		<div class="section">
			<div>
				<h4 class="slab light accent-text center-align">The Power of Collaboration</h4>
				<p class="center-align">
					We firmly believe that moving the energy industry forward as quickly aspossible is a collaborative effort that depends on mutual synergy. We are dedicated to doing everything in our power to encourage the efforts of renewable energy organizations at global, national and local levels.
				</p>
				<p class="center-align">
					To that end, we enthusiastically support the following like-minded organizations:
					<div class="row">
						<?php
							$partners = json_decode(file_get_contents("../res/data/partners.json"), true);
							//Escape array
							array_walk_recursive($partners,'escape');
							foreach ($partners as $partner) {
						?>
						<div class="col s12 m10-12 center">
							<a href="<?=$partner['url']?>" target="_blank">
								<div class="card waves-effect waves-green">
									<div class="card-image">
										<img src="<?=$partner['img']?>">
									</div>
									<div class="card-content">
										<p class="noindent"><?=$partner['name']?></p>
									</div>
								</div>
							</a>
						</div>
						<?php } ?>
					</div>
				</p>
			</div>
		</div>
	</div>
	
    <?php require_once('../include/footer.php');?>
</body>

</html>
