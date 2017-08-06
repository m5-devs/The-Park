<?php

//Determine what page user is on in order to highlight current page in naviagtion
$pagename = $_SERVER['PHP_SELF'];
if (strpos($pagename, 'profile.php')) {
	$page = 'profile';
} else if (strpos($pagename, 'classroom.php') or  strpos($pagename, 'classrooms.php') or strpos($pagename, 'assignments.php') or strpos($pagename, 'assignment.php')) {
	$page = 'classroom';
} else if (strpos($pagename, 'chat.php')) {
	$page = 'chat';
} else if (strpos($pagename, 'helpcenter.php')) {
	$page = 'help';
} else if (strpos($pagename, 'settings.php')) {
	$page = 'settings';
}

?>
<style>
/************** Global PHP/CSS **************/
	
.accent { background: #<?php echo $color;?>; }
.accent *, .material-tooltip * { color: #fff; }
.accent-text {
	color: #<?php echo $color;?>;
}

/* Light/dark theme */
.theme-1, .modal-footer{ background: #<?php if ($sesuser['theme']=='dark') {echo '3f3f3f';} else {echo 'ffffff';} ?> !important; }
.theme-2, body, .modal 	{ background: #<?php if ($sesuser['theme']=='dark') {echo '2c2c2c';} else {echo 'f5f5f5';} ?> !important; }
.theme-3 		{ background: #<?php if ($sesuser['theme']=='dark') {echo '1e1e1e';} else {echo 'ededed';} ?> !important; }
.theme-4 		{ background: #<?php if ($sesuser['theme']=='dark') {echo '161616';} else {echo 'dedede';} ?> !important; }
.theme-5 		{ background: #<?php if ($sesuser['theme']=='dark') {echo '121212';} else {echo 'd3d3d3';} ?> !important; }
.theme-6		{ background: #<?php if ($sesuser['theme']=='dark') {echo '000000';} else {echo 'c2c2c2';} ?> !important; }
.theme-dark-1	{ background: #<?php if ($sesuser['theme']=='dark') {echo '5a5a5a';} else {echo 'ffffff';} ?> !important; }
.theme-dark-2	{ background: #<?php if ($sesuser['theme']=='dark') {echo '434343';} else {echo 'f5f5f5';} ?> !important; }
.theme-dark-3	{ background: #<?php if ($sesuser['theme']=='dark') {echo '3f3f3f';} else {echo 'ededed';} ?> !important; }
.theme-dark-4	{ background: #<?php if ($sesuser['theme']=='dark') {echo '2c2c2c';} else {echo 'dedede';} ?> !important; }
.theme-dark-5	{ background: #<?php if ($sesuser['theme']=='dark') {echo '1e1e1e';} else {echo 'd3d3d3';} ?> !important; }
.theme-dark-6	{ background: #<?php if ($sesuser['theme']=='dark') {echo '121212';} else {echo 'c2c2c2';} ?> !important; }
.card			{ background: #<?php if ($sesuser['theme']=='dark') {echo '3c3c3c';} else {echo 'fdfdfd';} ?> !important; }

body * { color: #<?php if ($sesuser['theme']=='dark') {echo 'fff;';} else {echo '000;';} ?> }

.switch label input[type=checkbox]:checked+.lever {
	background: #<?php echo $color;?>;
}
.switch label input[type=checkbox]:checked+.lever:after {
	background: #<?php echo $color;?>;
}
.btn:hover, .btn-large:hover {
	background: #<?php echo $color;?>;
}
.tabs .tab a:hover{ color: #<?php echo $color;?>; }
.tabs .indicator{ background-color: #<?php echo $color;?>; }
	
/* Label focus color */
.input-field input[type=text]:focus + label {
 color: #<?php echo $color;?>;
}
/* Label underline focus color */
input[type=text]:focus:not([readonly]),input[type=password]:focus:not([readonly]),input[type=email]:focus:not([readonly]),input[type=url]:focus:not([readonly]),input[type=time]:focus:not([readonly]),input[type=date]:focus:not([readonly]),input[type=datetime-local]:focus:not([readonly]),input[type=tel]:focus:not([readonly]),input[type=number]:focus:not([readonly]),input[type=search]:focus:not([readonly]),textarea.materialize-textarea:focus:not([readonly]) {
 border-bottom: 1px solid #<?php echo $color;?>;
 box-shadow: 0 1px 0 0 #<?php echo $color;?>;
}
/* Valid color */
.input-field input[type=text].valid {
 border-bottom: 1px solid #<?php echo $color;?>;
 box-shadow: 0 1px 0 0 #<?php echo $color;?>;
}
/* Invalid color */
.input-field input[type=text].invalid {
 border-bottom: 1px solid #<?php echo $color;?>;
 box-shadow: 0 1px 0 0 #<?php echo $color;?>;
}
/* Icon prefix focus color */
.input-field .prefix.active {
 color: #<?php echo $color;?>;
}
/* Checkbox color */
input[type="checkbox"].filled-in:checked+label:after {
	color: #<?php echo $color;?>;
	border: 2px solid #<?php echo $color;?>;
	background-color: #<?php echo $color;?>;
}
/* Radio button color */
[type="radio"].with-gap:checked+label:before { border: 2px solid #<?php echo $color;?>; }
[type="radio"].with-gap:checked+label:after { border: 2px solid #<?php echo $color;?>; background-color: #<?php echo $color;?>; }
/* Range slider color */
input[type=range]::-webkit-slider-thumb { background: #<?php echo $color;?>; }
input[type=range]::-ms-thumb { background: #<?php echo $color;?>; }
input[type=range]::-moz-range-thumb { background: #<?php echo $color;?>; }
input[type=range]+.thumb { background-color: #<?php echo $color;?>; }

/************** Header, Modal, and Misc. CSS **************/
	
#sidenav-overlay {
    z-index: 8;
}

#hamburger {
    position: relative; 
    right: 5px;
    font-size: 30px;
    color: #666;
}
	
#loader {
	position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(128,128,128,.5);
    z-index: 8;
    display: none;
}
.spinner-theme {
	border-color: #<?php echo $color;?> !important;
}
#loader-wrapper {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

#header {
	position: fixed;
	z-index: 10;
	top: 0px;
	transition: .3s all cubic-bezier(0.250, 0.460, 0.450, 0.940);
}
	
#header-left {
	position: absolute;
	width: 100%;
}
#headerlogo {
	margin: 20px; 
	width: 40px;
	display: none;
}
#title {
	position: relative;
	font-size: 18px;
	bottom: -1px;
}
	
#hamburger {
	line-height: 64px;
	font-size: 26px;
	margin: 0px 20px;
}
	
#search {
	position: absolute;
	width: 100%;
}
	
#searchbox {
	width: 60%;
	max-width: 750px;
	position: relative;
	margin: 0 auto;
	background: rgba(255, 255, 255, .2);
	border-radius: 4px;
	line-height: 48px;
	margin-top: 8px;
}
@media (max-width: 1100px) {
	#searchbox {
		width: 600px;
		right: 20px;
	}
}
#searchicon { display: none; }
@media (max-width: 900px) {
	#searchbox {
		display: none;
	}
	#searchicon {
		/*display: block;*/
	}
}
	
#searchinput {
	display: inline-block;
	position: relative;
	z-index: 1;
	width: 90%;
	margin: 0;
	border: none;
}
	
#searchboxicon {
	position: relative;
	margin: 0px 14px;
	top: 6px;
}
	
#header-right {
	position: absolute;
	width: 100%;
	text-align: right;
}
	
#header-right .material-icons {
	line-height: 64px;
	font-size: 26px;
	margin: 0px 20px 0px 0px;
}
	
#header-right .material-icons, #header-left .material-icons {
	color: #FFF;
	z-index: 11;
	cursor: pointer;
}
	
#searchbox { transition: .3s all ease-in-out; }
	
/* Search box text */
#searchinput { color: #fff; }
#searchinput:focus { color: #fff; box-shadow: none; }
#searchinput::-webkit-input-placeholder { /* WebKit, Blink, Edge */ color: #fff; }
#searchinput:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color: #fff; opacity: 1;}
#searchinput::-moz-placeholder { /* Mozilla Firefox 19+ */ color: #fff; opacity: 1; }
#searchinput:-ms-input-placeholder { /* Internet Explorer 10-11 */ color: #fff; }

	
#slide-out li {
	width: 100% !important;
}
#slide-out .material-icons {
	position: relative;
	right: 8px;
	top: 7px;
	margin: 0px 10px 0px 0px;
	transition: 150ms ease-in-out all;
}
#slide-out .page-active .material-icons {
	transition: 300ms all ease-in-out;
	color: #<?php echo $color?>;
}
	
#fabcontainer {
	bottom: 22px;
	right: 24px;
	z-index: 5;
	transition: 300ms all cubic-bezier(0.250, 0.460, 0.450, 0.940);
}

#sidenav-overlay, #slide-out { transition: 300ms ease-in-out all; }
#slide-out { z-index: 9; padding-top: 64px; }
@media (min-width: 992px) {
	#sidenav-overlay { display: none; }
	#slide-out {
		width: 70px !important;
		left: 0px;
	}
	#slide-out li a span {
		opacity: 0;
		font-size: 5px;
	}
	#hamburger { display: none; }
	#headerlogo { display: inline-block; }
	#title { bottom: 27px; }
}
	
