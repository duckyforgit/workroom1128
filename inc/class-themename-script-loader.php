<?php
/**
 * Javascript Loader Class
 *
 * Allow `async` and `defer` while enqueuing Javascript.
 *
 * Based on a solution in WP Rig.
 *
 * @package workroom1128
 * @subpackage workroom1128
 * @since workroom1128 1.0
 */

if ( ! class_exists( 'workroom1128_Script_Loader' ) ) {
	/**
	 * A class that provides a way to add `async` or `defer` attributes to scripts.
	 *
	 * @since workroom1128 1.0
	 */
	class workroom1128_Script_Loader {

		/**
		 * Adds async/defer attributes to enqueued / registered scripts. Based on Twenty Twenty function.
		 *
		 * @since workroom1128 1.0
		 *
		 * @param string $tag    The script tag.
		 * @param string $handle The script handle.
		 * @return string Script HTML string.
		 */
		public function filter_script_loader_tag( $tag, $handle ) {
			foreach ( array( 'async', 'defer' ) as $attr ) {
				if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
					continue;
				}
				// Prevent adding attribute when already added in #12009.
				if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
					$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
				}
				// Only allow async or defer, not both.
				break;
			}
			return $tag;
		}

	}
}
