<!DOCTYPE html>
<html>
<head>
	<title>Rinke Engineering</title>
	<?php require_once("include/import.php"); ?>
	<!-- Social media icons -->
	<link href="https://file.myfontastic.com/n6vo44Re5QaWo8oCKShBs7/icons.css" rel="stylesheet">

	<style>
		nav {
			background-color: rgba(0,0,0,0);
		}
		
		#jumbo .slides li div {
			padding-top: 64px;
		}
		
		#intro {
			padding: 30px;
		}
		
		#search { transition: ease-in-out all .4s; }
		#search.active {
			right: 50%;
			border-radius: 0;
			transform: translate3d(50%,-50%, 0);
			width: 100%;
		}
		#search-input { margin-top: 0; }
		#search-input label { top: 0; }
		#search-input input { border-bottom: none; }
		#search.active #search-icon { display: none; }
		
		#contact-container::before {
			content: ' ';
			display: block;
			position: absolute;
			left: 0;
			width: 100%;
			height: 100%;
			transform: translateY(0%);
			z-index: -1;
			opacity: 0.6;
			background-image: url('/rinke-eng/res/img/dot-map.svg');
			background-repeat: no-repeat;
			background-position: center;
			-ms-background-size: cover;
			-o-background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			background-size: cover;
		}
		@media (min-width: 600px) {
			#contact { padding-left: 30px; }
			#message { padding-right: 30px; }
		}
		@media (max-width: 600px) {
			#contact, #message {
				text-align: center;
			}
		}
		#contact-list .material-icons {
			font-size: 1.5rem;
			transform: translateY(5px);
			opacity: .7;
			margin-right: 6px;
		}
		#social-list .btn-floating { transform: scale(.8); }
		#social-list .btn-floating i { transform: translateY(3px); }
	</style>
</head>

<body class="scrollspy">
	<?php require_once("include/header.php"); ?>
	
	<div id="jumbo" class="slider">
		<ul class="slides">
			<li>
				<img src="res/img/logispan_truck.jpg"> <!-- random image -->
				<div class="caption center-align">
					<h3>Welcome!</h3>
					<h5 class="light grey-text text-lighten-3">Fueled by great energy and expertise, we turn visions for biomass heat and power plants into reality.
				</h5>
				</div>
			</li>
			<li>
				<img src="res/img/factory1.jpg"> <!-- random image -->
				<div class="caption left-align">
					<h3>Willkommen!</h3>
					<h5 class="light grey-text text-lighten-3">We bring independent project managers with extensive biomass know-how to the table.</h5>
				</div>
			</li>
			<li>
				<img src="res/img/logispan_truck.jpg"> <!-- random image -->
				<div class="caption right-align">
					<h3>&iexcl;Bienvenidos!</h3>
					<h5 class="light grey-text text-lighten-3">A more sustainable and successful future for Planet Earth starts here. Please join us.</h5>
				</div>
			</li>
		</ul>
	</div>

	<a id="search" class="btn-floating btn-large white on-seam">
		<i id="search-icon" class="material-icons black-text">search</i>
		<form>
			<div id="search-input" class="input-field">
				<input id="search" type="search" required placeholder="Search for something...">
				<i id="search-close" class="material-icons black-text">close</i>
			</div>
		</form>
	</a>
	
	<div id="intro" class="accent">
		<div class="container">
			<div class="section">
				<h4 class="left-align white-text">What will it take for the world to realize the potential of renewable energy?</h4>
				<h5 class="left-align white-text light">At Rinke Engineering, we believe it will take companies that combine know-how, dedication, openness and courage. We began our successful quest more than two decades ago, and look forward to working with you to build a brighter, greener future.</h5>
			</div>
		</div>
	</div>
	
	<div class="blue-grey darken-4">
	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col m4">
					<div class="card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="res/img/factory1.jpg">
							<span class="card-title">Services</span>
						</div>
						<div class="card-content">
							<p>We offer you a wide range of services, from consulting, project development and planning through project management, financing, project  supervision and project control.</p>
						</div>
						<div class="card-action">
							<a href="http://thepark.site/rinke-eng/services">Read more</a>
						</div>
					</div>
				</div>
				<div class="col m4">
					<div class="card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="res/img/factory1.jpg">
							<span class="card-title">Company History</span>
						</div>
						<div class="card-content">
							<p>For more than 15 years, we&#39;ve worked to move beyond the costly, time-consuming use of scarce fossil fuels. Let us help you investigate the economics  of biomass.</p>
						</div>
						<div class="card-action">
							<a href="http://thepark.site/rinke-eng/company-profile">Read more</a>
						</div>
					</div>
				</div>
				<div class="col m4">
					<div class="card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="res/img/factory1.jpg">
							<span class="card-title">Areas of Business</span>
						</div>
						<div class="card-content">
							<p>We focus on all sectors of agricultural and forestry-derived bio-energy that contribute to solutions for a worldwide sustainable energy supply.</p>
						</div>
						<div class="card-action">
							<a href="http://thepark.site/rinke-eng/areas-of-business">Read more</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3 class="accent-text slab light">Stragetic Alliances</h3>
					<h5>We've partnered with these companies to bring you the best we can offer</h5>
				</div>
			</div>
			<div class="row center">
				<div class="col m2 s12">
					<a href="https://www.vdi.de/" target="_blank">
						<img src="https://www.vdi.de/fileadmin/_processed_/csm_logo_vdi_neu_464baef8d4.png"/>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="accent">
	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3 class="white-text slab light">News &amp; Events</h3>
				</div>
			</div>
			<?php
				$events = json_decode(file_get_contents("res/data/events.json"), true);
				foreach ($events as $event) {
			?>
			<div class="row card" style="position: relative;">
				<div class="col s9 push-s3 card-content">
					<h4 class="slab"><?=$event['title']?></h4>
					<h5 class="slab"><?=$event['description']?></h5>
					<p><?=$event['text']?></p>
				</div>
				<a href="<?=$event['link']?>" /><div class="col s3 pull-s9" style="background-image: url('<?=$event['img']?>'); padding: 0; height: 100%; position: absolute;"></div></a>
			</div>
			<?php } ?>
		</div>
	</div>
	</div>
	
	<div style="position: relative; overflow: hidden; padding: 30px;">
	<div id="contact-container"class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3 class="accent-text slab light">Get in touch</h3>
					<h5>Questions or comments? Shoot us a message!</h5>
				</div>
			</div>
			<div class="row">
				<div id="contact" class="col m5 s12 push-m7">
					<div>
						<h4>Contact</h4>
						<ul id="contact-list">
							<li>
								<i class="material-icons">home</i>
								Rinke Engineering, Germany
							</li>
							<li>
								<i class="material-icons">email</i>
								<a href="mailto:info@rinke-eng.com">gri@rinke-engineering.de</a>
							</li>
							<li>
								<i class="material-icons">phone</i>
								+49-36081-688-111
							</li>
						</ul>
					</div>
					<div id="social-list">
						<h4>Social</h4>
