<?php 

include('include/dbcon.php');
$ip = $_SERVER['REMOTE_ADDR'];
$userid = $sesuser['id'];

 //echo $ip;
$iplong = ip2long($ip);
echo $iplong;
$ipshort = long2ip(-1401141199);
echo $ipshort;
echo $ip;

?>