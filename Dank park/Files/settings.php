<?php

require('include/dbcon.php');

if (!isset($_SESSION['id'])) {
	header("Location: /index.php");
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Settings</title>
<?php require('include/import.php');?>

<style>	
	.group {
		margin: 35px auto;
		width: 50%;
		padding: 10px 50px;
	}
	
	.group h5 {
		font-size: 20px;
		font-weight: 500;
		margin: 35px 0px;
		transition: ease-in-out all 300ms;
	}
	
	.settingslist li {
		margin: 50px 0px;
	}
	
	.control {
		float: right;
		text-align: right;
	}
	
	.control .lever {
		margin: 0 !important;
	}
	
	#colorcontrol {
		width: 25px; height: 25px;
		border-radius: 50%;
		transition: ease-in-out all 300ms;
		-webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.58);
		   -moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.58);
				box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.58);
	}
	#colorpicker {
		position: absolute;
		z-index: 4;
		padding: 20px;
		transform: translate(-200px, -25px);
		display: none;
		opacity: 0;
		transition: ease-in-out all 300ms;
	}
	#colorpicker td { padding: 8px 12px; }
	.swap {
		width: 25px; height: 25px;
		border-radius: 50%;
		display: inline-block;
		cursor: pointer;
		transition: ease-in-out all 200ms;
		-webkit-box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.4);
		   -moz-box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.4);
				box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.4);
	}
	.swap:hover {
		-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.58);
		   -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.58);
				box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.58);
	}
	.swap:active { border: solid 2px white; }
	#red { background: #F44336 }
	#deeporange { background: #FF5722 }
	#orange { background: #EF6C00 }
	#amber { background: #FFA000 }
	#lightgreen { background: #689F38 }
	#green { background: #43A047 }
	#teal { background: #009688 }
	#cyan { background: #0097A7 }
	#lightblue { background: #039BE5 }
	#blue { background: #1976D2 }
	#indigo { background: #3F51B5 }
	#deeppurple { background: #673AB7 }
	#purple { background: #9C27B0 }
	#pink { background: #E91E63 }
	#brown { background: #795548 }
	#grey { background: #607D8B }
	
	@media (max-width: 1200px) {
		.group {
			width: 70%;
		}
	}
	
	@media (max-width: 650px) {
		.group {
			width: 90%;
		}
	}
	
	@media (max-width: 500px) {
		.group {
			width: 100%;
		}
	}

</style>

