<?php
/**
 * Load Custom Block
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\inc\custom_block\biblio_vertical_group\Biblio_Vertical_Group;

class Load_Custom_Block {
  
  public function __construct() {
    new Biblio_Vertical_Group;
  }

}