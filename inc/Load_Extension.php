<?php
/**
 * Load Extension
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\inc\extension\code_block_syntax\Code_Block_Syntax;
use biblio\lib\Helper;

class Load_Extension {
  
  public function __construct() {
    add_action( 'wp', array( $this, 'load_extension' ) );
  }

  public function load_extension() {
    if( Helper::is_block_used_on_page( 'core/code' ) ) {
      new Code_Block_Syntax;
    }
  }

}