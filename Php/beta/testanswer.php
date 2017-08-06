<?php
require('include/dbcon.php');
require('include/import.php'); 
$testnumber = $_GET['t'];
$testinfo = $db->select("SELECT * FROM tests WHERE testid='$testnumber'");
$studentid = $sesuser['id'];
$checkstudent = $db->select("SELECT * FROM testscores WHERE testid='$testnumber' AND studentid='$studentid'");
$checkstudent2 = count($checkstudent);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Answer Sheet</title>
</head>

<body>
<?php

require('include/header.php');

?>
<div style="width: 85%; margin: auto; position: relative; top: 100px;">
    <?php
	$numbig = "999999999999";
	if ($studentid != ( $studentid < $numbig)) {
		echo "You must log on";
	}
	else {
	if ($checkstudent2 == "0") {
		echo "You have not taken the test yet";
	}
	else {
		while ($test = mysqli_fetch_assoc($testinfo)) {
			$testanswer = $test['answer'];
			$answer = $test[$testanswer];
			?>
            (<?php echo $test['question#']; ?>). Answer: <?php echo $test['answer']; ?>, <?php echo $answer; ?> <br/>
            <?php
		}
	}
	}
	?>
</div>



</body>
</html>
