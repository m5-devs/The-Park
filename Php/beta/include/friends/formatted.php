<style>
.collection-item .title { font-weight: 500; }
</style>

<ul class="collection">

<?php

//Selects all of user's friends
$userid = $currentuser['id'];
$friends_result = $db->select("SELECT user_from FROM friends WHERE user_to = '$userid' UNION SELECT user_to FROM friends WHERE user_from = '$userid'");
$friendid = '';

//Create friender's avatars
foreach ($friends_result as $friendrow) {

    //Get friend's info from users table and store as array
    $friendid = $friendrow['user_from'];
    $friendinfo = $db->select("SELECT * FROM users WHERE id = '$friendid'");
    $friendinfo = $friendinfo[0];

    //Check if the friend request has been confirmed
    $accepted = $db->select("SELECT accepted FROM friends WHERE user_from = '$friendid' AND user_to = '$userid' OR user_to = '$friendid' AND user_from = '$userid'");
    $accepted = $accepted[0]['accepted'];
    //Create boolean value for accepted or not accepted

    if ($accepted==1) { ?>
        <li class="collection-item avatar">
            <a href="profile.php?u=<?=$friendinfo['id']?>" class="black-text" style="text-transform: none;">
                <img src="<?=$friendinfo['avatar']?>" class="circle">
                <span class="title"><?=$friendinfo['first_name'].' '.$friendinfo['last_name']?></span>
                <p>@<?=$friendinfo['username']?><br>
            </a>
            <?=$friendinfo['email']?>
            </p>
            <?php /*<a href="#!" class="secondary-content"><i class="material-icons accent-text">message</i></a>*/?>
        </li>
    <?php }
}

?>

</ul>
