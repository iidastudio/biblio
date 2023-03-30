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
  public static function is_block_used_on_page( $target_block_name ) {
    $blocks = parse_blocks( get_post()->post_content );
    foreach ( $blocks as $block ) {
      if ( $target_block_name === $block['blockName'] ) {
        return true;
      }
    }
    return false;
  }

}