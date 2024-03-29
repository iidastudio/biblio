<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Biblio
 * @since 1.0.0
 */

use biblio\inc;
use biblio\lib;

// composer autoload
require_once 'vendor/autoload.php';

/**
 * autoload
 */
new inc\Block_Styles();
new inc\Block_Patterns();
new inc\Custom_Post_Types();
new inc\Ogp_Settings();
new inc\Theme_Support();
new inc\Template_Part_Areas();
// admin
new inc\Theme_Update();
new inc\Admin_Pages();
// extension, custom block
new inc\Load_Blocks();
new inc\Load_Extensions();
// utility
new lib\Utility();

//-------------------------------------------------
// post_idをもとにして投稿ごとにnoimageサムネイルを設置する
//-------------------------------------------------
function alternative_thumbnail_settings( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	$array_post_type = array(
		'post',
		'writing',
		'book',
		'info',
	);
	$flg             = in_array( get_post_type( $post_id ), $array_post_type, true );

	if ( $flg ) {
		if ( '' === $html ) {
			$img_num    = $post_id % 2;
			$post_title = get_the_title( $post_id );
			$html       = '<img width="768" height="432" src="' . get_template_directory_uri() . '/dist/img/alt-images/alt-img_' . $img_num . '.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="' . esc_html( $post_title ) . '" loading="lazy" />';
		}
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'alternative_thumbnail_settings', 10, 5 );

//-------------------------------------------------
// bbpress
//-------------------------------------------------
if ( class_exists( 'bbPress' ) ) {
	// var_dump(is_bbpress());
	/**
	 * Using block templates.
	 */
	add_filter(
		'bbp_template_include',
		function ( $template ) {
			return ABSPATH . WPINC . '/template-canvas.php';
		}
	);

	/**
	 * Using templates
	 * get_block_template( 'themeplate-slug//template-slug' )
	 */
	add_filter(
		'pre_get_block_templates',
		function ( $query_result ) {
			if ( is_bbpress() ) {
				return array(
					get_block_template( 'biblio//page' ),
				);
			}
			return $query_result;
		}
	);
	/**
	 * Hide IP
	 */
	add_filter( 'bbp_get_author_ip', '__return_empty_string' );
}
