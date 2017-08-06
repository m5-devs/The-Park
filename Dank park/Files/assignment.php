<?php require('include/dbcon.php');?>

<!DOCTYPE html>
<html>
<head>
	<title>Assignment</title>
	<?php require('include/import.php');?>

	<style>
		@media (min-width: 992px) {
		.flush {
			box-shadow: none;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
		}
		.flush:not(nav) { background: rgba(0,0,0,0) !important; }
		#slide-out.flush .material-icons { opacity: .65; color: #000; }
		hr { transition: ease-in-out all 300ms; }
		.flush hr { opacity: 0 !important; margin: 0; }
		.flush .page-active .material-icons { color: #fff !important; opacity: 1 !important; }
		}
		
		#jumbo {
			width: 100%;
			min-height: 460px;
			padding-top: 80px;
			display: inline-block;
		}
		#jumbo .container div { margin: 30px 0px; }
		#assignment-name { margin-bottom: 12px; }
		#assignment-teacher { margin-top: 0px; margin-bottom: 16px; }
		#assignment-info { font-size: 22px; }
		#assignment-attachment span { float: left; }
		#assignment-upload { float: right; right: calc(15% + 20px); transform: translateY(-50%); background: #eceff1; }
		#assignment-upload i { color: #515252; }
		#file-icon { width: 70px; }
		
		.title { font-size: 23px; margin-left: 15px; padding: 8px; }
		
		#table {
			position: relative;
			margin-bottom: 50px;
			overflow: visible;
		}
		#table th { opacity: .7; }
		#table td, #table th { padding: 22px; }
		#table thead { border-bottom: none; }
		#table tr th:last-child, tr td:last-child { text-align: right; }
	</style>
</head>
<body>
	<?php include('include/header.php'); ?>
	
	<div id="jumbo" class="accent">
		<div class="container">
			<div>
				<h3 id="assignment-name"><strong>Multi-Step Equations</strong></h3>
				<h5 id="assignment-teacher">Mr. Smith - 2nd Block</h5>
				<span><strong>DUE TOMORROW</strong></span>
			</div>
			<div>
				<span id="assignment-info">"Complete numbers 1-26, we will go over the rest in class on Friday."</span>
			</div>
			<ul>
				<li id="assignment-attachment" style="height: 95px;">
					<span><img src="http://i.imgur.com/Znq3wll.png" id="file-icon"></img></span>
					<span style="padding-top: 18px; margin-left: 5px;">
						<span><i class="material-icons" style="margin-top: 9px; margin-right: 5px;">attach_file</i></span>
						<span id="file-name">multi_step_equations.docx</span><br>
						<span id="file-size">0.3 MB</span>
					</span>
				</li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>
	<a id="assignment-upload" class="btn-floating btn-large waves-effect waves-dark"><i class="material-icons">cloud_upload</i></a>

	<div class="container">
		<br/>
		<h5 class="title"><strong>Submissions</strong></h5>
		<div id="table" class=" card z-depth-1-half">
			<table class="striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Grade</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>You</td>
						<td>Today, 4:12 PM</td>
						<td>92%</td>
					</tr>
					<tr>
						<td>John Smith</td>
						<td>Today, 3:28 PM</td>
						<td>Hidden</td>
					</tr>
					<tr>
						<td>Bobby Newport</td>
						<td>Yesterday</td>
						<td>Hidden</td>
					</tr>
					<tr>
						<td>Jim Halpert</td>
						<td>2 days ago</td>
						<td>Hidden</td>
					</tr>
					<tr>
						<td>Detlow Coffin</td>
						<td>2 days ago</td>
						<td>Hidden</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
	<script>

	$(function() {
		$('nav, #slide-out').addClass('flush');
	})
	
	$(window).scroll(function(){
		var st = $(this).scrollTop();
		if (st > 0) {
			$('nav, #slide-out').removeClass('flush');
		} else {
			$('nav, #slide-out').addClass('flush');
		}
		function reverse(str){
    str = str.split("").reverse().join("").split(" ").reverse().join(" ");
    console.log(str)
}
	});

	/******************** Google Picker Script ********************/
	var developerKey = 'AIzaSyCCKBK236c5tH7pUjHlz485R7Xi-m64EDg', //Browser API key
		clientId = '958305636628-7hvvhnprofn4thnvatdhc7pvucd2efkf.apps.googleusercontent.com', //Client ID
		scope = ['https://www.googleapis.com/auth/drive'], //Permission scope
		pickerApiLoaded = false,
		oauthToken;
	$('#assignment-upload').click(function() {
		// Use the API Loader script to load google.picker and gapi.auth.
		gapi.load('auth', {'callback': onAuthApiLoad});
		gapi.load('picker', {'callback': onPickerApiLoad});
	});
	function onAuthApiLoad() {
		window.gapi.auth.authorize({
			'client_id': clientId,
			'scope': scope,
			'immediate': false
		},
		handleAuthResult);
	}
	function onPickerApiLoad() {
		pickerApiLoaded = true;
		createPicker();
	}
	function handleAuthResult(authResult) {
		if (authResult && !authResult.error) {
			oauthToken = authResult.access_token;
			createPicker();
		}
	}
	function createPicker() {
		// Create and render a Picker object for picking user Photos.
		if (pickerApiLoaded && oauthToken) {
			var picker = new google.picker.PickerBuilder().
            addView(google.picker.ViewId.DOCUMENTS).
            addView(new google.picker.DocsUploadView()).
			addView(google.picker.ViewId.VIDEO_SEARCH).
			setOAuthToken(oauthToken).
			setDeveloperKey(developerKey).
			setCallback(pickerCallback).
			build();
			picker.setVisible(true);
		}
	}
	function pickerCallback(data) {
		// A simple callback implementation.
		var url = 'nothing';
		if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
			var doc = data[google.picker.Response.DOCUMENTS][0];
			//How to parse json and modify information returned:
			//https://developers.google.com/picker/docs/results

			console.log(doc);
            var thumbs = data.docs[0].thumbnails;
            var imageURL = thumbs[thumbs.length - 1].url; //select the largest image returned
		}
		var message = 'You picked: <br/><img src="'+imageURL+'"/>';
        document.getElementById('result').innerHTML = message;
	}
		
	</script>

	<!-- The Google API Loader script. -->
	<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>

</body>
</html>