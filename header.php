<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
// var_dump($wp_query->query_vars);

$navbar_type = get_theme_mod( 'workroom1128_navbar_type', 'collapse' );
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <meta name="viewport" content="width=device-width, height=device-height, viewport-fit=cover, initial-scale=1"> -->
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> <?php workroom1128_body_attributes(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<div class="site relative" id="page">

<?php // if ( is_front_page() && is_home() ) : ?>
	<?php // get_template_part( 'global-templates/landing-banner' ); ?>
<?php // endif; ?>

<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'workroom1128' ); ?></a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-bootstrap5-megamenu' ); ?>


	</header><!-- #wrapper-navbar end -->
