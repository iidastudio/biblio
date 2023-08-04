<?php
/**
 * Plugin Name:       Biblio Block Vertical Group
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       biblio-vertical-group-block
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
namespace biblio\inc\custom_block\biblio_vertical_group;

class Biblio_vertical_Group {

	public function __construct() {
    add_action( 'init', [$this,  'create_block_biblio_vertical_group_init'] );
  }

  public function create_block_biblio_vertical_group_init() {
		register_block_type( __DIR__ . '/build' );
	}

}