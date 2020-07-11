<?php
/* $ghresumes: logoff.php,v 1.0 2011/08/07 11:18:00 aedavies */

require_once("lib/cSession.php");

$sess = new cSession;
$sess->kill('uid');
$sess->kill('uname');
$sess->kill('fname');
$sess->kill('email');
$sess->kill('lastlogin');
$sess->kill('lastip');
$sess->kill('actype');

header("Location: admin.html");
?>
