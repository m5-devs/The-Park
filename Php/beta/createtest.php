<?php 
require_once('include/dbcon.php');
$stepnumber = 0;
$userid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('include/import.php');?>
	<script type="text/javascript" src="/js/towords.js"></script>
	<title>Create Test</title>
	<style>
		*,
		*:before,
		*:after {
			box-sizing: border-box;
		}

		/*Stepper*/
		.creator .stepper { margin: 20px auto; padding: 15px 15px 0px 15px; }
		.step { position: relative; min-height: 32px /* circle-size */; }
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
		.step .body { padding-bottom: 15px; }
		.step .body:not(.active) { display: none; }
		.step .body p { margin: 10px 0px; }

		#step-number-right {
			float: right;
			width: 100px;
		}
		#step-number-left { overflow: hidden; }
		#step-number-range { border: none; }
		#step-number-text { width: 50px; text-align: center; }
		
		.creator .newquestion.hidden { opacity: 0; transform: translate3d(0, 100%, 0); transition: 300ms ease-in-out all; }
		.creator .newquestion .card-content { padding: 40px 40px 20px 40px; }
		.creator .newquestion { margin: 20px auto; margin-bottom: calc(100vh - 554px); }
		.creator .newquestion .title * { font-size: 20px; }
		.creator .newquestion .title input { width: calc(100% - 50px); }
		.creator .newquestion .number { font-size: 30px; opacity: .8; position: relative; top: 4px; margin-right: 12px; }
		.creator .newquestion .settings * { margin: 0px 6px; }
		.creator .newquestion .settings .points { width: 30px; text-align: center; }
		.creator .newquestion .choices { margin-top: 15px; }
		.answerchoice { width: calc(100% - 40px) !important; }
		.choicecheck { position: relative; cursor: pointer; top: 8px; left: 10px; opacity: .8; transition: ease-in-out all 200ms; -moz-user-select: none; -webkit-user-select: none; -ms-user-select: none; }
		.choicecheck.correct { opacity: 1; color: #4caf50; }
		.creator .newquestion .choices .addremove a { margin: 10px 10px 0px 0px; }

	</style>
</head>

<body class="spaced">
	<?php require('include/header.php');?>
	<div class="creator">
		<div class="stepper card container">
			<div class="card-content">
				<form>
					<div id="step-name" class="step">
						<div>
							<div class="circle"><span><?=++$questionnumber?></span><i class="material-icons">done</i></div>
							<div class="line"></div>
						</div>
						<div>
							<div class="title">Choose a name</div>
							<div class="description">Your test needs a name so it can be identified by you and your students</div>
							<div class="body">
								<div class="input-field">
									<input id="test-name" type="text" name="test-name"/>
									<label for="test-name">Test Name</label>
								</div>
								<a class="btn accent disabled stepper-next">Next</a>
							</div>
						</div>
					</div>

					<div id="step-number" class="step">
						<div>
							<div class="circle"><span><?=++$questionnumber?></span><i class="material-icons">done</i></div>
							<div class="line"></div>
						</div>
						<div>
							<div class="title">Choose the number of questions</div>
							<div class="description">Give it your best guess, you can add and remove questions later</div>
							<div class="body">
								<div id="parent">
									<div id="step-number-right" style="margin-top: 5px;">
										<input id="step-number-text" type="text" value="10"/>
									</div>
									<div id="step-number-left">
										<p class="range-field" style="margin: 20px 15px 0px 15px;">
											<input id="step-number-range" type="range" name="question-number" min="1" max="150" value="10"/>
										</p>
									</div>
								</div>
								<a class="btn accent waves-effect waves-light stepper-next">Next</a>
								<a class="btn-flat waves-effect waves-dark stepper-prev">Previous</a>
							</div>
						</div>
					</div>

					<div id="step-settings" class="step">
						<div>
							<div class="circle"><span><?=++$questionnumber?></span><i class="material-icons">done</i></div>
							<div class="line"></div>
						</div>
						<div>
							<div class="title">Select Test Settings</div>
							<div class="description">Set up a few more options for your test</div>
							<div class="body">
								<p><input type="checkbox" name="randomize" class="filled-in" id="check-randomize"/>
								<label for="check-randomize">Randomize order of questions</label></p>

								<p><input type="checkbox" name="text-select" class="filled-in" id="check-textselect"/>
								<label for="check-textselect">Allow text selection</label></p>

								<p><input type="checkbox" name="copy-paste" class="filled-in" id="check-copypaste"/>
								<label for="check-copypaste">Allow copy and paste</label></p>

								<p><input type="checkbox" name="lock-test" class="filled-in" id="check-locktest"/>
								<label for="check-locktest">Lock test on tab change</label>
								<i class="material-icons tooltipped" style="font-size: 16px; position: relative; top: 3px; left: 2px; cursor: pointer; opacity: .6; display: inline-block;" data-position="bottom" data-delay="50" data-tooltip="Test will be locked if student tries to navigate to another window">info</i>
								</p>

								<a class="btn accent waves-effect waves-light stepper-next">Next</a>
								<a class="btn-flat waves-effect waves-dark stepper-prev">Previous</a>
							</div>
						</div>
					</div>

					<div id="step-classes" class="step">
						<div>
							<div class="circle"><span><?=++$questionnumber?></span><i class="material-icons">done</i></div>
							<div class="line"></div>
						</div>
						<div>
							<div class="title">Add to a classroom</div>
							<div class="description">Select all of the classrooms that you want to add your test to</div>
							<div class="body">
								<?php 
									$classrooms = $db->select("SELECT * FROM classes WHERE teacherid = '$userid'");
									foreach ($classrooms as $classinfo) { ?>
										<p><input type="checkbox" class="filled-in add-class" data-class="<?=$classinfo['id']?>" id="check-class-<?=$classinfo['id']?>"/>
										<label for="check-class-<?=$classinfo['id']?>"><?=$classinfo['name']?></label></p>
							  <?php } ?>

								<button class="btn accent waves-effect waves-light stepper-next" type="submit">Next</button>
								<a class="btn-flat waves-effect waves-dark stepper-prev">Previous</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="card container newquestion hidden white">
			<form onsubmit="return false;">
				<div class="card-content">
					<div class="title">
						<span class="number">1.</span>
						<input class="question" type="text" name="question" placeholder="Enter question here..."/>
					</div>
					
					<div class="settings">
						<!--<span>Type:</span><!-- Dropdown Trigger -->
						<!--<a class="dropdown-button btn accent" data-activates="creator-newquestion-settings-types">Type</a>-->
						<span>Points:</span>
						<input class="points" type="number" name="points" value="1" min="1"/>
						
						<!-- Dropdown Structure -->
						<!--<ul id="creator-newquestion-settings-types" class="dropdown-content">
							<li><a href="#!">Multiple Choice</a></li>
							<li><a href="#!">True or False</a></li>
							<li><a href="#!">Short Answer</a></li>
						</ul>-->
					</div>
					
					<div class="choices">
						<div class="input">
							<?php for ($i=1; $i<=4; $i++) { //create 4 answer choices ?>
								<div><input type="text" placeholder="Answer choice <?=$i?>" class="answerchoice"/><i class="material-icons choicecheck" data-number="<?=$i?>">done</i></div>
							<?php } ?>
						</div>
						
						<div class="addremove">
							<a class="add btn-floating tooltipped"
							   data-position="bottom"
							   data-delay="500"
							   data-tooltip="Add answer choice"><i class="material-icons green">add</i></a>
							<a class="remove btn-floating tooltipped"
							   data-position="bottom"
							   data-delay="500"
							   data-tooltip="Remove answer choice"><i class="material-icons red">remove</i></a>
						</div>
					</div>
				</div>
				<div class="card-action">
					<button class="add btn accent waves-effect waves-light">Add Question</button>
					<button class="finish btn-flat waves-effect waves-dark">Finish</button>
				</div>
			</form>
		</div>
		</div>

	<script type="text/javascript">

		var creator = {};

		//Stepper functions
		function stepper($element) {
			this.container = $element;
			this.activeStep = this.container.find('.step').first(),

			this.next = function() {
				if (this.activeStep.next('.step').size() > 0 && $('#test-name').val().trim().length >= 5) {
					this.complete();
					this.activeStep = this.activeStep.next('.step');
					this.activate();
				}
			};
			this.prev = function() {
				if (this.activeStep.prev('.step').size() > 0) {
					this.deactivate();
					this.activeStep = this.activeStep.prev('.step');
					this.activate();
				}
			};
			this.activate = function() {
				this.activeStep
					.addClass('active')
					.removeClass('complete')
					.find('.body')
					.slideDown();
			};
			this.deactivate = function() {
				this.activeStep
					.removeClass('active')
					.removeClass('complete')
					.find('.body')
					.slideUp();
			};
			this.complete = function() {
				this.activeStep
					.addClass('complete')
					.removeClass('active')
					.find('.body')
					.slideUp();
			};
			this.finish = function(callback) {
				this.complete();
				if (callback) {
					callback();
				}
			};
		}

		//New question form
		function newQuestion($element) {
			this.container = $element;
			this.questionNumber = 1;
			this.add = function() {
				$('#loader').fadeIn();
				this.questionNumber++;
				var data = this.container.find('form').serializeObject(),
					answers = [],
					$this = this;
				data.testid = creator.testid;

				//Create array of answers
				this.container.find('.answerchoice').each(function(i, v) {
					var bool;
					if ($(this).siblings('.choicecheck').prop('correct') == true) { bool = 1; }
					else { bool = 0; }

					answers[i] = {
						"value": $(this).val(),
						"correct": bool
					}
				})
				data.answers = answers;

				//Add question and answer choices in database
				$.post('php/addquestion.php', {data: data}, function(response) {
					$('#loader').fadeOut();
					var response = $.parseJSON(response);
					Materialize.toast(response.message, 5000);
					if (response.success == true) {
						//Clear form
						$this.container.find('.number').text($this.questionNumber+'.');
						$this.clear();
					}
				});
			};
			this.clear = function() {
				this.container.find('form').trigger('reset');
			};
			this.finish = function() {
				if (!this.checkEmpty()) {
					if (confirm("Do you want to save the question that you were working on?")) {
					    alert('Okay, saved');
					} else {
						alert('Discarded');
					}
				}
			};
			this.validate = function() {
				// Check for empty question
				if ($.trim($('.creator .newquestion .question').val()) == "") {
					Materialize.toast("Enter a question", 5000);
				} else {
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
						var points = $('.creator .newquestion .settings .points').val();
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
			};
			this.addChoice = function() {
				var choiceNumber = this.container.find('.choices .input input').length+1;
				if (choiceNumber <= 5) {
					$('<div><input type="text" placeholder="Answer choice '+choiceNumber+'" class="answerchoice"/><i class="material-icons choicecheck" data-number="'+choiceNumber+'">done</i></div>')
						.appendTo(".creator .newquestion .choices .input");
				} else {
					Materialize.toast("You can only add up to 5 answer choices", 5000);
				}
			};
			this.removeChoice = function() {
				var choiceNumber = this.container.find('.choices .input input').length-1;
				if (choiceNumber >= 2) {
					this.container.find('.choices .input div:last-child').remove();
				} else {
					Materialize.toast("You need at least 2 answer choices", 5000);
				}
			};
			this.checkEmpty = function() {
				var empty = true;
				this.container.find('input[type="text"]').each(function() {
					if ($.trim($(this).val()) != '') {
						empty = false;
					}
				});
				return empty;
			}
		}
		
		//Document load
		$(function() {
			///////////////////////// Activation /////////////////////////

			creator.stepper = new stepper($('.stepper'));
			creator.stepper.finish();//.activate();

			creator.newQuestion = new newQuestion($('.creator .newquestion'));
			creator.newQuestion.container.removeClass('hidden');

			///////////////////////// Event functions /////////////////////////

			//Confirm naivation alert
			window.onbeforeunload = function(e) { return "You haven't finished creating your test"; };

			//Go to next/previous step
			$('.stepper-next').on('click', function() {
				creator.stepper.next();
			});
			$('.stepper-prev').on('click', function() {
				creator.stepper.prev();
			});
			//Toggle disabled next button
			$('#test-name').keyup(function() {
				var btns = $('.stepper-next');
				if ($(this).val().trim().length < 5) {
					btns.addClass('disabled').removeClass('waves-effect waves-light');
				} else {
					btns.removeClass('disabled').addClass('waves-effect waves-light');
				}
			});
			//Update number when range is changed
			$('#step-number-range').change(function() {
				var num = parseInt($(this).val());
				$('#step-number-text').val(num);
			});
			$('#step-number-text').keyup(function() {
				var num = parseInt($(this).val());
				$('#step-number-range').val(num);
			});

			creator.stepper.container.find('input').on('keypress', function(event) {
				if (event.keyCode == 13) {
					event.preventDefault(); //Prevent form from submitting
					creator.stepper.next(); //Go to next step
				}
		    });

			//Create test in database and continue to question creator
			$('.creator .stepper form').submit(function() {
				$('#loader').fadeIn();
				testInfo = $(this).serializeObject();
				testInfo.classes = [];
				$('input[type="checkbox"].add-class').each(function(i, v) {
					if ($(this).is(':checked')) {
						var classid = parseInt($(this).data('class'));
						testInfo.classes[i] = classid;
					}
				});
				$.post('php/createtest.php', {data: testInfo}, function(response) {
					$('#loader').fadeOut();
					var response = $.parseJSON(response);
					Materialize.toast(response.message, 5000);
					if (response.success == true) {
						creator.testid = response.testid;
						creator.stepper.finish(function() {
							$('.creator .newquestion').removeClass('hidden');
							document.title = testInfo["test-name"];
							$('#title').text(testInfo["test-name"]);
						});
					}
				})
				return false;
			});

			//New question -  add answer choices
			creator.newQuestion.container.find('.choices .add').on('click', function() {
				creator.newQuestion.addChoice();
			});
			//New question - remove answer choices
			creator.newQuestion.container.find('.choices .remove').on('click', function() {
				creator.newQuestion.removeChoice();
			});
			//New question - on submit
			creator.newQuestion.container.find('.card-action button.add').on('click', function() {
				creator.newQuestion.add();
				//creator.newQuestion.clear();
			});
			//Finish function
			creator.newQuestion.container.find('.card-action button.finish').on('click', function() {
				if (creator.newQuestion.container.find())
				creator.newQuestion.finish();
			})
			
			//Mark answer correct
			$(document).on('click', '.choicecheck', function() {
				var $this = $(this);
				if ($this.prop('correct')) {
					$this.removeClass('correct');
					$this.prop('correct', false);
				} else {
					$this.addClass('correct');
					$this.prop('correct', true);
				}
			});
		});

	</script>
</body>
</html>