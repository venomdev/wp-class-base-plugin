<?php
/**
 * Plugin Name: venomDev - Plugin Template
 * Description: A WordPress class based plugin template
 * Version: 0.1.0
 * Author: venomDev
 * License: MIT
 */

namespace venomDev;

defined('ABSPATH') || die();

require_once 'include/AutoLoader.php';

class Main {

	/**
	 * Initialize the plugin
	 */
	static function init() {

		// Register the auto loader paths
		AutoLoader::setPaths([
			__NAMESPACE__ => self::path('include'),
			'Vendor' => self::path('vendor')
		]);

		// Start the Admin controller
		if(is_admin()) {

			Admin::init();
		}
	}

	/**
	 * Return the plugin path
	 */
	static function path($path = null) {

		return plugin_dir_path(__FILE__). $path;
	}
}

Main::init();
