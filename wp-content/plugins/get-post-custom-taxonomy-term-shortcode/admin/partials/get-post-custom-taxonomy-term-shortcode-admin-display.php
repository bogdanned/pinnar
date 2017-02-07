<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Get_Post_Custom_Taxonomy_Term_Shortcode
 * @subpackage Get_Post_Custom_Taxonomy_Term_Shortcode/admin/partials
 */
class Shoertcode_Creator_Main {

    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_settings_menu'));
    }

    public static function gtsortcode_register_meta_boxes() {
        if (!empty($_GET['get-post-sortcode-custom-css'])) {
            add_meta_box('gtsortcode-css-box-id', __('Custom Css', 'get-post-custom-taxonomy-term-shortcode'), 'gtsortcode_box_cb', 'page');
        }
    }

    public static function add_settings_menu() {
        add_menu_page('Short Code Creator', 'Get Post Option', 'manage_options', 'get-post-custom-taxonomy-term-shortcode', array(__CLASS__, 'shortcode_page_menu'));
        add_submenu_page('get-post-custom-taxonomy-term-shortcode', 'Custom CSS', 'Custom CSS', 'manage_options', 'get-post-sortcode-custom-css', array(__CLASS__, 'gtsortcode_box_cb'));
    }

    public static function shortcode_page_menu() {
        global $wpdb;
        $current_user = wp_get_current_user();

        if (!get_option('gpctts_plugin_notice_shown')) {
            echo '<div id="gpctts_dialog" title="Basic dialog"> <p> Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_gpctts" class="regular-text" name="txt_user_sub_gpctts" value="' . $current_user->user_email . '"></p></div>';
        }

        echo '<div class="shortcode_main_div">
				<div class="wrap">
					<h2>Get Post Custom Taxonomy Term Shortcode</h2>
			
					<table class="form-table" id="form_table_id">
						<tbody class="select-option">
							<tr valign="top">
								<th scope="row">
									<label for="default_role">Select Post Type</label>
								</th>
								<td>
									<select id="default_role" name="default_role" class="shortcode_main">';
        $post_types = get_post_types();
        $exclude = array('attachment', 'revision', 'nav_menu_item', 'page');
        foreach ($post_types as $key => $value) {
            if (in_array($key, $exclude)) {
                unset($post_types[$key]);
            }
        }
        echo '<option value="select-post-type">Select Post Type</option>';
        foreach ($post_types as $key => $value):
            echo '<option value="' . $key . '">' . $value . '</option>';
        endforeach;
        echo '</select>
                                                                                    
								</td>
							</tr>
                                  
                                </table>
					<br/><br/>';
        echo '<div id="gtpagination">
                                        <table class="form-table per_page_limit" id="form_table_id">
                                        <tbody>
                                        <tr valign="top">
					<th scope="row">
						<label for="post_per_page">Post Per Page</label>
					</th>
					
						<td ><input type="text" name="post_per_page" value="" class="post_per_page_value"></input></td>
					
                                        </tr>
                                        <tbody>
                                        </table>
                                        </div>';
        echo '<div id="sorting_id">
                                        <table class="form-table sort_option" id="form_table_id">
                                        <tbody>
                                        <tr valign="top">
					<th scope="row">
						<label for="sorting">Sorting</label>
					</th>
                                            <td id="srt_id">
                                            <div class="sort-option">
                                            <input type="radio" name="sorting" value="yes">Yes
                                            <input type="radio" name="sorting" value="no" checked>No
                                            </div>
                                            </td>    
                                        </tr>
                                        <tbody>
                                        </table>
                                        </div>';
        echo '<div id="custom_term_loading"><img src="' . plugin_dir_url(__FILE__) . 'images/custom_term_loading.gif" id="custom_term_loading_img"></div>
					<table class="form-table display-view" id="form_table_id">
						<tbody>
							<tr>
							<th scope="row"><label for="display_view">Select Dispaly View</label></th>
								<td id="tbl_id">	
										
									<div class="color-option">
									<label>
										<input type="radio" name="post_view" value="first-view">
										<img src="' . plugin_dir_url(__FILE__) . 'images/first.jpg" alt="" align="center"/></input></label>
									</div>
									
									<div class="color-option">
									<label>
										<input type="radio" name="post_view" value="second-view" checked="checked">
										<img src="' . plugin_dir_url(__FILE__) . 'images/second.jpg" alt="" align="center"/>
										</label>
									</div>
									<div class="color-option">
									<label>
										<input type="radio" name="post_view" value="third-view">
										<img src="' . plugin_dir_url(__FILE__) . 'images/third.jpg" alt="" align="center"/>
										</label>
									</div>								
							</td>
						</tr>
					</tbody>
				</table>
				</div>
				<p class="submin">
					<input id="submit" class="get_shortcode button button-primary" type="submit" value="Get Shortcode">
				</p>
			</div>
			</div>';
        ?>
        <div class='popup'>
            <div class='content'>
                <img src='<?php echo plugin_dir_url(__FILE__) ?>images/fancy_close.png' alt='quit' class='x' id='x' />
                <!--<p><textarea rows="3" id="txtarea" onClick="SelectAll('txtarea');" style="width:200px" >This text you can select all by clicking here </textarea>-->
                <b>Copy Shortcode & Paste Wherever You Want Display Posts</b>
                <label></label>
            </div>
        </div>

        <?php
    }

    public static function gtsortcode_box_cb() {

        if (isset($_POST['submit'])) {
            update_option('gtsortcode-custom-css', $_POST['my_meta_box_text']);
        }

        $custom_css = get_option('gtsortcode-custom-css');
        $custom_css = !empty($custom_css) ? $custom_css : "";
        ?> 
        <div class="gt_custom_css">
            <table>
                <form method="post">
                    <tr>
                        <th><label><?php _e('Custom CSS') ?></label></th>
                        <td><textarea name="my_meta_box_text" id="gt_sortcode_css"style="width: 574px;height: 280px;">
                                <?php echo $custom_css; ?></textarea><br></td>                <!--<input type="submit" name="gtsortcss" value="Submit">-->
                    </tr>
                    <tr><td><?php submit_button(); ?></td></tr>

                </form>
            </table>
        </div>

        <?php
    }

}

Shoertcode_Creator_Main::init();