<?php
/**
 * Simple PSR4 auto loader
 */

namespace venomDev;

class AutoLoader {

	// Name spaces list and paths
	private static $nameSpaces;

	/**
	 * Set the autoload name spaces and paths
 	 */
	static function setPaths($nsList = array()) {

		if(empty($nsList) || !is_array($nsList)) {

			return;
		}

		self::$nameSpaces = $nsList;

		spl_autoload_register(array(get_called_class(), 'loadNS'));
	}

	/**
	 * Load the namespace if it's registered here
	 */
	static function loadNS($class) {

		// Check valid namespaces
		foreach(self::$nameSpaces as $ns => $nsPath) {

			// Find the namespace
			$res = stripos($class, $ns);
			if($res === false || $res > 0) {

				continue;
			}

			// Set the namespace path
			$path = str_replace("\\", "/",
			  preg_replace("/{$ns}/", $nsPath, $class, 1));

			// Load the class
			$file = "{$path}.php";
			if(file_exists($file)) {

				require_once $file;
				break;
			}
		}
	}
}
