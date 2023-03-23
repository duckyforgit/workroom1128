<?php
/**
 * The template for displaying single offer life skills group course offer
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
						<section id="single-course" class="offers">
							<div style="position:relative; width:100%; height:50px">
							</div>
							<div class="grid-wrapper single-course">
								<div class="box-1 justify-content-center flex-column align-items-center text-white grid-box-shadow">
										<h2 class="display-5 text-shadow pe-5 ps-5">ENGAGE THROUGH A LIFE SKILLS SELF-DEVELOPMENT COURSE</h2>
									</div>
									<div class="box-2 grid-box-shadow img31"></div>
									<div class="box-3 box-3--growth align-items-start flex-column grid-box-shadow ps-2 pe-2">
										<ul class="fa-ul">
											<li><span class="fa-li primary-color"><i class="fa-solid fa-user-check"></i></span>Generate self-authority, authenticity, and critical thinking to create a healthy career.</li>
											<li><span class="fa-li primary-color"><i class="fa-solid fa-user-check"></i></span>Apply the above outcomes to sustain a robust and meaningful future.</li>
										</ul>
									</div>								
								</div>
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
						<div class="entry-content">
							<div class="course-options-title mt-3">
								<p class="mt-2 mb-2" style="text-align:center">*Deliberate Doing Original Course: <em>Overcoming Career Constraints - What College Doesn't Teach You"</em></p>
							</div>

							<table class="course-options pb-5" role="table">
								<thead role="rowgroup">
									<tr role="row">
										<th role="columnheader">Options</th>
										<th role="columnheader">Delivery</th>
										<th role="columnheader">Platform Host</th>
										<th role="columnheader">Course Timeline</th>
										<th role="columnheader" colspan="2">Course Schedule</th>
										<th role="columnheader">Capacity</th>
									</tr>
								</thead>
								<tbody role="rowgroup">
									<tr role="row">
										<td class="first" role="col">1</td>
										<td role="col">Live, Includes Q&A Discussion</td>
										<td role="col">Per Organizational Requirements (Zoom, MS Teams, etc.)</td>
										<td role="col">Each module to occur on 3 separate days during the same week, i.e., M-W-F, etc.</td>
										<td role="col" colspan="2">Days 1, 2 and 3 within the same week:<br>Module 1 @ 4 hrs<br>Module 2 @ 4 hrs<br>Module 3 @ 4 hrs</td>
										<td role="col" rowspan="2">25 Max<br>Smaller class sizes promote integrity and intimate discussion.</td>
									</tr>
									<tr role="row">
										<td class="first" role="col">2</td>
										<td role="col">Live, Includes Q&A Discussion</td>
										<td role="col">Per Organizational Requirements (Zoom, MS Teams, etc.)</td>
										<td role="col">Each module to occur in 3 separate weeks, i.e., three Fridays in a row.</td>
										<td role="col" colspan="2">Day 1, Week 1 - Module 1 @4hrs<br>Day 2, Week 2 - Module 2 @4hrs<br>Day 3, Week 3 - Module 3 @4hrs</td>
									</tr>
									<tr role="row">
										<td role="col">3</td>
										<td role="col">Lecture Replays and PDF Worksheets</td>
										<td role="col">TBD</td>
										<td role="col">12 separate lectures to be recorded and delivered (appx. 30 min/ea) for a self-paced program</td>
										<td role="col" colspan="2">Self-paced</td>
										<td role="col">Total rewatch time requires approximately 6 hours.<br>Total time for self-paced worksheets requires approximately 6 hours.</td>
									</tr>
									<tfoot role="rowgroup">
										<tr role="row">
										<td class="footnote" colspan="7">*All information is preliminary and subject to change.</td>
										</tr>
									</tfoot>
								</tbody>
							</table>

							<div class="mobile">
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Options</div>
									<div class="col-sm-9 col-md-8" >1</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Delivery</div>
									<div class="col-sm-9 col-md-8" >Live, Includes Q&A Discussion</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Platform Host</div>
									<div class="col-sm-9 col-md-8" >Per Organizational Requirements (Zoom, MS Teams, etc.)
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Timeline</div>
									<div class="col-sm-9 col-md-8" >Each module to occur on 3 separate days during the same week, i.e., M-W-F, etc.</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Schedule</div>
									<div class="col-sm-9 col-md-8" >Days 1,2 and 3 with the same week:<br>Module 1 @ 4 hrs<br>Module 2 @ 4 hrs<br>Module 3 @ 4 hrs</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Capacity</div>
									<div class="col-sm-9 col-md-8" >25 Max<br>Smaller class sizes promote integrity and intimate discussion.</div>
								</div>

								<div class="row mt-3">
									<div class="col-sm-3 col-md-4 mobile-title" >Options</div>
									<div class="col-sm-9 col-md-8" >2</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Delivery</div>
									<div class="col-sm-9 col-md-8" >Live, Includes Q&A Discussion</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Platform Host</div>
									<div class="col-sm-9 col-md-8" >Per Organizational Requirements (Zoom, MS Teams, etc.)</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Timeline</div>
									<div class="col-sm-9 col-md-8" >Each module to occur in 3 separate weeks, i.e., three Fridays in a row.</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Schedule</div>
									<div class="col-sm-9 col-md-8" >Day 1, Week 1 - Module 1 @4hrs<br>Day 2, Week 2 - Module 2 @4hrs<br>Day 3, Week 3 - Module 3 @4hrs</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Capacity</div>
									<div class="col-sm-9 col-md-8" >25 Max<br>Smaller class sizes promote integrity and intimate discussion.</div>
								</div>

								<div class="row mt-3">
									<div class="col-sm-3 col-md-4 mobile-title" >Options</div>
									<div class="col-sm-9 col-md-8" >3</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Delivery</div>
									<div class="col-sm-9 col-md-8" >Lecture Replays and PDF Worksheets</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Platform Host</div>
									<div class="col-sm-9 col-md-8" >TBD</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Timeline</div>
									<div class="col-sm-9 col-md-8" >12 separate lectures to be recorded and delivered (appx. 30 mins/ea) for a self-paced program.</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Course Schedule</div>
									<div class="col-sm-9 col-md-8" >Self-paced</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-md-4 mobile-title" >Capacity</div>
									<div class="col-sm-9 col-md-8" >Total rewatch time requires appoximately 6 hours.<br>Total time for self-paced worksheets requires approximately 6 hours.</div>
								</div>
							</div>

							<div class="container">
								<div class="row mt-5" style="justify-content:center">
									<div class="col-sm-12 col-lg-6" >
										<div class="button-wrapper__left text-center">
											<button role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lifeSkillsModal">I am interested in this life skills course, let's chat!</button>
										</div>
									</div>
								</div>
							</div>
						</div>
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

				<div class="modal" id="lifeSkillsModal" tabindex="-1" aria-labelledby="lifeSkillsModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo do_shortcode( '[ninja_form id=6]' ); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</main><!-- #content -->

		</div><!-- container full width -->
	</div>

</div>

<?php
get_footer();
