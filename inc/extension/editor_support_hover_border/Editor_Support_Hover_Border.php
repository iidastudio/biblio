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
  }

  function editor_support_hover_border_scripts() {
    register_block_type( __DIR__ . '/build' );
  }
  
}
