<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>Google Picker Example</title>

	<script type="text/javascript">
		
	/******************** Google Picker Script ********************/
	var developerKey = 'AIzaSyCCKBK236c5tH7pUjHlz485R7Xi-m64EDg', //Browser API key
		clientId = '958305636628-7hvvhnprofn4thnvatdhc7pvucd2efkf.apps.googleusercontent.com', //Client ID
		scope = ['https://www.googleapis.com/auth/photos','https://www.googleapis.com/auth/photos.upload','https://www.googleapis.com/auth/drive.readonly'], //Permission scope
		pickerApiLoaded = false,
		oauthToken;
	function onApiLoad() {
			// Use the API Loader script to load google.picker and gapi.auth.
		gapi.load('auth', {'callback': onAuthApiLoad});
		gapi.load('picker', {'callback': onPickerApiLoad});
	}
	function onAuthApiLoad() {
		window.gapi.auth.authorize({
			'client_id': clientId,
			'scope': scope,
			'immediate': false
		},
		handleAuthResult);
	}
	function onPickerApiLoad() {
		pickerApiLoaded = true;
		createPicker();
	}
	function handleAuthResult(authResult) {
		if (authResult && !authResult.error) {
			oauthToken = authResult.access_token;
			createPicker();
		}
	}
	function createPicker() {
			// Create and render a Picker object for picking user Photos.
		if (pickerApiLoaded && oauthToken) {
			var picker = new google.picker.PickerBuilder().
			addView(google.picker.ViewId.PHOTOS).
			addView(google.picker.ViewId.PHOTO_UPLOAD).
			addView(google.picker.ViewId.IMAGE_SEARCH).
			addView(google.picker.ViewId.VIDEO_SEARCH).
            addView(google.picker.ViewId.DOCUMENTS).
			setOAuthToken(oauthToken).
			setDeveloperKey(developerKey).
			setCallback(pickerCallback).
			build();
			picker.setVisible(true);
		}
	}
	function pickerCallback(data) {
		// A simple callback implementation.
		var url = 'nothing';
		if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
			var doc = data[google.picker.Response.DOCUMENTS][0];
			console.log(doc);
            var thumbs = data.docs[0].thumbnails;
            var imageURL = thumbs[thumbs.length - 1].url; //select the largest image returned
		}
		var message = 'You picked: <br/><img src="'+imageURL+'"/>';
        document.getElementById('result').innerHTML = message;
	}
		
	</script>
	</head>
	<body>
	<div id="result"></div>

	<!-- The Google API Loader script. -->
	<script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>
	</body>
</html>