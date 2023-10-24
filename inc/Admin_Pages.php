<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;
use biblio\dist\admin_pages\biblio_settings_page\Biblio_Settings_Page;

defined( 'ABSPATH' ) || exit;

class Admin_Pages {

  public function __construct() {
    if( is_admin() ) {
      add_action('admin_menu', [ $this, 'add_custom_pages' ]);
      add_action( 'admin_enqueue_scripts', [ $this, 'biblio_admin_styles' ] );
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

  // 管理画面の配色と合わせるために読み込み
  public function biblio_admin_styles() {
    $screen = get_current_screen();
    if( $screen->id === 'toplevel_page_biblio-settings' ) {
      wp_register_style( 'edit-post-style', includes_url( '/css/dist/edit-post/style.min.css' ), array(), get_bloginfo( 'version' ) );
      wp_enqueue_style( 'edit-post-style' );
    }
  }
}