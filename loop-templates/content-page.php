<?php
/**
 * Partial template for content in page.php
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo esc_html( workroom1128_custom_breadcrumb() ); ?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php
		the_content();
		workroom1128_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php workroom1128_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
