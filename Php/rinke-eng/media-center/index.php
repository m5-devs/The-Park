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
			background-image: url('http://forwallpapers.com/wp-content/uploads/2013/10/Social-Media-Speach-HD-ForWallpapers.com_1.jpg');
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
		
		.media-item {
			min-height: 175px;
		}
		.media-item .icon-big {
			font-size: 50px;
			transform: translate(3px, 7px);
		}
		
		footer {
			box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
		}
    </style>
</head>

<body class="scrollspy">
    <?php require_once('../include/header.php');?>
	
    <div id="jumbo"></div>
	
	<div id="overview" class="container">
        <div class="section">
            <div class="card">
                <div class="center card-content">
                    <h4 class="slab light accent-text">Media Center</h4>
					<p>
						Rinke Engineering is always eager to share our knowledge about green energy and biomass and help you learn more about our company. In this section of our website, you&#39;ll find white papers, interviews, articles and media resources, including a library of photos and graphics to assist your editorial efforts. Please note usage rights below.
					</p>
                </div>
            </div>
        </div>
    </div>
		
	<div class="container row">
		<div class="col s12 m12 l6">
			<a href="#">
				<div class="card media-item waves-effect waves-light white-text green">
					<div class="card-content row">
						<div class="col s2 icon-big">
							<h5>
								<i class="material-icons icon-big">insert_drive_file</i>
							</h5>
						</div>
						<div class="col s10">
							<h5 class="slab">File Exchange</h5>
							<p>
								Click here for a quicker and more convenient way to to share files with our engineering experts without having to email.
							</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col s12 m12 l6">
			<a href="#">
				<div class="card media-item waves-effect waves-light white-text blue">
					<div class="card-content row">
						<div class="col s2 icon-big">
							<h5>
								<i class="material-icons icon-big">group</i>
							</h5>
						</div>
						<div class="col s10">
							<h5 class="slab">Web Meetings</h5>
							<p>
								Connect directly with our engineers through a web meeting here.
							</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col s12 m12 l6">
			<a href="#">
				<div class="card media-item waves-effect waves-light white-text red">
					<div class="card-content row">
						<div class="col s2 icon-big">
							<h5>
								<i class="material-icons icon-big">movie</i>
							</h5>
						</div>
						<div class="col s10">
							<h5 class="slab">Videos</h5>
							<p>
								Our video library is always open. What can you learn about renewable energy and biomass when you click &ldquo;play&rdquo;?
							</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col s12 m12 l6">
			<a href="whitepapers.php">
				<div class="card media-item waves-effect waves-light white-text orange">
					<div class="card-content row">
						<div class="col s2 icon-big">
							<h5>
								<i class="material-icons icon-big">file_download</i>
							</h5>
						</div>
						<div class="col s10">
							<h5 class="slab">White Papers</h5>
							<p>
								White papers and technical articles are right here, ready for you to download, read and save. What renewal energy topics would you like to learn more about?
							</p>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<div class="green lighten-4">
	<div class="container">
		<div class="section">
			<div class="row small-text">
				<p clas="noindent">
					Copyright and Usage Rights
				</p>
				<p clas="noindent">
					All photos, graphics, sounds etc. in our website are legally protected. Only the material provided in the part 'Pictures and Graphics' of our website can be used for editorial reporting. When using this material, the source must be indicated (copyright notice) and author's copy (printed) or a release note (online) must be mailed to us (Rinke Engineering GmbH. Schanze 6, 37318)
				</p>
				<p clas="noindent">
					It is illegal to modify, falsify or misuse the provided material. 
				</p>
			</div>
		</div>
	</div>
	</div>
	
    <?php require_once('../include/footer.php');?>
</body>

</html>
