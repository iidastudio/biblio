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
  }
  
  public function code_block_styntax_scripts() {

    $asset_file = include( get_template_directory(). '/inc/extension/code_block_syntax/build/index.asset.php' );

    wp_enqueue_script(
      'biblio-code-block-syntax-script',
      get_template_directory_uri(). '/inc/extension/code_block_syntax/build/index.js',
      $asset_file['dependencies'],
      $asset_file['version']
    );
    wp_script_add_data('biblio-code-block-syntax-script', 'defer', true);

    register_block_type( __DIR__ . '/build' );
  }
}
