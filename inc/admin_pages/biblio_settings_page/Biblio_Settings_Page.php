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

  public function __construct() {
    add_action( 'admin_enqueue_scripts', [$this, 'page_script'] );
    add_action( 'init', [$this, 'biblio_register_settings'] , 999);
  }

  public function create_page() {
    ?>
      <div id="biblio-settings"></div>
    <?php
    // $this->page_script(get_current_screen()->id);
  }
  
  public function page_script($hook_suffix) {
    // 作成したオプションページ以外では読み込まない
    if ( 'toplevel_page_biblio-settings' !== $hook_suffix ) {
      return;
    }
    
    $asset_file = include( get_template_directory(). '/inc/admin_pages/biblio_settings_page/build/index.asset.php' );

    // CSSファイルの読み込み
    wp_enqueue_style(
        'biblio-settings-page-style',
        get_template_directory_uri(). '/inc/admin_pages/biblio_settings_page/build/index.css',
        array( 'wp-components' ) // ←Gutenbergコンポーネントのデフォルトスタイルを読み込み
    );

    // JavaScriptファイルの読み込み
    wp_enqueue_script(
        'biblio-settings-page-script',
        get_template_directory_uri(). '/inc/admin_pages/biblio_settings_page/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        true // </body>`終了タグの直前でスクリプトを読み込む
    );
  }

  public function biblio_register_settings() {
    // 広告を表示する
    register_setting(
        'biblio_admin_settings',
        'biblio_admin_show_writing_flg',
        array(
            'type'         => 'boolean',
            'show_in_rest' => true,
            'default'      => true,
        )
    );
  }
}
