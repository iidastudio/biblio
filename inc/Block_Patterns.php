<?php
/**
 * Block patterns
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Block_Patterns {

	public function __construct() {
		add_action( 'init', [ $this, 'biblio_register_block_patterns' ], 9 );
  }

	public function biblio_register_block_patterns() {

		// block pattern categories
		$block_pattern_categories = array(
			'biblio-query' => [ 'label' => __( 'Biblio Query', 'biblio' ) ],
		);

		$block_pattern_categories = apply_filters('biblio_block_pattern_categories', $block_pattern_categories);
		foreach ( $block_pattern_categories as $name => $properties ) {
			register_block_pattern_category( $name, $properties );
		}

		// block patterns
		$block_patterns = [
			'biblio/query-card' => [
				'title'       => esc_html__( 'card', 'biblio' ),
				'categories'  => ['query'],
				'blockTypes'  => ['core/query'],
				'keywords'    => ['card', 'list', 'index'],
				'description' => 'card list style block pattern.',
				'content'     => $this -> render_block_pattern('query-card')
			]
		];

		$block_patterns = apply_filters('biblio_block_patterns', $block_patterns);
		foreach ( $block_patterns as $name => $properties ) {
			register_block_pattern($name, $properties);
		}
	}

	/**
	 * return block pattern html
	 * 
	 * @param string $slug block_pattern name.
	 * @return string html in php file.
	 * 
	 */
	public static function render_block_pattern($slug) {
		$path = realpath( get_template_directory(). '/inc/block-patterns/'. $slug. '.php' );
		if ( ! file_exists( $path ) ) {
			return '';
		}
		ob_start();
		include( $path );
		return preg_replace( '/(\t|\r\n|\r|\n)/ms', '', ob_get_clean() );
	}
}