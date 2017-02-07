<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/includes
 * @author     Multidots <inquiry@multidots.in>
 */
class Eu_Cookie_Notice_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		set_transient( '_welcome_screen_eu_cookie_notice_activation_redirect_data', true, 30 );
	}

}