</style>

<div id="loader">
	<div id="loader-wrapper">
		<div class="preloader-wrapper active">
			<div class="spinner-layer spinner-blue-only spinner-theme">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Header bar -->
<nav id="header" class="accent white-text" role="navigation">
	<!-- Left side -->
	<span id="header-left">
		<i id="hamburger"data-activates="slide-out" class="material-icons button-collapse">menu</i>
		<img id="headerlogo" src="../res/img/graphics/header_logo.svg"/>
		<span id="title"><script>$(function(){var title = $('title').text();$('#title').text(title);});</script></span>
	</span>
	
	<!-- Search bar -->
	<span id="search">
		<div id="searchbox" class="waves-effect waves-light">
			<span>
				<i id="searchboxicon" class="material-icons">search</i>
				<form method="get" action="../search.php" style="display: inline;"><input id="searchinput" type="text" name="q" placeholder="Search"></input></form>
			</span>
		</div>
	</span>

	<!-- Right side -->
	<span id="header-right">
		<i id="searchicon" class="material-icons">search</i>
		<span>
				<a href="instantmessage.php?i=<?php echo $currentuser['id']; ?>" class="modal-trigger"><i class="material-icons">chat_bubble_outline</i></a>
			<a href="#notificationsmodal" class="modal-trigger"><i class="material-icons">notifications_none</i></a>
			<div style="position: relative; left: 200px;">
			</div>
		</span> 
	</span>
