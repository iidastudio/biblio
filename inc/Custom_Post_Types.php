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
		add_action( 'init', array( $this, 'create_post_type' ) );
	}

	public function create_post_type() {
		$show_writing_flg = get_option( 'biblio_admin_show_writing_flg' );
		if ( true === $show_writing_flg && $show_writing_flg ) {
			register_post_type(
				'writing',
				array( // 投稿タイプ名の定義
					'labels'        => array(
						'name'          => '執筆', // 管理画面上で表示する投稿タイプ名
						'singular_name' => '執筆', // カスタム投稿の識別名
						'add_new'       => '新しく執筆する',
						'all_items'     => '執筆物一覧',
					),
					'public'        => true, // 投稿タイプをpublicにするか
					'hierarchical'  => true,
					'taxonomies'    => array( 'writing-category' ),
					'has_archive'   => true, // アーカイブ機能ON/OFF
					'menu_position' => 5, // 管理画面上での配置場所(投稿の下に配置)
					'show_in_rest'  => true, // wordpress5.x系から出てきた新エディタ「Gutenberg」を有効にする
					'supports'      => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', 'post-formats', 'page-attributes' ), // カスタム投稿で使用する項目を設定（タイトル、エディター、アイキャッチ）
				)
			);
			/* タクソノミー(カテゴリー分け)の定義 */
			register_taxonomy(
				'writing-category', /* タクソノミーの名前 */
				'writing', /* 使用するカスタム投稿タイプ名 */
				array(
					'hierarchical'          => true, /* trueだと親子関係が使用可能。falseで使用不可 */
					'update_count_callback' => '_update_post_term_count',
					'label'                 => '執筆物カテゴリー',
					'singular_label'        => '執筆物カテゴリー',
					'public'                => true,
					'show_ui'               => true, // 管理画面表示ON/OFF
					'show_in_rest'          => true,
				)
			);
		}
		$show_book_flg = get_option( 'biblio_admin_show_book_flg' );
		if ( true === $show_book_flg && $show_book_flg ) {
			register_post_type(
				'book',
				array(
					'labels'        => array(
						'name'          => '本',
						'singular_name' => '本',
						'add_new'       => '新しく本を作る',
						'all_items'     => '本一覧',
					),
					'public'        => true,
					'has_archive'   => true,
					'taxonomies'    => array( 'book-category' ),
					'menu_position' => 5,
					'show_in_rest'  => true,
					'supports'      => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', 'post-formats' ),
				)
			);
			register_taxonomy(
				'book-category',
				'book',
				array(
					'hierarchical'          => true,
					'update_count_callback' => '_update_post_term_count',
					'label'                 => '本のカテゴリー',
					'singular_label'        => '本のカテゴリー',
					'public'                => true,
					'show_ui'               => true,
					'show_in_rest'          => true,
				)
			);
		}
		$show_info_flg = get_option( 'biblio_admin_show_info_flg' );
		if ( true === $show_info_flg && $show_info_flg ) {
			register_post_type(
				'info',
				array(
					'labels'        => array(
						'name'          => 'お知らせ',
						'singular_name' => 'お知らせ',
						'add_new'       => '新しいお知らせを投稿する',
						'all_items'     => 'お知らせ一覧',
					),
					'public'        => true,
					'has_archive'   => true,
					'menu_position' => 5,
					'show_in_rest'  => true,
					'supports'      => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', 'post-formats' ),
				)
			);
			register_taxonomy(
				'info-category',
				'info',
				array(
					'hierarchical'          => true,
					'update_count_callback' => '_update_post_term_count',
					'label'                 => 'お知らせのカテゴリー',
					'singular_label'        => 'お知らせのカテゴリー',
					'public'                => true,
					'show_ui'               => true,
				)
			);
		}
	}
}
