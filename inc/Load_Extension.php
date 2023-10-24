<?php
/**
 * Load Extension
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;

class Load_Extension {

  public function __construct() {
      add_action( 'enqueue_block_editor_assets', [$this,  'biblio_register_extentions'] );
  }

  public function biblio_register_extentions() {
    register_block_type( get_template_directory() . '/dist/extensions/code_block_syntax_highlight' );
    if( is_admin() ) {
      register_block_type( get_template_directory() . '/dist/extensions/editor_support_hover_border' );
    }
  }

}