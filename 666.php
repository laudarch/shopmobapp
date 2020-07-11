<?php
/* $shopmobapp: 666,v 1.0 2012/01/11 17:35:00 aedavies Exp $ */ 

require_once("lib/cJSON.php");
require_once("lib/cRequest.php");
require_once("lib/cCookies.php");
require_once("lib/cSession.php");
require_once("lib/cGenPasswd.php");
require_once("lib/cMail.php");
require_once("lib/cDB.php");
require_once("common.php");
require_once("etc/sys.conf");

$cmd    = cRequest::any('cmd');
$json   = new Services_JSON;
$resout = new StdClass;
$db     = new cDB;

switch($cmd) 
{
case 'login':
	require_once("login.php");
	login();
	break;
case 'signup':
	require_once("signup.php");
	signup();
	break;
case 'forgot':
	require_once("forgot.php");
	forgot();
	break;
case 'adds':
	$sid    = cGenPasswd::genid(time());
	$uid    = cGenPasswd::genid($sid);
	$uname  = cRequest::any("_user");
	$passwd = cRequest::any("_pass");
	$sname  = cRequest::any("_sname");
	$scat   = cRequest::any("_scat");
	$actype = 'a';
	$dbh = $db->open($conf['db']['host'], $conf['db']['user'],
			 $conf['db']['passwd'], $conf['db']['name']);
	$sql    = "call newshop('$sid', '$uid', '$uname', '$passwd',
	  '$actype', '$sname', '', '', '$scat', '');";
	$ret = $db->qry($sql);
	if ($ret) {
		print "Record Added. <a href=\"javascript:history.go(-1);\">Go Back</a>";
	} else {
		print "Error: [$ret]".mysql_error();
	}
	$db->close($dbh);
	unset($db);
	exit();
	break;
case 'js':
	$ftype = cRequest::any('ftype');
	$file  = $jsfiles[$ftype];
	header("Pragma: no-cache");
	header("Content-Type: text/javascript");
	header("Expires: Thu, 16 Sep 1996 16:00:00 GMT");
	print ($file) ? file_get_contents($file) : "";
	exit;
case 'css':
	$ftype = cRequest::any('ftype');
	$file  = $cssfiles[$ftype];
	header("Pragma: no-cache");
	header("Content-type: text/css");
	header("Expires: Thu, 16 Sep 1996 16:00:00 GMT");
	print ($file) ? file_get_contents($file) : "";
	exit;
default:
	$user = preg_split('/\//', $_SERVER['REQUEST_URI']);
	$pg   = $user[1];

	# XXX: Error page
	header("HTTP/1.1 200 Ok");
	print "<b>LOST SOUL</b> I can't find <b>$pg</b><br /><br />
	<hr /><br /><sub><i>666 Daemon</i></sub>";
	exit;
}
unset($json);
unset($resout);
unset($db);
header("Location: index.html");
exit;
?>