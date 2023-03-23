<?php
/**
 * Register_acf_block Adds custom acf block types to Gutenberg Editor.
 *
 * @package workroom1128
 * @param array $classes Classes for the body element.
 * @return array
 */

if ( ! function_exists( 'register_acf_block' ) ) :
	/**
	 * Adds custom acf block types to Gutenberg Editor.
	 *
	 * @package workroom1128
	 * @return void
	 */
	function register_acf_block() {

		acf_register_block_type(
			array(
				'name'            => 'about',
				'title'           => __( 'About Content' ),
				'description'     => __( 'About Page content layout.' ),
				'render_template' => 'template-parts/blocks/content/about.php',
				'category'        => 'formatting',
				'icon'            => 'text-page',
				'mode'            => 'preview',
				'keywords'        => array( 'about', 'content' ),
				'supports'        => array(
					'align'           => true,
					'anchor'          => true,
					'customClassName' => true,
					'jsx'             => true,
				),
			),
		);
		acf_register_block_type(
			array(
				'name'            => 'hours',
				'title'           => __( 'Hours Content' ),
				'description'     => __( 'Hours Page content layout.' ),
				'render_template' => 'template-parts/blocks/content/hours.php',
				'category'        => 'formatting',
				'icon'            => 'clock',
				'mode'            => 'preview',
				'keywords'        => array( 'hours', 'content' ),
				'supports'        => array(
					'align'           => true,
					'anchor'          => true,
					'customClassName' => true,
					'jsx'             => true,
				),
			),
		);
		acf_register_block_type(
			array(
				'name'            => 'testimonial',
				'title'           => __( 'Testimonial Content' ),
				'description'     => __( 'Testimonial Page content layout.' ),
				'render_template' => 'template-parts/blocks/content/testimonial.php',
				'category'        => 'formatting',
				'icon'            => 'format-quote',
				'mode'            => 'preview',
				'keywords'        => array( 'testimonial', 'content' ),
				'supports'        => array(
					'align'           => true,
					'anchor'          => true,
					'customClassName' => true,
					'jsx'             => true,
				),
			),
		);
	}
	endif;

	// Check if function exists and hook into setup.
	/**
	 * Adds custom acf block types to Gutenberg Editor.
	 *
	 * @package workroom1128
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
if ( function_exists( 'register_acf_block' ) ) {
	add_action( 'acf/init', 'register_acf_block' );
}

/* can use when not defining template part */
/**
 * Adds custom acf block types to Gutenberg Editor.
 *
 * @package workroom1128
 * @param array   $block Classes for the body element.
 * @param string  $content Content string.
 * @param boolean $is_preview true or false.
 * @return void
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false ) {

		// create id attribute for specific styling.
	$id = $block['id'];

	// convert name ("acf/testimonial") into path friendly slug ("testimonial").
	$slug = str_replace( 'acf/', '', $block['render_template'] );

	// include a template part from within the "template-parts/block" folder.
	if ( file_exists( get_theme_file_path( "/{$slug}" ) ) ) {
		include get_theme_file_path( "/{$slug}" );
	}
}
/**
 * Adds custom acf block types to Gutenberg Editor.
 *
 * @package workroom1128
 * @param array $block           Classes for the body element.
 * @return void
 */
function course_featured_block_render_callback( $block ) {
	// convert name ("acf/testimonial") into path friendly slug ("testimonial").
	$slug = str_replace( 'acf/', '', $block['name'] );
	// include a template part from within the "template-parts/block" folder.
	if ( file_exists( get_theme_file_path( '/template-parts/blocks/course/course-featured.php' ) ) ) {
		include get_theme_file_path( '/template-parts/blocks/course/course-featured.php' );
	}
}
/**
 *  This is the callback that displays the hero block.
 *
 * @param  array  $block The block settings and attributes.
 * @param  string $content The block content (emtpy string).
 * @param  bool   $is_preview True during AJAX preview.
 */
function hero_render_callback( $block, $content = '', $is_preview = false ) {

	// create id attribute for specific styling.
	$id = 'hero-' . $block['id'];

	// create align class ("alignwide") from block setting ("wide").
	$align_class = $block['align'] ? 'align' . $block['align'] : '';

	// ACF field variables.
	$image     = get_field( 'image' );
	$headline  = get_field( 'headline' );
	$paragraph = get_field( 'paragraph' );
	$cta       = get_field( 'cta' );

	?>
<section id="<?php echo esc_html( $id ); ?>" class="hero <?php echo esc_html( $align_class ); ?>" style="background-image: url(<?php echo esc_url( $image ); ?>);">
	<?php if ( $headline ) : ?>
		<h2><?php echo esc_html( $headline ); ?></h2>
	<?php endif; ?>
	<?php if ( $paragraph ) : ?>
		<p><?php echo esc_html( $paragraph ); ?></p>
	<?php endif; ?>
	<?php if ( $cta ) : ?>
		<a class="button" href="<?php echo esc_url( $cta['url'] ); ?>" target="<?php echo esc_html( $cta['target'] ); ?>"><?php echo esc_html( $cta['title'] ); ?></a>
	<?php endif; ?>
</section>
	<?php
}
