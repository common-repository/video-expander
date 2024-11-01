<?php 
 /*
Plugin Name: Video Expander Gallery
Plugin URI: http://benupham.com

Description: Creates shortcode to display video iframes in columns, where each video expands to play on mouse click.

Version: 1.0

Author: Ben Upham
Author URI: http://benupham.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

*/

//
// Creates and registers settings for Video Expander
//
 
function video_expander_settings_init() {
	// Add the section to reading settings so we can add our fields to it
	add_settings_section(
	'video_expander_setting_section',
	'Video Expander Plugin Settings',
	'video_expander_setting_section_callback',
	'media'
	);

	// Add the field with the names and function to use for our new settings, put it in our new section
	add_settings_field(
	'video_expander_columns',
	'Columns',
	'video_expander_columns_callback',
	'media',
	'video_expander_setting_section'
	);

	register_setting( 'media', 'video_expander_columns' );
}
 
add_action( 'admin_init', 'video_expander_settings_init' );
 
/*
 * Settings section callback function
 */
 
function video_expander_setting_section_callback() {
	echo '<p>Change the settings for the Video Expander plugin here.</p>';
}
 
 
function video_expander_columns_callback() {
	$columns = esc_attr( get_option( 'video_expander_columns' ) );
	echo '<p>Default number of columns of videos. <br>For screens 800px and below, video will display in one column.</p>';
	echo	'<p><select name="video_expander_columns" value="' . $columns . '" >';
	for ($i = 1; $i <= 4; $i++) {
		echo '<option value="' . $i . '"';
		if ($i == $columns) {
			echo ' selected >';
		} else echo ' >';
		echo $i . ' column(s)</option>';
	}
	echo  '</select></p>';
}


//
// Register shortcode
//

add_action('init', 'register_video_expander_shortcode');

function register_video_expander_shortcode(){
	add_shortcode('video-expander', 'video_expander_shortcode');
	wp_register_script( 'videoexpander-js', plugins_url( 'js/video-expander.js' , __FILE__ ), array('jquery'), '1.0.0', true );
	wp_register_style( 'videoexpander-css', plugins_url( 'css/video-expander.css' , __FILE__ ) );
}

function enqueue_video_expander_scripts() {
	global $post;
	if (has_shortcode( $post->post_content, 'video-expander')) { 
		wp_enqueue_script( 'videoexpander-js' );
		wp_enqueue_style( 'videoexpander-css' );
	}
}

add_action('wp_enqueue_scripts', 'enqueue_video_expander_scripts');


function video_expander_shortcode($atts, $content=null) {
	
	$columns = esc_attr( get_option( 'video_expander_columns', 2 ) );
	
	$video_url = $atts['video-url'];
	$video_url = strpos($video_url, '?') === false ? $video_url : strstr($video_url, '?', true);
	$video_id = array_pop(explode('/', $video_url));

	if ( strpos($video_url, 'youtube') !== false || strpos($video_url, 'youtu.be') !== false ) {
		$video_url = '//www.youtube.com/embed/' . $video_id . '?autoplay=1&border=0&wmode=opaque&enablejsapi=1';
		$video_thumb = '//i.ytimg.com/vi/' . $video_id . '/hqdefault.jpg';
	} elseif ( strpos($video_url, 'vimeo') !== false ) {
		$video_url = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=1&color=ff9933&title=0&byline=0&portrait=0';
		$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $video_id . '.php'));
		$video_thumb = $hash[0]['thumbnail_large'];
	} else {
		$content .= ' (UNSUPPORTED VIDEO - Youtube and Vimeo only)';
	}
	
	$play_button = plugins_url( 'assets/play-button.png' , __FILE__ );
	
	$output = '';
	
	$output .= '<div class="video-item" data-video="' . $video_url . '" data-columns="' . $columns . '" ';
	$output .= 'style="background-image: url(' . $video_thumb . ');">';
	$output .= '<div class="play-button" style="background: transparent url(' . $play_button . ') no-repeat" ></div>';
	$output .= '<div class="video-caption">' . $content . '</div>';
	$output .= '</div>';
		
	return $output;

} // end video_expander plugin function