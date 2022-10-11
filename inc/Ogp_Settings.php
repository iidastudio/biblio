<?php
/**
 * Biblio Theme: Block Styles
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Ogp_Settings {
  
  public function __construct() {
		add_action( 'wp_head', [ $this, 'biblio_meta_ogp' ] );
	}

  public function biblio_meta_ogp() {
    if (is_front_page() || is_home() || is_singular()) {
      
      $ogp_image = '画像URL';
      $twitter_site = '@Twitterアカウント名';
      // Twitter card type "summary_large_image" or "summary".
      $twitter_card = 'summary_large_image';
      $facebook_app_id = '';
      
      global $post;
      $ogp_title = '';
      $ogp_description = '';
      $ogp_url = '';
      $html = '';
      if (is_singular()) {
      // 記事＆固定ページ
      setup_postdata($post);
      $ogp_title = $post->post_title;
      $ogp_description = mb_substr(get_the_excerpt(), 0, 100);
      $ogp_url = get_permalink();
      wp_reset_postdata();
      } elseif (is_front_page() || is_home()) {
      // トップページ
        $ogp_title = get_bloginfo('name');
        $ogp_description = get_bloginfo('description');
        $ogp_url = home_url();
      }
      
      // og:type
      $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';
      
      // og:image
      if (is_singular() && has_post_thumbnail()) {
        $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $ogp_image = $ps_thumb[0];
      }
      
      // 出力するOGPタグをまとめる
      $html = "\n";
      $html .= '<meta property="og:title" content="'. esc_attr($ogp_title). '">'. "\n";
      $html .= '<meta property="og:description" content="'. esc_attr($ogp_description). '">'. "\n";
      $html .= '<meta property="og:type" content="'. $ogp_type. '">'. "\n";
      $html .= '<meta property="og:url" content="'. esc_url($ogp_url). '">'. "\n";
      $html .= '<meta property="og:image" content="'. esc_url($ogp_image). '">'. "\n";
      $html .= '<meta property="og:site_name" content="'. esc_attr(get_bloginfo('name')). '">'. "\n";
      $html .= '<meta name="twitter:card" content="'. $twitter_card. '">'. "\n";
      $html .= '<meta name="twitter:site" content="'. $twitter_site. '">'. "\n";
      $html .= '<meta property="og:locale" content="ja_JP">'. "\n";
      
      if ($facebook_app_id != "") {
      $html .= '<meta property="fb:app_id" content="'. $facebook_app_id. '">'. "\n";
      }
      
      echo $html;
    }
  }
}