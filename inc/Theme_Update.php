<?php
/**
 * Theme support
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

defined( 'ABSPATH' ) || exit;

class Theme_Update {

  public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'update_check' ] );
	}

  public function update_check() {
    require_once get_template_directory(). '/lib/plugin-update-checker/plugin-update-checker.php';
    PucFactory::buildUpdateChecker(
      'https://qim.chu.jp/release/biblio-info.json',
      get_template_directory(). '/functions.php',
      'biblio'
    );
  }
}