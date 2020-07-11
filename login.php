<?php
/* $shopmobapp: login.php,v 1.0 2011/07/31 12:34:00 aedavies */

function login()
{
	global $conf, $json, $resout, $db;

	$username = cRequest::any('_user');
	$password = cRequest::any('_pass');
	$p = $password;

	//die("_user: $username | _pass: $password");
	
	if ((!$password) || (!$username)) {
		# XXX: Error page
		die("Username and Password Required");
	}

	$dbh = $db->open($conf['db']['host'], $conf['db']['user'],
			 $conf['db']['passwd'], $conf['db']['name']);

	$uname  =  $db->secure($username);
	$passwd = sha1($password);

	$sql = "select * from {$conf['tbl']['usermap']}
		where username='$uname';";
	$ret = $db->query($sql);
	if ($ret) {
		$res    = $db->asfetch($ret);
		$uid    = $res['uid'];
		$actype = $res['actype'];
		switch($actype) {
		case 'sa':
			$sql = "select * from {$conf['tbl']['login']}
				where username='$uname'";
			$ret = $db->query($sql);
			$res = $db->asfetch($ret);
			break;
		case 'a':
			$sql = "select * from {$conf['tbl']['shopinfo']}
				left join {$conf['tbl']['login']} 
				on({$conf['tbl']['shopinfo']}.sid = 
				{$conf['tbl']['login']}.uid )
				where username='$uname'";
			$ret = $db->query($sql);
			$res = $db->asfetch($ret);
			break;
		case 'u':
			$sql = "select * from {$conf['tbl']['profile']}
				left join {$conf['tbl']['login']} 
				on({$conf['tbl']['profile']}.uid = 
				{$conf['tbl']['login']}.uid )
				where username='$uname'";
			$ret = $db->query($sql);
			$res = $db->asfetch($ret);
			break;
		default:
			/* XXX: ERROR */
			die("[!] Error: No account with Username $uname");
			/* NOTREACHED */
		}

		# cmp passwd
		if ($passwd != $res['passwd']) {
			print_r($res);
			print "Passwords don't match[$passwd | {$res['passwd']}]";
			exit();
		}

		# get last login
		$sqll = "select * from loginhistory where uid='$uid'";
		$retl = $db->query($sqll);
		$resl = $db->asfetch($retl);

		# set up session data
		$sess     = new cSession;
		$datetime = date('Y/m/d H:i:s');
		$lastip   = cIP::getusrip();
		$location = cIP::getusrcountry($lastip); # FIXME: need to add ip2ctry dir
		if (isset($location['country_name'])) {
			$location = $location['country_name'];
		} else {
			$location = "Unknown";
		}

		if (preg_match('/1996\/09\/26 16:00:00/', $resl['lastlogin'], $match)) {
			$ll = $datetime;
		} else {
			$ll = $resl['lastlogin'];
		}

		if (preg_match('/0\.0\.0\.0/', $resl['lastip'], $match)) {
			$lip = $lastip;
		} else {
			$lip = $resl['lastip'];
		}

		$sess->set('uid', $res['uid']);
		$sess->set('uname', $username);
		$sess->set('actype', $actype);
		if ($actype == 'u') {
			$sess->set('fname', $res['fname']);
			$sess->set('email', $res['email']);
		}
		if ($actype == 'a') {
			$sess->set('sname', $res['sname']);
			$sess->set('email', $res['email']);
		}

		$sess->set('lastlogin', $ll);
		$sess->set('lastip', $lip);

		# XXX: update login history
		$sql = "update {$conf['tbl']['loginhistory']} set lastlogin='$datetime',
			lastip='$lastip', lastlocation='$location'
			where uid='$uid';";
		$db->query($sql);

		$db->close($dbh);
		unset($db);
		unset($sess);

		header("Location: dashboard.php");
		exit();
	} else {
		# XXX: Error page
		die("[!] Fatal Error: No account with Username '$uname'");
		/* NOTREACHED */
	}
}
?>