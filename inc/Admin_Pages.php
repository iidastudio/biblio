<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\inc\admin_pages\biblio_settings_page\Biblio_Settings_Page;

defined( 'ABSPATH' ) || exit;

class Admin_Pages {

  public function __construct() {
    add_action('admin_menu', [ $this, 'add_custom_pages' ]);
  }

  // BIBLIO Settings page
  public function add_custom_pages() {
    add_menu_page(
      __('BIBLIO Settings','biblio'),
      __('BIBLIO Settings','biblio'),
      'manage_options',
      'biblio-settings',
      function () {
        $biblio_settings_page = new Biblio_Settings_Page;
        $biblio_settings_page -> create_page();
      },
      'dashicons-admin-settings'
    );
  }
}