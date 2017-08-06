<?php require('include/dbcon.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Scores</title>
	<?php require('include/import.php');?>
	<?php
		$teacherid = $sesuser['id'];
		$studentscores = $db->select("SELECT * FROM testscores WHERE teacherid = '$teacherid'");
	?>
	<style>
		/* CSS */
	</style>
</head>
	
<body class="spaced">
	<?php require('include/header.php');?>

	<div class="container">
		<!-- HTML -->
		<?php
			while ($score = mysqli_fetch_array($studentscores)) { ?>
			<div class="card container" id="question-container">
				<div class="card-content">
					<p>
						<?php
							$studentinfo = getInfo((int) $score['studentid']);
							echo $studentinfo['first_name'].' '.$studentinfo['last_name'].':     '.$score['score'].'%';
						?>
					</p>
				</div>
			</div>
					<?php
			}
		?>
	</div>

	<script>
		//Javascript
	</script>
</body>
</html>