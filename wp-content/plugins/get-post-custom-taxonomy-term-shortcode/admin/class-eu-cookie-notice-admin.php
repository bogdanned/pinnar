<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/admin
 * @author     Multidots <inquiry@multidots.in>
 */
class Eu_Cookie_Notice_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Eu_Cookie_Notice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Eu_Cookie_Notice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/eu-cookie-notice-admin.css', array('wp-color-picker','wp-jquery-ui-dialog'), $this->version, 'all' );
		
		if ( !empty( $_GET['page'] ) && isset( $_GET['page'] ) && $_GET['page'] == 'eu_cookie_notice'){
			wp_enqueue_style( $this->plugin_name.'-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
		}
		
		wp_enqueue_style( 'wp-pointer' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Eu_Cookie_Notice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Eu_Cookie_Notice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/eu-cookie-notice-admin.js', array( 'jquery','wp-color-picker','jquery-ui-tabs','jquery-ui-dialog' ), $this->version, false );
		
		wp_localize_script('eu-cookie-notice', 'ajax_params', array(
	        'ajax_url' => admin_url('admin-ajax.php'),
	        'ajax_icon' => plugin_dir_url( __FILE__ ) . '/images/ajax-loader.gif'
	    ));
	    wp_enqueue_script('eu-cookie-notice');
	    wp_enqueue_script( 'wp-pointer' );
	}
	
	
	
	public function custom_eu_cookie_notice_pointers_footer(){ 
		$admin_pointers = custom_eu_cookie_notice_pointers_admin_pointers();
	    ?>
		    <script type="text/javascript">
		        /* <![CDATA[ */
		        ( function($) {
		            <?php
		            foreach ( $admin_pointers as $pointer => $array ) {
		               if ( $array['active'] ) {
		                  ?>
		            $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
		                content: '<?php echo $array['content']; ?>',
		                position: {
		                    edge: '<?php echo $array['edge']; ?>',
		                    align: '<?php echo $array['align']; ?>'
		                },
		                close: function() {
		                    $.post( ajaxurl, {
		                        pointer: '<?php echo $pointer; ?>',
		                        action: 'dismiss-wp-pointer'
		                    } );
		                }
		            } ).pointer( 'open' );
		            <?php
		         }
		      }
		      ?>
		        } )(jQuery);
		        /* ]]> */
		    </script>
		<?php
	}
	
	    // Function For Welcome page to plugin 
    public function welcome_eu_cookie_notice_screen_do_activation_redirect (){ 
    	
    	if (!get_transient('_welcome_screen_eu_cookie_notice_activation_redirect_data')) {
			return;
		}
		
		// Delete the redirect transient
		delete_transient('_welcome_screen_eu_cookie_notice_activation_redirect_data');

		// if activating from network, or bulk
		if (is_network_admin() || isset($_GET['activate-multi'])) {
			return;
		}
		// Redirect to extra cost welcome  page
		wp_safe_redirect(add_query_arg(array('page' => 'eu_cookie_notice_welcome_page&tab=about'), admin_url('index.php')));
    }
    
    public function welcome_pages_screen_eu_cookie_notice() {
		add_dashboard_page(
		'Eu Cookie Notice Dashboard', 'Eu Cookie Notice Dashboard', 'read', 'eu_cookie_notice_welcome_page', array(&$this, 'welcome_screen_content_eu_cookie_notice')
		);
	}
	
	public function welcome_screen_content_eu_cookie_notice(){ 
        ?>
        
         <div class="wrap about-wrap">
            <h1 style="font-size: 2.1em;"><?php printf(__('Welcome to Eu Cookie Notice', 'analytics-for-woocommerce-by-customerio')); ?></h1>

            <div class="about-text woocommerce-about-text">
        <?php
        $message = '';
        printf(__('%s Cookie Notice plugin allows you to simple inform users that your site uses cookies and to comply with the EU cookie law regulations.', 'eu-cookie-notice'), $message, $this->version);
        ?>
                <img class="version_logo_img" src="<?php echo plugin_dir_url(__FILE__) . 'images/eucnotice.png'; ?>">
            </div>

        <?php
        $setting_tabs_wc = apply_filters('eu_cookie_notice_setting_tab', array("about" => "Overview", "other_plugins" => "Checkout our other plugins"));
        $current_tab_wc = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
        $aboutpage = isset($_GET['page'])
        ?>
            <h2 id="woo-extra-cost-tab-wrapper" class="nav-tab-wrapper">
            <?php
            foreach ($setting_tabs_wc as $name => $label)
            echo '<a  href="' . home_url('wp-admin/index.php?page=eu_cookie_notice_welcome_page&tab=' . $name) . '" class="nav-tab ' . ( $current_tab_wc == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            ?>
            </h2>

                <?php
                foreach ($setting_tabs_wc as $setting_tabkey_wc => $setting_tabvalue) {
                	switch ($setting_tabkey_wc) {
                		case $current_tab_wc:
                			do_action('eu_cookie_notice_' . $current_tab_wc);
                			break;
                	}
                }
                ?>
            <hr />
            <div class="return-to-dashboard">
                <a href="<?php echo home_url('/wp-admin/admin.php?page=eu_cookie_notice'); ?>"><?php _e('Go to Eu Cookie Notice Settings', 'eu-cookie-notice'); ?></a>
            </div>
        </div>
	<?php }
	
	
	public function eu_cookie_notice_other_plugins() { 
		global $wpdb;
         $url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/checkout_other_plugin.php';
    	 $response = wp_remote_post( $url, array('method' => 'POST',
    	'timeout' => 45,
    	'redirection' => 5,
    	'httpversion' => '1.0',
    	'blocking' => true,
    	'headers' => array(),
    	'body' => array('plugin' => 'advance-flat-rate-shipping-method-for-woocommerce'),
    	'cookies' => array()));
    	
    	$response_new = array();
    	$response_new = json_decode($response['body']);
		$get_other_plugin = maybe_unserialize($response_new);
		
		$paid_arr = array();
		?>

        <div class="plug-containter">
        	<div class="paid_plugin">
        	<h3>Paid Plugins</h3>
	        	<?php foreach ($get_other_plugin as $key=>$val) { 
	        		if ($val['plugindesc'] =='paid') {?>
	        			
	        			
	        		   <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>	
	        			
	        			
	        		<?php }else {
	        			
	        			$paid_arry[$key]['plugindesc']= $val['plugindesc'];
	        			$paid_arry[$key]['pluginimage']= $val['pluginimage'];
	        			$paid_arry[$key]['pluginurl']= $val['pluginurl'];
	        			$paid_arry[$key]['pluginname']= $val['pluginname'];
	        		
	        	?>
	        	
	         
	            <?php } }?>
           </div>
           <?php if (isset($paid_arry) && !empty($paid_arry)) {?>
           <div class="free_plugin">
           	<h3>Free Plugins</h3>
                <?php foreach ($paid_arry as $key=>$val) { ?>  	
	            <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>
	            <?php } }?>
           </div>
          
        </div>

    <?php
	}
	
	
	/**
     * About tab content of Add social share button about
     *
     */
	public function eu_cookie_notice_about() {
		//do_action('my_own');
		$current_user = wp_get_current_user();

    	?>
        <div class="changelog">
            </br>
           	<style type="text/css">
				p.eu_cookie_notice_overview {max-width: 100% !important;margin-left: auto;margin-right: auto;font-size: 15px;line-height: 1.5;}
				.eu_cookie_notice_ul ul li {margin-left: 3%;list-style: initial;line-height: 23px;}
			</style>  
            <div class="changelog about-integrations">
                <div class="wc-feature feature-section col three-col">
                    <div>
                    
                    <p class="eu_cookie_notice_overview"><?php _e('Cookie Notice plugin is a simple, configurable notice that appears on sticky top, Sticky Bottom and Popup of the page. Easily closed by the user.you can add script in header and footer as per your choice.', 'eu-cookie-notice'); ?></p>
                        
                         <p class="eu_cookie_notice_overview"><strong>Plugin Functionality: </strong></p> 
                        <div class="eu_cookie_notice_ul">
                        	<ul>
								<li>Customize the cookie message</li>
								<li>Redirect users to specified page for more cookie information</li>
								<li>Set cookie expiry</li>
								<li>Custom cookie Message (sticky top, Sticky Bottom and Popup)</li>
								<li>Link to more info page</li>
								<li>Option to accept cookies on scroll</li>
								<li>Option to refuse functional cookies</li>
								<li>Select the position of the cookie message box</li>
								<li>Animate the message box after cookie is accepted</li>
								<li>Select bottons style from None, WordPress and Bootstrap</li>
								<li>Set the text and bar background colors</li>
							</ul>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        <?php	
        	global $wpdb;
        	$current_user =  wp_get_current_user();
		 if (!get_option('eucnotice_plugin_notice_shown')) {
				/**
				 * html for Subscribe popupbox.
				 */
				echo '<div id="eucnotice_dialog" title="Basic dialog"><p>Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free!</p><p><input type="text" id="txt_user_sub_eucnotice" class="regular-text" name="txt_user_sub_eucnotice" value="'.$current_user->user_email.'"></p></div>';
   			
		?>
             
        <script type="text/javascript">

        jQuery( document ).ready(function() {
		
			$( "#eucnotice_dialog" ).dialog({
				modal: true, title: 'Subscribe Now', zIndex: 10000, autoOpen: true,
				width: '500', resizable: false,
				position: {my: "center", at:"center", of: window },
				dialogClass: 'dialogButtons',
				buttons: {
					Yes: function () {
						// $(obj).removeAttr('onclick');
						// $(obj).parents('.Parent').remove();
						var email_id = $('#txt_user_sub_eucnotice').val();
						var data = { 'action': 'add_plugin_user_eucnotice','email_id': email_id };
						// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
						$.post(ajaxurl, data, function(response) {
							$('#eucnotice_dialog').html('<h2>You have been successfully subscribed');
							$(".ui-dialog-buttonpane").remove();
						});
					},
					No: function () {
						var email_id = $('#txt_user_sub_eucnotice').val();
						var data = {'action': 'hide_subscribe_eucnotice',	'email_id': email_id };
						// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
						$.post(ajaxurl, data, function(response) { });
						$(this).dialog("close");
					}
				},
				close: function (event, ui) { $(this).remove(); }
			});
        	
        	jQuery("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");
        	jQuery("div.dialogButtons .ui-dialog-buttonpane .ui-button").css("width","80px");
        	jQuery("div.dialogButtons .ui-dialog-buttonpane .ui-button").css("margin-right","14px");
        	jQuery("div.dialogButtons .ui-dialog-buttonset button").removeClass("ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only");
        	
        });
        </script>
        <?php
        } 
        ?>
	<?php  }
	
	public function adjust_the_wp_menu_eu_cookie_notice(){ 
		remove_submenu_page('index.php', 'eu_cookie_notice_welcome_page');
	}
	
	/**
	 * function for add eu cookie admin menu
	 *
	 */
	public function cookie_warning_custom_admin_menu() {
		/**
		 * add new admin menu
		 */
		add_menu_page( EUCN_PLUGIN_MENU_TITLE,__(EUCN_PLUGIN_MENU_NAME, EUCN_PLUGIN_SLUG),'manage_options',EUCN_PLUGIN_MENU_SLUG,'eucn_custom_admin_setting_options');
		
		/**
		 * function for cookie notice settings
		 */
		function eucn_custom_admin_setting_options() {
			global $post,$wpdb; 
			
			/**
			 * get current user
			 */
			$current_user = wp_get_current_user();
			
			//check eucnotice_plugin_notice_shown active or not
			if (!get_option('eucnotice_plugin_notice_shown')) {
				/**
				 * html for Subscribe popupbox.
				 */
				echo '<div id="eucnotice_dialog" title="Basic dialog"><p>Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free!</p><p><input type="text" id="txt_user_sub_eucnotice" class="regular-text" name="txt_user_sub_eucnotice" value="'.$current_user->user_email.'"></p></div>';
			}
			?>
			<!--Html for eu cookie notice-->
			<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>main_container">
				<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>title"><h2><?php echo EUCN_PLUGIN_NAME; ?></h2></div>
				<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>notice"></div>
				<div id="tabscokkie">
					<form id="cw_plugin_form_id" method="post" action="<?php echo get_admin_url(); ?>admin-post.php" enctype="multipart/form-data" novalidate="novalidate">
						<input type='hidden' name='action' value='submit-form-cookie' />
						<input type='hidden' name='action-which' value='add' />
						<ul>
							<li><a href="#settings"><?php echo __(EUCN_PLIGIN_SETTING_TAB,EUCN_PLUGIN_SLUG); ?></a></li>
							<li><a href="#buttons"><?php echo __(EUCN_PLIGIN_BUTTONS_TAB,EUCN_PLUGIN_SLUG); ?></a></li>
							<!--<li><a href="#shortcode">Shortcode</a></li>-->
							<li><a href="#advancesettings"><?php echo __(EUCN_PLIGIN_ADD_SETTING_TAB,EUCN_PLUGIN_SLUG); ?></a></li>
					    </ul>
					    
					    <!--html for general tab settings-->
			     		<div id="settings">
							<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>sub_contain">
								<h2><?php echo EUCN_PLUGIN_CONFIGURATION_TEXT; ?></h2>
								<?php
									$getcwoptionarray = get_option('cookie_warning_option');
									$getcwoptionarray = maybe_unserialize($getcwoptionarray);
								 ?>
								<table class="form-table">
									<tbody>
										<tr>
											<th><?php echo __('Enable Cookie Bar',EUCN_PLUGIN_SLUG) ?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<?php 
													if ($getcwoptionarray != '') {
														if( isset( $getcwoptionarray['cw_cookie_bar_enabled']) && $getcwoptionarray['cw_cookie_bar_enabled'] !='' && !empty( $getcwoptionarray['cw_cookie_bar_enabled'] ) ) { ?>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_bar_enabled']) && $getcwoptionarray['cw_cookie_bar_enabled'] == 'yes') { echo 'checked';} ?> type="radio" checked name="cw_cookie_bar_enabled" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_bar_enabled']) && $getcwoptionarray['cw_cookie_bar_enabled'] == 'no') { echo 'checked';} ?> type="radio" name="cw_cookie_bar_enabled" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
														} else { ?>
															<label><input type="radio" checked name="cw_cookie_bar_enabled" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio" name="cw_cookie_bar_enabled" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
														}
													} else { ?>
														<label><input type="radio" checked name="cw_cookie_bar_enabled" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
														<label><input type="radio" name="cw_cookie_bar_enabled" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
													}?>
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_CONFIGURATION_MSG,EUCN_PLUGIN_SLUG ); ?></th>
											<td><div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row"><textarea name="cw_display_message"><?php echo isset( $getcwoptionarray['cw_message'] ) ? $getcwoptionarray['cw_message'] :"";?></textarea><p><?php echo EUCN_PLIGIN_MESSAGE_TOOLTIP; ?></p></div></td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_ON_SCROLL_TXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<input type="checkbox" <?php if( isset( $getcwoptionarray['cw_refuse_on_scroll'] ) && $getcwoptionarray['cw_refuse_on_scroll'] =='1' ) { echo"checked"; } ?> value="<?php echo isset( $getcwoptionarray['cw_refuse_on_scroll'] ) ? $getcwoptionarray['cw_refuse_on_scroll'] : '0'; ?>" name="cw_refuse_on_scroll_btn" id="cw_refuse_on_scroll_btn" ><?php echo EUCN_PLUGIN_ON_SCROLL_OPTION_TEXT; ?>
												</div>
												<div <?php if( isset( $getcwoptionarray['cw_refuse_on_scroll'] ) && $getcwoptionarray['cw_refuse_on_scroll'] =='1' ) { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>onscroll_contain">
													<input type="text" value="<?php echo !empty( $getcwoptionarray['cw_refuse_on_scroll_amount'] ) ? $getcwoptionarray['cw_refuse_on_scroll_amount'] : '100'; ?>" name="cw_on_scroll_amount"> px
												<p><?php echo __(EUCN_PLIGIN_REFUSE_SCROLL_TOOLTIP,EUCN_PLUGIN_SLUG); ?></p>
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_COOKIE_EXPIRY_TEXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<select name="cw_cookie_expiry_time">
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='1day' ) { echo 'selected'; } ?> value="1day">1 day</option>
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='1week' ) { echo 'selected'; } ?> value="1week">1 week</option>
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='1month' ) { echo 'selected'; } ?> value="1month">1 month</option> 
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='3months' ) { echo 'selected'; } ?> value="3months">3 months</option>
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='6months' ) { echo 'selected'; } ?> value="6months">6 months</option>
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='1year' ) { echo 'selected'; } ?> value="1year">1 year</option>
													<option <?php if( isset( $getcwoptionarray['cw_cookie_expiry_time'] ) && $getcwoptionarray['cw_cookie_expiry_time'] =='infinity' ) { echo 'selected'; } ?> value="infinity">infinity</option>
												</select>
												<p><?php echo EUCN_PLIGIN_COOKIE_EXPIRE_TOOLTIP;?></p>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_SCRIPT_PLACEMENT_TEXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<?php 
													if ($getcwoptionarray != '') {
														if( isset( $getcwoptionarray['cw_cookie_script_placement'] ) && $getcwoptionarray['cw_cookie_script_placement'] !='' && !empty( $getcwoptionarray['cw_cookie_script_placement'] ) ) { ?>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_script_placement'] ) && $getcwoptionarray['cw_cookie_script_placement'] == 'header') { echo 'checked';} ?> type="radio" checked name="cw_script_placement" value="header"><?php echo __('Header',EUCN_PLUGIN_SLUG); ?></label>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_script_placement'] ) && $getcwoptionarray['cw_cookie_script_placement'] == 'footer') { echo 'checked';} ?> type="radio" name="cw_script_placement" value="footer"><?php echo __('Footer',EUCN_PLUGIN_SLUG); ?></label><?php 
														} else { ?>
															<label><input type="radio" checked name="cw_script_placement" value="header"><?php echo __('Header',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio" name="cw_script_placement" value="footer"><?php echo __('Footer',EUCN_PLUGIN_SLUG); ?></label><?php 
														}
													} else { ?>
														<label><input type="radio" checked name="cw_script_placement" value="header"><?php echo __('Header',EUCN_PLUGIN_SLUG); ?></label>
														<label><input type="radio" name="cw_script_placement" value="footer"><?php echo __('Footer',EUCN_PLUGIN_SLUG); ?></label><?php 
													}?>
												<p><?php echo __('Select where the plugin scripts should be placed.',EUCN_PLUGIN_SLUG); ?></p>
											</td>
										</tr>
										<tr style="display:none;">
											<th><?php echo __( EUCN_PLUGIN_DEACTIVATION_TEXT,EUCN_PLUGIN_SLUG );?></th>
											<td><input type="checkbox" <?php if( isset( $getcwoptionarray['cw_deactivation_option'] ) && $getcwoptionarray['cw_deactivation_option'] =='1' ) { echo'checked';} ?> value="<?php echo isset( $getcwoptionarray['cw_deactivation_option'] ) ? $getcwoptionarray['cw_deactivation_option'] :'0'; ?>" name="cw_deactivation_option" id="cw_deactivation_option"></td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_MSG_POSITION,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<?php 
													if ($getcwoptionarray != '') {
														if( isset( $getcwoptionarray['cw_message_position'] ) && $getcwoptionarray['cw_message_position'] !='' && !empty( $getcwoptionarray['cw_message_position'] )) { ?>
															<label><input type="radio" <?php if( isset( $getcwoptionarray['cw_message_position']) && $getcwoptionarray['cw_message_position'] =='top' ) { echo 'checked';} ?> name="cw_msg_position" class="cw_msg_position" value="top"><?php echo __('Sticky Top',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="sticky top" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/top__image.jpg' ?>" /></label>
															<label><input type="radio" <?php if( isset( $getcwoptionarray['cw_message_position']) && $getcwoptionarray['cw_message_position'] =='bottom' ) { echo 'checked';} ?> name="cw_msg_position" class="cw_msg_position" value="bottom"><?php echo __('Sticky Bottom',EUCN_PLUGIN_SLUG); ?>  <img class="msg_position" alt="sticky bottom" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/bottom__image.jpg' ?>" /></label>
															<label><input type="radio" <?php if( isset( $getcwoptionarray['cw_message_position']) && $getcwoptionarray['cw_message_position'] =='fancybox' ) { echo 'checked';} ?> name="cw_msg_position" class="cw_msg_position" value="fancybox"><?php echo __('Popup',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="popup" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/popup__image.jpg' ?>" /></label><?php 
														} else { ?>
															<label><input type="radio" checked name="cw_msg_position" class="cw_msg_position" value="top"><?php echo __('Sticky Top',EUCN_PLUGIN_SLUG); ?><img class="msg_position" alt="sticky top" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/top__image.jpg' ?>" /></label>
															<label><input type="radio" name="cw_msg_position" class="cw_msg_position" value="bottom"><?php echo __('Sticky Bottom',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="sticky bottom" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/bottom__image.jpg' ?>" /></label>
															<label><input type="radio" name="cw_msg_position" class="cw_msg_position" value="fancybox"><?php echo __('Popup',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="popup" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/popup__image.jpg' ?>" /></label><?php 
														}
													} else { ?>
														<label><input type="radio" checked name="cw_msg_position" class="cw_msg_position" value="top"><?php echo __('Sticky Top',EUCN_PLUGIN_SLUG); ?><img class="msg_position" alt="sticky top" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/top__image.jpg' ?>" /></label>
														<label><input type="radio" name="cw_msg_position" class="cw_msg_position" value="bottom"><?php echo __('Sticky Bottom',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="sticky bottom" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/bottom__image.jpg' ?>" /></label>
														<label><input type="radio" name="cw_msg_position" class="cw_msg_position" value="fancybox"><?php echo __('Popup',EUCN_PLUGIN_SLUG); ?> <img class="msg_position" alt="popup" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/popup__image.jpg' ?>" /></label><?php 
													} ?>
												<p><?php echo __(EUCN_PLIGIN_MSG_POSITION_TOOLTIP,EUCN_PLUGIN_SLUG); ?></p>
											</td>
										</tr>
										<?php
										$displayoption =''; 
										if( isset( $getcwoptionarray['cw_message_position'] ) && !empty( $getcwoptionarray['cw_message_position'] ) & $getcwoptionarray['cw_message_position'] =='fancybox' ) {
											$displayoption =' style="display:none"';
										} else {
											$displayoption ='';
										}
										?>
										<tr <?php echo $displayoption; ?> class="cw_cookie_animation_enable">
											<th ><?php echo __( EUCN_PLUGIN_MSG_ANIMATION,EUCN_PLUGIN_SLUG );?></th>
											<td >
												<?php 
													if ($getcwoptionarray != '') {
														if( isset( $getcwoptionarray['cw_message_animation'] ) && $getcwoptionarray['cw_message_animation'] !='' && !empty( $getcwoptionarray['cw_message_animation'] ) ) { ?>
															<label><input type="radio"  <?php if( isset( $getcwoptionarray['cw_message_animation'] ) && $getcwoptionarray['cw_message_animation'] =='none' ) { echo 'checked';} ?> name="cw_msg_animation" class="cw_msg_animation" value="none"><?php echo __('None',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  <?php if( isset( $getcwoptionarray['cw_message_animation'] ) && $getcwoptionarray['cw_message_animation'] =='fade' ) { echo 'checked';} ?> name="cw_msg_animation" class="cw_msg_animation" value="fade"><?php echo __('Fade',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  <?php if( isset( $getcwoptionarray['cw_message_animation'] ) && $getcwoptionarray['cw_message_animation'] =='slide' ) { echo 'checked';} ?> name="cw_msg_animation" class="cw_msg_animation" value="slide"><?php echo __('Slide',EUCN_PLUGIN_SLUG); ?></label>
													<?php } else { ?>
															<label><input type="radio"  checked name="cw_msg_animation" class="cw_msg_animation" value="none"><?php echo __('None',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  name="cw_msg_animation" class="cw_msg_animation" value="fade"><?php echo __('Fade',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  name="cw_msg_animation" class="cw_msg_animation" value="slide"><?php echo __('Slide',EUCN_PLUGIN_SLUG); ?></label><?php 
														}
													} else { ?>
														<label><input type="radio"  checked name="cw_msg_animation" class="cw_msg_animation" value="none"><?php echo __('None',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  name="cw_msg_animation" class="cw_msg_animation" value="fade"><?php echo __('Fade',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio"  name="cw_msg_animation" class="cw_msg_animation" value="slide"><?php echo __('Slide',EUCN_PLUGIN_SLUG); ?></label><?php 
													} ?>
												<p><?php echo __(EUCN_PLIGIN_MSG_ANIMATION_TOOLTIP,EUCN_PLUGIN_SLUG); ?></p>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_MSG_COLOR_EFFECT_TXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>color_main">
													<p><?php echo __('Message box Text color',EUCN_PLUGIN_SLUG); ?></p>
													<input type="text" name="cw_box_text_color" value="<?php echo !empty( $getcwoptionarray['cw_box_text_color'] ) ? $getcwoptionarray['cw_box_text_color'] :'#FFFFFF'; ?>" class="cw_txt_color_effect">
												</div>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>color_main">
													<p><?php echo __('Message box Bakground color',EUCN_PLUGIN_SLUG); ?></p>
													<input type="text" name="cw_box_bg_color" value="<?php echo !empty( $getcwoptionarray['cw_box_bg_color'] ) ? $getcwoptionarray['cw_box_bg_color'] :'#000000'; ?>" class="cw_box_color_effect">
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __('Auto-hide cookie bar after delay?',EUCN_PLUGIN_SLUG); ?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<?php 
													if ($getcwoptionarray != '') {
														if( isset( $getcwoptionarray['cw_cookie_auto_hide'] ) && $getcwoptionarray['cw_cookie_auto_hide'] !='' && !empty( $getcwoptionarray['cw_cookie_auto_hide'] ) ) { ?>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_auto_hide'] ) && $getcwoptionarray['cw_cookie_auto_hide'] == 'yes') { echo 'checked';} ?> type="radio" checked name="cw_cookie_auto_hide" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
															<label><input <?php if( isset( $getcwoptionarray['cw_cookie_auto_hide'] ) && $getcwoptionarray['cw_cookie_auto_hide'] == 'no') { echo 'checked';} ?> type="radio" name="cw_cookie_auto_hide" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
														} else { ?>
															<label><input type="radio" checked name="cw_cookie_auto_hide" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
															<label><input type="radio" name="cw_cookie_auto_hide" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
														}
													} else { ?>
														<label><input type="radio" checked name="cw_cookie_auto_hide" value="yes"><?php echo __('On',EUCN_PLUGIN_SLUG); ?></label>
														<label><input type="radio" name="cw_cookie_auto_hide" value="no"><?php echo __('Off',EUCN_PLUGIN_SLUG); ?></label><?php 
													}?>
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __('Milliseconds until hidden',EUCN_PLUGIN_SLUG); ?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<?php 
													if ($getcwoptionarray != '') {
														if( isset(  $getcwoptionarray['cw_cookie_auto_hide_seconds'] ) && $getcwoptionarray['cw_cookie_auto_hide_seconds'] !='' && !empty( $getcwoptionarray['cw_cookie_auto_hide_seconds'] ) ) { ?>
															<input type="text" value="<?php echo !empty( $getcwoptionarray['cw_cookie_auto_hide_seconds'] ) ? $getcwoptionarray['cw_cookie_auto_hide_seconds'] : '5000'; ?>" name="cw_cookie_auto_hide_seconds"><?php 
														} else { ?>
															<input type="text" value="5000" name="cw_cookie_auto_hide_seconds"><?php 
														}
													} else { ?>
														<input type="text" value="5000" name="cw_cookie_auto_hide_seconds"><?php
													}?>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!--html for buttons tab settings-->
						<div id="buttons">
							<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>sub_contain">
							<table class="form-table">
									<tbody>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_BUTTON_TXT,EUCN_PLUGIN_SLUG );?></th>
											<td><div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row"><input type="text" value="<?php echo isset( $getcwoptionarray['cw_yes_btn'] ) ? $getcwoptionarray['cw_yes_btn'] :"ok";?>" name="cw_display_btn_txt"><p><?php echo __(EUCN_PLIGIN_BUTTON_OK_TOOLTIP,EUCN_PLUGIN_SLUG); ?></p></div></td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_MORE_INFO_LINK,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<input type="checkbox" <?php if( isset( $getcwoptionarray['cw_more_info_link'] ) && $getcwoptionarray['cw_more_info_link'] !='' && $getcwoptionarray['cw_more_info_link'] == '1') { echo "checked";} ?> value="<?php echo isset( $getcwoptionarray['cw_more_info_link'] ) ? $getcwoptionarray['cw_more_info_link'] :"0";?>" name="cw_more_info_links" id="cw_more_info_links" ><?php echo EUCN_PLUGIN_MORE_LINK_OPTION; ?>
												</div>
												<div  <?php if( isset( $getcwoptionarray['cw_more_info_link'] ) && $getcwoptionarray['cw_more_info_link'] !='' && $getcwoptionarray['cw_more_info_link'] == '1') { echo 'style="display:block"';   } else { echo 'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>more_info">
														<input type="text" value="<?php echo !empty( $getcwoptionarray['cw_more_link_txt']) ? $getcwoptionarray['cw_more_link_txt'] :'Read more';?>" name="cw_more_links_text">
														<p>The text of the more info button.</p>
														<?php if( !empty($getcwoptionarray['cw_more_info_link']) && $getcwoptionarray['cw_more_info_link'] !='' && $getcwoptionarray['cw_more_info_link'] == '1' ) { ?> 
															<label><input type="radio" <?php if( isset( $getcwoptionarray['cw_page_attribte'] ) && $getcwoptionarray['cw_page_attribte'] =='custom' ) { echo 'checked'; } ?> name="cw_page_link_attribute" value="custom" class="cw_page_custom_link" >Custom Link</label>
															<label><input type="radio" <?php if( isset( $getcwoptionarray['cw_page_attribte'] ) && $getcwoptionarray['cw_page_attribte'] =='pages' ) { echo 'checked'; } ?> name="cw_page_link_attribute" value="pages" class="cw_page_custom_link">Page Link</label>
														<?php } else { ?>
															<label><input type="radio" checked name="cw_page_link_attribute" value="custom" class="cw_page_custom_link" >Custom Link</label>
															<label><input type="radio" name="cw_page_link_attribute" value="pages" class="cw_page_custom_link">Page Link</label>
														<?php } ?>
														<p><?php echo EUCN_PLIGIN_LINK_CUSTOM_PAGE_TOOLTIP; ?></p>
														<div <?php if( isset( $getcwoptionarray['cw_page_attribte'] ) && $getcwoptionarray['cw_page_attribte'] =='custom' ) { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>custom_link_option">
															<input type="text" name="cw_custom_page_link" value="<?php echo isset( $getcwoptionarray['cw_page_links'] ) ? $getcwoptionarray['cw_page_links'] :''; ?>">
															<p><?php echo EUCN_PLIGIN_LINK_URL_TOOLTIP;?></p>
														</div>
														<div <?php if( isset(  $getcwoptionarray['cw_page_attribte'] ) && $getcwoptionarray['cw_page_attribte'] =='pages' ) { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>page_link_option">
															<select name="cw_select_page_link">
																<option value="">-- select page --</option>
																<?php
																$args = array(
																	'posts_per_page'   => -1,
																	'post_type'        => 'page',
																	'orderby'          => 'title',
																	'order'            => 'ASC',
																	'post_status'      => 'publish',
																);
																$posts_array = get_posts( $args );
																if( isset( $posts_array ) && !empty( $posts_array ) && $posts_array !='' ) {
																	foreach ( $posts_array as $key=> $value ) { ?>
																		<?php if( isset( $getcwoptionarray['cw_page_select_links']) && $getcwoptionarray['cw_page_select_links'] !=''  && !empty( $getcwoptionarray['cw_page_select_links'] ) ) { ?>
																			<option <?php if( isset( $getcwoptionarray['cw_page_select_links'] ) && $getcwoptionarray['cw_page_select_links'] == $value->ID ) { echo "selected";} ?> value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
																		<?php } else { ?>
																			<option value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
																		<?php } ?>
																	<?php }
																}
																?>
															</select>
															<p><?php echo EUCN_PLIGIN_LINK_SITE_PAGE_TOOLTIP; ?></p>
														</div>
													</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_MORE_LINK_TARGET,EUCN_PLUGIN_SLUG );?></th>
											<td><div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<select name="cw_target_attribute">
														<option <?php if( isset( $getcwoptionarray['cw_page_link_target'] ) && $getcwoptionarray['cw_page_link_target'] !='' && $getcwoptionarray['cw_page_link_target'] == '_blank' ) { echo 'selected';} ?> value="_blank">_blank</option>
														<option <?php if( isset( $getcwoptionarray['cw_page_link_target'] ) && $getcwoptionarray['cw_page_link_target'] !='' && $getcwoptionarray['cw_page_link_target'] == '_self' ) { echo 'selected';} ?> value="_self">_self</option>
													</select>
													<p><?php echo EUCN_PLIGIN_LINK_TARGET_TOOLTIP; ?></p>
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_REFUSE_BTN_TEXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<input type="checkbox" <?php if( isset( $getcwoptionarray['cw_refuse_btn_chk'] ) && $getcwoptionarray['cw_refuse_btn_chk'] =='1' ) { echo"checked"; } ?> value="<?php echo isset( $getcwoptionarray['cw_refuse_btn_chk'] ) ? $getcwoptionarray['cw_refuse_btn_chk'] :'0'; ?>" name="cw_refuse_chk_btn" id="cw_refuse_chk_btn" ><?php echo EUCN_PLUGIN_REFUSE_OPTION_TEXT; ?> (Give to the user the possibility to refuse third party non functional cookies.)
												</div>
												<div <?php if( isset( $getcwoptionarray['cw_refuse_btn_chk'] ) && $getcwoptionarray['cw_refuse_btn_chk'] =='1' ) { echo 'style="display:block"'; } else { echo 'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>refuse_contain">
													<input type="text" value="<?php echo !empty( $getcwoptionarray['cw_refuse_btn_text'] ) ? $getcwoptionarray['cw_refuse_btn_text'] :'no'; ?>" name="cw_refuse_btn_txt" id="cw_refuse_btn_txt">
													<p><?php echo EUCN_PLIGIN_REFUSE_BTN_TOOLTIP; ?></p>
													<textarea name="cw_refuse_additional_script" id="cw_refuse_additional_script"><?php echo !empty( $getcwoptionarray['cw_refuse_additional_script'] ) ? $getcwoptionarray['cw_refuse_additional_script'] :''; ?></textarea>
													<p><?php echo EUCN_PLIGIN_REFUSE_SCRIPT_TOOLTIP; ?></p>
												</div>
											</td>
										</tr>
										<tr>
											<th><?php echo __( EUCN_PLUGIN_BUTTON_STYLE_TXT,EUCN_PLUGIN_SLUG );?></th>
											<td>
												<?php if( !empty( $getcwoptionarray['cw_button_style'] ) && $getcwoptionarray['cw_button_style'] !='' ) {?> 
													<label><input type="radio" <?php if( $getcwoptionarray['cw_button_style'] =='none' ) { echo 'checked'; } ?>  name="cw_msg_btn_styles" class="cw_msg_btn_style" value="none">None</label>
													<label><input type="radio" <?php if( $getcwoptionarray['cw_button_style'] =='wordpress' ) { echo 'checked'; } ?> name="cw_msg_btn_styles" class="cw_msg_btn_style" value="wordpress">WordPress </label>
													<label><input type="radio" <?php if( $getcwoptionarray['cw_button_style'] =='bootstrap' ) { echo 'checked'; } ?> name="cw_msg_btn_styles" class="cw_msg_btn_style" value="bootstrap">Bootstrap</label>
												<?php } else { ?> 
													<label><input type="radio"  checked name="cw_msg_btn_styles" class="cw_msg_btn_style" value="none">None</label>
													<label><input type="radio"  name="cw_msg_btn_styles" class="cw_msg_btn_style" value="wordpress">WordPress </label>
													<label><input type="radio"  name="cw_msg_btn_styles" class="cw_msg_btn_style" value="bootstrap">Bootstrap</label>
												<?php } ?> 
												<P><?php echo EUCN_PLIGIN_BTN_STYLE_TOOLTIP; ?></P>
												<?php 
													if ($getcwoptionarray != '') {
														if( $getcwoptionarray['cw_button_style'] !='' && !empty( $getcwoptionarray['cw_button_style'] ) ) { ?>
															<div <?php if( $getcwoptionarray['cw_button_style'] =='none' ) { echo'style="display:block"'; } else { echo'style="display:none"'; } ?> class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>custom_button_style">
																<p>Button Text color</p>
																<input type="text" name="cw_button_text_color" value="<?php echo !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#CCCCCC'; ?>" class="cw_txt_color_effect">
																<p>Button Bakground color</p>
																<input type="text" name="cw_button_bg_color" value="<?php echo !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000000'; ?>" class="cw_txt_color_effect">
															</div><?php 
														} else { ?>
															<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>custom_button_style">
																<p>Button Text color</p>
																<input type="text" name="cw_button_text_color" value="<?php echo !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#CCCCCC'; ?>" class="cw_txt_color_effect">
																<p>Button Bakground color</p>
																<input type="text" name="cw_button_bg_color" value="<?php echo !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000000'; ?>" class="cw_txt_color_effect">
															</div><?php 
														}
													} else { ?>
														<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>custom_button_style">
															<p>Button Text color</p>
															<input type="text" name="cw_button_text_color" value="<?php echo !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#CCCCCC'; ?>" class="cw_txt_color_effect">
															<p>Button Bakground color</p>
															<input type="text" name="cw_button_bg_color" value="<?php echo !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000000'; ?>" class="cw_txt_color_effect">
														</div><?php 
													} ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!--html for shortcode tab settings-->
						<!--<div id="shortcode">
							<div class="<?php //echo EUCN_HTML_CLASS_PREFIX; ?>sub_contain">
								<dd class="cli-help" style="display: block;">
									<h4>Cookie bar shortcodes</h4>
									<p>You can enter the shortcodes in the "message" field of the Cookie Law Info bar. They add nicely formatted buttons and/or links into the cookie bar, without you having to add any HTML.</p>
									<p>The shortcodes are:</p>
									
									<pre>[md_cookie_accept]</pre><span>If you just want a standard green "Accept" button that closes the header and nothing more, use this shortcode. It is already styled, you don't need to customise it.</span>
									
									<pre>[md_cookie_accept colour="red"]</pre><span>Alternatively you can add a colour value. Choose from: red, blue, orange, yellow, green or pink.<br><em>Careful to use the British spelling of "colour" for the attribute.</em></span>
									
									<pre>[md_cookie_button]</pre><span>This is the "main button" you customise above.</span>
									
									<pre>[md_cookie_link]</pre><span>This is the "read more" link you customise above.</span>
									
									<h4>Other shortcodes</h4>
									<p>These shortcodes can be used in pages and posts on your website. It is not recommended to use these inside the cookie bar itself.</p>
									
									<pre>[md_cookie_audit]</pre><span>This prints out a nice table of cookies, in line with the guidance given by the ICO. <em>You need to enter the cookies your website uses via the Cookie Law Info menu in your WordPress dashboard.</em></span>
									
									<pre>[md_delete_cookies]</pre><span>This shortcode will display a normal HTML link which when clicked, will delete the cookie set by Cookie Law Info (this cookie is used to remember that the cookie bar is closed).</span>
									<pre>[md_delete_cookies text="Click here to delete"]</pre><span>Add any text you like- useful if you want e.g. another language to English.</span>
								</dd>
							</div>
						</div>-->
						<!--html for addvance tab settings-->
						<div id="advancesettings">
							<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>sub_contain">
								<table class="form-table">
									<tbody>
										<tr>
											<td>
												<div class="<?php echo EUCN_HTML_CLASS_PREFIX; ?>row">
													<p><?php echo __(EUCN_PLUGIN_ADD_SETTING_CONTENT,EUCN_PLUGIN_SLUG); ?></p>
													<input type="button" value="<?php echo __(EUCN_PLIGIN_RESET_BUTTON,EUCN_PLUGIN_SLUG); ?>" name="cw_reset_options" class="button button-primary" id="cw_reset_settings">
													<p><?php echo __(EUCN_PLUGIN_ADD_SETT_WARN_MSG,EUCN_PLUGIN_SLUG); ?></p>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<p class="submit"><input type="submit" value="<?php echo __(EUCN_PLIGIN_SAVE_BUTTON,EUCN_PLUGIN_SLUG); ?>" name="cw_scve_option" class="button button-primary" ></p>
					</form>
				</div>
			</div>
<?php  }
	}
	
	/**
	 * function for add or update plugin settings
	 *
	 */
	function cw_add_update_options() {
		global $post,$wpdb;
		
		//get action
		$getformaction = isset( $_POST['action'] ) ? $_POST['action'] :'';
		
		//get form action
		$getaction = isset( $_POST['action-which'] ) ? $_POST['action-which'] :'';
		
		//check form action not null
		if( !empty( $getaction ) && $getaction == 'add' && $getformaction == 'submit-form-cookie' ) {
			
			//get plugin settings option
			$getcwdisplaymessage = isset( $_POST['cw_display_message'] ) ? $_POST['cw_display_message'] : '';
			$getcwenabled = isset( $_POST['cw_cookie_bar_enabled'] ) ? $_POST['cw_cookie_bar_enabled'] : '';
			$getcwautoHide = isset( $_POST['cw_cookie_auto_hide'] ) ? $_POST['cw_cookie_auto_hide'] : '';
			$getcwautoHideSeconds = isset( $_POST['cw_cookie_auto_hide_seconds'] ) ? $_POST['cw_cookie_auto_hide_seconds'] : '';
			$getcwdisplaybtntxt = trim($_POST['cw_display_btn_txt']);
			$getcwdisplaybtntxt = !empty( $getcwdisplaybtntxt ) ? $getcwdisplaybtntxt : 'Ok';
			$getcwmoreinfolinks = isset( $_POST['cw_more_info_links'] ) ? $_POST['cw_more_info_links'] : '';
			$getcwpagelinks ='';
			$getcwmorelinkstext ='';
			$getcwpagselectelinks ='';
			$getcwpagelinkattribute ='';
			
			if( !empty( $getcwmoreinfolinks ) && $getcwmoreinfolinks !='' && $getcwmoreinfolinks == '1' ) {
				
				$getcwmorelinkstext = isset( $_POST['cw_more_links_text'] ) ? $_POST['cw_more_links_text'] : '';
				$getcwpagelinkattribute = isset( $_POST['cw_page_link_attribute'] ) ? $_POST['cw_page_link_attribute'] : '';
				
				if( $getcwpagelinkattribute !='' && !empty( $getcwpagelinkattribute ) && $getcwpagelinkattribute =='custom' ) {
					$getcwpagelinks = isset( $_POST['cw_custom_page_link'] ) ? $_POST['cw_custom_page_link'] : '';
				}
				
				if( $getcwpagelinkattribute !='' && !empty( $getcwpagelinkattribute ) && $getcwpagelinkattribute =='pages' ) {
					$getcwpagselectelinks = isset( $_POST['cw_select_page_link'] ) ?  $_POST['cw_select_page_link'] : '';
				}
				
			}
			
			$getlinktaget = isset( $_POST['cw_target_attribute'] ) ? $_POST['cw_target_attribute']  : '';
			$getrefusebtnchk = isset( $_POST['cw_refuse_chk_btn'] ) ? $_POST['cw_refuse_chk_btn']  : '';
			
			$getrefusebtntext ='';
			$getrefuseadditionalscript ='';
			
			if( !empty( $getrefusebtnchk ) && $getrefusebtnchk !='' && $getrefusebtnchk =='1' ) {
				$getrefusebtntext = isset( $_POST['cw_refuse_btn_txt'] ) ? $_POST['cw_refuse_btn_txt']  : '';
				$getrefuseadditionalscript = isset( $_POST['cw_refuse_additional_script'] ) ? stripslashes(  $_POST['cw_refuse_additional_script'] )  : '';
			}
			
			$getrefuseonscroll = isset( $_POST['cw_refuse_on_scroll_btn'] ) ? $_POST['cw_refuse_on_scroll_btn']  : '';
			
			$getrefuseonscrollamount ='';
			
			if( $getrefuseonscroll !='' && !empty( $getrefuseonscroll ) && $getrefuseonscroll =='1' ) {
				$getrefuseonscrollamount = isset( $_POST['cw_on_scroll_amount'] ) ? $_POST['cw_on_scroll_amount']  : '';
			}
			
			$getcookieexpiretime = isset( $_POST['cw_cookie_expiry_time'] ) ? $_POST['cw_cookie_expiry_time']  : '';
			$getscriptplacement = isset( $_POST['cw_script_placement'] ) ? $_POST['cw_script_placement']  : '';
			$getdeactivationoption = isset( $_POST['cw_deactivation_option'] ) ? $_POST['cw_deactivation_option']  : '';
			$getmessageboxposition = isset( $_POST['cw_msg_position'] ) ? $_POST['cw_msg_position']  : '';
			$getmessageboxanimation = isset( $_POST['cw_msg_animation'] ) ? $_POST['cw_msg_animation']  : '';
			$getbuttonstyle = isset( $_POST['cw_msg_btn_styles'] ) ? $_POST['cw_msg_btn_styles']  : '';
			
			$getbuttontextcolor ='';
			$getbuttonbgcolor ='';
			if( !empty( $getbuttonstyle ) && $getbuttonstyle !='' && $getbuttonstyle =='none' ) {
				$getbuttontextcolor = isset( $_POST['cw_button_text_color'] ) ? $_POST['cw_button_text_color']  : '';
				$getbuttonbgcolor = isset( $_POST['cw_button_bg_color'] ) ? $_POST['cw_button_bg_color']  : '';
			}
			
			$getmsgboxtextcolor = isset( $_POST['cw_box_text_color'] ) ? $_POST['cw_box_text_color']  : '';
			$getmsgboxbgcolor = isset( $_POST['cw_box_bg_color'] ) ? $_POST['cw_box_bg_color']  : '';
			
			/**
			 * create plugin settings array
			 */
			
			$cwoptionarry = array();
			$cwoptionarry['cw_cookie_bar_enabled'] = $getcwenabled;	
			$cwoptionarry['cw_cookie_auto_hide'] = $getcwautoHide;	
			$cwoptionarry['cw_cookie_auto_hide_seconds'] = $getcwautoHideSeconds;	
			$cwoptionarry['cw_message'] = $getcwdisplaymessage;	
			$cwoptionarry['cw_yes_btn'] = $getcwdisplaybtntxt;	
			$cwoptionarry['cw_more_info_link'] = $getcwmoreinfolinks;	
			$cwoptionarry['cw_more_link_txt'] = $getcwmorelinkstext;	
			$cwoptionarry['cw_page_attribte'] = $getcwpagelinkattribute;	
			$cwoptionarry['cw_page_links'] = $getcwpagelinks;	
			$cwoptionarry['cw_page_select_links'] = $getcwpagselectelinks;	
			$cwoptionarry['cw_page_link_target'] = $getlinktaget;	
			$cwoptionarry['cw_refuse_btn_chk'] = $getrefusebtnchk;	
			$cwoptionarry['cw_refuse_btn_text'] = $getrefusebtntext;	
			$cwoptionarry['cw_refuse_additional_script'] = $getrefuseadditionalscript;	
			$cwoptionarry['cw_refuse_on_scroll'] = $getrefuseonscroll;	
			$cwoptionarry['cw_refuse_on_scroll_amount'] = $getrefuseonscrollamount;	
			$cwoptionarry['cw_cookie_expiry_time'] = $getcookieexpiretime;	
			$cwoptionarry['cw_cookie_script_placement'] = $getscriptplacement;	
			$cwoptionarry['cw_deactivation_option'] = $getdeactivationoption;	
			$cwoptionarry['cw_message_position'] = $getmessageboxposition;
			$cwoptionarry['cw_message_animation'] = $getmessageboxanimation;
			$cwoptionarry['cw_button_style'] = $getbuttonstyle;
			$cwoptionarry['cw_button_text_color'] = $getbuttontextcolor;
			$cwoptionarry['cw_button_bg_color'] = $getbuttonbgcolor;
			$cwoptionarry['cw_box_text_color'] = $getmsgboxtextcolor;
			$cwoptionarry['cw_box_bg_color'] = $getmsgboxbgcolor;
			
			/**
			 * plugin settings array encoded
			 */
			$cwoptionarry = maybe_serialize($cwoptionarry);
			
			/**
			 * update plugin option
			 */
			update_option( 'cookie_warning_option' , $cwoptionarry);
			
			/**
			 * redirect to plugin settings tab 
			 */
			wp_safe_redirect(site_url("/wp-admin/admin.php?page=".EUCN_PLUGIN_MENU_SLUG));
			exit();
		
		}
		
	}
	
	/**
	 * function for add plugin subcribe notice accept to user
	 *
	 */
	public function wp_add_plugin_eucnotice_userfn() { 
		global $wpdb;
		$email_id = $_POST['email_id'];
		$log_url = $_SERVER['HTTP_HOST'];
		$cur_date = date('Y-m-d');
		$url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/wp-add-plugin-users.php';
		$response = wp_remote_post( $url, array('method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array('user'=>array('user_email'=>$email_id,'plugin_site' => $log_url,'status' => 1,'plugin_id' => '34','activation_date'=>$cur_date)),
		'cookies' => array()));
		update_option('eucnotice_plugin_notice_shown', 'true');
	}
	
	/**
	 * function for add plugin subcribe notice hide
	 *
	 */
	 public function hide_subscribe_eucnoticefn() { 
		global $wpdb;
		$email_id= $_POST['email_id'];
		update_option('eucnotice_plugin_notice_shown', 'true');
	}
	
	/**
	 * function for plugin all settings reset.
	 *
	 */
	
	function cw_reset_settings() {
		global $wpdb;
		
		/**
		 * update all settings as null
		 */
		update_option( 'cookie_warning_option' ,'');
		
		die();
	}
}

function custom_eu_cookie_notice_pointers_admin_pointers(){ 

	$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    $version = '1_0'; // replace all periods in 1.0 with an underscore
    $prefix = 'custom_eu_cookie_notice_pointers' . $version . '_';

    $new_pointer_content = '<h3>' . __( 'Welcome to Eu Cookie Notice' ) . '</h3>';
    $new_pointer_content .= '<p>' . __( 'Cookie Notice plugin is a simple, configurable notice that appears on sticky top, Sticky Bottom and Popup of the page. Easily closed by the user.you can add script in header and footer as per your choice.' ) . '</p>';

    return array(
        $prefix . 'eu_cookie_notice_view' => array(
            'content' => $new_pointer_content,
            'anchor_id' => '#adminmenu',
            'edge' => 'left',
            'align' => 'left',
            'active' => ( ! in_array( $prefix . 'eu_cookie_notice_view', $dismissed ) )
        )
    );
}