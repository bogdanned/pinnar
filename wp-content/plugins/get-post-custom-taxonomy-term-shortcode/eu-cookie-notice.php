<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.multidots.com/
 * @since             1.0.0
 * @package           Eu_Cookie_Notice
 *
 * @wordpress-plugin
 * Plugin Name:       Eu Cookie Notice
 * Plugin URI:        http://www.multidots.com/
 * Description:       Cookie Notice plugin allows you to simple inform users that your site uses cookies and to comply with the EU cookie law regulations.
 * Version:           1.0.2
 * Author:            Multidots
 * Author URI:        http://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       eu-cookie-notice
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-eu-cookie-notice-activator.php
 */
function activate_eu_cookie_notice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-eu-cookie-notice-activator.php';
	Eu_Cookie_Notice_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-eu-cookie-notice-deactivator.php
 */
function deactivate_eu_cookie_notice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-eu-cookie-notice-deactivator.php';
	Eu_Cookie_Notice_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_eu_cookie_notice' );
register_deactivation_hook( __FILE__, 'deactivate_eu_cookie_notice' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-eu-cookie-notice.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-eu-cookie-notice-constant.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_eu_cookie_notice() {

	$plugin = new Eu_Cookie_Notice();
	$plugin->run();

}
run_eu_cookie_notice();