</nav>

<!-- Nav drawer --> 
<ul id="slide-out" class="side-nav theme-1 z-depth-1-half fixed">
	<?php if (isset($sesuser['id'])) { ?>
		<li id="menu-profile" 	class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Profile">	<a href="/../profile.php">		<i class="material-icons">account_circle</i><span>Profile<span>		</a></li>
		<li id="menu-classroom" class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Classrooms">	<a href="/../classrooms.php">	<i class="material-icons">class</i>			<span>Classrooms<span>	</a></li>
		<?php#<li id="menu-chat" class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Chat">		<a href="/../chat.php">			<i class="material-icons">message</i>		<span>Chat<span>		</a></li> ?>
		<li id="menu-help" 		class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Help">		<a href="/../helpcenter.php">	<i class="material-icons">help</i>			<span>Help Center<span>	</a></li>
		<hr style="opacity: .5">
		<li id="menu-settings" 	class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Settings">	<a href="/../settings.php">		<i class="material-icons">settings</i>		<span>Settings<span>	</a></li>
		<li id="menu-logout" 	class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Log Out">	<a href="/../php/logout.php">	<i class="material-icons">exit_to_app</i>	<span>Log Out<span>		</a></li>
	<?php } else { ?>
		<li id="menu-login" 	class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Log In">		<a class="modal-trigger" href="#loginmodal">	<i class="material-icons">account_circle</i><span>Log In<span>	</a></li>
		<li id="menu-signup" 	class="waves-effect waves-dark tooltipped" data-position="right" data-delay="50" data-tooltip="Sign Up">	<a class="modal-trigger" href="#signupmodal">	<i class="material-icons">add_circle	</i><span>Sign Up<span>	</a></li>
	<?php } ?>
	
</ul>

<?php //if (!isset($_SESSION['id'])) { ?>
<!-- Log in modal -->
<div id="loginmodal" class="modal align-center">
    <div class="modal-content center-align">
        <h4>Log In</h4>
        <?php include_once('include/login.html');?>
    </div>
</div>

<!-- Sign up modal -->
<div id="signupmodal" class="modal">
    <div class="modal-content center-align">
        <h4>Sign Up</h4>
        <?php include_once('include/signup.html');?>
    </div>
</div>
<?php //} ?>

<!-- Notifications modal -->
<?php include_once('notifications.php');?>


