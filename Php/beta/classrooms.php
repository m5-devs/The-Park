<?php
	require('include/dbcon.php');

	if (!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Classrooms</title>
	<?php require('include/import.php');?>
	
	<style>
		.group {
			margin: 0 auto;
		}
		.group .title { font-size: 23px; margin-left: 15px; padding: 8px; }
		.group .avatarcontainer {
			height: auto;
		}
		
		#group-classes .class * { color: #fff; }
		#group-classes li {
			width: 100%;
			padding: 23px;
		}
		.avatarcontainer, .infocontainer {
			display: table-cell;
			vertical-align: top;
			position: relative;
		}
		.avatarcontainer {
			width: 50px;
			padding: 0px 5px;
		}
		.infocontainer {
			padding-left: 15px;
			width: auto;
		}
		.infocontainer h6 {
			margin: 0;
			font-size: 20px;
		}
		#newclass { padding: 23px; display: none; }
		#newclassfab { float: right; position: relative; right: 45px; bottom: 42px; }
	</style>
</head>
<body class="spaced">
	<?php require('include/header.php');?>
	
	<div class="group container">
		<h5 class="title"><strong>All Classes</strong></h5>
		<div class="card" id="group-classes">
			<ul id="classlist" style="margin: 0;">
				
				<?php
				$userid = $sesuser['id'];
				if ($sesuser['privilege'] == '2') { $teacher = true; } else { $teacher = false; }
				if ($teacher) {//Teacher account
					//Get ids of classes
					$classquery = $db->select("SELECT * FROM classes WHERE teacherid = '$userid' ORDER BY period, ab ASC");
				} else {//Student account
					
					//Get ids and periods of classes
					$classquery = $db->select("SELECT classid FROM students WHERE studentid = '$userid'");
					$classids = Array();
					foreach ($classquery as $row){ $classids[] = "'".$row['classid']."'"; }
					$classids = implode(',', $classids);
					//Second sql query run because students table doesn't have sufficient information
					if (count($classquery) != 0) {$classquery = $db->select("SELECT * FROM classes WHERE id in ($classids) ORDER BY period, ab ASC");}
				}
				//List classes
				if (count($classquery) == 0) { ?>
					<li id="noclasses">
						<div class="infocontainer">
							<h6>You haven't <?php if($teacher){echo'created';}else{echo'joined';}?> any classes!</h6>
							<span class="black-text lighten-2">Click the plus button to <?php if($teacher){echo'create';}else{echo'join';}?> a class</span>
						</div>
					</li>
		  <?php } else {
					foreach ($classquery as $classinfo) {
						//Get information about teacher
						$teacherinfo = getInfo((int) $classinfo['teacherid']);
						$classid = $classinfo['id'];
						if ($teacher) {
							//Get class code
							$classcode = $db->select("SELECT code FROM classcodes WHERE classid = '$classid'");
							$classcode = $classcode[0]['code'];
						}
					?>
					<a href="/classroom.php?id=<?=$classid?>&name=<?=nonAlphaNum($classinfo['name'])?>">
						<li class="class waves-effect waves-light" style="background: linear-gradient(to right, rgba(0,0,0,.5), rgba(0,0,0,.4),rgba(0,0,0,.1), rgba(0,0,0,0)), url('<?=$classinfo['cover']?>') center center no-repeat; background-position: center;">
							<div class="avatarcontainer">
								<img src="<?=$teacherinfo['avatar']?>" class="avatar" style="width: 40px;"/>
							</div>

							<div class="infocontainer">
								<h6><?php if($teacher){echo $classinfo['name'];}else{echo formalName($teacherinfo['last_name'],$teacherinfo['gender']);}?></h6>
								<span><?php if(!$teacher){echo $classinfo['name'].' - ';}echo formatPeriod($classinfo['period'],$classinfo['ab']).' - '.$classcode?></span>
							</div>
						</li>
					</a>
			  <?php }
				} ?>
				
				<li id="newclass">
					<div class="infocontainer">
						<h6>Join New Class</h6>
						<form id="newclassform">
							<input type="text" id="classcodeinput" placeholder="Enter class code..." maxlength="6"/>
							<button type="submit" class="btn accent waves-effect waves-light">Join</button>
							<button id="cancelnewclass" onclick="return false;" class="btn-flat waves-effect waves-dark" onclick="return: false;">Cancel</button>
						</form>
					</div> 
				</li>
			</ul>
		</div>
		<a id="newclassfab" class="btn-floating btn-large waves-effect waves-light accent">
			<i class="material-icons">add</i>
		</a>
	</div>
	
	<div class="group container">
		<h5 class="title"><strong>Recent Activity</strong></h5>
		<div id="recentactivity"></div>
		<script>
			$.post('include/posts.php',{
				type: 'classrooms',
			}, function(data) {
				$('#recentactivity').html(data);
				loadMsnry();
			});
		</script>
	</div>
	
	<script>
		
		$('#newclassfab').click(function(){
			<?php if ($teacher) { ?>
				//Go to create class page
				window.location.href = "/createclass.php";
			<?php } else { ?>
				//Open join classroom box
				$(this).css({'transform':'scale(0, 0)'});
				$('#newclass').slideDown(); //Animate in
				$('#noclasses').slideUp(400, function() {
					$(this).hide();
				});
			<?php } ?>
		});
		
		//Close join classroom box
		$(document).on('click','#cancelnewclass',function() {
			$('#newclassfab').css({'transform':'scale(1, 1)'});
			$('#newclass').slideUp(300);
			$('#noclasses').slideDown(300);
		});
		
		$('#newclassform').submit(function() {
			var code = $('#classcodeinput').val().replace(/\W+/g, ''); //Replaces non-alphanumeric characters
			$.post('/php/joinclass.php', {code: code}, function(data) {
				if (data == true) {
					location.reload();
				} else {
					Materialize.toast(data, 5000);
				}
			});
			return false;
		});

	</script>
</body>
</html>