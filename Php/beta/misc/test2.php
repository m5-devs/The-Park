<?php require('../include/dbcon.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<?php require('../include/import.php');?>
	<link href="/css/jquery.gridster.min.css" type="text/css" rel="stylesheet"/>
	<script src="/js/jquery.gridster.min.js"></script>

	<style>
	</style>
</head>
	
<body class="spaced">
	<?php require('../include/header.php');?>
<div class="container">
	<div class="g-signin2" data-onsuccess="onSignIn"></div>
	<a href="#" onclick="signOut();">Sign out</a>
	</div>
	
	<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
}
		  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
		// auth2 is initialized with gapi.auth2.init() and a user is signed in.

if (auth2.isSignedIn.get()) {
  var profile = auth2.currentUser.get().getBasicProfile();
  console.log('ID: ' + profile.getId());
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
}
	</script>
</body>
</html>