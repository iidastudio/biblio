<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Custom_Pages {

  public function __construct() {
    add_action('admin_menu', [ $this, 'add_custom_pages' ]);
  }

  public function add_custom_pages() {
    add_menu_page(
      __('BIBLIO Settings','biblio'),
      __('BIBLIO Settings','biblio'),
      'manage_options',
      'biblio-settings',
      'biblio-settings',
      'dashicons-admin-settings'
    );
  }
}