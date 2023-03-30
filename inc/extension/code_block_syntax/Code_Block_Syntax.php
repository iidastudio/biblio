<?php
/**
 * Code block syntax
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc\extension\code_block_syntax;

class Code_Block_Syntax {
  // JavaScriptファイルの読み込み
  public function __construct() {
    add_action( 'init', [$this, 'code_block_styntax_scripts'] );
    if ( !is_admin() ) {
      wp_enqueue_style('style-prism', get_template_directory_uri().'/inc/extension/code_block_syntax/lib/prism.css', array(), filemtime( get_template_directory().'inc/extension/code_block_syntax/lib/prism.css' ));
      wp_enqueue_script('js-prism', get_template_directory_uri().'/inc/extension/code_block_syntax/lib/prism.js', array('wp-i18n'), filemtime( get_template_directory().'inc/extension/code_block_syntax/lib/prism.js' ) );
      wp_script_add_data('js-prism', 'defer', true);
    }
  }

  public function code_block_styntax_scripts() {
    register_block_type( __DIR__ . '/build' );
  }
}
