<?php
include('include/dbcon.php');

//Selects all of user's friends
$userid = $currentuser['id'];
$sql_get_friends = "SELECT user_from FROM friends WHERE user_to = '$userid' UNION SELECT user_to FROM friends WHERE user_from = '$userid' LIMIT 10";
$friends_result = mysql_query($sql_get_friends);
$friendid = '';

//Create frienders avatars
while ($friendrow = mysql_fetch_assoc($friends_result)) {

    //Get friend's info from users table and store as array
    $friendid = $friendrow['user_from'];
    $sql_friend_info = mysql_query("SELECT * FROM users WHERE id = '$friendid'");
    $friend_info = mysql_fetch_assoc($sql_friend_info);

    //Check if the friend request has been confirmed
    $accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friends WHERE user_from = '$friendid' AND user_to = '$userid' OR user_to = '$friendid' AND user_from = '$userid'"));
    //Create boolean value for accepted or not accepted
    $accepted = $accepted_array[0];

    if ($accepted==1) { ?>
        <a href="profile.php?u=<?php echo $friend_info['id'];?>">
            <img src="<?php echo $friend_info['avatar'];?>"
                 style="width: 50px; margin: 0px 4px;"
                 class="tooltipped z-depth-1 avatar-circle"
                 data-position="bottom" data-delay="50" data-tooltip="<?php echo $friend_info['first_name'].' '.$friend_info['last_name'];?>"/>
        </a>
    <?php }
}

?>
