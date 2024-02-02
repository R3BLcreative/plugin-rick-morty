<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://r3blcreative.com
 * @since      1.0.0
 *
 * @package    Plugin_Rick_Morty
 * @subpackage Plugin_Rick_Morty/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Plugin_Rick_Morty
 * @subpackage Plugin_Rick_Morty/includes
 * @author     James Cook - R3BL Creative <jcook@r3blcreative.com>
 */
class Plugin_Rick_Morty_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-rick-morty',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
