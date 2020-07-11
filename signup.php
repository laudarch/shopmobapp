<?php
/* $ghresumes: signup.php,v1.0 2011/07/19 15:19:00 aedavies Exp $ */

function signup() {
	global $conf, $json, $resout;

	$actype  = cRequest::any('actype');
	$email   = cRequest::any('email');
	$passwd  = cRequest::any('passwd');
	$passwd1 = cRequest::any('passwd1');

	if (!preg_match("/^\w+@\w+\.\w{2,4}[\.\w{2,4}]$/", $email, $match)) {
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		Invalid Email "$email"<br />
		<a href="javascript:history.go(0);">Retry</a><br /><br />
ERROR;
		print $json->encode($resout);
		exit;
	}
	if ((strlen($passwd) < 8) || (strlen($passwd1) < 8)) {
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		Password must be eight(8) characters or more<br /><br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		print $json->encode($resout);
		exit;
	}

	$cmp = strcmp($passwd, $passwd1);
	if ($cmp != 0) {
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		Passwords don't match<br /><br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		print $json->encode($resout);
		exit;
	}
	
	$passwd  = sha1($passwd);
	switch ($actype) {
	case "personal":
		regpersonal($passwd, $email, $actype);
		break;
	case "business":
		regbusiness($passwd, $email, $actype);
		break;
	default:
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		FATAL ERROR: Unknow registration type "$actype"<br />
		<a href="javascript:history.go(0);">Retry</a><br /><br />
ERROR;
		print $json->encode($resout);
		exit;
	}
}

# personal(cv) registration
function regpersonal($passwd, $email, $actype) {
	$fname   = cRequest::any('fname');
	$lname   = cRequest::any('lname');
	$uname   = cRequest::any('uname');
	$pass    = cRequest::any('passwd');
	$user 	 = $uname;
	$photo 	 = "upic/nopic.png";
	
	global $conf, $json, $resout, $db;

	$dbh = $db->open($conf['db']['host'], $conf['db']['user'],
			$conf['db']['passwd'], $conf['db']['name']);

	$fname   = $db->secure($fname);
	$lname   = $db->secure($lname);
	$email   = $db->secure($email);
	$uname   = $db->secure($uname);
	$actype  = $db->secure($actype);
	$uid     = cGenPasswd::genid($fname.$mname.$lname.$uname.$actype);

	$sql = "select * from {$conf['tbl']['usermap']}
	        where username='$uname';";
	$ret = $db->query($sql);
	if ($ret) {
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		Username <b>$uname</b> already exists<br />
		<br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	}
	unset($ret);

	$sql = "call newuser('$uid', '$uname', '$passwd', '$actype',
		 '$fname', '$mname', '$lname', '$email', '$photo');";
	$ret = $db->qry($sql);
	if ($ret) {
		$resout->error = 0;
		$resout->msg   = <<<SUCCESS
		Hi <i>$fname</i>,<br />
		Your registration was successful<br />
		Thank you for signing up<br /><br />
		<a href="/" class="button">Click here to login</a>
SUCCESS;
		$mailmsg   = <<<SUCCESS
		Hi <i>$fname</i>,<br />
		Your registration on <a href="http://ghanaresumes.com">
                Ghana Resumes</a> was successful<br />
		Thank you for signing up<br /><br />
                You can now <a href="/" class="button">Click here to login</a>
		with your login details:<br />
		Username: <b>$user</b>
		Password: <b>$pass</b><br />And <br />
		<ul>
			<li>Set up your CV</li>
			<li>Search for jobs</li>
			<li>Send Messages to friends about the latest job trends</li>
			<li>and much more</li>
		</ul><br />
		<a href="http://ghanaresumes.com">Ghana Resumes</a> has a
		visual directory at 
	<a href="http://ghanaresumes.com/locate.html">Find a Location</a>
		to help you easily locate companies and businesses.<br /><br />
		We hope you have a nice stay and gain a profitable career.<br />
		<i>The Ghana Resumes Team</a>
SUCCESS;
		$from = "Ghana Resumes <no-reply@ghanaresumes.com>";
		$subject = "Ghana Resumes Registration Confirmation";
		$m = new cMail;
		$m->mail($email, $from, $subject, $mailmsg);
		unset($m);
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	} else {
		if ($conf['dbg'])
			$emsg = "[$ret|".mysql_error()."]<br /><pre>$sql</pre>";
		else
			$emsg = "";

		$resout->error = 1;
		$resout->msg   = <<<ERROR
		An Error occurred<br />$emsg<br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	}
}

# business(company profile) registration
function regbusiness($passwd, $email, $actype) {
	$cname 		= cRequest::post('cname');
	$curl 		= cRequest::post('curl');
	$cindustry 	= cRequest::post('cindustry');
	$cregion 	= cRequest::post('cregion');
	$cuname 	= cRequest::post('cuname');
	$logo 		= "cpic/nologo.png";

	global $conf, $json, $resout, $db;

	$dbh = $db->open($conf['db']['host'], $conf['db']['user'],
				     $conf['db']['passwd'], $conf['db']['name']);

	$cname 	   = $db->secure($cname);
	$email 	   = $db->secure($email);
	$curl 	   = $db->secure($curl);
	$cindustry = $db->secure($cindustry);
	$cregion   = $db->secure($cregion);
	$cuname    = $db->secure($cuname);
	$cid       = cGenPasswd::genid($cname.$cuname.$actype);

	$sql = "select * from {$conf['tbl']['usermap']}
	        where username='$cuname';";
	$ret = $db->query($sql);
	if ($ret) {
		$resout->error = 1;
		$resout->msg   = <<<ERROR
		Username <b>$cuname</b> already exists<br />
		<br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	}
	unset($ret);

	$sql = "call newcompany('$cid', '$cuname', '$passwd', '$actype',
		'$cname', '$email', '$curl', '$cindustry', '$cregion',
                '$logo');";
	$ret = $db->qry($sql);
	if ($ret) {
		$resout->error = 0;
		$resout->msg   = <<<SUCCESS
		Hello <b>$cname</b>,<br />
		your registration was successful<br />
		Thank you for signing up<br /><br />
		<a href="/" class="button">Click here to login</a>
SUCCESS;
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	} else {
		if ($conf['dbg'])
			$emsg = "[$ret|".mysql_error()."]<br /><pre>$sql</pre>";
		else
			$emsg = "";

		$resout->error = 1;
		$resout->msg   = <<<ERROR
		An Error occurred<br />$emsg<br />
		<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
		$db->close($dbh);
		unset($db);
		print $json->encode($resout);
		exit;
	}
}
?>
