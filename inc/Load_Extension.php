<?php
/**
 * Load Extension
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\inc\extension\code_block_syntax\Code_Block_Syntax_Highlight;

class Load_Extension {
  
  public function __construct() {
    new Code_Block_Syntax_Highlight;
  }

}