<?php
     /* $Id: cSendSMS.php,v 0.1 2010/10/20 02:14:39 aedavies Exp $ */

interface iSendSMS
{
	public static function send($to, $msg, $sender="1413",
		$host="196.200.112.25", $port='7236', $file="Receiver",
		$username="n2", $password="arch", $method="GET");
}

class cSendSMS implements iSendSMS
{
	public static function send($to, $msg, $sender="1413",
		$host="196.200.112.25", $port='7236', $file="Receiver",
		$username="n2", $password="arch", $method="GET")
	{
		$req  = "";
		$resp = "";
		$parameters = "messagetext=$msg&sender=$sender&gsm=$to&
			username=$username&password=$password";
		$size = strlen($parameters); # for POST Method

		$fsd = fsockopen($host, $port, $errno, $errdesc, '30');
		if (!$fsd) {
		   return false;
		} else {
			# use GET method
		   if ($method == "GET") {
			    $req  = "GET $file?$parameters HTTP/1.0\r\n";
			    $req .= "Host: $host\r\n";
			    $req .= "User-Agent: SMS_client/1.0\r\n\r\n";
		   } else {
				# use POST method
				$req  = "POST $file HTTP/1.1\r\n";
				$req .= "Host: $host\r\n";
				$req .= "User-Agent: SMS_client/1.0\r\n";
				$req .= "Content-Type: application/x-www-form-urlencoded\r\n";
				$req .= "Content-Length: $size\r\n";
				$req .= "Accept: */*\r\n\r\n";
				$req .= $parameters;
		  }

		  fwrite($fsd, $req);
		  while(!feof($fsd)) {
			$resp .= fgets( $fsd, 1024 );
		  }
		  fclose( $fsd );
		  return ($resp); # maybe not neccessary :/
	   }
	}
}
?>
