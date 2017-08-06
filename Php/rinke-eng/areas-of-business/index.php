<!DOCTYPE html>
<html>

<head>
    <title>Services</title>
    <?php require_once('../include/import.php');?>
    <style>
    /* CSS */
		#jumbo {
			height: 500px;
			width: 100%;
			background-image: url('../res/img/factory1.jpg');
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

<body class="scrollspy">
    <?php require_once('../include/header.php');?>
	
	<div id="toc" class="hide-on-med-and-down card">
		<ul class="section table-of-contents">
			<li><a data-scroll href="#overview">Overview</a></li>
			<li><a data-scroll href="#development">Project Development</a></li>
			<li><a data-scroll href="#chp">Biomass CHP Plants</a></li>
			<li><a data-scroll href="#heat">Biomass Heat Plants</a></li>
			<li><a data-scroll href="#pellet">Pellet Production Plants</a></li>
<!-- 			<li><a data-scroll href="#briquette">Briquette Production Plants</a></li> -->
			<li><a data-scroll href="#engineering">Engineering</a></li>
			<li><a data-scroll href="#efficiency">Energy Efficiency</a></li>
			<li><a data-scroll href="#management">Project Management</a></li>
<!-- 			<li><a data-scroll href="#biogas">Biogas</a></li> -->
		</ul>
	</div>
	
    <div id="jumbo"></div>
	
	<div class="accent">
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">Your Resource from Start to Finish</h4>
                    <p>Our company has been recognized as an international leader in providing renewable energy solutions for projects throughout the world for more than three decades. Our areas of business encompass project development, planning, financing, and project supervision after plant commissioning for large biomass heating and power plants, small decentralized biomass heating plants, pellet production plants and briquette production plants. Our engineering expertise and efficiencies are evident in projects of all sizes for companies ranging from public utilities to family-owned companies.</p>
                </div>
            </div>
        </div>
    </div>
	
	<div id="development" class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 m5">
					<img src="../res/img/factory5.jpg" class="card" style="width: 100%;"/>
				</div>
				<div class="col s12 m7">
					<h4 class="slab white-text light">Extensive Development Expertise</h4>
					<p class="white-text noindent">
						Our preliminary project activities encompass six key endeavors that analyze project viability and create the kind of team that puts every project on a firm foundation from the start:
					</p>
					<p class="white-text">
						<ul class="bulleted green-text text-darken-4">
							<li>Concept development</li>
							<li>Profitability analysis</li>
							<li>Funds sourcing</li>
							<li>Gathering expertise</li>
							<li>Solidifying strategic partnerships</li>
							<li>Locating heat sinks</li>
						</ul>
					</p>
				</div>
			</div>
			<div class="row">
				<h5 class="slab white-text light center-align">
					With Rinke Engineering on your team, you can make informed decisions from Day One.
				</h5>
			</div>
		</div>
	</div>
	</div>
	
	<div id="chp" class="container">
		<div class="section">
			<h4 class="slab light accent-text">Biomass CHP Plants</h4>
			<p class="noindent">
				A biomass-fueled CHP installation is an integrated power system made up of three main components:
			</p>
			<p>
				<ul class="bulleted">
					<li>Biomass receiving and feedstock preparation</li>
					<li>Energy conversion from biomass into steam for direct combustion systems or into biogas for gasification systems. This includes necessary environmental control equipment, including cyclones, bag houses, acid gas removal, selective non-catalytic reduction, selective catalytic reduction, heat recovery, boiler system or biogas cooling, and cleanup section</li>
					<li>Power and heat production: conversion of the steam or syngas into electric power and process steam or hot water</li>
				</ul>
			</p>
		</div>
	</div>
	
	<div class="accent white-text">
	<div id="heat" class="container">
		<div class="section">
			<h4 class="slab light center-align">Biomass Heat Plants</h4>
			<p>
				Price increases in oil, natural gas and coal have increased the value of biomassfor heat generation. Biomass sources such as forest materials, agricultural waste, and crops grown specifically for energy production have become competitive resources, promising ongoing benefits in creating a multi-dimensional renewable energy industry.
			</p>
		</div>
	</div>
	</div>
	
	<div id="pellet" class="container">
		<div class="section">
			<h4 class="slab light accent-text">Pellet Production Plants</h4>
			<p>
				Pellet production plants convert natural biomass into fuels that can be used instead of oil and gas heating in homes or in commercial energy production. Pellet production includes:
			</p>
			<ul class="bulleted">
				<li>EN plus A1 / A2 pellets</li>
				<li>Industrial pellets</li>
				<li>Pellets made from energy crops</li>
			</ul>
			
			<p>
				During the conversion process, raw material is dehumidified, increasing heating value.
			</p>
			<p>
				The increase in heat value is a prerequisite for the use of natural biomass in small fully automated heating systems (such as pellet heating systems), making them as easy to handle as oil or gas heating systems. The use of industrial pellets in large power plants, engaged in co-firing of biomass and fossil fuels, is becoming more and more important in those countries that have ratified the Kyoto treaty.
			</p>
			<p>
				Pellet production plants are fully automated plants that use processing steps to dry and harden the raw material. As a result, biomass can be transported more easily, allowing for an economic and ecological use of fuels.
			</p>
			<p>
				Rinke Engineering is your perfect partner for the planning and constructing pellet production plants with a production capacity of 15,000 tons up to 1,000,000 tons per year.</p>
			</p>
		</div>
	</div>

