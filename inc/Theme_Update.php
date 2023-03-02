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

  public function __construct() {
    add_filter( 'pre_set_site_transient_update_themes', [ $this, 'update_check'] );
    add_filter( 'site_transient_update_themes', [ $this, 'update_check'] );
	}

  public function update_check( $transient ) {

    $stylesheet = get_template();
    $theme = wp_get_theme();
    $version = $theme->get( 'Version' );

    if( false == $remote = get_transient( 'biblio-theme-update'.$version ) ) {

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

      set_transient( 'biblio-theme-update'.$version, $remote, HOUR_IN_SECONDS );
    }

    $data = array(
      'theme' => $stylesheet,
      'url' => $remote->details_url,
      'requires' => $remote->requires,
      'requires_php' => $remote->requires_php,
      'new_version' => $remote->version,
      'package' => $remote->download_url,
    );

    // check all the versions now
    if(
      $remote
      && version_compare( $version, $remote->version, '<' )
      && version_compare( $remote->requires, get_bloginfo( 'version' ), '<' )
      && version_compare( $remote->requires_php, PHP_VERSION, '<' )
    ) {
      $transient->response[ $stylesheet ] = $data;
      delete_transient('biblio-theme-update'.$version);
    } else {
      $transient->no_update[ $stylesheet ] = $data;
    }

    return $transient;
  }
}