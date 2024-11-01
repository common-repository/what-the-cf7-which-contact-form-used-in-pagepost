<?php
/**
 * Plugin Name: What the CF7 - Which Contact Form Used In Page/Post
 * Plugin URI: https://addonmaster.com/plugins/wtcf7
 * Description: A simple plugin that help you to get contact form id and edit url from current page/post while you are visiting any page or posts. Simple but heloful
 * Author: mdshuvo
 * Author URI: https://akhtarujjaman.com
 * Tags: cf7,contact form 7, show cf7, what the cf7, what cf, what cf7, which cf7, current cf7, current form, show current form
 * Version: 1.0.0
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
* Including Plugin file for security
* Include_once
* 
* @since 1.0.0
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*Admin Css JS*/
function wtcf7__css_js(){ 
	if( is_admin_bar_showing() ){ ?>
		<script type='text/javascript'>
		/* <![CDATA[ */
		var wtcf7_admin_url = "<?php echo admin_url();?>";
		/* ]]> */
			jQuery(function($){
				$(document).ready(function(){
					var html = "";
					$('.wpcf7-form').each(function(){
						var formId = $(this).find('input[name="_wpcf7"]').val();				
						html += '<li id="wp-admin-bar-wtcf7-'+formId+'"><div class="ab-item ab-empty-item"><a class="ab-item" href="'+wtcf7_admin_url+'admin.php?page=wpcf7&post='+formId+'&action=edit" target="_blank">CF7 ID: #'+formId+'</a></div></li>';				
					});

					if( html != "" ){
						$('#wp-admin-bar-wtcf7-default').html(html);
					}			
				});
			});
		</script>
		<?php
	}
}
add_action('wp_footer','wtcf7__css_js',99);

function wtcf7_create_admin_bar_menu() {
	if ( is_admin() ){
		return;
	}
	global $wp_admin_bar;

	$menu_id = 'wtcf7';
	//$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('Contact Form 7'), 'href' => 'http://website.com/', 'meta' => array( 'target' => '_blank' ) ));
	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('Contact Form 7'), 'meta' => array( 'target' => '_blank' ) ));
		$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('No Form Used'), 'id' => 'wtcf7-zero'));

}
add_action('admin_bar_menu', 'wtcf7_create_admin_bar_menu', 2000);