<?php

$require_once('../include/dbcon.php');

//Only let teachers and admins make tests
if (!isset($_SESSION['id'])) { header('Location: index.php'); exit(); }
if (!$sesuser['privilege'] == '2' or $sesuser['privilege'] == '4') { header('Location: index.php'); exit(); }

?>