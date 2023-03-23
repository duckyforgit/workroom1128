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
						<section id="group-course" class="offers"> 
							<div class="grid-wrapper group-course mt-5">
								<div class="box-1 flex-column align-items-center text-white box-shadow grid-padding">
									<h2 class="display-3 text-shadow pe-5 ps-5 ">ENGAGE THROUGH A LIFE SKILLS GROUP COURSE</h2>
								</div>
								<div class="box-2 grid-box-shadow">2</div>
								<div class="box-3 img42">								 
								</div>								 
								<div class="box-4 grid-box-shadow">
									<h4 class="h5 text-shadow-black line-height-15" >This course was designed to help students and professionals build a solid internal foundation (including but not limited to upgrading their self-awareness, interpersonal skills, emotional intelligence, decision-making, etc.) which translates to a solid external career.</h4>
								</div>
								<div class="box-5 align-items-stretch flex-column grid-box-shadow ps-5 pe-5">
								</div>
								<div class="box-6 img34"></div>
								<div class="box-7 img33 grid-box-shadow"> 7
								</div>
								<div class="box-8a"></div>
								<div class="box-8 align-items-stretch flex-column grid-box-shadow ps-5 pe-5">
									<div class="d-flex flex-row align-items-center justify-content-start pb-2 pt-4">
										<h3 class="text-center"><span style="font-weight:600">Professional</span> growth comes from <span style="font-weight:600">personal</span> growth.</h3>
									</div>
								</div> 
								<div class="box-9">									
									<div class="boxx h d-flex flex-column align-items-center justify-content-center grid-box-shadow ps-sm-1 ps-md-2"> 
										<!--<h1 style="color:#000">box 9 h</h1>-->
										<div class="d-flex flex-row justify-content-center">
											<img class="icon me-2 width-50" width="50" height="50" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/icons/noun-happy-1147409-F55C20.svg' ); ?>" alt="">
											<h3 class="h2 text-shadow-black pe-2">Happy employees are productive employees!</h3>
										</div>
										<h4 class="h5">Empower and enable your employees to create a healthy life and a robust career!</h4>
									</div>
									<div class="boxx i grid-box-shadow img30">
									</div>
									<div class="boxx j grid-box-shadow img31">9j
									</div>
								</div>
								<div class="box-10 d-flex flex-column justify-content-center background-primary grid-box-shadow">
									<img class="width-200 d-none d-sm-none d-md-none d-lg-none d-xl-flex" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="Let's talk about it">
									<h3 class="h2 text-white ps-md-3 pe-md-1 pt-2 text-center text-shadow">Interested in this group course?<br>Let's talk about it!</h3>
									<button type="button" class="btn btn-outline-light mt-2" data-bs-toggle="modal" data-bs-target="#groupCourseModal" aria-controls="consultation" aria-haspopup="true" tabindex="0">I am interested in this group course, let&#39;s chat!</button>								
								</div>						
							</div>
							<div class="entry-content mt-5">							
								<?php
								the_content();
								workroom1128_link_pages();
								?>
							</div>
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
										<div class="button-wrapper d-flex justify-content-center">
											<button role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#groupCourseModal">I am interested in this group course, let's chat!</button>
										</div>
									</div>
								</div>
							</div>
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

				<div class="modal" id="groupCourseModal" tabindex="-1" aria-labelledby="groupCourseModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo do_shortcode( '[ninja_form id=13]' ); ?>
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
