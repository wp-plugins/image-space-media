<?php

/*
Plugin Name: Image Space Media
Plugin URI: http://www.pivari.com/wordpress-plugins/image-space-media-wp-plugin/
Description: A simple Plugin to add Image Space Media code on your pages.
Version: 1.0.0
Author: Fabrizio Pivari
Author URI: http://www.pivari.com
 */
/*  Copyright 2012 Fabrizio Pivari  (email : fabrizio@pivari.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$ismversion="1.0.0";

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activate_ism() {
	add_option('adtrigger', 'imagefocus');
}

function deactive_ism() {
  delete_option('adtrigger');
}

function admin_init_ism() {
  register_setting('ism', 'adtrigger');
}

function admin_menu_ism() {
  add_options_page('Image Space Media', 'Image Space Media', 8, 'ism', 'options_page_ism');
}

function options_page_ism() {
  include(WP_PLUGIN_DIR.'/image-space-media/options.php');  
}

function ism() {
  global $ismversion;
  $adtrigger = get_option('adtrigger');
  if ( $adtrigger == 'mouseover' )
	  $adtrigger = "picadService.set('token','');";
  echo "\n".'<!-- Image Space Media plugin v. '.$ismversion.' (Begin) -->'."\n" ;
  echo '<script type="text/javascript" src="http://services.picadmedia.com/js/picad.js"></script>'."\n" ;
  $options='<script type="text/javascript">' . $adtrigger . 'picadService.initialize();</script>'."\n";
  echo $options;
  echo '<!-- Image Space Media plugin v. '.$ismversion.' (End) -->'."\n" ;

}

function ism_settings( $links ) {
	$settings_link = '<a href="options-general.php?page=ism">'.__('Settings').'</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

function ism_plugin_settings($links, $file) {
	if ( $file == basename( dirname( __FILE__ ) ).'/'.basename( __FILE__ ) ) {
		$links[] = '<a href="options-general.php?page=ism">' . __('Settings') . '</a>';
		$links[] = '<a href="http://www.pivari.com/contatta-pivari/">' . __('Support') . '</a>';
	}
	return $links;
}

register_activation_hook(__FILE__, 'activate_ism');
register_deactivation_hook(__FILE__, 'deactive_ism');
add_action('admin_init', 'admin_init_ism');
add_action('admin_menu', 'admin_menu_ism');
add_action( 'plugin_action_links_'.basename( dirname( __FILE__ ) ).'/'.basename( __FILE__ ), 'ism_settings', 10, 4 );
add_filter( 'plugin_row_meta', 'ism_plugin_settings', 10, 2 );
add_action('wp_footer', 'ism');


?>
