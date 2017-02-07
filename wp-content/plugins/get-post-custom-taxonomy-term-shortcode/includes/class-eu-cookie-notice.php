<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/includes
 * @author     Multidots <inquiry@multidots.in>
 */
class Eu_Cookie_Notice {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Eu_Cookie_Notice_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'eu-cookie-notice';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Eu_Cookie_Notice_Loader. Orchestrates the hooks of the plugin.
	 * - Eu_Cookie_Notice_i18n. Defines internationalization functionality.
	 * - Eu_Cookie_Notice_Admin. Defines all hooks for the admin area.
	 * - Eu_Cookie_Notice_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-eu-cookie-notice-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-eu-cookie-notice-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-eu-cookie-notice-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-eu-cookie-notice-public.php';

		$this->loader = new Eu_Cookie_Notice_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Eu_Cookie_Notice_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Eu_Cookie_Notice_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Eu_Cookie_Notice_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu',$plugin_admin, 'cookie_warning_custom_admin_menu' );
		$this->loader->add_action( 'admin_post_submit-form-cookie',$plugin_admin,  'cw_add_update_options');
		$this->loader->add_action( 'admin_post_nopriv_submit-form-cookie',$plugin_admin, 'cw_add_update_options');
		$this->loader->add_action( 'wp_ajax_cw_reset_settings',$plugin_admin, 'cw_reset_settings');
		$this->loader->add_action( 'wp_ajax_add_plugin_user_eucnotice', $plugin_admin, 'wp_add_plugin_eucnotice_userfn' );
		$this->loader->add_action( 'wp_ajax_hide_subscribe_eucnotice', $plugin_admin, 'hide_subscribe_eucnoticefn' );
		
		/**Welcome page hook**/
		$this->loader->add_action('admin_init', $plugin_admin, 'welcome_eu_cookie_notice_screen_do_activation_redirect');
        $this->loader->add_action('admin_menu', $plugin_admin, 'welcome_pages_screen_eu_cookie_notice');
        $this->loader->add_action('eu_cookie_notice_other_plugins', $plugin_admin, 'eu_cookie_notice_other_plugins');
        $this->loader->add_action('eu_cookie_notice_about', $plugin_admin, 'eu_cookie_notice_about');
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'adjust_the_wp_menu_eu_cookie_notice', 999 );
		
		/**Custom pointer hook**/
        $this->loader->add_action('admin_print_footer_scripts', $plugin_admin, 'custom_eu_cookie_notice_pointers_footer');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Eu_Cookie_Notice_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'cookie_warning_message_box_html' );
		$this->loader->add_action( 'wp_ajax_cw_cookie_noticebar_action', $plugin_public, 'cw_cookie_noticebar_action' ); 
		$this->loader->add_action( 'wp_ajax_nopriv_cw_cookie_noticebar_action', $plugin_public, 'cw_cookie_noticebar_action' );
		
		if (in_array( 'woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) {
			$this->loader->add_filter('woocommerce_paypal_args', $plugin_public, 'paypal_bn_code_filter_eu_cookie_notice', 99, 1); 
		}
		
		$getcwoptionarray = get_option('cookie_warning_option');
		$getcwoptionarray = maybe_unserialize($getcwoptionarray);
		
		$getscriptplacement = !empty( $getcwoptionarray['cw_cookie_script_placement'] ) ? $getcwoptionarray['cw_cookie_script_placement'] :'';
		
		if( !empty( $getscriptplacement ) && isset( $getscriptplacement ) && $getscriptplacement =='header' ) {
			$this->loader->add_action( 'wp_head', $plugin_public, 'cw_scriptplacement_header' );
		} 
		
		if( !empty( $getscriptplacement ) && isset( $getscriptplacement ) && $getscriptplacement =='footer' ) {
			$this->loader->add_action( 'wp_footer', $plugin_public, 'cw_scriptplacement_footer' );	
		}
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Eu_Cookie_Notice_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
