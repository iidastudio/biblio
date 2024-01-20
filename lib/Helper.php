<?php
/**
 * Helper functions
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\lib;

class Helper {

	/**
	 * 表示したページにそのブロックが使用されているかどうか判定する
	 * $target_block_nameには'core/code'のようにblockNameを渡す
	 *
	 * @param string $target_block_name
	 * @return bool
	 */
	public static function has_block_all( $target_block_name ) {
		$blocks_name_on_part_flg = false;
		$template_parts_slug     = self::get_template_parts_slug();
		foreach ( $template_parts_slug as $template_part_slug ) {
			$blocks_name_on_part_arrays[] = self::get_block_used_on_part( $template_part_slug );
		}
		foreach ( $blocks_name_on_part_arrays as $blocks_name_on_part ) {
			for ( $i = 0; $i < count( $blocks_name_on_part ); $i++ ) {
				if ( $target_block_name === $blocks_name_on_part[ $i ] ) {
					$blocks_name_on_part_flg = true;
				}
			}
		}
		$has_block_flg = has_block( $target_block_name, get_the_content() );
		if ( $has_block_flg || $blocks_name_on_part_flg ) {
			return true;
		}
	}

	// 表示したページにあるtemplate_partのslugを取得
	public static function get_template_parts_slug() {
		global $_wp_current_template_content;
		$blocks              = parse_blocks( $_wp_current_template_content );
		$template_parts_slug = self::get_template_parts_slug_recursive( $blocks );
		return $template_parts_slug;
	}

	// 指定したtemplate_partにあるブロック名を取得
	public static function get_block_used_on_part( $part_name ) {
		$template_part = get_block_template( get_stylesheet() . '//' . $part_name, 'wp_template_part' );
		if ( ! $template_part || empty( $template_part->content ) ) {
			return;
		}
		$blocks = parse_blocks( $template_part->content );

		$blocks_name = self::get_block_names_recursive( $blocks );
		return $blocks_name;
	}

	// 再起的にインナーブロックを解析してブロック名を返す
	private static function get_block_names_recursive( $inner_blocks ) {
		foreach ( $inner_blocks as $block ) {
			$blocks_name[] = $block['blockName'];
			if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
				$blocks_name = array_merge( $blocks_name, self::get_block_names_recursive( $block['innerBlocks'] ) );
			}
		}
		return $blocks_name;
	}

	// 再起的にインナーブロックを解析してテンプレート名を返す
	private static function get_template_parts_slug_recursive( $inner_blocks ) {
		foreach ( $inner_blocks as $block ) {
			if ( isset( $block['blockName'] ) && isset( $block['attrs']['slug'] ) && 'core/template-part' === $block['blockName'] ) {
				$template_slug[] = $block['attrs']['slug'];
			}
			if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
				self::get_block_names_recursive( $block['innerBlocks'] );
			}
		}
		return $template_slug;
	}
}
