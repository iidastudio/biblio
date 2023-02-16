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

// composer autoload
require_once('vendor/autoload.php');

// autoload
new inc\Block_Styles();
new inc\Custom_Post_Types();
new inc\Ogp_Settings();
new inc\Theme_Support();
new inc\Template_part_areas();
new inc\Theme_Update();

// ショートコードブロックテスト用「hello shortcode!」と出力
function hello_func() {
  return "<div>hello shortcode!</div>";
}
add_shortcode('hello', 'hello_func');

if(have_posts()) {
  while(have_posts()) {
    the_post();
    if (has_post_thumbnail()) {
      the_post_thumbnail('large');
    } else {
      ?> <img src="<?php echo get_template_directory_uri(); ?>assets/img/noimg.png"> <?php
    };
  };
};

// 抜粋の文字数調整
// function twpp_change_excerpt_length( $length ) {
//   return 50; 
// }
// add_filter( 'excerpt_length', 'twpp_change_excerpt_length', 999 );
function twpp_change_excerpt_more( $more ) {
  $html = '<a href="' . esc_url( get_permalink() ) . '" class="wp-block-post-excerpt__more-link">...</a>';
  return $html;
}
add_filter( 'excerpt_more', 'twpp_change_excerpt_more' );


//-------------------------------------------------
// post_idをもとにして投稿ごとにnoimageサムネイルを設置する
//-------------------------------------------------
function wpdocs_addTitleToThumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
  if ( 'post' === get_post_type( $post_id ) ) {
    if($html === "") {
      $img_num = $post_id % 2;
      $post_title = get_the_title( $post_id );
      $html = '<img width="768" height="432" src="'. get_template_directory_uri(). '/assets/img/alt-images/alt-img_'. $img_num.'.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="'. esc_html( $post_title ) .'" loading="lazy" />';
    }
  }
  return $html;
}
add_filter( 'post_thumbnail_html', 'wpdocs_addTitleToThumbnail', 10, 5 );

//-------------------------------------------------
// bbpress
//-------------------------------------------------
if (class_exists('bbPress')) {
  // var_dump(is_bbpress());
  /**
   * Using block templates.
   */
  add_filter(
    'bbp_template_include',
    function( $template ) {
      return ABSPATH . WPINC . '/template-canvas.php';
    }
  );

  /**
   * Using templates
   * get_block_template( 'themeplate-slug//template-slug' )
   */
  add_filter(
    'pre_get_block_templates',
    function( $query_result ) {
      if ( is_bbpress() ) {
        return array(
          get_block_template( 'biblio//page' ),
        );
      }
      return $query_result;
    }
  );
  add_filter('bbp_get_author_ip', '__return_empty_string');
}

