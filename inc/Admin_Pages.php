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
    if( is_admin() ) {
      add_action('admin_menu', [ $this, 'add_custom_pages' ]);
    }
    // load page scripts.
    $biblio_settings_page = new Biblio_Settings_Page;
  }

  // BIBLIO Settings page
  public function add_custom_pages() {
    add_menu_page(
      __('BIBLIO Settings','biblio'),
      __('BIBLIO Settings','biblio'),
      'manage_options',
      'biblio-settings',
      function () {
        ?>
          <div id="biblio-settings" class="biblio-settings"></div>
        <?php
      },
      'dashicons-admin-settings'
    );
  }
}