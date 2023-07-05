<?php
/**
 * Code block syntax
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc\extension\code_block_syntax_highlight;
use biblio\lib\Helper;

class Code_Block_Syntax_Highlight {

  public function __construct() {
    add_action( 'init', [$this, 'code_block_styntax_scripts'] );
    if ( !is_admin() ) {
      add_action( 'wp_enqueue_scripts', [$this, 'load_prism_js'] );
    }
  }

  public function code_block_styntax_scripts() {
    register_block_type( __DIR__ . '/build' );
  }

  private $dir_name = '/inc/extension/code_block_syntax_highlight/lib/';

  public function load_prism_js() {
    if( Helper::has_block_all('core/code') ) {
      wp_enqueue_style('style-prism', get_template_directory_uri().$this->dir_name.'prism.css', array(), filemtime( get_template_directory().$this->dir_name.'prism.css' ));
      wp_enqueue_script('js-prism', get_template_directory_uri().$this->dir_name.'prism.js', array('wp-i18n'), filemtime( get_template_directory().$this->dir_name.'prism.js' ) );
      wp_script_add_data('js-prism', 'defer', true);
    }
  }

}
