<?php 
/**
 * Theme support
 *
 * @package Biblio
 * @since 1.0.0
 */

namespace biblio\inc;

defined( 'ABSPATH' ) || exit;

class Template_Part_Areas {
  
  public function __construct() {
    add_action( 'default_wp_template_part_areas', [ $this, 'biblio_default_wp_template_part_areas' ] );
  }

  public function biblio_default_wp_template_part_areas( $default_area_definitions ) {
    return array_merge(
      $default_area_definitions,
      array(
        array(
          'area'        => 'biblio/home/main',
          'label'       => __( 'Home main', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        ),
        array(
          'area'        => 'biblio/single/main',
          'label'       => __( 'Single main', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        ),
        array(
          'area'        => 'biblio/page/main',
          'label'       => __( 'Page main', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        )
      )
    );
  }
}