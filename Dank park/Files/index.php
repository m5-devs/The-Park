<?php
include('include/dbcon.php');

/* if (isset($_SESSION['user_login'])) {
    header('Location: home.php');
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>The Park</title>
	<meta name="google-site-verification" content="wXyAch1csye4l9yeSBoaDPo-kSh3HKhG0KWpOQYNJjo"/>

    <?php include('include/import.php');?>
	
	<style>		
		.title, .subtitle {
			text-shadow: 0px 2px 3px rgba(0, 0, 0, 0.7);
		}
	</style>

</head>
<body>
    <?php include('include/header.php'); ?>

    <div id="index-banner" class="parallax-container" style="width: 100%">
        <div class="section no-pad-bot" style="padding-top: 80px;">
            <div class="container">
                <br><br>
                <h1 class="header center green-text title" style="font-family: 'Product Sans';">The Park</h1>
                <div class="row center">
                    <h5 class="header col s12 light subtitle white-text">Blaze it 420</h5>
                </div>
                <div class="row center">
                    <?php
                        error_reporting(0);
                        if ($sesuser['id']) {
                            echo '<a class="btn-large waves-effect waves-light accent" href="profile.php" style="margin: 0px 8px;">Go to profile</a>';
                        } else {
                            echo '<a class="modal-trigger btn-large waves-effect waves-light accent" href="#loginmodal" style="margin: 0px 8px;">Log in</a>';
                            echo '<a class="modal-trigger btn-large waves-effect waves-light accent" href="#signupmodal" style="margin: 0px 8px;">Sign up</a>';
                        }
                        error_reporting(E_ALL);
                    ?>
                </div>
                <br><br>

            </div>
        </div>
        <div class="parallax"><img src="http://i.imgur.com/xXlmznd.gif"></div>
    </div>


    <div class="container">
        <div class="section">
            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center"><i class="material-icons">face</i></h2>
                        <h5 class="center">Smoke with friends</h5>

                        <p class="light">Blaze it with all of your closest friends, or find new ones. You can share dank memes, meet new friends in the sex exchange, or do it with your best friends!</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center"><i class="material-icons">explore</i></h2>
                        <h5 class="center">Discover substances</h5>

                        <p class="light">You'll see everthing your friends, family, and others have tried, or follow other people and places you're interested in.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center"><i class="material-icons">favorite</i></h2>
                        <h5 class="center">Get help from others</h5>

                        <p class="light">You can ask for help with doing anything that you need. Just simply post a help wanted poster on the help wanted page!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12 light subtitle white-text">Meet new friends and screw around with old ones</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="http://i.imgur.com/LbVb23q.jpg"></div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="material-icons " style="font-size: 53.4px;">info</i></h3>
                    <h4 class="">About Us</h4>
                    <p class="left-align">The Park is a dank memeing site created by two Myers Park students for Myers Park. The Park was created for the Myers Park community to come together. It offers an unsafe way for people talk to old friends, meet new ones, and recieve mental help quickly by people who have already had to go through the same issues. The site will be free to use forever and will constantly be updated with new features.</p>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12 light subtitle white-text">Get stimulants from your peers</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="https://i.ytimg.com/vi/pRheDNMoYFE/hqdefault.jpg"></div>
    </div>

    <?php include('include/footer.php') ?>

    </body>
</html>
