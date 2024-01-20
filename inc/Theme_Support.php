<?php
/**
 * Theme support
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Theme_Support {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );
		add_action( 'after_setup_theme', array( $this, 'biblio_enqueue_wp_block_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts_and_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'set_script_translations' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'biblio_block_variation_enqueue' ) );
		add_filter( 'should_load_separate_core_block_assets', '__return_true' );
		add_filter( 'document_title_separator', array( $this, 'title_separator_change' ) );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );
	}

	// title separator change
	public function title_separator_change( $separator ) {
		$separator = '|';
		return $separator;
	}

	// add_theme_support
	public function add_theme_supports() {
		add_editor_style( '/dist/css/editor.css' );
		remove_theme_support( 'core-block-patterns' );
		load_theme_textdomain( 'biblio', get_template_directory() . '/languages' );
	}

	// wp_enqueue_style anad wp_enqueue_script
	public function add_scripts_and_styles() {
		wp_enqueue_style( 'style-common', get_template_directory_uri() . '/dist/css/common.css', array(), filemtime( get_template_directory() . '/dist/css/common.css' ) );
		wp_enqueue_script( 'js-common', get_template_directory_uri() . '/dist/js/common-bundle.js', array( 'wp-i18n' ), filemtime( get_template_directory() . '/dist/js/common-bundle.js' ), array( 'strategy' => 'defer' ) );
		wp_deregister_script( 'jquery' );
	}

	public function biblio_block_variation_enqueue() {
		wp_enqueue_script(
			'block-variation-script',
			get_template_directory_uri() . '/dist/js/block-variations-bundle.js',
			array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
			filemtime( get_template_directory() . '/dist/js/block-variations-bundle.js' )
		);
	}

	public function set_script_translations() {
		wp_set_script_translations( 'js-common', 'biblio', get_template_directory() . '/languages' );
	}

	// コアのブロックに付与するスタイル
	private $styled_wp_blocks = array(
		'archives',
		'audio',
		'avatar',
		'buttons',
		'button',
		'calendar',
		'categories',
		'code',
		'columns',
		'comment-author-name',
		'comment-content',
		'comment-date',
		'comment-edit-link',
		'comment-reply-link',
		'comments',
		'comments-pagination',
		'comments-title',
		'comment-template',
		'cover',
		'embed',
		'footnotes',
		'freeform',
		'gallery',
		'group',
		'heading',
		'image',
		'latest-comments',
		'latest-posts',
		'media-text',
		'navigation',
		'nextpage',
		'page-list',
		'paragraph',
		'post-author',
		'post-author-name',
		'post-comments-form',
		'post-content',
		'post-excerpt',
		'post-date',
		'post-featured-image',
		'post-navigation-link',
		'post-template',
		'post-terms',
		'post-title',
		'pullquote',
		'quote',
		'query-pagination',
		'query-pagination-next',
		'query-pagination-numbers',
		'query-pagination-previous',
		'rss',
		'search',
		'separator',
		'site-logo',
		'site-tagline',
		'site-title',
		'social-links',
		'spacer',
		'table',
		'table-of-contents',
		'template-part',
		'verse',
	);

	private $styled_biblio_blocks = array();

	// 使用されたブロックのみcssを読み込む
	public function biblio_enqueue_wp_block_styles() {

		$styled_blocks_arrays = array(
			'wp'     => $this->styled_wp_blocks,
			'biblio' => $this->styled_biblio_blocks,
		);

		foreach ( $styled_blocks_arrays as $blocks_name => $styled_blocks ) {
			// wp-blocksのハンドル名をcoreにする(他のブロックは同一を前提)
			'wp' ? $blocks_handle_name = 'core' : $blocks_handle_name = $blocks_name === $blocks_name;

			foreach ( $styled_blocks as $block_name ) {
				$handle = (
				function_exists(
					'wp_should_load_separate_core_block_assets'
				) &&
				wp_should_load_separate_core_block_assets()
				) ?
				"$blocks_name-block-$block_name" :
				'wp-block-library';

				$dir               = "dist/css/$blocks_name-blocks/$block_name/";
				$style_path        = $dir . $block_name . '.css';
				$editor_style_path = $dir . $block_name . '-editor.css';

				if ( file_exists( get_theme_file_path( $style_path ) ) ) {

						$block_args = array(
							'handle' => $blocks_handle_name . '/' . $block_name,
							'src'    => get_theme_file_uri( $style_path ),
							'path'   => get_theme_file_path( $style_path ),
						);
						wp_enqueue_block_style( $blocks_handle_name . '/' . $block_name, $block_args );
				}
				if ( file_exists( get_theme_file_path( $editor_style_path ) ) ) {
					add_editor_style( $editor_style_path ); // add editor
				}
			}
		}
	}
}
