<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'workroom1128_container_type' );
?>

<nav id="main-nav"
class="navbar navbar-expand-md navbar-dark fixed-top justify-content-between"
aria-labelledby="main-nav-label">

	<div class="header-background"></div>

		<h2 id="main-nav-label" class="sr-only">

			<?php esc_html_e( 'Main Navigation', 'workroom1128' ); ?>

		</h2>

<!-- Your site title as branding in the menu -->
<?php if ( ! has_custom_logo() ) { ?>
	<?php if ( is_front_page() && is_home() ) : ?>
		<h1 class="navbar-brand mb-0">
		<a rel="home"
			href="<?php echo esc_url( home_url( '/' ) ); ?>"
			itemprop="url">
			<?php bloginfo( 'name' ); ?>
		</a></h1>

	<?php else : ?>

	<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
		<?php bloginfo( 'name' ); ?>
	</a>

	<?php endif; ?>

	<?php
} else {
	the_custom_logo();
}
?>
<!-- end custom logo -->
	<button class="navbar-toggler" type="button"
	data-bs-toggle="collapse" data-bs-target="#main-menu"
	aria-controls="main-menu" aria-expanded="false"
	aria-label="<?php esc_attr_e( 'Toggle navigation', 'workroom1128' ); ?>">
	<span class="navbar-toggler-icon icon menu-open"></span>
	</button>

<!-- The WordPress Menu goes here -->
		<div class="collapse navbar-collapse" id="main-menu">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_class'     => '',
			'fallback_cb'    => '__return_false',
			'items_wrap'     => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-lg-0 p-2 p-lg-0 %2$s">%3$s</ul>',
			'depth'          => 4,
			'walker'         => new WP_Bootstrap_5_Megamenu_Navwalker(),
		)
	)
	?>

	<div class="site-header__util">
	<?php
	if ( is_user_logged_in() ) {
		?>
		<a href="<?php echo esc_url( wp_logout_url() ); ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">
			<span class="site-header__avatar"><?php echo get_avatar( get_current_user_id(), 60 ); ?></span>
			<span class="btn__text">Log Out</span>
		</a>
	<?php } else { ?>
		<a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
	<?php } ?>
	</div>

</nav><!-- .site-navigation -->
