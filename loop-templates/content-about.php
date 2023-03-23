<?php
/**
 * Partial template for about page content
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

	<div class="entry-content">

		<?php
		the_content();

         get_template_part( 'template-parts/content', 'clients' );  

		workroom1128_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php workroom1128_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
