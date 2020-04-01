<?php
/**
 * venomDev WP Admin Controller
 */

namespace venomDev;

defined('ABSPATH') || die();

class Admin {

	/**
	 * Initialize the Admin site
	 */
	static function init() {

		// Add actions events to handle
		add_action('admin_menu', array(get_called_class(), 'adminMenus'));
	}

	/**
	 * Add the admin menu options
	 */
	static function adminMenus() {

		// Add the main menu item
		add_menu_page("Page Title", "Menu Title", "manage_options",
		  "plugin_main", array(get_called_class(), "menuItem"),
		  "dashicons-admin-tools");
	}

	/**
	 * Show the menu pages
	 */
	static function menuItem() {

		// Read page slug
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
		if(strpos($page, 'plugin_') !== false) {

			$page = substr($page, strlen('plugin_'));
		}

		$file = Main::path("templates/admin/{$page}.php");
		if(file_exists($file)) {

			require_once($file);

		} else {

			echo "Missing the <b>{$page}</b> template<br>";
		}
	}
}
