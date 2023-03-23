<?php
/**
 * Template Name: Offer Alt Page
 *
 * @package workroom1128
 * https://www.youtube.com/channel/UC3Ho_r7DD58Cz3fb47vbxxg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="wrapper" id="single-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">
			<main class="site-main" id="main">
			<?php
			while ( have_posts() ) {
				the_post();
				?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="container">
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header> <!-- .entry-header -->
					</div>
					<div class="container container-images">
						<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 250, "gutter": 10, "isFitWidth":true }'>
						<div class="grid">
							<div class="grid-item grid-item--height grid-item--width2 d-flex justify-content-center flex-column align-items-center ps-5 pe-5 text-white background-purple box-shadow">
								<h2 class="display-3 text-shadow">ENGAGE YOUR GROUP</h2>
							</div>
							<div class="grid-item grid-item--width2  special" >
								<div class="row row-cols-2 gx-2">
									<div class="col">
										<div class="img2-1 box-shadow" >
										</div>
									</div>
									<div class="col">
										<div class="img2-2 box-shadow" >
										</div>
									</div>
								</div>
							</div>  <div class="grid-item background-brown d-flex align-items-center"></div>
							<div class="grid-item d-flex align-items-center"> </div>
							<div class="grid-item grid-item--width2 grid-item--height3 img1 box-shadow">
							</div>
							<div class="grid-item grid-item--width2 background-white d-flex align-items-center box-shadow">
								<h4 class="h3 ps-5 pe-5">In addition to tailored coaching, I customize GROUP SPEAKING engagements.</h4>
							</div>
							<div class="grid-item background-purple box-shadow"></div>
<!-- use one grid item adn 2 columsn -->
							<div class="grid-item grid-item--width2 special" >
								<div class="row row-cols-2 gx-2">
									<div class="col background-purple box-shadow" style="height:245px; width:250px">

									</div>
									<div class="col background-white" style="height:245px; width:250px">

									</div>
								</div>
							</div>

							<div class="grid-item grid-item--width2 img3 box-shadow"></div>
							<div class="grid-item background-brown box-shadow"></div>
							<div class="grid-item grid-item--width2 background-white d-flex align-items-center justify-content-center flex-column box-shadow">
								<h2 class="text-center p-3 text-shadow-black">FORTY-FIVE MINUTE PRESENTATIONS</h2><h3 class="ps-1 pb-1 ps-md-4">Length and content can be adjusted to meet audience needs. If you have a special request, let’s talk about it!</h3>
							</div>
							<div class="grid-item d-flex align-items-center background-purple box-shadow"></div>
							<div class="grid-item grid-item--height5 d-flex flex-column justify-content-center background-purple box-shadow" >
							<img class="grid-item--img" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="" >
								<h3 class="h2 text-white ps-3 pe-1">If you have a special request, let&#39s talk about it!</h3>
								<a href="#request" class="btn btn-primary ms-2 me-2 mb-0 text-white">REQUEST MORE INFO</a>
							</div>
							<div class="grid-item grid-item--height2 grid-item--width3 img5"></div>
							<div class="grid-item grid-item--width3 d-flex justify-content-center align-items-center background-white box-shadow" ><h3 class="h2 text-center ps-3 pe-3">My core messages, listed below,<br>are the most popular from 2021. </h3></div>
							</div>
							<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 250, "gutter": 10, "isFitWidth":true }'>
								<div class="grid-item img6 message-listing"></div>
								<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
									<h2 class="h3 ps-4 pe-2">Career Purpose: When Work Isn't Working for You</h2>
									<h3 class="h6 pt-4 ps-4 pe-5">Established engineering professionals anticipate a fulfilling career and a rewarding future. Much to your dismay, sometimes career outcomes disappoint, and work satisfaction seems more like a pipe dream. Worse, your desperate attempts to solve this dilemma fall short.</h3>
									<h3 class="h6 ps-4 pe-3">Learn the reasons behind career unfulfillment, what your career purpose looks like, and how to adjust your approach accordingly.</h3>
								</div>
							<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
								<h2 class="h3 ps-4 pe-2">Career Attachment: Blending Self & Work Identity</h2>
								<h3 class="h6 pt-4 ps-4 pe-5">You might believe overworking proves your worthiness to your employer, especially during the pandemic. As you become attached to your employment, it becomes more difficult to draw personal boundaries, despite knowing it is the right thing. You will learn the unintended consequences of career attachment and what it takes to set healthy boundaries.</h3>
							</div>
							<div class="grid-item img7 message-listing"></div>

							<div class="grid-item img8 message-listing"></div>
							<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
								<h2 class="h3 ps-4 pe-2">Career Path: What is My Right Career Path?</h2>
								<h3 class="h6 pt-4 ps-4 pe-5">Too many people waste precious time and remain stuck in a futile attempt to determine the ‘right’ career path. It’s no wonder they cannot find an answer to this close-minded question; it’s not the right question to be asking! It assumes there is one right and many wrong answers. This presentation will open the mind to newfound possibilities as it offers flexible questions to ignite one’s career.</h3>
							</div>
							<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
								<h2 class="h3 ps-4 pe-2">Career Stagnation and Indecision</h2>
								<h3 class="h6 pt-4 ps-4 pe-5">All of us are prone to the “what am I doing with my life” syndrome. Perhaps you are distressed by too many enticing options. If chronic indecision plagues you, the result includes wasted time and negative career momentum. Strengthen your decision-making abilities and confidently create forward movement in your career.</h3>
							</div>
							<div class="grid-item img9 message-listing"></div>
							<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
								<h2 class="h3 ps-4 pe-2">Self-Confidence and People-Pleasing</h2>
								<h3 class="h6 pt-4 ps-4 pe-5">Do you obey authority and please others too much? At the heart of people-pleasing lies the question, “what will they think of me?” This self-confidence drill will expose how your confidence is lacking and why. You will explore the meaning of self-confidence, why it’s critical to your wellbeing, and how you can work towards building more.</h3>
							</div>
							<div class="grid-item img10 message-listing"></div>
							<div class="grid-item grid-item--width3 grid-item--transparent d-flex flex-column justify-content-center message-listing">
								<h2 class="h3 ps-4 pe-2">Work Relationships: When Others Disappoint</h2>
								<h3 class="h6 pt-4 ps-4 pe-5">Let’s face it, bad bosses are real and unremarkable colleagues exist. At some point, you may have to work for or work with people who are not the most reliable. There is a saying that “people don’t leave jobs, they leave bosses.” Find out how to address poor leadership, indolent colleagues, or toxic work environments. Learn whether it is worth leaving the situation to seek a better outcome elsewhere, and how you can work towards building more.</h3>
							</div>
							<div class="grid-item img11 message-listing"></div>
						</div>
					</div>
					<div class="container">
							<div class="grid">
							<div class="grid-sizer"></div>
							<div class="grid-item grid-item--width2 grid-item--height background-purple d-flex justify-content-center flex-column align-items-center  text-white background-purple box-shadow grid-padding">
								<h2 class="display-3 text-shadow pe-5 ps-5">ENGAGE YOUR GROUP</h2>
							</div>

							<div class="grid-item grid-item--width2 grid-48 grid-item--height no-background position-relative grid-padding">
								<div class="row row-cols-2">
									<div class="col pe-2 col-image-1">
										<div class="img2-1 box-shadow grid-item--height" >
										</div>
									</div>
									<div class="col col-image-2">
										<div class="img2-2 box-shadow grid-item--height" >
										</div>
									</div>
								</div>
							</div>

							<div class="grid-item grid-item--width2 grid-item--height3">
								<div class="img1 box-shadow  grid-item--height3"></div>
							</div>
							<div class="grid-item grid-item--width2 grid-item--height4 grid-padding ">
								<div class="d-flex justify-content-center align-items-center background-white box-shadow grid-item--height4 ">
									<h4 class="h3 ps-5 pe-5">In addition to tailored coaching, I customize GROUP SPEAKING engagements.</h4>
								</div>
							</div>
							<div class="grid-item grid-item--width grid-item--height grid-padding">
								<div class="grid-item--height background-purple ">2</div>
							</div>
							<div class="grid-item grid-item grid-item--width2 grid-item--height">
								<div class="img3 box-shadow  grid-item--height">3</div>
							</div>
							<!-- <div class="grid-item grid-item--width grid-item--height  background-brown">4</div> -->
							<div class="grid-item grid-item--width2 grid-item--height background-white d-flex align-items-center justify-content-center flex-column box-shadow">
								<h2 class="text-center p-3 text-shadow-black">FORTY-FIVE MINUTE PRESENTATIONS</h2>
								<h3 class="ps-1 pb-1 ps-md-4">Length and content can be adjusted to meet audience needs. If you have a special request, let’s talk about it!</h3>
							</div>
							<div class="grid-item grid-item--width grid-item--height   background-purple">5
							</div>
							<div class="grid-item grid-item--width grid-item--height5 d-flex flex-column justify-content-center background-purple box-shadow">
								<img class="grid-item--img" src="http://localhost/deliberatedoing/wp-content/themes/workroom11285/dist/img/noun-talk-1471159-FFFFFF.png" width="200" alt="">
								<h3 class="h2 text-white ps-3 pe-1">If you have a special request, let's talk about it!</h3>
								<a href="#request" class="btn btn-primary ms-2 me-2 mb-0 text-white">REQUEST MORE INFO</a>
							</div>
							<div class="grid-item grid-item--height2 grid-item--width3 img5 mb-0">
							</div>
							<div class="grid-item grid-item--width3 grid-item--height d-flex justify-content-center align-items-center background-white box-shadow mb-0">
								<h3 class="h2 text-center ps-3 pe-3">My core messages, listed below,<br>are the most popular from 2021. </h3>
							</div>
						</div><!--end of grid -->
						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

						<div id="request" class="entry-content mt-5">
							<?php
							the_content();
							workroom1128_link_pages();
							?>
						</div><!-- .entry-content -->
						<footer class="entry-footer">
							<?php workroom1128_entry_footer(); ?>
						</footer><!-- .entry-footer -->
					</div>
				</article><!-- #post-## -->
					<!-- ======= The Experience Section ======= -->
					<section id="experience" class="experience">
						<!-- <div class="container" data-aos="fade-up"> -->
						<div class="container">
							<style>



							</style>
							<h1>Isotope - layout modes</h1>


<div class="grid">
<div class="grid-sizer"></div>
	<div class="grid-item grid-item--width2 grid-item--height background-purple">1</div>

	<div class="grid-item grid-item--width2 grid-item--height no-background position-relative">
		<div class="row row-cols-2 gx-2">

			<div class="col    ">
				<div class="img2-1 box-shadow grid-item--height" >
				</div>
			</div>
			<div class="col    ">
				<div class="img2-2 box-shadow grid-item--height" >
				</div>
			</div>
		</div>
	</div>

	<div class="grid-item grid-item--width2 grid-item--height3">
	<div class="img1 box-shadow  grid-item--height3" >
			</div>
	</div>
	<div class="grid-item grid-item--width2 grid-item--height d-flex justify-content-center align-items-center background-white box-shadow">
	<h4 class="h3 ps-5 pe-5">In addition to tailored coaching, I customize GROUP SPEAKING engagements.</h4>
	</div>
	<div class="grid-item grid-item--width grid-item--height background-purple ">5</div>
	<div class="grid-item grid-item grid-item--width2 grid-item--height">
		<div class="img3 box-shadow  grid-item--height">
			</div>
	</div>
	<div class="grid-item grid-item--width grid-item--height background-brown">7</div>
	<div class="grid-item grid-item--width2 grid-item--height background-white d-flex align-items-center justify-content-center flex-column box-shadow">
		<h2 class="text-center p-3 text-shadow-black">FORTY-FIVE MINUTE PRESENTATIONS</h2><h3 class="ps-1 pb-1 ps-md-4">Length and content can be adjusted to meet audience needs. If you have a special request, let’s talk about it!</h3>
	</div>
	<div class="grid-item grid-item--width grid-item--height background-purple">9</div>
	<div class="grid-item grid-item--width grid-item--height5 d-flex flex-column justify-content-center background-purple box-shadow">
		<img class="grid-item--img" src="http://localhost/deliberatedoing/wp-content/themes/workroom11285/dist/img/noun-talk-1471159-FFFFFF.png" width="200" alt="">
		<h3 class="h2 text-white ps-3 pe-1">If you have a special request, let's talk about it!</h3>
		<a href="#request" class="btn btn-primary ms-2 me-2 mb-0 text-white">REQUEST MORE INFO</a>
	</div>
	<div class="grid-item grid-item--height2 grid-item--width3 img5">11</div>
	<div class="grid-item grid-item--width3 grid-item--height d-flex justify-content-center align-items-center background-white box-shadow">
	<h3 class="h2 text-center ps-3 pe-3">My core messages, listed below,<br>are the most popular from 2021. </h3>
	</div>

</div>
						</div>
					</section>
				<?php
				workroom1128_post_nav();
			}
			?>
			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #single-wrapper -->
<?php
get_footer();
