<?php
    /* $Id: cIP.php,v 0.1 2010/10/14 20:07:04 aedavies Exp $ */
    
interface iIP
{
	public static function getusrip();
	public static function getusrcountry($ip);
}

class cIP implements iIP
{
	/**
	 * Returns User IP Address
	 * @params
	 *        IN:  NONE
	 *        OUT: ip address(0.0.0.0)
	 */
	public static function getusrip()
	{
		$ip = "";
		if ((isset($_SERVER['HTTP_X_FORWARDED_FOR'])) &&
		    (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			return ($ip);
		} elseif ((isset($_SERVER['HTTP_CLIENT_IP'])) &&
			  (!empty($_SERVER['HTTP_CLIENT_IP']))) {
			$ip = explode(".", $_SERVER['HTTP_CLIENT_IP']);
			$ip = "{$ip[3]}.{$ip[2]}.{$ip[1]}.{$ip[0]}";
			return ($ip);
		} elseif ((!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) &&
			  (empty($_SERVER['HTTP_X_FORWARDED_FOR'])) &&
			  (!isset($_SERVER['HTTP_CLIENT_IP'])) &&
			  (empty($_SERVER['HTTP_CLIENT_IP'])) &&
			  (isset($_SERVER['REMOTE_ADDR'])) ) {
			   return ($_SERVER['REMOTE_ADDR']);
		     } else {
			     return (null);
		       }
	}

	/**
	 * Returns User IP Location
	 * @params
	 *        IN:  ip address(0.0.0.0)
	 *        OUT: Country Name
	 */
	public static function getusrcountry($ip)
	{
		$ctry_code = "";
		$numbers   = preg_split("/\./", $ip);
		require_once("ip2ctry/".$numbers[0].".php");
		$code = ($numbers[0] * 16777216) + ($numbers[1] * 65536) +
			($numbers[2] * 256) + ($numbers[3]);
		foreach ($ranges as $key => $value) {
			if ($key<=$code) {
				if ($ranges[$key][0]>=$code) {
					$ctry_code = $ranges[$key][1];
					break;
				}
			}
		}
		if ($ctry_code == "") $ctry_info = "unknown";
		else $ctry_info = self::_getctry($ctry_code);

		return ($ctry_info);
	}
		
	/**
	 * Private Function to retrieve Country name, flag and three letter code
	 * @params
	 *         IN:  TWO Letter Country Code
	 *         OUT: array 'three_letter_code', 
	 *		'country_name', 'country_flag', and 'country_flag'
	 */
	private static function _getctry($ctry_code)
	{
		require_once("ip2ctry/countries.php");
		$ctry_info['three_letter_code'] = $countries[$ctry_code][0];
		$ctry_info['country_name']      = $countries[$ctry_code][1];
		# To display flag
		$ctry_code = strtolower( $ctry_code );
		$flag = "flags/$ctry_code.gif";
		if (file_exists($flag)) {
			$ctry_info['country_flag']       = $flag;
			$ctry_info['country_flag_error'] = "none";
		} else {
			$ctry_info['country_flag_error'] = "flags/noflag.gif";
			$ctry_info['country_flag']       = "unknown";
		}
		return ($ctry_info);
	}
}
?>
