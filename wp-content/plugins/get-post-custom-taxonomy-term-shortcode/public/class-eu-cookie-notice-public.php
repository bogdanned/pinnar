<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Eu_Cookie_Notice
 * @subpackage Eu_Cookie_Notice/public
 * @author     Multidots <inquiry@multidots.in>
 */
class Eu_Cookie_Notice_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/eu-cookie-notice-public.css', array('wp-jquery-ui-dialog'), $this->version, 'all' );
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/eu-cookie-notice-public.js', array( 'jquery','jquery-ui-dialog' ), $this->version, false );
		
		wp_localize_script('eu-cookie-notice', 'ajax_params', array(
	        'ajax_url' => admin_url('admin-ajax.php'),
	        'ajax_icon' => plugin_dir_url( __FILE__ ) . '/images/ajax-loader.gif'
	    ));
	    wp_enqueue_script('eu-cookie-notice');
		
	}
	
	/**
	 * Enter description here...
	 *
	 */
	public function cookie_warning_message_box_html () {
		global $post,$wpdb;
		/**
		 * get cookie name
		 */
		$cookieName = EUCN_COOKIE_NAME;
		/**
		 * check cookie set or not
		 */
		$getEucnCookie = isset( $_COOKIE[$cookieName])  ? $_COOKIE[$cookieName] :'';
		
		/**
		 * get plugin settings option
		 */
		$getcwoptionarray = get_option('cookie_warning_option');
		
		/**
		 * unserialize plugin settings option
		 */
		$getcwoptionarray = maybe_unserialize($getcwoptionarray);
		
		/**
		 * check cookie is not set.
		 */
		if( empty( $getEucnCookie ) && $getEucnCookie =='' ) {
		
			if( !empty( $getcwoptionarray ) && $getcwoptionarray !='' && isset( $getcwoptionarray ) ) {
				
				//cheack cookiebar enable or disable
				if( !empty( $getcwoptionarray['cw_cookie_bar_enabled'] ) && $getcwoptionarray['cw_cookie_bar_enabled'] =='yes' && isset( $getcwoptionarray['cw_cookie_bar_enabled'] ) ) {
					
					$getmessgeboxBgColor = !empty( $getcwoptionarray['cw_box_bg_color'] ) ? $getcwoptionarray['cw_box_bg_color'] :'';
					$getmessgeboxTextColor = !empty( $getcwoptionarray['cw_box_text_color'] ) ? $getcwoptionarray['cw_box_text_color'] :'';
					$getmessageboxPosition =!empty( $getcwoptionarray['cw_message_position'] ) ? $getcwoptionarray['cw_message_position'] :'';
					
					$setpostion = '';
					$adddialogboxclass ='';
					$setmessageanimation ='';
					
					if( !empty( $getmessageboxPosition ) && isset( $getmessageboxPosition ) && $getmessageboxPosition =='fancybox' ) {
						$setpostion ='';
						$adddialogboxclass ='ca_open_dialogbox';
						$messageanimation = "";
						
					} else {
						$setpostion = $getmessageboxPosition.':0;position: fixed;';	
						$adddialogboxclass ='';
						
						$messageanimation = !empty( $getcwoptionarray['cw_message_animation'] ) ? $getcwoptionarray['cw_message_animation'] : '';
						
						if( !empty( $messageanimation ) && $messageanimation =='fade' || $messageanimation =='slide' || $messageanimation =='none')	{
							$setmessageanimation ='cw_message_box_'.$messageanimation;
						}
						
					}
						
					?>	
					<!--html for cookie notice message box-->
					<div class="cw_message_box_main <?php echo $setmessageanimation.' '.$adddialogboxclass; ?>" style="font-size: 12px;text-align:center;color:<?php echo $getmessgeboxTextColor; ?>;background:<?php echo $getmessgeboxBgColor; ?> none repeat scroll 0 0;height: 50px;<?php echo $setpostion; ?>width: 100%;z-index: 2147483647;" >
						<div class="cw_container">
							<input type="hidden" class="cw_message_notify_position" value="<?php echo $getmessageboxPosition ?>">
							<input type="hidden" class="cw_message_notify_animation" value="<?php echo $messageanimation ?>">
							<!--set cookie message-->
							<?php $getCookieMessage = !empty( $getcwoptionarray['cw_message'] ) ? $getcwoptionarray['cw_message'] : '';	?>
							<p class="cw_message_text"><?php echo $getCookieMessage; ?></p>
							<!--set cookie ok button-->
							<?php
							$getbuttonStyle = !empty( $getcwoptionarray['cw_button_style'] ) ? $getcwoptionarray['cw_button_style'] :'';
							$getCookieOkText = !empty( $getcwoptionarray['cw_yes_btn'] ) ? $getcwoptionarray['cw_yes_btn'] :'ok';
							if( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='none') {
								$getButtonbgcolor = !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000';
								$getButtontextcolor = !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#FFF';
							?>
							<input style="background:<?php echo $getButtonbgcolor; ?>;color: <?php echo $getButtontextcolor; ?>;border: 1px solid <?php echo $getButtonbgcolor; ?>;" class="cw_button_style_<?php echo  $getbuttonStyle; ?>" type="button" id="cw_message_ok" name="cw_message_ok" value="<?php echo $getCookieOkText; ?>">
							<?php } elseif ( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='wordpress' || $getbuttonStyle =='bootstrap' ) { ?>
								<input class="cw_button_style_<?php echo  $getbuttonStyle; ?>" type="button" id="cw_message_ok" name="cw_message_ok" value="<?php echo $getCookieOkText; ?>">
							<?php } ?>
							
							<!--set refuse button-->
							<?php 
							$refusebuttonenalbe = !empty( $getcwoptionarray['cw_refuse_btn_chk'] ) ? $getcwoptionarray['cw_refuse_btn_chk'] :'';
							$refusebtntext = !empty( $getcwoptionarray['cw_refuse_btn_text'] ) ? $getcwoptionarray['cw_refuse_btn_text'] :'';
							if( !empty( $refusebuttonenalbe ) && isset( $refusebuttonenalbe ) && $refusebuttonenalbe == '1' ) {
								
								if( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='none' ) { 
									$getButtonbgcolor = !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000';
									$getButtontextcolor = !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#FFF';?>
									
									<input style="background:<?php echo $getButtonbgcolor; ?>;color: <?php echo $getButtontextcolor; ?>;border: 1px solid <?php echo $getButtonbgcolor; ?>;" class="cw_button_style_<?php echo  $getbuttonStyle; ?>" type="button" id="cw_message_refuse" name="cw_message_refuse" value="<?php echo $refusebtntext; ?>">
							
						  <?php } elseif ( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='wordpress' || $getbuttonStyle =='bootstrap' ) { ?>
									
						  			<input class="cw_button_style_<?php echo  $getbuttonStyle; ?>" type="button" id="cw_message_refuse" name="cw_message_refuse" value="<?php echo $refusebtntext; ?>">
						  			
						  <?php }
							}
							?>
							
							<!--set read more links-->
							
							<?php
							$getreadmoreEnable = !empty( $getcwoptionarray['cw_more_info_link'] ) ? $getcwoptionarray['cw_more_info_link'] :'';
							$getreadmoretext = !empty( $getcwoptionarray['cw_more_link_txt'] ) ? $getcwoptionarray['cw_more_link_txt'] :''; 
							$getreadmoreTarget = !empty( $getcwoptionarray['cw_page_link_target'] ) ? $getcwoptionarray['cw_page_link_target'] :''; 
							$getpageattribute = !empty( $getcwoptionarray['cw_page_attribte'] ) ? $getcwoptionarray['cw_page_attribte'] :''; 
							
							if( !empty( $getreadmoreEnable ) && $getreadmoreEnable == '1' && isset( $getreadmoreEnable ) ) { 
								
								if( !empty( $getpageattribute ) && isset( $getpageattribute ) && $getpageattribute =='custom' ) {
									$pageLinks = !empty( $getcwoptionarray['cw_page_links'] ) ? $getcwoptionarray['cw_page_links'] :''; 
									if( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='none' ) {
										$getButtonbgcolor = !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000';
										$getButtontextcolor = !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#FFF';?>
									
										<a style="background:<?php echo $getButtonbgcolor; ?>;color: <?php echo $getButtontextcolor; ?>;border: 1px solid <?php echo $getButtonbgcolor; ?>;" id="cw_message_more" target="<?php echo $getreadmoreTarget; ?>" class="cw_button_style_<?php echo  $getbuttonStyle; ?>" href="<?php echo $pageLinks; ?>"><?php echo $getreadmoretext; ?></a>
									
									<?php } elseif ( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='wordpress' || $getbuttonStyle =='bootstrap' ) { ?>
										<a id="cw_message_more" target="<?php echo $getreadmoreTarget; ?>" class="cw_button_style_<?php echo  $getbuttonStyle; ?>" href="<?php echo $pageLinks; ?>"><?php echo $getreadmoretext; ?></a>
									<?php 	}
									
								} elseif ( !empty( $getpageattribute ) && isset( $getpageattribute ) && $getpageattribute =='pages' ) {
									$SelectpageLinks = !empty( $getcwoptionarray['cw_page_select_links'] ) ? $getcwoptionarray['cw_page_select_links'] :'';
									if( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='none' ) {
										$getButtonbgcolor = !empty( $getcwoptionarray['cw_button_bg_color'] ) ? $getcwoptionarray['cw_button_bg_color'] :'#000';
										$getButtontextcolor = !empty( $getcwoptionarray['cw_button_text_color'] ) ? $getcwoptionarray['cw_button_text_color'] :'#FFF';?>
										<a style="background:<?php echo $getButtonbgcolor; ?>;color: <?php echo $getButtontextcolor; ?>;border: 1px solid <?php echo $getButtonbgcolor; ?>;" id="cw_message_more" target="<?php echo $getreadmoreTarget; ?>"  class="cw_button_style_<?php echo  $getbuttonStyle; ?>" href="<?php echo get_permalink($SelectpageLinks); ?>"><?php echo $getreadmoretext; ?></a>
									
									<?php } elseif ( !empty( $getbuttonStyle ) && isset( $getbuttonStyle ) && $getbuttonStyle =='wordpress' || $getbuttonStyle =='bootstrap' ) { ?>
										<a id="cw_message_more" target="<?php echo $getreadmoreTarget; ?>" class="cw_button_style_<?php echo  $getbuttonStyle; ?>" href="<?php echo get_permalink($SelectpageLinks); ?>"><?php echo $getreadmoretext; ?></a>
									<?php }
									
								}
								
							}
							?>
							<!--Hide on scroll-->
							<?php 
							$gethideonscroll = !empty( $getcwoptionarray['cw_refuse_on_scroll'] ) ? $getcwoptionarray['cw_refuse_on_scroll'] :'';
							
							if( !empty( $gethideonscroll ) && isset( $gethideonscroll ) && $gethideonscroll =='1' ) {
								
								$gethideonscrollamount = !empty( $getcwoptionarray['cw_refuse_on_scroll_amount'] ) ? $getcwoptionarray['cw_refuse_on_scroll_amount'] :'';
								?>
								<input type="hidden" class="cw_hide_onscroll_amount" value="<?php echo $gethideonscrollamount; ?>">
								<input type="hidden" class="cw_hide_onscroll_enable" value="<?php echo $gethideonscroll; ?>">
								<?php 
							}
							?>
							<!--auto hide cookie bar-->
							<?php $getautohideenable = !empty( $getcwoptionarray['cw_cookie_auto_hide'] ) ? $getcwoptionarray['cw_cookie_auto_hide'] :''; 
								if( !empty( $getautohideenable ) && isset( $getautohideenable ) && $getautohideenable =='yes' ) {
									$getautohidesecond = !empty( $getcwoptionarray['cw_cookie_auto_hide_seconds'] ) ? $getcwoptionarray['cw_cookie_auto_hide_seconds'] :''; 
									
									if( !empty( $getautohidesecond ) && isset( $getautohidesecond) && $getautohidesecond !='' ) { ?>
									<script type="text/javascript">
										jQuery(window).load(function () {
											var getmsgposition = '<?php echo $getmessageboxPosition; ?>';
											var getscrollamount = '<?php echo $getautohidesecond;  ?>';
											
											var boxanimation = '<?php echo $messageanimation; ?>';
											
											if( getmsgposition =='fancybox' ) {
												
												settimeintdialog = setTimeout(function() { jQuery('.ca_open_dialogbox').dialog("close"); clearTimeout(settimeintdialog); },getscrollamount);	
																					
											} else {
												
												if( boxanimation == 'fade' ) {
													settimeintfadeout = setTimeout(function(){jQuery(".cw_message_box_fade").fadeOut( 1000 ); clearTimeout(settimeintfadeout); },getscrollamount);	
												}
												
												if( boxanimation =='slide') {
													settimeintslideout = setTimeout(function(){jQuery(".cw_message_box_slide").slideUp("slow"); clearTimeout(settimeintslideout); },getscrollamount);	
												}
												
												if( boxanimation =='none' ) {
													settimeintslideout = setTimeout(function(){jQuery(".cw_message_box_none").hide("slow"); clearTimeout(settimeintslideout); },getscrollamount);	
												}
												
											}
										});
									</script>	
								<?php }
								}
							?>
						</div>
					</div>
				<?php
				}
			}
		}	
	}
	
	/**
	 * set cookie in after message box button action
	 * cookie notice acccept
	 * cookie notice reject
	 * cookie notice hide on scroll
	 */
	
	public function  cw_cookie_noticebar_action() {
		
		$hideaction = !empty( $_POST['hideaction'] ) ? $_POST['hideaction'] :'';
		
		$getcwoptionarray = get_option('cookie_warning_option');
		$getcwoptionarray = maybe_unserialize($getcwoptionarray);
		
		$getcookieexpire = !empty( $getcwoptionarray['cw_cookie_expiry_time'] ) ? $getcwoptionarray['cw_cookie_expiry_time'] :'';
		
		$setcookieexptime ='';
		
		if( $getcookieexpire == '1day' ) {
			$setcookieexptime = 60 * 60 * 24;
		} elseif ( $getcookieexpire == '1week' ) {
			$setcookieexptime = 60 * 60 * 24 * 7;
		} elseif ( $getcookieexpire == '1month' ) {
			$currentmonthday = date('t');
			$setcookieexptime = 60 * 60 * 24 * $currentmonthday;
		} elseif ( $getcookieexpire == '3months' ) {
			
			$getmonth = 3;
			$totaldaycounts ='';
			for ($i = 0; $i < $getmonth; $i++) {
			   
				$nextmonthdate = date('Y-m-d', strtotime('+'.$i.' month'));
				$nextmonthdate = date_create($nextmonthdate);
				$nextmonthday = date_format($nextmonthdate,"t");
				$totaldaycounts += $nextmonthday;
			} 
			
			$setcookieexptime = 60 * 60 * 24 * $totaldaycounts ;
			
		} elseif ( $getcookieexpire == '6months' ) {
			
			$getmonth = 6;
			$totaldaycounts ='';
			for ($i = 0; $i < $getmonth; $i++) {
			   
				$nextmonthdate = date('Y-m-d', strtotime('+'.$i.' month'));
				$nextmonthdate = date_create($nextmonthdate);
				$nextmonthday = date_format($nextmonthdate,"t");
				$totaldaycounts += $nextmonthday;
			} 
			
			$setcookieexptime = 60 * 60 * 24 * $totaldaycounts ;
			
		} elseif ( $getcookieexpire == '1year' ) {
			
			$setcookieexptime = 60 * 60 * 24 * 365;
			
		} elseif ( $getcookieexpire == 'infinity' ) {
			$setcookieexptime = 60 * 60 * 24 * 365 * 10;
		}
		
		$cookie_name = EUCN_COOKIE_NAME;
		setcookie($cookie_name, $hideaction , time() + ( $setcookieexptime ), "/");
		die();
	}
	
	/**
	 * function for cookie additional script placement in header
	 *
	 */
	function cw_scriptplacement_header() {
		$cookieName = EUCN_COOKIE_NAME;
		$getEucnCookie = isset( $_COOKIE[$cookieName])  ? $_COOKIE[$cookieName] :'';
		
		if( !empty( $getEucnCookie ) && isset( $getEucnCookie ) && $getEucnCookie =='cookie_not_accepted') {
			$getcwoptionarray = get_option('cookie_warning_option');
			$getcwoptionarray = maybe_unserialize($getcwoptionarray);
			
			$getrefusebtnEnable = !empty( $getcwoptionarray['cw_refuse_btn_chk'] ) ? $getcwoptionarray['cw_refuse_btn_chk'] : '';
			
			if( !empty( $getrefusebtnEnable ) && isset( $getrefusebtnEnable ) && $getrefusebtnEnable == '1' ) {
				$getrefusescript = !empty( $getcwoptionarray['cw_refuse_additional_script'] ) ? $getcwoptionarray['cw_refuse_additional_script'] : '';
		 ?>
			<script type='text/javascript'><?php echo strip_tags($getrefusescript); ?></script>
			
	<?php }
		}
	}
	
	/**
	 * function for cookie additional script placement in footer
	 *
	 */
	function cw_scriptplacement_footer() {
		$cookieName = EUCN_COOKIE_NAME;
		$getEucnCookie = isset( $_COOKIE[$cookieName])  ? $_COOKIE[$cookieName] :'';
		
		if( !empty( $getEucnCookie ) && isset( $getEucnCookie ) && $getEucnCookie =='cookie_not_accepted') {
			$getcwoptionarray = get_option('cookie_warning_option');
			$getcwoptionarray = maybe_unserialize($getcwoptionarray);
			
			$getrefusebtnEnable = !empty( $getcwoptionarray['cw_refuse_btn_chk'] ) ? $getcwoptionarray['cw_refuse_btn_chk'] : '';
			
			if( !empty( $getrefusebtnEnable ) && isset( $getrefusebtnEnable ) && $getrefusebtnEnable == '1' ) {
				$getrefusescript = !empty( $getcwoptionarray['cw_refuse_additional_script'] ) ? $getcwoptionarray['cw_refuse_additional_script'] : '';
		 ?>
			<script type='text/javascript'><?php echo strip_tags($getrefusescript); ?></script>
	<?php }
		}
	}
	
	/**
    * BN code added
    */
	function paypal_bn_code_filter_eu_cookie_notice($paypal_args) {
		$paypal_args['bn'] = 'Multidots_SP';
		return $paypal_args;
	}
}