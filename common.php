<?php
/* $shopmobapp: common.php,v1.0 2011/07/21 17:11:11 aedavies Exp $ */ 

$pcategory = array();
$scategory = array();
$regions = array();
$regions_loc = array();

$jsfiles = array(
	"chkbrowser" => "js/chkbrowser.js",
	"cookie"     => "js/cookie.js",
	"app"	     => "js/app.js",
	"xhr"        => "js/xhr.js",
	"jq"	     => "js/jquery.min.js"
);

$cssfiles = array(
	"app" => "style/app.css"
);

$logo = <<<LOGO
LOGO;

$menu = <<<MENU
MENU;

$footer = <<<FOOTER
FOOTER;

function checklogin() {
	require_once("lib/cSession.php");

	$sess = new cSession;
	$uid  = $sess->get('uid');
die("uid_: $uid");
	if (!isset($uid)) {
die("uid: $uid");
		#header("Location: index.html");
		#exit;
	}
}
?>