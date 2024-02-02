<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://r3blcreative.com
 * @since             1.0.0
 * @package           Plugin_Rick_Morty
 *
 * @wordpress-plugin
 * Plugin Name:       Rick and Morty
 * Plugin URI:        https://https://rickandmortyapi.com/documentation/
 * Description:       A simple plugin created for a technical interview that connects to the GraphQL API at https://rickandmortyapi.com/documentation/
 * Version:           1.0.0
 * Author:            James Cook - R3BL Creative
 * Author URI:        https://r3blcreative.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-rick-morty
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_RICK_MORTY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-rick-morty-activator.php
 */
function activate_plugin_rick_morty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-rick-morty-activator.php';
	Plugin_Rick_Morty_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-rick-morty-deactivator.php
 */
function deactivate_plugin_rick_morty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-rick-morty-deactivator.php';
	Plugin_Rick_Morty_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_rick_morty' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_rick_morty' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-rick-morty.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_rick_morty() {

	$plugin = new Plugin_Rick_Morty();
	$plugin->run();

}
run_plugin_rick_morty();
