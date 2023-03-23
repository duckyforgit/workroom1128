<?php
/**
 * Partial template for content in page.php
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div id="landing" class="container">
	<div class="row">
		<div class="col-12 col-lg-6">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/banner-book.jpg' ); ?>" alt="Step by Step Guide sample pages">
		</div>
		<div class="col-12 col-lg-6 ">
			<h2>A simple step-by-step guide.</h2>
			<h3>Manage your career - expectations, purpose and happiness.</h3>
			<ul class="checkmark" >
				<li>Part 1. Learn to gauge what "reasonable expectations" should look like.</li>
				<li>Part II. Use the 3 pillars of Service, Development, and Legacy to help you generate purpose in your career, whether you're staying put or looking to move on.<br>
				These pillars are applicable whether you are happily employed, miserably employed, or not employed at all!
				</li>
				<li>Part III. Learn to depend on yourself for happiness through personal growth.</li>
			</ul>
			<button id="continue" class="btn btn-primary">Continue</button>
		</div>
	</div>	
</div>
