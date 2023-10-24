<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\dist\admin_pages\biblio_settings_page;

defined( 'ABSPATH' ) || exit;

class Biblio_Settings_Page {

  public function __construct() {
    add_action( 'admin_enqueue_scripts', [$this, 'page_script'] );
    add_action( 'init', [$this, 'biblio_register_settings'] );
  }
  
  public function page_script($hook_suffix) {
    // 作成したオプションページ以外では読み込まない
    if ( 'toplevel_page_biblio-settings' !== $hook_suffix ) {
      return;
    }
    
    $asset_file = include( get_template_directory(). '/dist/admin_pages/biblio_settings_page/index.asset.php' );

    // CSSファイルの読み込み
    wp_enqueue_style(
        'biblio-settings-page-style',
        get_template_directory_uri(). '/dist/admin_pages/biblio_settings_page/index.css',
        array( 'wp-components' ) // ←Gutenbergコンポーネントのデフォルトスタイルを読み込み
    );

    // JavaScriptファイルの読み込み
    wp_enqueue_script(
        'biblio-settings-page-script',
        get_template_directory_uri(). '/dist/admin_pages/biblio_settings_page/index.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        array('strategy' => 'defer')
    );
  }

  public function biblio_register_settings() {
    // 執筆(カスタム投稿タイプ)
    register_setting(
      'biblio_admin_settings',
      'biblio_admin_show_writing_flg',
      array(
        'type'         => 'boolean',
        'show_in_rest' => true,
        'default'      => false,
      )
    );
    // 本(カスタム投稿タイプ)
    register_setting(
      'biblio_admin_settings',
      'biblio_admin_show_book_flg',
      array(
        'type'         => 'boolean',
        'show_in_rest' => true,
        'default'      => false,
      )
    );
    // お知らせ(カスタム投稿タイプ)
    register_setting(
      'biblio_admin_settings',
      'biblio_admin_show_info_flg',
      array(
        'type'         => 'boolean',
        'show_in_rest' => true,
        'default'      => false,
      )
    );
    // テキスト
    register_setting(
      'biblio_admin_settings',
      'my_gutenberg_admin_plugin_text',
      array(
        'type'         => 'string',
        'show_in_rest' => true,
        'default'      => 'ここにテキストが入ります',
      )
    );
    // 文字サイズ
    register_setting(
      'biblio_admin_settings',
      'my_gutenberg_admin_plugin_font_size',
      array(
        'type'         => 'number',
        'show_in_rest' => true,
        'default'      => 16,
      )
    );
  }

}
