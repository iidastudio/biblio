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
    add_action( 'after_setup_theme', [ $this, 'add_theme_supports' ] );
    add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts_and_styles' ] );
    add_action( 'admin_print_styles', [ $this, 'add_styles_by_post_type']);
    add_action( 'wp_enqueue_scripts', [ $this, 'set_script_translations' ] );
    add_filter( 'should_load_separate_core_block_assets', '__return_true' );
    add_action( 'wp_enqueue_scripts', [ $this, 'biblio_enqueue_wp_core_block_styles'] );
    add_action( 'admin_init', [ $this, 'biblio_enqueue_wp_core_block_styles'] ); 
    add_action( 'enqueue_block_editor_assets', [ $this, 'biblio_block_variation_enqueue'] );
  }

  // add_theme_support
  public function add_theme_supports() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( '/assets/css/editor.css' );
    add_theme_support( 'post-thumbnails');
    load_theme_textdomain( 'biblio', get_template_directory().'/languages' );
  }

  // wp_enqueue_style anad wp_enqueue_script
  public function add_scripts_and_styles() {
    wp_enqueue_style('style-common', get_template_directory_uri().'/assets/css/common.css', array(), filemtime( get_template_directory().'/assets/css/common.css' ));
    wp_enqueue_script('js-common', get_template_directory_uri().'/assets/js/common-bundle.js', array('wp-i18n'), filemtime( get_template_directory().'/assets/js/common-bundle.js' ), true );
  }

  public function add_styles_by_post_type() {
    if ( 'page' === get_post_type() ) {
      echo '<style>
        .editor-styles-wrapper.editor-styles-wrapper .edit-post-visual-editor__post-title-wrapper > *,
        .editor-styles-wrapper.editor-styles-wrapper .block-editor-block-list__layout.is-root-container > * {
          max-width: min(calc(100% - var(--wp--style--root--padding-left) * 2), var(--wp--custom--layout--wide));
        }
      </style>'."\n";
    }
  }

  public function biblio_block_variation_enqueue() {
    wp_enqueue_script( 'block-variation-script', get_template_directory_uri().'/assets/js/block-variations-bundle.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), filemtime( get_template_directory().'/assets/js/block-variations-bundle.js' )
    );
  }

  public function set_script_translations() {
    wp_set_script_translations( 'js-common', 'biblio', get_template_directory().'/languages' );
  }

  // 使用されたブロックのみcssを読み込む
  public function biblio_enqueue_wp_core_block_styles() {
    // コアのブロックに付与するスタイル
    $styled_blocks = array(
      'archives',
      'audio',
      'avatar',
      'buttons',
      'button',
      'calendar',
      'categories',
      'code',
      'columns',
      'cover',
      'embed',
      'freeform',
      'gallery',
      'group',
      'heading',
      'image',
      'latest-posts',
      'media-text',
      'navigation',
      'nextpage',
      'page-list',
      'paragraph',
      'post-author',
      'post-author-name',
      'post-comments',
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
      'template-part',
      'verse',
    );

    foreach ( $styled_blocks as $block_name ) {
      $handle = (
      function_exists( 
        'wp_should_load_separate_core_block_assets' ) &&
        wp_should_load_separate_core_block_assets()
      ) ? 
        "wp-block-$block_name" :
        'wp-block-library';

      $dir = "assets/css/wp-blocks/$block_name/";
      $extension = ".css";
      $editor_extension = "-editor.css";

      if( file_exists(get_theme_file_path( $dir.$block_name.$extension)) ) {
        // get styles.
        $styles = file_get_contents( get_theme_file_path( $dir.$block_name.$extension ) );

        wp_add_inline_style( $handle, $styles ); // add front
        add_editor_style( $dir.$block_name.$extension ); // add editor
      }
      if ( file_exists( get_theme_file_path( $dir.$block_name.$editor_extension ) ) ) {
        add_editor_style( $dir.$block_name.$editor_extension ); // add editor
      }
    }
  }

}