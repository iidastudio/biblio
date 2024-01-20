<?php
/**
 * Utility
 *
 * @package BIBLIO
 * @since 1.0.0
 */
namespace biblio\lib;

class Utility {

	public function __construct() {
		add_filter( 'script_loader_tag', array( $this, 'support_async_defer_script_attrs' ), 10, 2 );
	}

	public function support_async_defer_script_attrs( $tag, $handle ) {
		foreach ( array( 'async', 'defer' ) as $attr ) {
			if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
				continue;
			}
			// Prevent adding attribute twice.
			if ( ! preg_match( ":\s{$attr}[=>\s]:", $tag ) ) {
				$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
			}
			break; // Only async or defer, not both.
		}
		return $tag;
	}
}
