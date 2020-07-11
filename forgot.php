<?php
/* $ghresumes: signup.php,v 1.0 2011/07/19 15:19:00 aedavies Exp $ */

function forgot()
{
	global $conf, $json, $resout, $db;

	$uname   = cRequest::any('username');

	$dbh = $db->open($conf['db']['host'], $conf['db']['user'],
			     $conf['db']['passwd'], $conf['db']['name']);

	$uname    = $db->secure($uname);
	$npasswd  = cGenPasswd::genpasswd(8);
	$passwd   = sha1($npasswd);

	$sql = "select uid from {$conf['tbl']['usermap']}
	        where username='$uname';";
	$ret = $db->query($sql);
	if ($ret) {
		$res = $db->asfetch($ret);
		$uid = $res['uid'];
		$sql = "select email from {$conf['tbl']['companyinfo']}
	            where uid='$uid';";
		$ret = $db->query($sql);
		$res = $db->asfetch($ret);
		$email = $res['email'];
		$sql1 = "call setuserpasswd('$uname', '$passwd');";
		$ret = $db->qry($sql1);
		if ($ret) {
			if ($conf['dbg'])
				$emsg = "[$ret|".mysql_error()."]<br /><pre>$sql</pre>
				<br /><pre>$sql1</pre>
				<br />Password: [<b>$npasswd</b>]";
			else
				$emsg = "";

			# Mail user's new password to user
			$message = <<<MAIL
			Hi <br />
			Your password has been.<br />
			Your new password is <b>$npasswd</b>.<br /><br />
			<a href="http://www.ghanaresumes.com">Click here to login</a>
MAIL;
			$from    = "Ghana Resumes <no-reply@ghanaresumes.com>";
			$subject = "Ghana Resumes password reset";
			$m = new cMail;
			$m->mail($email, $from, $subject, $message);
			unset($m);
			$resout->error = 0;
			$resout->msg   = <<<SUCCESS
		Your password has been reset<br />
		Please check the mail you registered with<br />
		for your new password.<br /><br />
		$emsg
		<a href="/" class="button">Click here to login</a>
SUCCESS;
			$db->close($dbh);
			unset($db);
			print $json->encode($resout);
			exit;
		} else {
			$resout->error = 1;
			$resout->msg   = <<<ERROR
			Username <b>$uname</b> was not found<br />
			<br />
			<a href="javascript:history.go(0);" class="button">Retry</a>
ERROR;
			$db->close($dbh);
			unset($db);
			print $json->encode($resout);
			exit;
		}
		unset($ret);
		unset($res);
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
