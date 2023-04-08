<?php
/**
 * Theme update
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Theme_Update {

  private $old_transient_name;
  private $now_transient_name;

  public function __construct() {
    if( is_admin() ) {
      add_filter( 'pre_set_site_transient_update_themes', [ $this, 'update_check'] );
      add_filter( 'site_transient_update_themes', [ $this, 'update_check'] );
      add_action( 'after_switch_theme', [$this, 'delete_old_transient'] );
    }
	}

  public function update_check( $transient ) {

    $theme_name = get_template();
    $theme_data = wp_get_theme();
    $version = $theme_data->get( 'Version' );
    $this->now_transient_name = 'biblio-theme-update'.$version;

    if( false == $remote = get_transient( $this->now_transient_name ) ) {

      $remote = wp_remote_get(
        'https://qim.chu.jp/release/biblio-info.php',
        array(
          'timeout' => 10,
          'headers' => array(
            'Accept' => 'application/json'
          )
        )
      );

      // do nothing if errors
      if(
        is_wp_error( $remote )
        || 200 !== wp_remote_retrieve_response_code( $remote )
        || empty( wp_remote_retrieve_body( $remote ) )
      ) {
        return $transient;
      }

      // encode the response body
      $remote = json_decode( wp_remote_retrieve_body( $remote ) );
      
      if( ! $remote ) {
        return $transient; // who knows, maybe JSON is not valid
      }

      set_transient( $this->now_transient_name, $remote, HOUR_IN_SECONDS );
    }

    $remote_data = array(
      'theme' => $theme_name,
      'url' => $remote->details_url,
      'requires' => $remote->requires,
      'requires_php' => $remote->requires_php,
      'new_version' => $remote->version,
      'package' => $remote->download_url,
    );

    $newTransient = new \stdClass();
    // check all the versions now
    if(
      $remote
      && version_compare( $version, $remote->version, '<' )
      && version_compare( $remote->requires, get_bloginfo( 'version' ), '<' )
      && version_compare( $remote->requires_php, PHP_VERSION, '<' )
    ) {
      $this->old_transient_name = $this->now_transient_name;
      $newTransient->response[ $theme_name ] = $remote_data;
    } else {
      $newTransient->no_update[ $theme_name ] = $remote_data;
    }

    return $newTransient;
  }

  // アップデート完了時に古いversionのtrasientを削除
  public function delete_old_transient() {
    if( $this->old_transient_name !== $this->now_transient_name ) {
      delete_transient( $this->old_transient_name );
    }
  }
}