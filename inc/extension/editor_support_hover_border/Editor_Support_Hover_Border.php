<?php
/**
 * Editor support hover border
 * 
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc\extension\editor_support_hover_border;
use biblio\lib\Helper;

class Editor_Support_Hover_Border {

  public function __construct() {
    add_action( 'enqueue_block_editor_assets', [$this,  'editor_support_hover_border_scripts'] );
    add_action( 'enqueue_block_editor_assets', [$this, 'php_to_js'] );
  }

  public function editor_support_hover_border_scripts() {
    register_block_type( __DIR__ . '/build' );
  }

  public function php_to_js () {
    wp_localize_script( 
      'biblio-extension-editor-support-hover-border-editor-script', 
      'phpToJs', 
      array(
        'isGutenbergActive' => is_plugin_active( 'gutenberg/gutenberg.php' )
      )
    );
  }
  
}