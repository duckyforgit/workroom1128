<?php
/**
 * Template Name: Table Page
 * Template Post Type: page, offer
 * Template for displaying a page like a table
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php
			while ( have_posts() ) {
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header>

						<h1 class="h2 entry-title"><?php the_title(); ?></h1>

					</header>
					<!-- ======= The Grid Speaking to Your Organization Section ======= -->
					<section id="experience" class="experience">
						<div style="position:relative; width:100%; height:50px"></div>
							<div class="grid-wrapper">
								<div class="extra-wide background-sealife d-flex justify-content-center flex-column align-items-center  text-white box-shadow grid-padding">
									<h2 class="display-3 text-shadow pe-5 ps-5 ">ENGAGE THROUGH A VIRTUAL WEBINAR</h2>
								</div>
								<div class="d-none d-lg-flex"></div>

								<div class="wide-on-small tall-on-medium flex-column justify-content-center grid-box-shadow ps-2 pe-2">
									<h3 class="h1 text-shadow-black " >FORTY-FIVE MINUTE PRESENTATIONS.</h3>
									<h3 class="text-shadow-black ">Additional time for live Q&A TBD.</h3>
								</div>
									<div class="wide-sm-reg-md grid-box-shadow img20">
									</div>

									<div class="extra-wide justify-content-center align-items-center grid-box-shadow">
										<div class="d-flex justify-content-center align-items-center grid-item--height4 ">
											<h4 class="h3 text-shadow-black ps-5 pe-5">Virtual Platform to be arranged on an organizational basis.</h4>
										</div>
									</div>
									<div class="d-none d-xl-flex background-antiquewhite wide-on-small">
									</div>
									<!-- <div class="background-white d-none d-md-flex">
									</div> -->
									<div class="giant grid-box-shadow img21">
									</div>
									<!-- <div class="d-none d-sm-none d-md-none d-lg-flex d-xl-flex background-brown ">
									</div> -->
									<!-- <div class="wide d-flex flex-column justify-content-center align-items-center ps-1 pe-1 grid-box-shadow">-->
										<!-- <h2 class="text-shadow-black">FORTY-FIVE MINUTE PRESENTATIONS</h2> -->
										<!-- <h3 class="text-shadow-black">Additional time for live Q&A TBD.</h3> -->
										<!--<h3 class="text-shadow-black text-center">Virtual Platform to be arranged on an organizational basis.</h3>
									</div> -->
									<div class="tall-on-medium d-flex d-lg-flex d-xl-flex text-shadow-black grid-box-shadow ps-4 pe-2">
										<h3>Themes are flexible and will integrate organization objectives.</h3>

									</div>
								<div class="d-none d-sm-none d-md-flex d-lg-none d-xl-none tall background-brown">
								</div>
								<div class="tall wide d-flex flex-column justify-content-center background-sealife box-shadow">
									<img class="width-200 d-none d-sm-none d-md-none d-lg-none d-xl-flex" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="Let's talk about it">
									<h3 class="h2 text-white ps-3 pe-1 text-shadow ">Interested in the virtual self development series? Let's talk about it!</h3>
									<a href="#request" class="btn btn-primary ms-2 me-2 mb-0 text-white">REQUEST MORE INFO</a>
								</div>
								<!-- <div class="extra-wide tall img5">
								</div> -->
								<!-- <div class="extra-wide d-flex justify-content-center align-items-center background-white grid-box-shadow">
									<h3 class="h2 text-center ps-3 pe-3"></h3>
								</div> -->
							</div>
						<div class="entry-content mt-5">
							<?php
							the_content();
							workroom1128_link_pages();
							?>
						</div>
						<footer class="entry-footer">
							<!-- edit button which is only visible if logged in -->
							<?php workroom1128_entry_footer(); ?>
						</footer>
					</section>

					<div class="table-responsive">
					<ul class="list-unstyled mb-0">
				<li class="d-flex">
					<span class="pe-4 small text-muted" data-config-id="num1">01</span>
					<a class="h2 text-decoration-none lh-sm text-primary-dark" href="#" data-config-id="link1">Wanda Hurt</a>
				</li>
				<li class="d-flex mt-6 mt-xl-8">
					<span class="pe-4 small text-muted" data-config-id="num2">02</span>
					<a class="h2 text-decoration-none link-dark" href="#" data-config-id="link2">Jeffrey Helms</a>
				</li>
			</ul>
			<style>
				.mb-n6 {
	margin-bottom: -1.5rem !important;
}
.me-n2 {
	margin-right: -0.5rem !important;
}
.ms-8 {
	margin-left: 2rem !important;
}
			</style>
			<div class="container position-relative">
				<div class="row">
					<div class="position-relative col-lg-5 h-100 mb-16 mb-lg-0">
					<div class="position-absolute top-0 start-0 bottom-0 end-0 ms-8 me-n2 mt-6 mb-n6 bg-primary"></div>
					<img class="position-relative img-fluid h-100" style="object-fit: cover;" src="https://images.unsplash.com/photo-1593062096033-9a26b09da705?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80" alt="" data-config-id="image">
					<div class="position-absolute bottom-0 end-0 d-flex me-3">
						<button class="btn btn-secondary" style="width: 64px; height: 64px;">
						<svg style="width: 12px; height: 9px;" width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-2-4">
					<path d="M1.70711 4H11.5C11.7761 4 12 4.22386 12 4.5C12 4.77614 11.7761 5 11.5 5H1.70711L4.85355 8.14645C5.04882 8.34171 5.04882 8.65829 4.85355 8.85355C4.65829 9.04882 4.34171 9.04882 4.14645 8.85355L0.146447 4.85355C-0.0488155 4.65829 -0.0488155 4.34171 0.146447 4.14645L4.14645 0.146447C4.34171 -0.0488155 4.65829 -0.0488155 4.85355 0.146447C5.04882 0.341709 5.04882 0.658291 4.85355 0.853553L1.70711 4Z" fill="#322C1C"></path>
				</svg>
				</button>
				<button class="btn btn-secondary" style="width: 64px; height: 64px;">
				<svg style="width: 12px; height: 9px;" width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg" data-config-id="auto-svg-3-4">
					<path d="M10.2929 5H0.5C0.223858 5 0 4.77614 0 4.5C0 4.22386 0.223858 4 0.5 4H10.2929L7.14645 0.853553C6.95118 0.658291 6.95118 0.341709 7.14645 0.146447C7.34171 -0.0488155 7.65829 -0.0488155 7.85355 0.146447L11.8536 4.14645C12.0488 4.34171 12.0488 4.65829 11.8536 4.85355L7.85355 8.85355C7.65829 9.04882 7.34171 9.04882 7.14645 8.85355C6.95118 8.65829 6.95118 8.34171 7.14645 8.14645L10.2929 5Z" fill="#322C1C"></path>
				</svg>
				</button>
			</div>
			</div>
			<div class="col-12 col-lg-7 mb-5 mb-lg-0">
			<div class="mt-lg-6">
				<div class="mw-lg-md ms-lg-20">
				<h2 class="mb-5 text-primary" data-config-id="header">Take care of your performance every day.</h2>
				<p class="lead text-muted lh-lg mb-6" data-config-id="desc">Build a well-presented brand that everyone will love. Take care to develop resources continually and integrity them with previous projects.</p>
				<div class="mb-16 mb-lg-24"><a class="btn btn-primary d-block d-md-inline-block mb-2 mb-md-0 mb-lg-0 me-md-4" href="#" data-config-id="hero-primary-action">Track your performance</a><a class="btn btn-dark d-block d-md-inline-block" href="#" data-config-id="hero-secondary-action">Learn More</a></div>
				</div>
				<div class="ms-lg-20">
				<div class="row align-items-center">
					<div class="col-6 col-md-4 col-lg-2 mb-12 mb-lg-0">
					<img class="img-fluid" src="cronos-assets/logos/brands/slack-color.svg" alt="" style="height: 24px" data-config-id="image1">
					</div>
					<div class="col-6 col-md-4 col-lg-2 mb-12 mb-lg-0">
					<img class="img-fluid" src="cronos-assets/logos/brands/dropbox-color.svg" alt="" style="height: 24px" data-config-id="image2">
					</div>
					<div class="col-6 col-md-4 col-lg-2 mb-12 mb-lg-0">
					<img class="img-fluid" src="cronos-assets/logos/brands/spotify-color.svg" alt="" style="height: 24px" data-config-id="image3">
					</div>
					<div class="col-6 col-md-4 col-lg-2">
					<img class="img-fluid" src="cronos-assets/logos/brands/stripe-color.svg" alt="" style="height: 24px" data-config-id="image4">
					</div>
					<div class="col-6 col-md-4 col-lg-2">
					<img class="img-fluid" src="cronos-assets/logos/brands/netflix-color.svg" alt="" style="height: 24px" data-config-id="image5">
					</div>
				</div>
				</div>
			</div>
			</div>
		</div>
		</div>

					<table class="table responsive-card-table">

						<thead>

							<tr>


								<th scope="col">Series Title</th>

								<th scope="col">Series Takeaway</th>

								<th scope="col">Webinar 1</th>

								<th scope="col">Webinar 2</th>

								<th scope="col">Webinar 3</th>

							</tr>

						</thead>

						<tbody>

							<tr class="tropical-blue">

								<td data-label="Series Title">

									<p class="width-200">I. Upgrade Your Life and Elevate Your Profession</p>

								</td>

								<td data-label="Series Takeaway">

									<p class="width-200">Your career will only ever be as great as you are.</p>

								</td>

								<td data-label="Webinar 1">

									<ul>

										<li class="title">Title: Career Stagnation</li>

										<li class="theme">Theme - Propel Career Forward</li>

										<li>Fear</li>

										<li>Indecision</li>

										<li>Goal Setting</li>

										<li>Self-Awareness</li>

									</ul>

								</td>

								<td data-label="Webinar 2">

									<ul>

										<li class="title">Title: Career Dependency</li>

										<li class="theme">Theme - Establish Personal Autonomy</li>

										<li>Career Outcomes</li>

										<li>Self-Identity</li>

										<li>Self-Confidence</li>

										<li>Tools for Self-Autonomy</li>

									</ul>

								</td>

								<td data-label="Webinar 3">

									<ul>

										<li class="title">Title: Career Unfulfillment</li>

										<li class="theme">Theme - Create Career Purpose</li>

										<li>Leadership</li>

										<li>Success</li>

										<li>Failure</li>

										<li>Happiness</li>

										<li>Career Purpose</li>

									</ul>

								</td>

							</tr>

							<tr class="grapefruit-light">

								<td data-label="Series Title">

									<p class="width-200">II. Career Status: Why Your Approach to Work Isn't Working</p>

								</td>

								<td data-label="Series Takeaway">

									<p class="width-200">People miss the profound impact of a career when their goals are to obtain status, money or benefits.</p>

								</td>

								<td data-label="Webinar 1">

									<ul>
										<li class="title">Title: Career Attachment</li>

										<li class="theme">Theme - Why Are You Held Back</li>

										<li>The Motivational Triad</li>

										<li>Job and Self-Identity</li>

										<li>The Job Scavenger Hunt</li>

									</ul>

								</td>

								<td data-label="Webinar 2">

									<ul>
										<li class="title">Title: Becoming Self Aware</li>

										<li class="theme">Theme - Tools for a Happier Life</li>

										<li>Fact or Fiction</li>

										<li>Energetic Framework for Life</li>

										<li>Instruction Guide for Others</li>

									</ul>

								</td>

								<td data-label="Webinar 3">
									<ul>
										<li class="title">Title: Craft Your Future</li>

										<li class="theme">Theme - Optimize Your Work Approach</li>

										<li>Goal Setting</li>

										<li>Failure/Imposter</li>

										<li>Career & Life Purpose</li>

									</ul>

								</td>

							</tr>

							<tr class="gray">

								<td data-label="Series Title"><p class="width-200">III. Defeat Indecision and Enhance Your Self-Confidence</p></td>

								<td data-label="Series Takeaway">

									<p class="width-200">Falling forward and beating obstacles remove barriers from knowing how great you are.</p>

								</td>

								<td data-label="Webinar 1">

									<ul>
										<li class="title">Title: Indecision is the Enemy</li>

										<li class="theme">Theme - Why We Choose Indecision</li>

										<li>Your Brain</li>

										<li>Indecision</li>

										<li>Decision-Making Tools</li>

										<li>Purpose of Goals</li>

									</ul>
								</td>
								<td data-label="Webinar 2">

									<ul>
										<li class="title">Title: Get Comfortable with Discomfort</li>

										<li class="theme">Theme - Nothing is Guaranteed</li>

										<li>Uncertainty</li>

										<li>Vulnerability</li>

										<li>Authenticity</li>

										<li>Self-Sabotage</li>

									</ul>

								</td>

								<td data-label="Webinar 3">

									<ul>

										<li class="title">Title: Upgrade Your Self-Confidence</li>

										<li class="theme" style="font-style:italic">Theme - Your Duty to the World</li>

										<li>Leadership</li>

										<li>Self-Confidence</li>

										<li>Career & Life Purpose</li>

									</ul>

								</td>

							</tr>

						</tbody>

					</table>

					</div>

						<?php the_content(); ?>

						<?php edit_post_link( __( '(Edit)', 'workroom1128' ), '<span class="edit-link">', '</span>' ); ?>

				</div>

				<footer>

					<?php
						wp_link_pages(
							array(
								'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'workroom1128' ),
								'after'  => '</p></nav>',
							)
						);
					?>
					<?php
					$navtags = get_the_tags();
					if ( $navtags ) {
						?>
						<p><?php the_tags(); ?></p>
					<?php } ?>

				</footer>

			</article>

				<?php
			}
			?>





		</main><!-- #content -->

	</div><!-- container full width -->

</div>

<?php
get_footer();
