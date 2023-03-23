<?php
/**
 * Partial template for gallery content in page.php
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$images = get_field( 'gallery_images' );
if ( $images ) :
	?>
<!-- <ul class="row gx-4 gy-4 list-unstyled row-cols-1 row-cols-sm-2 row-cols-md-4"> -->
<div class="row gx-4 gy-4 ">
	<?php foreach ( $images as $image ) : ?>
		<!-- add .15s to transition-delay for each slide for page load -->
	<!-- <li class="col box show" style="transition-delay: 0s;">
		<div class="inner"> -->
		<div class="col-md-6 col-lg-3">
			<div class="gallery-item">
				<a href="<?php echo esc_url( $image['sizes']['large'] ); ?>" class="glightbox" data-description="<?php echo esc_html( $image['description'] ); ?>">
				<img src="<?php echo esc_url( $image['sizes']['gallery'] ); ?>" 
				alt="<?php echo esc_attr( $image['alt'] ); ?>" >								
				</a>
			</div>
		</div>
	<?php endforeach; ?>
<!-- </ul> -->
</div>
	<?php
endif;
