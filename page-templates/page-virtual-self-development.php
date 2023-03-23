<?php
/**
 * Template Name: Virtual Self Development Page
 * Template Post Type: page, offer
 * Template for displaying group course page without sidebar even if a sidebar widget is published.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?> 

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">
			<main class="site-main" id="main">
				<?php
				while ( have_posts() ) {
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<h1 class="entry-title entry-mobile-title"><?php the_title(); ?></h1>

						</header>
						<section id="webinar-series" class="offers"> 
							<div class="grid-wrapper webinar-series mt-5">
								<div class="box-1 justify-content-center flex-column align-items-center text-white grid-box-shadow">
									<h2 class="display-5 text-shadow pe-5 ps-5">ENGAGE THROUGH A LIFE SKILLS COURSE</h2>
								</div>
								<div class="box-2 grid-box-shadow img31"></div>
								<div class="box-3 box-3--growth align-items-start flex-column grid-box-shadow ps-2 pe-2">
									<h3 class="pb-2" >Generate self-authority, authenticity, and critical thinking to create a healthy career.</h3>
									<h3>Apply the above outcomes to sustain a robust and meaningful future.</h3>
								</div>
								<div class="box-4 grid-box-shadow img51 justify-content-center align-items-center">
								</div>
								<div class="box-5 align-items-start flex-column justify-content-center grid-box-shadow ps-2 pe-2">
									<h4 class="h5 text-center text-shadow-black ">Themes are flexible and will integrate organization objectives.</h4>
								</div>
								<div class="box-6 grid-box-shadow img30">
									<div class="box-6--presentation"></div>
								</div>
								<div class="box-7 grid-box-shadow img41">
								</div>								
								<div class="box-8 flex-column justify-content-center background-primary grid-box-shadow">
									<img class="width-200 d-none d-sm-none d-md-none d-lg-none d-xl-flex" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="Let's talk about it">
									<h3 class="h2 text-white ps-3 pe-1 text-shadow ">Interested in the virtual self development webinar series?<br>Let's talk about it!</h3>
									<div class="btn-group">
										<a href="#nf-form-11-cont" role="button" class="btn btn btn-outline-light btn-outline-gold m-2 mt-4">I am interested in this webinar series, let&#39;s chat!</a>
									</div>
								</div>
							</div>
						</section>
						<div class="entry-content">
							<div class="course-options-title mt-5">
								<h3>Each Webinar includes a 45-minute presentation; additional time for live Q&A TBD.</h3>
								<p class="mt-2 mb-2" style="text-align:center">Themes are flexible and will integrate organization objectives.</em></p>
							</div>

							<div class="table-responsive">

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
						</div>
						<div id="nf-form-11-cont" class="entry-content mt-5">
							<?php
							the_content();
							workroom1128_link_pages();
							?>
						</div>
						<footer class="entry-footer">
							<!-- edit button which is only visible if logged in -->
							<?php workroom1128_entry_footer(); ?>
						</footer>
						<footer>
							<?php
							wp_link_pages(
								array(
									'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'workroom1128' ),
									'after'  => '</p></nav>',
								),
							);
							?>
						</footer>
					</article>
					<?php
				}
				?>
			</main><!-- #content -->

		</div><!-- container full width -->
	</div>

</div>

<?php
get_footer();
