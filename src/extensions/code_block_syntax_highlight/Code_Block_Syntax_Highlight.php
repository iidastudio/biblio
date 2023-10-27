<?php
/**
 * Code block syntax
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\dist\extensions\code_block_syntax_highlight;
use biblio\lib\Helper;

class Code_Block_Syntax_Highlight {

  public function __construct() {
    if ( !is_admin() ) {
      add_action( 'wp_enqueue_scripts', [$this, 'load_prism_js'] );
    }
  }

  private $dir_name = '/dist/extensions/code_block_syntax_highlight/';

  public function load_prism_js() {
    if( Helper::has_block_all('core/code') ) {
      wp_enqueue_style('style-prism', get_template_directory_uri().$this->dir_name.'view.css', array(), filemtime( get_template_directory().$this->dir_name.'view.css' ));
      wp_enqueue_script('js-prism', get_template_directory_uri().$this->dir_name.'view.js', array('wp-i18n'), filemtime( get_template_directory().$this->dir_name.'view.js' ), array('strategy' => 'defer') );
    }
  }

}
