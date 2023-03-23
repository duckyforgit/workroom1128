<?php
/**
 * The template for displaying all single offer spekaing for your professional organization offer posts
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
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="container"> 
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header> <!-- .entry-header --> 
					</div> 
					<!-- ======= The Grid Speaking to Your Organization Section ======= -->
					<section id="speaking" class="offers">  
						<div style="position:relative; width:100%; height:50px"></div>
						<div class="grid-wrapper speaking">
							<div class="box-1 background-purple flex-column align-items-center text-white background-purple box-shadow grid-padding">
								<h2 class="display-3 text-shadow pe-5 ps-5">ENGAGE YOUR GROUP</h2>
							</div>
							<div class="box-2 img2-1">
							</div>
							<div class="box-3 grid-box-shadow img1"> 
							</div>
							<div class="box-4 align-items-center background-white grid-item--height4 grid-box-shadow">
								<h4 class="h3 text-shadow-black ps-5 pe-5">In addition to tailored coaching, I customize GROUP SPEAKING engagements.</h4>
							</div>
							<div class="box-5 grid-box-shadow background-purple">
							</div>
							<!-- <div class="box-6 background-white grid-box-shadow">6
							</div> -->
							<div class="box-6 grid-box-shadow img3">
							</div>
							<div class="box-7 background-brown grid-box-shadow"> 
							</div>
							<div class="box-8 flex-column align-items-center ps-1 pe-1 grid-box-shadow"> 
								<h2 class="text-shadow-black">FORTY-FIVE MINUTE PRESENTATIONS</h2>
								<h3 class="text-shadow-black text-center">Length and content can be adjusted to meet audience needs. If you have a special request, let’s talk about it!</h3>
							</div>
							<div class="box-9 background-purple grid-box-shadow">
							</div>
							<div class="box-10 background-purple grid-box-shadow"></div>
							<!-- <div class="box-11 background-brown grid-box-shadow">11 
							</div> -->
							<div class="box-12 flex-column background-purple grid-box-shadow">
								<img class="width-200 d-none d-sm-none d-md-none d-lg-none d-xl-flex" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="Let's talk about it">
								<h3 class="h2 text-white ps-3 pe-1 text-shadow ">Interested in a group speaking engagement? Let's talk about it!</h3>
								<a href="#request"  role="button" data-bs-toggle="button" class="btn btn-primary ms-2 me-2 mb-0 text-white">REQUEST MORE INFO</a>
							</div>
							<div class="box-13 img5">
							</div>
							<div class="box-14 align-items-center background-white grid-box-shadow">
								<h3 class="h2 text-center ps-3 pe-3">My core messages, listed below,<br>are the most popular from 2021. </h3>
							</div>
							<div class="box-15 background-purple">15</div> 
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
				</article><!-- #post-## --> 
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
