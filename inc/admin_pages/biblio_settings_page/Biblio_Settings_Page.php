<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc\admin_pages\biblio_settings_page;

defined( 'ABSPATH' ) || exit;

class Biblio_Settings_Page {

  public function create_page() {
    ?>
      <h1>BIBLIO Settings</h1>
      <div id="biblio-settings"></div>
    <?php
  }
  
  private function page_script() {
    var_dump("hoge");

  }
}
