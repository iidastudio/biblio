<?php
/**
 * Biblio Theme: Block Styles
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Block_styles {
	
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'register_block_styles' ] );
	}

  public function register_block_styles() {
		if ( function_exists( 'register_block_style' ) ) {			
			/**
			 * Register block styles
			 */
			register_block_style(
				'core/paragraph',
				array(
					'name'         => 'biblio-align-justify',
					'label'        => __( 'Justify', 'biblio' ),
					'style_handle' => 'biblio-align-Justify',
				)
			);
			register_block_style(
				'core/group',
				array(
					'name'         => 'biblio-filter-noise',
					'label'        => __( 'Filter-Noise', 'biblio' ),
					'style_handle' => 'biblio-filter-noise',
				)
			);
			register_block_style(
				'core/group',
				array(
					'name'         => 'biblio-filter-glass',
					'label'        => __( 'Filter-Glass', 'biblio' ),
					'style_handle' => 'biblio-filter-glass',
				)
			);
			register_block_style(
				'core/navigation',
				array(
					'name'         => 'biblio-toggle-list',
					'label'        => __( 'List', 'biblio' ),
					'style_handle' => 'biblio-toggle-list',
				)
			);
			register_block_style(
				'core/avatar',
				array(
					'name'         => 'biblio-squircle',
					'label'        => __( 'Squircle', 'biblio' ),
					'style_handle' => 'biblio-squircle',
				)
			);
			register_block_style(
				'core/post-navigation-link',
				array(
					'name'         => 'biblio-simple',
					'label'        => __( 'Simple', 'biblio' ),
					'style_handle' => 'biblio-simple',
				)
			);
			register_block_style(
				'core/separator',
				array(
					'name'         => 'biblio-dotted-wide',
					'label'        => __( 'Dotted wide', 'biblio' ),
					'style_handle' => 'biblio-dotted-wide',
				)
			);
		}
	}
}