<?php if ((int) getInfo((int) $sesuser['id'], 'privilege') > 2) { ?>
			
<!-- Feedback FAB -->
<div id="fabcontainer" class="fixed-action-btn modal-trigger" href="#feedback">
	<a id="fab" class="btn-floating btn-large accent waves-effect waves-light" title="Feedback">
		<i class="large material-icons">bug_report</i>
	</a>
</div>

<!-- Feedback modal -->
<div id="feedback" class="modal modal-fixed-footer" style="height: 360px;">
	<div class="modal-content">
		<h4>Feedback</h4>
		
		<div id="radio">
			<p>
				<input name="group1" type="radio" id="radioBug" class="with-gap"/>
				<label for="radioBug">Report bug</label>
			</p>
			<p>
				<input name="group1" type="radio" id="radioFeature" class="with-gap"/>
				<label for="radioFeature">Request Feature</label>
			</p>
		</div>
		
		<style>
			#feedbackTextarea { 
				height: 124px;
				border: solid 1px #E0E0E0;
				border-radius: 4px;
				resize: none;
				background: #FFF; 
				padding: 8px;
			}
		</style>	
		<textarea id="feedbackTextarea" class="textarea" placeholder="Enter your feedback here"></textarea>
	</div>
	<div class="modal-footer">
		<a class="modal-action waves-effect btn-flat" id="sendfb">Send</a>
		<a class="modal-action modal-close waves-effect btn-flat">Cancel</a>
	</div>
</div>

<?php } ?>

<script>
	////////////////////////// Event based functions //////////////////////////
	$(function() {
		$('#menu-<?php echo $page;?>').addClass('page-active');
	})
	
	$('#hamburger').click(function() {
		searchInactive();
	})
	/*$('#searchinput').submit(function() {
		//Quick suggest here
	});*/
	$('#searchinput').focus(function() {
		//Change search box bg
		searchActive();
	});
	$('#searchinput').focusout(function() {
		//Change search box bg
		searchInactive();
	});
	$('#slide-out li').click(function() {
		$('.button-collapse').sideNav('hide');
	})
	
	//Send feedback script
	$('#sendfb').click(function() {
		var selected = $("#radio input[type='radio']:checked"),
			type = selected.attr('id'),
			message = $('#feedbackTextarea').val();
		if (selected.length != 0) {
			if ($('#feedbackTextarea').val() != 0) {
				$('#feedback').closeModal();
				$.post('../php/feedback.php',{
					type: type,
					message: message
				}, function(data) {
					Materialize.toast(data, 5000);
				});
			} else {
				Materialize.toast('Enter feedback in the text box', 5000);
			}
		} else {
			Materialize.toast('Choose the type of report first', 5000);
		}
	});

	////////////////////////// User defined functions //////////////////////////
	//Hide header on scroll down, reveal on scroll up
	var lastScrollTop = 1;
	$(window).scroll(function(){
		var st = $(this).scrollTop();
		if (st > lastScrollTop) {
			hideHeader();
			searchInactive();
		} else {
			showHeader();
		}
		lastScrollTop = st;
	});
	
	function searchActive() {
		$('#searchbox').css({'background': 'rgba(255, 255, 255, .35)',
							'-webkit-box-shadow':'0px 3px 6px 0px rgba(0,0,0,0.3)',
							'-moz-box-shadow':'0px 3px 6px 0px rgba(0,0,0,0.3)',
							'box-shadow':'0px 3px 6px 0px rgba(0,0,0,0.3)'
		});
	}
	function searchInactive() {
		$('#searchbox').css({'background': 'rgba(255, 255, 255, .2)',
							'-webkit-box-shadow':'0px 0px 0px 0px rgba(0,0,0,0.0)',
							'-moz-box-shadow':'0px 0px 0px 0px rgba(0,0,0,0.0)',
							'box-shadow':'0px 0px 0px 0px rgba(0,0,0,0.0)'
		});
	}
	
	function hideHeader() {
		$('#header').css({'top':'-64px'});
		$('#fabcontainer').css({'bottom':'-100px'});
		$('#slide-out').css({'padding-top':'0px'});
		if ($(document).width() > 992) {
			$('#slide-out').css({'left':'-240px'});
		}
	}
	function showHeader() {
		$('#header').css({'top':'0px'});
		$('#fabcontainer').css({'bottom':'22px'});
		$('#slide-out').css({'padding-top':'64px'});
		if ($(document).width() > 992) {
			$('#slide-out').css({'left':'0px'});
		}
	}

</script>
