<?php
/**
 * Single post partial template
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header> <!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content mt-5">

		<?php
		the_content();
		workroom1128_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php workroom1128_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
