<?php
	require_once('lib/nusoap.php');

	/* Initialize parameter */
	/*$mobile		= '+233241410739';
	$mesg		= 'Testing SOAP Service 1 2 1 2';
	$src		= 'laudarch';
	$username	= 'test';
	$password	= '12345';
	$param  = array('mobile'   => $mobile,
			'mesg'     => $mesg,
			'src'      => $src,
			'username' => $username,
			'password' => $password);*/

	$name         = "laudarch";
	$info         = "Buying NOTHING O_o";
	$amt          = "0.01";
	$mobile       = "+233241410739";
	$mesg         = "You have just bought nothing :)";
	$src	      = "ShopMob App";
	$expiry       = "2012-02-20";
	$billprompt   = "0";
	$thirdpartyID = "666";
	$username     = "orig@gh";
	$password     = "!noV8";
	$param  = array("name"         => $name, 
			"info"         => $info,
			"amt"          => $amt,
			"mobile"       => $mobile,
			"mesg"         => $mesg,
			"src"	       => $src,
			"expiry"       => $expiry,
			"billprompt"   => $billprompt,
			"thirdpartyID" => $thirdpartyID,
			"username"     => $username,
			"password"     => $password);

	/* create the client for my rpc/encoded web service */
	$wsdl = "http://payments.api.transflowservices.com/index.php?wsdl";

	$client = new soapclient($wsdl, true);

	/* call operation */
	$response = $client->call('postInvoice', array($param));
	print_r($response);
	if ($response) {
		print "invoice No: <b>{$response['invoiceNo']}</b><br />";
		print "Response code: <b>{$response['responseCode']}</b><br />";
		print "Response mesg: <b>{$response['responseMesg']}</b>";
	} else {
		print "Error ".$client->getError();
	}
	unset($client);
?>