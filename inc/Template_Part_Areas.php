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
          'area'        => 'biblio/main/home',
          'label'       => __( 'Main home', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        ),
        array(
          'area'        => 'biblio/main/single',
          'label'       => __( 'Main single', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        ),
        array(
          'area'        => 'biblio/main/page',
          'label'       => __( 'Main page', 'biblio' ),
          'icon'        => 'layout',
          'description' => '',
          'area_tag'    => 'main',
        )
      )
    );
  }
}