<!-- 						<a class="btn-floating btn-large waves-effect waves-light" style="background-color: #00aced;"><i class="socicon-twitter"></i></a> -->
						<a class="btn-floating btn-large waves-effect waves-light" style="background-color: #007bb6;"><i class="socicon-linkedin"></i></a>
					</div>
				</div>
				<div id="message" class="col m7 s12 pull-m5">
					<form id="mailForm" action="scripts/mail.php" method="POST">
						<div class="row">
							<div class="col s12 m12 l6">
								<input name="fname" type="text" placeholder="First name..." class="validate" required/>
							</div>
							<div class="col s12 m12 l6">
								<input name="lname" type="text" placeholder="Last name..." class="validate" required/>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m12 l6">
								<input name="email" type="email" placeholder="Email..." class="validate" required/>
							</div>
							<div class="col s12 m12 l6">
								<input name="phone" type="text" placeholder="Phone number..." class="validate" required/>
							</div>
						</div>
						<input name="company" type="text" placeholder="Company name..." class="validate" required/>
						<textarea name="message" id="textarea1" class="materialize-textarea validate" placeholder="Message..."></textarea>
						
						<button class="left accent btn waves-effect waves-light" type="submit" name="action">Send message</button>
						<p style="transform: translate(15px, -7px);">
							<input name="newsletter" type="checkbox" id="check-newsletter" class="filled-in"/>
							<label for="check-newsletter">Sign Up for Newsletter</label>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<?php require_once("include/footer.php"); ?>
	
	<script>
		$('#search').click(function() {
			if (!$(this).hasClass('active')) {
				$(this).addClass('active');
				$(this).find('input').focus();
			}
		});
		$('#search-close').click(function(e) {
			$('#search').removeClass('active');
			e.stopPropagation();
		});	

		$('#mailForm').submit(function() {
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serialize(),
				success: function(response) {
					var response = $.parseJSON(response);
					Materialize.toast(response.message, 5000);
				}     
			});
			return false;
		});
	</script>
</body>
</html>