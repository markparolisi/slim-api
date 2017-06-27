<?php
/**
 * ErrorHandler
 *
 * @category    Erdiko
 * @package     Core
 * @copyright   Copyright (c) 2016, Arroyo Labs, http://www.arroyolabs.com
 * @author      Leo Daidone, leo@arroyolabs.com
 */

namespace erdiko\core;

use ToroHook;

class ErrorHandler 
{
	public static function init()
	{
		ini_set('html_errors',0); // @todo review this line
		// error_reporting((E_ALL | E_STRICT)); // @note we shouldn't override by default, but we could inject
		set_error_handler("\\erdiko\\core\\ErrorHandler::errorHandler");
		register_shutdown_function("\\erdiko\\core\\ErrorHandler::fatalErrorShutdownHandler");
	}

	public static function errorHandler($errno, $errstr, $errfile, $errline)
	{
		$debug = \erdiko\core\ErrorHandler::isDebug();
		if ( ! ( error_reporting() & $errno ) || empty( $errstr ) ) {
			return null;
		}

        $errorHook = "500";

		switch ( $errno ) {
			case E_USER_ERROR:
				$vars['msg_type']        = "USER ERROR";
				$vars['msg_description'] = " Fatal error in line $errline of $errfile file";
				$vars['msg_description'] .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")";
				break;

			case E_USER_WARNING:
				$vars['msg_type'] = "USER WARNING";
				break;

			case E_USER_NOTICE:
				$vars['msg_type'] = "USER NOTICE";
				break;

			case E_ERROR:
				$vars['msg_type'] = "ERROR";
				$vars['msg_description'] = print_r(debug_backtrace(),1);
				break;

			default:
				$vars['msg_type'] = "Type of error: [$errno] $errstr";
				$vars['msg_description'] = print_r(debug_backtrace(),1);
				break;
		}

		$vars['code']               = $errno;
		$vars['error']              = trim($errstr);
		$vars['path_info']          = $errfile . " on line " . $errline;
        	$vars['debug']              = $debug;

        	ToroHook::fire($errorHook, $vars );

		return false;
	}

	public static function fatalErrorShutdownHandler()
	{
		$last_error = error_get_last();
		static::errorHandler(E_ERROR, 
			$last_error['message'], $last_error['file'], $last_error['line']);
	}

	/**
	 * isDebug
	 *
	 * @return bool
	 */
	public static function isDebug()
	{
		return (getenv("ERDIKO_DEBUG")=='1');
	}
}
