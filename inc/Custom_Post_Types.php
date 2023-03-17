<?php
/**
 * Biblio Theme: Custom Post Types
 *
 * @package Biblio
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Custom_Post_Types {
	public function __construct() {
		add_action( 'init', [ $this, 'create_post_type' ] );
	}

  public function create_post_type() {
    $showWritingFlg = get_option( 'biblio_admin_show_writing_flg' );
    if( ! $showWritingFlg && ! $showWritingFlg == true ) {
      return;
    }
    register_post_type('writing', [ // 投稿タイプ名の定義
      'labels' => [
        'name' => '執筆', // 管理画面上で表示する投稿タイプ名
        'singular_name' => '執筆', // カスタム投稿の識別名
        'add_new' => '新しく執筆する',
        'all_items' => '執筆物一覧',
      ],
      'public' => true, // 投稿タイプをpublicにするか
      'has_archive' => true, // アーカイブ機能ON/OFF
      'menu_position' => 5, // 管理画面上での配置場所(投稿の下に配置)
      'show_in_rest' => true, // wordpress5.x系から出てきた新エディタ「Gutenberg」を有効にする
      'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', "post-formats"), // カスタム投稿で使用する項目を設定（タイトル、エディター、アイキャッチ）
    ]);
    /* タクソノミー(カテゴリー分け)の定義 */
    register_taxonomy(
      'writing-category', /* タクソノミーの名前 */
      'writing', /* 使用するカスタム投稿タイプ名 */
      array(
        'hierarchical' => true, /* trueだと親子関係が使用可能。falseで使用不可 */
        'update_count_callback' => '_update_post_term_count',
        'label' => '執筆物カテゴリー',
        'singular_label' => '執筆物カテゴリー',
        'public' => true,
        'show_ui' => true,// 管理画面表示ON/OFF
      )
    );
  }
}