<?php
$_pass  = sha1("admin");
$sql1   = "insert into login values('666', 'admin', '$_pass', 'sa')";
$sql2   = "insert into usermap values('666', 'admin', 'sa')";
$sql3   = "insert into loginhistory('666', '1996/09/26 16:00:00', '0.0.0.0', lastlocation)";
$dbname = "shopmoba_sma";

$link = mysql_connect('127.0.0.1', 'shopmoba_root', 't00r3d');
if (!$link) {
   die('Could not connect: '.mysql_error());
}

$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
   die('Can\'t use foo : ' . mysql_error());
}

mysql_query($sql1);
print("Error1: ". mysql_error());
mysql_query($sql2);

print("Error2: ". mysql_error());

mysql_close($link);
# Done :)
?>