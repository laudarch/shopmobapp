<?php
$req = $_REQUEST['file'];
$android_name = "ShopMobApp.apk";
$android      = "app/$android_name";

switch ($req) {
case 'android':
	pushfile($android, $android_name);
	break;
default:
	print "Coming Soon!";
	exit;
}
exit;

function pushfile($file, $name)
{
	$buffer = file_get_contents($file);

	header('Content-Type: application/x-download');
	header('Content-Length: '.strlen($buffer));
	header('Content-Disposition: attachment; filename="'.$name.'"');
	header('Cache-Control: private, max-age=0, must-revalidate');
	header('Pragma: public');
	ini_set('zlib.output_compression','0');
	print $buffer;
	exit;
}
?>