<?php
/* $Id: cConfig.php,v 0.1 2010/10/14 19:19:00 aedavies Exp $ */

require_once("cError.php");

interface iConf
{
	public static function is_defined($name);
	public static function are_defined(array $names);

	public static function set($name, $value);
	public static function get($name);
	public static function get_all();

	public static function store_conf($config_data);
}

/**
 * Static config container class.
 * Stores global variables.
 *
 * As opposed to the PHP constants, they can be redefined at runtime
 * and can also contain other conf var references. Meaning that when
 * the referenced variable changes, the initial one does as well.
 */
final class cConf implements iConf
{
	/**
	 * Sub-variable reference regexp.
	 *
	 * @var string
	 */
	const var_pattern = '/{([a-z0-9-_]+)}/i';
	/**
	 * Variable container.
	 *
	 * @var array
	 */
	private static $stack = array();

	/**
	 * Var existance check.
	 *
	 * @param  string $name Var name
	 * @return   bool       Check result
	 */
	public static function is_defined($name)
	{
		return(isset(self::$stack[$name]) ? true : false);
	}

	/**
	 * Var existance mass check.
	 *
	 * @param  array $names Var names
	 * @return  bool        Check result
	 */
	public static function are_defined(array $names)
	{
		foreach ($names as $name) {
			if (!self::is_defined($name)) {
				return (false);
			}
		}
		return true;
	}

	/**
	 * Var set.
	 *
	 * To include a var reference in another var, use {VAR_NAME}.
	 * 
	 * Example: conf::set('VAR_NAME', "{OTHER_VAR_NAME} plus more")
	 *
	 * @param string $name  Var name
	 * @param  mixed $value Var value
	 */
	public static function set($name, $value)
	{
		if (!strlen($name)) {
			throw new cError(500, "Invalid config var name");
		}
		self::$stack[$name] = $value;
	}

	/**
	 * Var get.
	 *
	 * Example: conf::get('VAR_NAME')
	 *
	 * @param  string $name Var name
	 * @return  mixed       Var value
	 */
	public static function get($name)
	{
		if(!self::is_defined($name)) {
			throw new cError( 500, "Invalid config var \"$name\"" );
		}
		$value = self::$stack[$name];
	
		if (is_string($value)) {
			return preg_replace_callback(
				self::var_pattern,
				array('cConf', 'replace_callback'),
				$value
			);
		}
		return ($value);
	}

	/**
	 * Var mass get.
	 *
	 * @return array All vars
	 */
	public static function get_all()
	{
		return (self::$stack);
	}

	public static function store_conf($conf_data)
	{
	   # XXX: Do write log data here
	   $conf_file = "../etc/sys.conf";
	   $fd = fopen($conf_file, "w");
	   if ($fd) {
	     # XXX: Write on :)
	     $wf = fwrite($fd, $conf_data);
	     fclose($fd);
	   } else {
		$msg = <<<ERR
	<font color="#ff0000">Fatal Error</font> The Application Developer has been alerted!
	Please check back soon.
ERR;
				throw new cError(500, "$conf_file not found :(");
		cError::showerror($msg);
	   }
	}

	/**
	 * Internal var reference replace callback.
	 *
	 * @return mixed Matched var value
	 */
	private static function replace_callback( $matches )
	{
		if (self::is_defined($matches[1])) {
			return self::get($matches[1]);
		}
		return ('{'.$matches[1].'}');
	}
}
?>