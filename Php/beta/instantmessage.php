<?php require_once('include/dbcon.php');
$user2 = $_GET['i'];
$_SESSION['user2'] = $user2;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages <?php echo $user2; ?></title>
	<?php require_once('../include/import.php');?>

	<style>
		/* CSS */
	</style>
</head>
	
<body class="spaced">

    <style>
        #messages {
            height: 100vh;
            width: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .msgto {
            position: relative;
            text-align: right;
            right: 60px;
			color: #000;
        }
			
		.msgto * { color: #000; }
		.msgfrom * { color: #fff; }	

        .msgfrom .info {
            position: relative;
            top: 3px;
            left: 60px;
            margin: 5px;
            font-size: 9.5pt;
            color: #899;
        }

        .msgto .info {
            position: relative;
            top: 3px;
            right: 2px;
            margin: 5px;
            font-size: 9.5pt;
            color: #899;
        }

        .avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            margin: 0px 9px;
        }

        .msgfrom .avatar { float: left; }

        .msgto .avatar { position: absolute; bottom: 20px; }

        .msgcontent {
            background-color: #455a64;
            position: relative;
            display: inline-block;
            border-radius: 8px;
            max-width: 60%;
            top: 2px;
            padding: 3px 15px;
            color: #fff;
        }

        .msgto .msgcontent { background: #dedede; color: #000; }
			
				.msgfrom a { color: #B2EBF2; }

        .string {
            line-height: 19px;
            display: block;
            margin: 6px 0px;
            text-align: left;
        }
    </style>
</head>

<body style="height: 100%; padding-top: 66px;">
	<?php include('include/header.php');?>

	<!-- Main container -->
	<div class="container card z-depth-1" style="margin: 0 auto; overflow: visible;">
		<!-- Messages container -->
		<div id="messages"></div>

		<!-- Post -->
		<form id="submitmessage">
			<input type="text" id="messageinput" maxlength="255" placeholder="Write a message..."/>
		</form>
	</div>

    <script> 
        $(document).ready(function() {
            $('#messages').load('php/loadinstant.php');
            setInterval(function() {
				$("#messages").load('php/loadinstant.php');
			}, 1000);
        }); 
		
		$('#submitmessage').submit(function() {
			var message = $('#messageinput').val();
			$.post('php/submitinstant.php', {message: message}, function(data) {
				if (data == 'empty') {
					Materialize.toast("Can't send blank message");
				} else {
					$('#messageinput').val('');
				}
			});
			//$("#messages").animate({ scrollTop: $('#messages').height()}, 300);
			return false;
		});
    </script>
</body>
</html>