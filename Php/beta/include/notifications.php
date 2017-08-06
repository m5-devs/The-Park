<style>
	.notificationaction {
		cursor: pointer;
		transition: .15s ease-in-out all;
		color: #212121;
	}
	.clear:hover, .reject:hover {
		color: #F44336;
	}
	.accept:hover {
		color: #4CAF50;
	}
	.go:hover {
		color: #000;
	}
	
	#toast-container {
		z-index: 1004;
	}
</style>

<!-- Notifications modal -->
<div id="notificationsmodal" class="modal">
    <div class="modal-content">
        <h4>Notifications</h4>
		<ul class="collection">
			
			<?php
				$userid = $sesuser['id'];
				$notifications = $db->select("SELECT * FROM notifications WHERE userid = '$userid'");
				$message = '';
				$action = '';
				foreach ($notifications as $notification) {
					$userinfo = getInfo((int) $notification['user_from']);
					if ($notification['type'] == 'post') {
						$message = 'Posted on your profile';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'comment') {
						$message = 'Commented on your post';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'mention') {
						$message = 'Mentioned you';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'friend_request') {
						$message = 'Wants to be your friend';
						$action = '
							<i class="material-icons notificationaction accept">check</i>
							<i class="material-icons notificationaction reject">close</i>
						';
					} else if ($notification['type'] == 'friend_accept') {
						$message = 'Accepted your friend request';
						$action = '
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'help') {
						$message = 'Replied to your help request';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'like') {
						$message = 'Liked your message';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else if ($notification['type'] == 'report') {
						$message = 'Reported a post';
						$action = '
							<a href="../profile.php#post117"><i class="material-icons notificationaction go">arrow_forward</i></a>
							<i class="material-icons notificationaction clear">close</i>
						';
					} else {
						$message = 'Sent new feedback';
						$action = '
							<i class="material-icons notificationaction clear">close</i>
						';
					}
					?>
					<li class="collection-item avatar dismissable" id="not<?=$notification['id']?>">
						<img src="<?=$userinfo['avatar']?>" class="circle avatar-circle">
						<span class="title"><?=$userinfo['first_name'].' '.$userinfo['last_name']?></span>
						<p><?=$message?></p>
						<span class="secondary-content"><?=$action?></span>
					</li>
					<?php
				}
			?>
		</ul>
    </div>
</div>

<script>
	
	//Remove element from list
	(function() {
		var ev = new $.Event('remove'),
			orig = $.fn.remove;
		$.fn.remove = function() {
			$(this).trigger(ev);
			return orig.apply(this, arguments);
		}
	})();
	
	//When remove button is clicked, remove from DOM
	$('.notificationaction').click(function() {
		var id = $(this).closest('.collection-item').attr('id').substring(3);
		if ($(this).hasClass('clear')) {
			notificationAction(id, 'dismiss');
		} else if ($(this).hasClass('accept')) {
			notificationAction(id, 'accept');
		} else if ($(this).hasClass('reject')) {
			notificationAction(id, 'reject');
		} else {
			notificationAction(id);
		}
	});

	//When collection item is removed, delete notification from db
	$('.dismissable').bind('remove', function() {
		var id = $(this).attr('id').substring(3);
		notificationAction(id, 'dismiss');
	});
	
	//Delete notification from database
	function notificationAction(id, action) {
		action = action || 'null'; //Allow optional 'action' parameter
		$.post('php/dismissnotification.php',{
			id: id,
			action: action
		},function(data) {
			$('#not'+id).remove();
			Materialize.toast(data, 5000);
		});
	}
	
</script>