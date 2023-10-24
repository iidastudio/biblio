<?php
/**
 * Load Custom Block
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;

class Load_Custom_Block {

  public function __construct() {
    add_action( 'init', [$this,  'biblio_register_blocks'] );
  }

  public function biblio_register_blocks() {
		register_block_type( get_template_directory() . '/dist/blocks/vertical_group' );
	}

}