<!-- 	<div id="briquette" class="container">
		<div class="section">
			<h4 class="slab light">Briquette Production Plants</h4>
			<p>
				Briquette production plants convert natural biomass into fuels that can be used instead of oil and gas in residences or in the energy industry.
			</p>
			<p>
				Different types of briquettes produced include:
			</p>
			<ul class="bulleted">
				<li>Wood briquettes</li>
				<li>Bark briquettes</li>
			</ul>
			<p>
				During the conversion process, raw material is dehumidified, increasing heating value.
			</p>
			<p>
				Briquette production plants are fully automated plants that use processing steps to dry and harden the raw material. As a result, biomass can be transported more easily, allowing for an economic and ecological use of fuels.
			</p>
			<p>
				Seeger Green Energy is adept at helping you plan and build briquette plants with a production capacity of 15,000 tons up to 500,000 tons per year.
			</p>
		</div>
	</div> -->

	<div id="engineering" class="container">
		<div class="section">
			<h4 class="slab light accent-text">Engineering</h4>
			<p class="noindent">
				To ensure exceptional results, we rely on engineers with a wide variety of backgrounds and specialties, including:
			</p>
			<p>
				<ul class="bulleted">
					<li>Mechanical engineers</li>
					<li>Electrical engineers </li>
					<li>Industrial engineers</li>
					<li>Wood engineers</li>
					<li>Agricultural engineers</li>
					<li>Technicians, design draftsmen, and other well-educated professionals</li>
				</ul>
			</p>
			<p class="noindent">
				These engineering experts focus on nine core processes:
			</p>
			<p>
				<ul class="bulleted">
					<li>Basic evaluation</li>
					<li>Preliminary planning</li>
					<li>Blueprint planning</li>
					<li>Approval planning</li>
					<li>Contract preparation</li>
					<li>Contract award participation</li>
					<li>Implementation planning</li>
					<li>Construction management</li>
					<li>Documenting and addressing deficiencies</li>
				</ul>
			</p>
		</div>
	</div>

	<div id="efficiency" class="container">
		<div class="section">
			<h4 class="slab light">Maximizing the Potential of Energy Efficiency</h4>
			<p>
				Energy efficiency describes the ratio of energy input and output, which means doing more with less energy and increasing energy productivity.
			</p>
			<p>
				The manufacturing industry significantly contributes to global energy consumption (electricity, oil and gas), as well as harmful emissions. Reliance on  scarce fossil fuels also adds to manufacturing costs. Smarter handling of energy resources is an important economic factor and promotes sustainable energy  development.
			</p>
			<p>
				Our independent experts follow specific steps to help you become an energy-efficient company:
			</p>
			<ul>
				<li>Step 1: Present and evaluate the current situation</li>
				<li>Step 2: Propose energy efficiency measures</li>
				<li>Step 3: Develop an overall concept</li>
				<li>Step 4: Implement the concept and control success</li>
			</ul>
			<p>
				Economic efficiency and an environmentally-aware corporate culture work hand-in-hand to achieve the goals of energy efficiency by:
			</p>
			<ul class="bulleted">
				<li>Identifying large consumers of energy</li>
				<li>Reducing energy consumption</li>
				<li>Reducing energy costs</li>
				<li>Reducing production</li>
			</ul>
			<p>
				Energy efficiency is a quality criterion for a sustainable and climate-friendly energy supply.
			</p>
		</div>
	</div>

	<div id="management" class="container">
		<div class="section">
			<h4 class="slab light">Project Management</h4>
			<p>
				Our project management activities span execution and plant utilization to provide you with both expertise and continuity. Execution incorporates:
			</p>
			<ul class="bulleted">
				<li>Project management</li>
				<li>Fuel acquisition</li>
				<li>CO2 management</li>
				<li>Finding a heat customer</li>
				<li>Construction technique</li>
			</ul>
			<p>
				We also support you with downstream project activities, such as:
			</p>
			<ul class="bulleted">
				<li>Building your operations staff</li>
				<li>Ongoing engineering support throughout your plant&#39;s life cycle</li>
				<li>Selling old plants</li>
			</ul>
		</div>
	</div>
	
    <?php require_once('../include/footer.php');?>
</body>

</html>
