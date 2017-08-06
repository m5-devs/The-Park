<?php require_once('include/dbcon.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php require('include/import.php');?>
	<script type="text/javascript" src="/js/towords.js"></script>
	<title></title>
	<style>
		*,
		*:before,
		*:after {
			box-sizing: border-box;
		}

		/*Stepper*/
		#creator-stepper { margin-top: 30px; }
		.step { position: relative; min-height: 32px /* circle-size */; display: none; }
		.step > div:first-child { position: static; height: 0; }
		.step > div:last-child { margin-left: 32px ; padding-left: 16px; }
		.step .circle { background: #bdbdbd; width: 40px; height: 40px; line-height: 40px; font-size: 18px; border-radius: 50%; position: relative; color: white; text-align: center; }
		.step .circle * { color: #fff; }
		.step:not(.complete) .circle i { display: none; }
		.step.complete .circle span { display: none; }
		.step.complete .circle i { color: #fff; position: relative; top: 7px; display: block; }
		.step.active .circle, .step.complete .circle { background: #<?php echo $color; ?>; }
		.step .line { position: absolute; border-left: 1px solid grey; left: 20px; bottom: 10px; top: 46px; opacity: .25; }
		.step:last-child .line { display: none; }
		.step .title { font-size: 20px; line-height: 40px; }
		.step.active .title { font-weight: bold; }
		.step .description { position: relative; bottom: 6px; color: grey; transition: ease-in-out all 300ms; }
		.step:not(.active) .description { opacity: 0; }
		.step .body { padding-bottom: 30px; }
		.step:not(.active) .body { display: none; }

		#creator-stepper-number-right {
			float: right;
			width: 100px;
		}
		#creator-stepper-number-left { overflow: hidden; }
		#creator-stepper-number-range { border: none; }
		#creator-stepper-number-text { width: 50px; text-align: center; }
		
		#creator-newquestion .card-content { padding: 40px 40px 20px 40px; }
		#creator-newquestion { margin: 0 auto; }
		#creator-newquestion-title * { font-size: 20px; }
		#creator-newquestion-title input { width: calc(100% - 50px); }
		#creator-newquestion-number { font-size: 30px; opacity: .8; position: relative; top: 4px; margin-right: 12px; }
		#creator-newquestion-settings * { margin: 0px 6px; }
		#creator-newquestion-settings-points { width: 30px; text-align: center; }
		#creator-newquestion-choices { margin-top: 15px; }
		.answerchoice { width: calc(100% - 40px) !important; }
		.choicecheck { position: relative; cursor: pointer; top: 8px; left: 10px; opacity: .8; transition: ease-in-out all 200ms; -moz-user-select: none; -webkit-user-select: none; -ms-user-select: none; }
		.choicecheck.correct { opacity: 1; color: #4caf50; }
		#creator-newquestion-choices-addremove a { margin: 10px 10px 0px 0px; }

	</style>
</head>

<body class="spaced">
	<?php require('include/header.php');?>
	<div id="creator-stepper" class="stepper container">
	<div id="creator-stepper-name" class="step active">
		<div>
			<div class="circle"><span>1</span><i class="material-icons">done</i></div>
			<div class="line"></div>
		</div>
		<div>
			<div class="title">Choose a name</div>
			<div class="description">Your test needs a name so it can be identified by you and your students</div>
			<div class="body">
				<div class="input-field">
					<input id="test-name" type="text"/>
					<label for="test-name">Test Name</label>
				</div>
			</div>
		</div>
	</div>

	<div id="creator-stepper-number" class="step active">
		<div>
			<div class="circle"><span>2</span><i class="material-icons">done</i></div>
			<div class="line"></div>
		</div>
		<div>
			<div class="title">Choose the number of questions</div>
			<div class="description">Give it a ballpark guess, you can add and remove questions later</div>
			<div class="body">
				<div id="parent">
					<div id="creator-stepper-number-right" style="margin-top: 5px;">
						<input id="creator-stepper-number-text" type="text" value="10"/>
					</div>
					<div id="creator-stepper-number-left">
						<form action="#">
							<p class="range-field" style="margin: 20px 15px 0px 15px;">
								<input id="creator-stepper-number-range" type="range" name="points" min="1" max="150" value="10"/>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="creator-stepper-settings" class="step active">
		<div>
			<div class="circle"><span>3</span><i class="material-icons">done</i></div>
			<div class="line"></div>
		</div>
		<div>
			<div class="title">Select Test Settings</div>
			<div class="description">Set up a few more options and you can start creating your test</div>
			<div id="creator-stepper-settings" class="body">
				<p><input type="checkbox" class="filled-in" id="creator-stepper-settings-check-random"/>
				<label for="creator-stepper-settings-check-random">Randomize order of questions</label></p>

				<p><input type="checkbox" class="filled-in" id="creator-stepper-settings-check-textselect"/>
				<label for="creator-stepper-settings-check-textselect">Allow text selection</label></p>

				<p><input type="checkbox" class="filled-in" id="creator-stepper-settings-check-copypaste"/>
				<label for="creator-stepper-settings-check-copypaste">Allow copy and paste</label></p>

				<p><input type="checkbox" class="filled-in" id="creator-stepper-settings-check-locktest"/>
				<label for="creator-stepper-settings-check-locktest">Lock test on tab change</label>
				<i class="material-icons tooltipped" style="font-size: 16px; position: relative; top: 3px; left: 2px; cursor: pointer; opacity: .6; display: inline-block;" data-position="bottom" data-delay="50" data-tooltip="Test will be locked if student tries to navigate to another window">info</i>
				</p>

			</div>
		</div>
	</div>
	</div>

	<div id="creator-newquestion" class="card container">
		<form id="creator-newquestion-form" onsubmit="return false;">
		<div class="card-content">
			<div id="creator-newquestion-title">
				<span id="creator-newquestion-number">1.</span>
				<input id="creator-newquestion-question" type="text" placeholder="Enter question here..."/>
			</div>
			
			<div id="creator-newquestion-settings">
				<!--<span>Type:</span><!-- Dropdown Trigger -->
				<!--<a class="dropdown-button btn accent" data-activates="creator-newquestion-settings-types">Type</a>-->
				<span>Points:</span>
				<input id="creator-newquestion-settings-points" type="number" value="1" min="1"/>
				
				<!-- Dropdown Structure -->
				<!--<ul id="creator-newquestion-settings-types" class="dropdown-content">
					<li><a href="#!">Multiple Choice</a></li>
					<li><a href="#!">True or False</a></li>
					<li><a href="#!">Short Answer</a></li>
				</ul>-->
			</div>
			
			<div id="creator-newquestion-choices">
				<div id="creator-newquestion-choices-input">
					<?php for ($i=1; $i<=4; $i++) { //create 4 answer choices ?>
						<div><input type="text" placeholder="Answer choice <?=$i?>" class="answerchoice"/><i class="material-icons choicecheck" data-number="<?=$i?>">done</i></div>
					<?php } ?>
				</div>
				
				<div id="creator-newquestion-choices-addremove">
					<a id="creator-newquestion-choices-add" class="btn-floating tooltipped"
					   data-position="bottom"
					   data-delay="500"
					   data-tooltip="Add answer choice"><i class="material-icons green">add</i></a>
					<a id="creator-newquestion-choices-remove" class="btn-floating tooltipped"
					   data-position="bottom"
					   data-delay="500"
					   data-tooltip="Remove answer choice"><i class="material-icons red">remove</i></a>
				</div>
			</div>
		</div>
		<div class="card-action">
			<button id="creator-newquestion-add" class="btn accent waves-effect waves-light">Add Question</button>
			<button id="creator-newquestion-finish" class="btn-flat waves-effect waves-dark">Finish</button>
		</div>
		</form>
	</div>

	<script type="text/javascript">

		//Update number when range is changed
		$('#creator-stepper-number-range').change(function() {
			var num = parseInt($(this).val());
			$('#creator-stepper-number-text').val(num);
		});
		$('#creator-stepper-number-text').keyup(function() {
			var num = parseInt($(this).val());
			$('#creator-stepper-number-range').val(num);
		});
		
		//Add answer choices
		$('#creator-newquestion-choices-add').click(function() {
			var choiceNumber = $('#creator-newquestion-choices-input input').length+1;
			if (choiceNumber <= 5) {
				$('<div><input type="text" placeholder="Answer choice '+choiceNumber+'" class="answerchoice"/><i class="material-icons choicecheck" data-number="'+choiceNumber+'">done</i></div>')
					.appendTo("#creator-newquestion-choices-input");
			} else {
				Materialize.toast("You can only add up to 5 answer choices", 5000);
			}
		});
		//Remove answer choices
		$('#creator-newquestion-choices-remove').click(function() {
			var choiceNumber = $('#creator-newquestion-choices-input input').length-1;
			if (choiceNumber >= 2) {
				$('#creator-newquestion-choices-input div:last-child').remove();
			} else {
				Materialize.toast("You need at least 2 answer choices", 5000);
			}
		});
		
		$(document).on('click','#creator-newquestion-choices-input .choicecheck', function() {
			var $this = $(this);
			if ($this.prop('correct')) {
				$this.removeClass('correct');
				$this.prop('correct', false);
			} else {
				$this.addClass('correct');
				$this.prop('correct', true);
			}
		});
		
		$('#creator-newquestion-form').submit(function() {
			// Check for empty question
			if ($.trim($('#creator-newquestion-question').val()) == "") { Materialize.toast("Enter a question", 5000); } else {
				// Check for empty answer choices
				var num = 0, extend;
				$('.answerchoice').each(function(i) {
					if ($.trim($(this).val()) == "") {
						num++; if (num > 1) { extend = "s"; } else { extend = ""; }
					}
				});
				
				// Alert if there are empty fields
				var numWord = toWords(num).replace(/(^[a-z])/,function(p) { return p.toUpperCase(); }); //Convert to word and uppercase
				if (num > 0) { Materialize.toast(numWord+" empty answer choice"+extend, 5000); } else {
					var points = $('#creator-newquestion-settings-points').val();
					if (parseInt(points)) {
						points = parseInt(points);
						if (points < 1) {
							Materialize.toast("Invalid points value", 5000);
						} else {
							// Field checks complete
							Materialize.toast("Valid form", 5000);
						}
					} else {
						Materialize.toast("Invalid points value", 5000);
					}
				}
			}
			
			return false;
		});

	</script>
</body>
</html>