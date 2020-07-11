<?php
// Connecting, selecting database
$mysql_host = 'localhost';
$mysql_user = 'shopmoba_tvnotes';
$mysql_password = 'tvnotes25';
$database_name = 'shopmoba_tvnotes';
$link = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die('Could not connect: ' . mysql_error());
//echo 'Connected successfully';
mysql_select_db($database_name) or die('Could not select database');
?>
