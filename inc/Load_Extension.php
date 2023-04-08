<?php
/**
 * Load Extension
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\inc\extension\code_block_syntax_highlight\Code_Block_Syntax_Highlight;
use biblio\inc\extension\editor_support_hover_border\Editor_Support_Hover_Border;
class Load_Extension {
  
  public function __construct() {
    new Code_Block_Syntax_Highlight;
    if( is_admin() ) {
      new Editor_Support_Hover_Border;
    }
  }

}