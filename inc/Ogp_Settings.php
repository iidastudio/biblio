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
		add_action( 'wp_head', array( $this, 'biblio_meta_ogp' ) );
	}

	public function biblio_meta_ogp() {
		if ( is_front_page() || is_home() || is_singular() ) {

			$ogp_image    = '画像URL';
			$twitter_site = '@Xアカウント名';
			// X/Twitter card type "summary_large_image" or "summary".
			$twitter_card    = 'summary_large_image';
			$facebook_app_id = '';

			global $post;
			$ogp_title       = '';
			$ogp_description = '';
			$ogp_url         = '';
			if ( is_singular() && $post ) {
				// 記事＆固定ページ
				setup_postdata( $post );
				$ogp_title       = get_the_title( $post ) ?: '';
				$excerpt         = (string) get_the_excerpt();
				$content         = (string) get_the_content();
				$ogp_description = mb_substr( $excerpt ?: wp_strip_all_tags( $content ), 0, 100 );
				$ogp_url         = get_permalink() ?: '';
				wp_reset_postdata();
			} elseif ( is_front_page() || is_home() ) {
				// トップページ
				$ogp_title       = get_bloginfo( 'name' );
				$ogp_description = get_bloginfo( 'description' ) ?: get_bloginfo( 'name' );
				$ogp_url         = home_url();
			}

			// og:type
			$ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

			// og:image
			if ( is_singular() && has_post_thumbnail() ) {
				$thumbnail_url = get_the_post_thumbnail_url( $post, 'full' );
				if ( $thumbnail_url ) {
					$ogp_image = $thumbnail_url;
				}
			}

			// 出力するOGPタグを直接 echo する
			echo "\n";
			echo '<meta property="og:title" content="' . esc_attr( $ogp_title ) . '">' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $ogp_description ) . '">' . "\n";
			echo '<meta property="og:type" content="' . esc_attr( $ogp_type ) . '">' . "\n";
			echo '<meta property="og:url" content="' . esc_url( $ogp_url ) . '">' . "\n";
			echo '<meta property="og:image" content="' . esc_url( $ogp_image ) . '">' . "\n";
			echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
			echo '<meta name="twitter:card" content="' . esc_attr( $twitter_card ) . '">' . "\n";
			echo '<meta name="twitter:site" content="' . esc_attr( $twitter_site ) . '">' . "\n";
			echo '<meta property="og:locale" content="ja_JP">' . "\n";

			if ( '' !== $facebook_app_id ) {
				echo '<meta property="fb:app_id" content="' . esc_attr( $facebook_app_id ) . '">' . "\n";
			}
		}
	}
}
