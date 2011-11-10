<?php
/*
Plugin Name: Youtube Thumbnailer
Plugin URI: http://orenyomtov.com
Description: This plugin creates thumbnails from your Youtube videos embedded in your posts.
Version: 1.1.1
Author: Oren Yomtov
Author URI: http://orenyomtov.com
*/

/*
Copyright (C) 2011 Oren Yomtov, orenyomtov.com (thenameisoren AT gmail DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
add_action('init', 'ytt_init');

function ytt_init() {
	add_action('admin_menu', 'ytt_config_pages');
	add_filter('plugin_action_links', 'ytt_actions', 10, 2 );
	if( get_option('ytt_new')=='' )
		add_action('save_post','ytt_save_post');
}

function ytt_config_pages() {
	if ( function_exists('add_submenu_page') )
		add_submenu_page('tools.php', __('Run Youtube Thumbnailer'), __('Run Youtube Thumbnailer'), 'manage_options', 'yt', 'ytt_go');
	if ( function_exists('add_options_page') )
		add_options_page('Youtube Thumbnailer', 'Youtube Thumbnailer', 8, 'ytt', 'ytt_conf');
}

function ytt_go() {
	global $wpdb;

	echo '<div class="wrap">
<h2>Youtube Thumbnailer Running</h2>Running...<br /><style tyle="text/css">ul.ytt {list-style-type:disc;margin-left:20px}</style><ul class="ytt">';

	$sql="SELECT `ID`,`post_title`,`post_content` FROM `{$wpdb->posts}` WHERE `post_status`='publish' AND `post_content` like '%http://www.youtube.com/v/%'";

	$posts=$wpdb->get_results($sql);
		
	foreach($posts as $p) {
		if (preg_match('#http://www\.youtube\.com/v/([^&"\'? ]*)#',$p->post_content,$match) || preg_match('#http://www\.youtube\.com/watch\?v=([^&"\'?\[\] ]*)#',$p->post_content,$match) )  {
			$img="http://i2.ytimg.com/vi/{$match[1]}/default.jpg";

			add_post_meta($p->ID,get_option('ytt_name','thumbnail'),$img,true) or update_post_meta($p->ID,get_option('ytt_name','thumbnail'),$img);

			echo '<li>Custom field "' . get_option('ytt_name','thumbnail') . '" of post "' . $p->post_title . '" changed to "' . $img . '"</li>' . "\n";

			flush();
		}
	}
	echo '</ul>Done!</div><script type="text/javascript" src="http://orenyomtov.com/downloads/plugins_outform.php?plugin=peb"></script>';
}

function ytt_save_post($id) {
	global $wpdb;

	$sql="SELECT `ID`,`post_title`,`post_content` FROM `{$wpdb->posts}` WHERE `ID`={$id}";

	$posts=$wpdb->get_results($sql);

	foreach($posts as $p) {
		if (preg_match('#http://www\.youtube\.com/v/([^&"\'? ]*)#',$p->post_content,$match) || preg_match('#http://www\.youtube\.com/watch\?v=([^&"\'?\[\] ]*)#',$p->post_content,$match) ) {
			$img="http://i2.ytimg.com/vi/{$match[1]}/default.jpg";

			add_post_meta($p->ID,get_option('ytt_name','thumbnail'),$img,true) or update_post_meta($p->ID,get_option('ytt_name','thumbnail'),$img);
		}
	}
}
function ytt_conf() {
?>
	<div class="wrap">
<h2>Youtube Thumbnailer</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

Auto thumbnail posts when saved/updated
<select name="ytt_new">
<option value="">Yes</option>
<option value="no" <?php if ( get_option('ytt_new')=='no' ) echo 'selected="selected" '?>>No</option>
</select>

<br />

Thumbnail custom field name:
<input type="text" name="ytt_name" id= "ytt_name" value="<?php echo get_option('ytt_name','thumbnail'); ?>" />


<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="ytt_new,ytt_name" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<script type="text/javascript" src="http://orenyomtov.com/downloads/plugins_outform.php?plugin=peb"></script> 
<?php
}

function ytt_actions($links, $file){
	$this_plugin = plugin_basename(__FILE__);
	
	if ( $file == $this_plugin ){
		$settings_link = '<a href="tools.php?page=yt">' . __('Run') . '</a>';
		array_unshift($links, $settings_link);
		$settings_link = '<a href="options-general.php?page=ytt">' . __('Settings') . '</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}
?>
