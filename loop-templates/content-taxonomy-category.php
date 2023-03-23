<?php
/**
 * Single post partial template
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<li class="col">

	<div class="card mb-5">

		<a href="<?php the_permalink(); ?>" class="stretched-link"></a>

		<div class="row g-0"> 

			<div class="col-sm-12">

				<div class="card-body">

					<h3 class="card-title entry-title"><?php esc_html( the_title() ); ?></h3> 
					<?php
					$trimmed = wp_trim_words( get_the_content(), 25 );
					echo esc_html( $trimmed );
					?>
					</p>

				</div>

			</div>

		</div>

	</div> 

</li>
