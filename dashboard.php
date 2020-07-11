<?php
/* $shopmobapp: dashboard.php,v 1.0 2012/01/11 17:35:00 aedavies Exp $ */ 

require_once("lib/cJSON.php");
require_once("lib/cRequest.php");
require_once("lib/cCookies.php");
require_once("lib/cSession.php");
require_once("lib/cGenPasswd.php");
require_once("lib/cMail.php");
require_once("lib/cDB.php");
require_once("common.php");
require_once("etc/sys.conf");

$args = cRequest::request();

$ui = cSession::get('uid');
$un = cSession::get('uname');
$ll = cSession::get('lastlogin');
$li = cSession::get('lastip');

if ($ui == '666') {
	include('sa.html');
}
?>