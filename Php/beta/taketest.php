<?php
	require('include/dbcon.php');

	$testid = $_GET['t'];
	$userid = $_SESSION['id'];
	$testinfo = $db->select("SELECT * FROM tests WHERE id = '$testid'");
	$students = $db->select("SELECT * FROM students WHERE studentid = '$userid'");
	$testpermission = false;

	foreach ($students as $row) {
		if ($row['classid'] == $testinfo['classid']) {
			$testpermission = true;
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $testinfo['name'];?></title>
<?php require('include/import.php');?>
	
<style>
	#question-container { margin: 0 auto; padding: 10px; }
	.question { margin-bottom: 30px;  }
	.question-choice { margin-top: 8px !important; }
</style>
</head>
	
<body class="spaced">
<?php require('include/header.php');?>

<div class="card container" id="question-container">
	<div class="card-content">
		<?php
		$testquestions = $db->select("SELECT * FROM testquestions WHERE testid = '$testid'");
		$i = 0;
		foreach ($testquestions as $question) {
			$testid = $question['testid'];
			$questionid = $question['id'];
			$i++;
		?>
			<div class="question">
				<p><?php echo $i.'. '.$question['question']; ?></p>

				<?php
				$choices = $db->select("SELECT * FROM testchoices WHERE questionid = '$questionid'");
				$choicenumber = 0;
				foreach ($choices as $choice) {
					$domid = 'choice-'.$questionnumber.'-'.++$choicenumber; ?>
					<p class="question-choice">
						<input class="with-gap" name="<?php echo 'q'.$questionnumber;?>" type="radio" id="<?php echo $domid;?>"  />
						<label for="<?php echo $domid;?>"><?php echo $choice['value'];?></label>
					</p>
		  <?php } ?>
			</div>
	  <?php }

		?>
		<button id="question-submit" class="btn accent waves-effect waves-light">Finish</button>
	</div>
</div>
</div>
	
<script>
	$('#question-submit').click(function() {
		var answers = [];
		$('.question').each(function() {
			$("input[name='q']:not(:checked)").siblings('label').slideUp();
		});
	});
	
	$(window).blur(function() {
		//alert('Test locked');
	});
</script>
</body>
</html>