<style>
.title { font-weight: 500; }
</style>

<ul class="collection">

<?php
include('include/dbcon.php');

//Selects all of user's friends
$userid = $currentuser['id'];
$sql_get_friends = "SELECT user_from FROM friends WHERE user_to = '$userid' UNION SELECT user_to FROM friends WHERE user_from = '$userid'";
$friends_result = mysql_query($sql_get_friends);
$friendid = '';

//Create frienders avatars
while($friendrow = mysql_fetch_assoc($friends_result)) {

    //Get friend's info from users table and store as array
    $friendid = $friendrow['user_from'];
    $sql_friend_info = mysql_query("SELECT * FROM users WHERE id = '$friendid'");
    $friend_info = mysql_fetch_assoc($sql_friend_info);

    //Check if the friend request has been confirmed
    $accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friends WHERE user_from = '$friendid' AND user_to = '$userid' OR user_to = '$friendid' AND user_from = '$userid'"));
    //Create boolean value for accepted or not accepted
    $accepted = $accepted_array[0];

    if ($accepted==1) {
        echo '
        <li class="collection-item avatar">
            <a href="profile.php?u='.$friend_info['id'].'" class="black-text" style="text-transform: none;">
                <img src="'.$friend_info['avatar'].'" alt="" class="circle">
                <span class="title">'.$friend_info['first_name'].' '.$friend_info['last_name'].'</span>
                <p>@'.$friend_info['username'].'<br>
            </a>
            '.$friend_info['email'].'
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons accent-text">message</i></a>
        </li>
        ';
    }
}

?>

</ul>
