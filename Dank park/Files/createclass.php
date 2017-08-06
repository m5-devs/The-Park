<?php require('include/dbcon.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Create classroom</title>
	<?php require('include/import.php');?>

	<style>
		#main { margin: 0 auto; }
		#ab-container { display: none; padding-top: 10px; }
		span#period { font-size: 22px; }
	</style>
</head>
	
<body class="spaced">
	<?php require('include/header.php');?>

	<div id="main" class="container card">
		<form id="newclassform">
			<div class="card-content">
				<div class="input-field col s6">
					<input id="classroom-name" type="text" class="validate" name="name">
					<label for="classroom-name">Classroom Name</label>
				</div>
				<span id="period">Period:</span>
				<p>
					<input class="with-gap" name="radio-period" type="radio" id="radio-period-1" />
					<label for="radio-period-1">1st</label>
				</p>
				<p>
					<input class="with-gap" name="radio-period" type="radio" id="radio-period-2" />
					<label for="radio-period-2">2nd</label>
				</p>
				<p>
					<input class="with-gap" name="radio-period" type="radio" id="radio-period-3"  />
					<label for="radio-period-3">3rd</label>
				</p>
				<p>
					<input class="with-gap" name="radio-period" type="radio" id="radio-period-4"/>
					<label for="radio-period-4">4th</label>
				</p>
				<br/>
				<p>
					<input type="checkbox" id="check-ab" class="filled-in" id="filled-in-box"/>
					<label for="check-ab">A-B schedule</label>
				</p>
				<div id="ab-container">
					<p>
						<input class="with-gap" name="radio-ab" type="radio" id="radio-ab-a"  />
						<label for="radio-ab-a">A day</label>
					</p>
					<p>
						<input class="with-gap" name="radio-ab" type="radio" id="radio-ab-b"/>
						<label for="radio-ab-b">B day</label>
					</p>
				</div>
				<div class="input-field col s6">
					<input id="coverphoto" type="text" class="validate" name="cover">
					<label for="coverphoto">Cover photo URL</label>
				</div>
			</div>
			<div class="card-action">
				<button class="btn accent waves-effect waves-light">Continue</button>
				<button class="btn-flat waves-effect waves-dark" onclick="cancel()">Cancel</button>
			</div>
		</form>
	</div>

	<script>
		$('#check-ab').change(function(){
			if ($(this).is(':checked')) {
				$('#ab-container').slideDown();
			} else {
				$('#ab-container').slideUp();
				$('input[name="radio-ab"]').attr('checked', false);
			}
		});
		
		$("#newclassform").submit(function(){
			var period, ab;
			if ($('#radio-period-1').is(":checked")) { period = 1 }
			else if ($('#radio-period-2').is(":checked")) { period = 2 }
			else if ($('#radio-period-3').is(":checked")) { period = 3 }
			else if ($('#radio-period-4').is(":checked")) { period = 4 }
			if ($('#radio-ab-a').is(":checked")) { ab = 'a' }
			else if ($('#radio-ab-b').is(":checked")) { ab = 'b' }
			$.post('php/createclass.php', {
				name: $('#classroom-name').val(),
				period: period, //$("input:radio[name='radio-period']:checked").val(),
				ab: ab, //$("input:radio[name='radio-ab']:checked").val(),
				cover: $('#coverphoto').val()
			}, function(response) {
				if (parseInt(response)) {
					window.location.href = "classroom.php?id="+response;
				} else {
					Materialize.toast(response, 5000);
				}
			})
			return false;
		});
		
		function cancel() {
			window.history.back();
			return false;
		}
	</script>
</body>
</html>