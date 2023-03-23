<?php
/**
 * WP_Bootstrap
 *
 * @package WP_Bootstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class Name: WP_Bootstrap_5_Megamenu_Navwalker
 * Plugin Name: Bootstrap_5_WP_Nav_Menu_Walker
 * Plugin URI:  https://github.com/wp-bvalueootstrap/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 4 navigation style in a custom theme using the WordPress built in menu manager.
 * Author: Edward McIntyre - @twittem, WP Bootstrap, William Patton - @pattonwebz
 * Version: 4.1.0
 * Author URI: https://github.com/wp-bootstrap
 * GitHub Plugin URI: https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * GitHub Branch: master
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * WP_Bootstrap_5_Megamenu_Navwalker class.
 *
 * @extends Walker_Nav_Menu
 */
class WP_Bootstrap_5_Megamenu_Navwalker extends Walker_Nav_menu {
	/**
	 * Current Item variable
	 *
	 * @var string
	 */
	private $current_item;
	/**
	 * Dropdown array
	 *
	 * @var array
	 */
	private $dropdown_menu_alignment_values =
		array(
			'dropdown-menu-start',
			'dropdown-menu-end',
			'dropdown-menu-sm-start',
			'dropdown-menu-sm-end',
			'dropdown-menu-md-start',
			'dropdown-menu-md-end',
			'dropdown-menu-lg-start',
			'dropdown-menu-lg-end',
			'dropdown-menu-xl-start',
			'dropdown-menu-xl-end',
			'dropdown-menu-xxl-start',
		);
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since WP 3.0.0
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class to add to the file.
		$classes = array( 'dropdown-menu' );
		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since WP 4.8.0
		 *
		 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		/**
		 * The `.dropdown-menu` container needs to have a labelledby
		 * attribute which points to it's trigger link.
		 *
		 * Form a string for the labelledby attribute from the the latest
		 * link with an id that was added to the $output.
		 */
		$labelledby = '';
		// find all links with an id in the output.
		preg_match_all( '/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches );
		// with pointer at end of array check if we got an ID match.
		if ( end( $matches[2] ) ) {
			// build a string to use as aria-labelledby.
			$labelledby = 'aria-labelledby="' . end( $matches[2] ) . '"';
		}
		$labelledby = '';
		// find all links with an id in the output.
		preg_match_all( '/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches );
		// with pointer at end of array check if we got an ID match.
		if ( end( $matches[2] ) ) {
			// build a string to use as aria-labelledby.
			$labelledby = 'aria-labelledby="' . end( $matches[2] ) . '"';
		}
		$submenu = ( $depth > 0 ) ? ' sub-menu' : '';
		$output .= "{$n}{$indent}<ul$class_names $labelledby >{$n}";
	}
	/**
	 * Starts the element output.
	 *
	 * @since WP 3.0.0
	 * @since WP 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$this->current_item = $item;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$value         = '';
		$class_names   = $value;

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = ( $args->walker->has_children ) ? 'dropdown' : '';
		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $item->ID;
		if ( $depth && $args->walker->has_children ) {
			$classes[] = 'dropdown-menu dropdown-menu-end';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$active_class   = ( $item->current || $item->current_item_ancestor ) ? 'active ' : '';
		$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
		$attributes    .= ( $args->walker->has_children ) ? ' class="' . $nav_link_class . $active_class . 'dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';
		$item_output    = $args->before;
		$item_output   .= '<a' . $attributes . '>';
		if ( in_array( 'menu-item-video', $classes, true ) ) {
			$item_output .= '<i class="fab fa-youtube"></i>  ';
		}

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';

		$item_output .= $args->after;
		if ( $item->description ) {
			$item_output .= '<p class="menu-item-description my-desc">' . $item->description . '</p>';
		}

		if ( in_array( 'featured-image', $classes, true ) ) {
			$image = get_the_post_thumbnail( $item->object_id, 'featured-blog' );
		}
		if ( ! empty( $image ) ) {
				$item_output .= '<div>' . $image . '</div>';
		}
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
