<!DOCTYPE html>
<html>

<head>
    <title>Services</title>
    <?php require_once('../include/import.php');?>
	<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
    <style>
    /* CSS */
		#jumbo {
			height: 500px;
			width: 100%;
			background-image: url('http://www.seeger-greenenergy.com/assets/user/content/Employement_Opportunities_940x350_Crop.jpg');
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
		
		#overview { margin-top: 360px; }
		
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
	
    <div id="jumbo"></div>
	
	<div class="accent">
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">Career Opportunities</h4>
					<p>
						We are always interested in finding out more about people who want to devote their careers to the field of energy recovery from biomass.<br/>
						We currently do not have job openings, but watch our website for more opportunities to become available soon.
					</p>
                </div>
            </div>
        </div>
    </div>
	
    <?php require_once('../include/footer.php');?>
	
	<script>
	</script>
</body>

</html>