</head>
<body class="spaced">

	<?php include('include/header.php');?>

	<div class="card group">
		<h5 class="accent-text">General</h5>
		<ul class="settingslist">
			<li>
				<strong>Accent color</strong>
				<span id="colorcontrol" class="control accent">
					<span id="colorpicker" class="card">
						<table style="width:100%">
							<tr>
								<td><span class="swap" id="red"></span></td>
								<td><span class="swap" id="deeporange"></span></td> 
								<td><span class="swap" id="orange"></span></td>
								<td><span class="swap" id="amber"></span></td>
							</tr>
							<tr>
								<td><span class="swap" id="lightgreen"></span></td>
								<td><span class="swap" id="green"></span></td>
								<td><span class="swap" id="teal"></span></td>
								<td><span class="swap" id="cyan"></span></td>
							</tr>
							<tr>
								<td><span class="swap" id="lightblue"></span></td>
								<td><span class="swap" id="blue"></span></td>
								<td><span class="swap" id="indigo"></span></td>
								<td><span class="swap" id="deeppurple"></span></td>
							</tr>
							<tr>
								<td><span class="swap" id="purple"></span></td>
								<td><span class="swap" id="pink"></span></td> 
								<td><span class="swap" id="brown"></span></td>
								<td><span class="swap" id="grey"></span></td>
							</tr>
						</table>
					</span>
				</span>
				
			</li>
			<li>
				<strong>Safe Filter</strong>
				<i class="material-icons tooltipped" style="font-size: 16px; position: relative; top: 3px; left: 2px; cursor: pointer; opacity: .6;" data-position="bottom" data-delay="50" data-tooltip="Blocks inappropriate words">info</i>
				<span class="control">
					<div class="switch">
						<label>
							<input id="censorswitch" type="checkbox"<?php if ($sesuser['filter']=='1') {echo ' checked'; }?>>
							<span class="lever"></span>
						</label>
					</div>
				</span>
			</li>
			<li>
				<strong>Recieve emails</strong>
				<span class="control">
					<div class="switch">
						<label>
							<input disabled type="checkbox">
							<span class="lever"></span>
						</label>
					</div>
				</span>
			</li>
		</ul>
	</div>

	<div class="card group">
		<h5 class="accent-text">Account</h5>
		<ul class="settingslist">
			<li>
				<strong>Email</strong>
				<span class="control">
					<strong><?php echo $sesuser['email'];?></strong>
					<br/>
					<?php //echo 'Primary';?>
				</span>
			</li>
			<li>
				<strong>Recovery Phone</strong>
				<span class="control">
					<strong class="grey-text">Set up recovery</strong>
				</span>
			</li>
			<li>
				<strong>Two-step authentication</strong>
				<span class="control">
					<div class="switch">
						<label>
							<input disabled type="checkbox">
							<span class="lever"></span>
						</label>
					</div>
				</span>
			</li>
			<li>
				<strong>Reset password</strong>
				<span class="control">
					<a class="waves-effect waves-light btn accent modal-trigger" href="#resetmodal">Reset</a>
				</span>
			</li>
			<li>
				<strong>Delete account</strong>
				<span class="control">
					<a class="waves-effect waves-light btn red modal-trigger" href="#deletemodal">Delete</a>
				</span>
			</li>
		</ul>
	</div>
	
	<?php if ((int) $sesuser['privilege'] == 3 or 4): //Only print the following html if beta or admin user ?>
	<div class="card group">
		<h5 class="accent-text">Experimental</h5>
		<ul class="settingslist">
			<li>
				<strong>Change avatar</strong>
				<span class="control">
					<input id="avatarinput" type="text" placeholder="<?php echo $sesuser['avatar'];?>" style="width: 300px; position: relative; bottom: 14px;"></input>
				</span>
			</li>
			<li>
				<strong>Change cover photo</strong>
				<span class="control">
					<input id="coverinput" type="text" placeholder="<?php echo $sesuser['cover'];?>" style="width: 300px; position: relative; bottom: 14px;"></input>
				</span>
			</li>
			<li>
				<strong>Dark Theme</strong>
				<span class="control">
					<div class="switch">
						<label>
							<input id="themeswitch" type="checkbox"<?php if ($sesuser['theme']=='dark') {echo ' checked'; }?>>
							<span class="lever"></span>
						</label>
					</div>
				</span>
			</li>
		</ul>
	</div>
	<?php endif; ?>

	<!-- Delete Account Modal -->
	<div id="deletemodal" class="modal">
		<form id="deleteform">
			<div class="modal-content">
				<h4>Delete Account</h4>
				<p>
					<input type="checkbox" id="confirmcheckbox" class="filled-in"/>
					<label for="confirmcheckbox">Yes, I really want to delete my account</label>
				</p>
				<input id="passconfirm" type="password" placeholder="Enter your password"/>
			</div>
			<div class="modal-footer">
				<a class="modal-action modal-close waves-effect waves-dark btn-flat">Cancel</a>
				<button id="deleteforreal" class="waves-effect waves-light btn-flat red white-text">Delete</button>
			</div>
		</form>
	</div>
	
	<!-- Reset Password Modal -->
	<div id="resetmodal" class="modal">
		<form id="resetform">
			<div class="modal-content">
				<h4>Reset Password</h4>
				<input id="oldpass" type="password" placeholder="Enter your old password"></input>
				<input id="newpass" type="password" placeholder="Enter new password"></input>
				<input id="confirmnewpass" type="password" placeholder="Confirm new password"></input>
			</div>
			<div class="modal-footer">
				<a class="modal-action modal-close waves-effect waves-dark btn-flat">Cancel</a>
				<button type="submit" id="resetpassbtn" class="waves-effect waves-light btn-flat accent white-text">Reset</button>
			</div>
		</form>
	</div>
	
	<script>
		
		//Open color picker on hover
		$("#colorcontrol").hover(
			function () {
				$('#colorpicker').css('display','block').animate({'opacity':'1'}, 10);
			}, 
			function () {
				$('#colorpicker').animate({'opacity':'0'}, 10, function() {
					setTimeout(function() {
						$('#colorpicker').css('display','none');
					}, 300);
				});
			}
		);
		
		//Change user's color setting when color is chosen
		$('.swap').click(function(){
			var color = $(this).attr('id'),
				rgb = $(this).css('background-color');
			$('#colorpicker').animate({'opacity':'0'}, 10, function() {
				setTimeout(function() {
					$('#colorpicker').css('display','none');
				}, 300);
			});
			//Ajax to change color
			$.post('php/updatesettings.php', {color: color}, function() {
				$('.accent').css({'background':rgb});
				$('.accent-text').css({'color':rgb});
			});
		});
		
		$('input[type="checkbox"]').click(function() {
			if ($(this).attr('id') == 'censorswitch') {
				var censor = $(this).prop('checked');
				$.post('php/updatesettings.php', {censor: censor});
			} else if ($(this).attr('id') == 'themeswitch') {
				var theme = $(this).prop('checked');
				$.post('php/updatesettings.php', {theme: theme}, function(data) {
					if (data == 'fail') {
						Materialize.toast('Something went wrong, try again later');
					} else {
						location.reload();
					}
				})
			}
		});
		
		$('input[type="text"]').keyup(function() {
			delay(function(){
				var avatar = $('#avatarinput').val(),
					cover = $('#coverinput').val();
				$.post('php/updatesettings.php', {avatar: avatar, cover: cover});
			}, 1000);
		});
		
		var delay = (function() {
			var timer = 0;
			return function(callback, ms){
				clearTimeout (timer);
				timer = setTimeout(callback, ms);
			};
		})();
		
		$('#deleteform').submit(function() {
			var password = $('#passconfirm').val();
			var delcheck = $('#confirmcheckbox').prop('checked');
			if (delcheck == true) {
				if (password.length > 0) {
					$.post('php/updatesettings.php', {password: password}, function(data) {
						if (data == 'empty') {
							Materialize.toast('Type in your password',5000);
						} else if (data == 'wrong') {
							Materialize.toast('Incorrect password',5000);
						} else if (data == 'fail') {
							Materialize.toast('Failed to delete account',5000);
						} else {
							window.location.replace("php/logout.php");
						}
					})
				} else {
					Materialize.toast('Type in your password',5000);
				}
			} else {
				Materialize.toast('Mark the checkbox first',5000);
			}
			return false;
		})
		
		$('#resetform').submit(function() {
			var old = $('#oldpass').val(),
				newpass = $('#newpass').val(),
				confirm = $('#confirmnewpass').val();
			if (old.length>0 && newpass.length>0 && confirm.length >0) {
				if (newpass == confirm) {
					$.post('php/updatesettings.php', {old: old, new: newpass, confirm: confirm}, function(data) {
						if (data == 'changed') {
							Materialize.toast('Password changed',5000);
							$('#resetmodal').closeModal();
						} else {
							Materialize.toast(data,5000);
						}
					})
				} else {
					Materialize.toast('New passwords do not match',5000);
				}
			} else {
				Materialize.toast('One or more fields missing',5000);
			}
			return false;
		})
		
	</script>

</body>
</html>
