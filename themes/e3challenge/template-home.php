<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage E3_Challenge
 * @since E3_Challenge 1.0
 */

get_header(); ?>

<div id="primary" class="content-area fullwidth">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<div class="entry-content">
				<div class="hero">
					<div class="background"></div>
					<?php
					the_content();
					?>
				</div>

				<div class="featured-event">
					<img src="/wp-content/uploads/2016/10/e3_challenge_hero.jpg" />
					<div class="content">
						<h3>September 29, 2016</h3>
						<h2>Real Rock Star Awards Gala</h2>
						<p>
							Back for its fourth year, the 2016 Real Rock Star Awards #RRSA will bring together local and national musicians to honor Youth on Record’s most resilient and talented students in a one-of-a-kind red carpet event for a new generation. The evening includes amazing music and performances, dinner, drinks, and the unique opportunity to be part of this fabulous event!
						</p>
						<a class="button" href="#">Learn More</a>
					</div>
				</div>

				<div class="upcoming-events">
					<h2 class="section-header">Upcoming Events</h2>
					<div class="events">
						<?php
						/**
						 * Query for events, ordered by date starting with oldest events.
						 */
							$args = [
								'post_type'      => 'event',
								'posts_per_page' => -1,
								'meta_key'       => '_e3_date',
								'orderby'        => 'meta_value_num',
								'order'          => 'ASC',
							];

							$query = new WP_Query( $args );
							while ( $query->have_posts() ) {
								$query->the_post();
								$date = E3_Challenge::get_field( 'date' );
								?>
								<div class="event">
									<div class="img-wrap">
										<?php the_post_thumbnail( 'event-thumb' ); ?>
									</div>

									<div class="date">
										<span class="month"><?php echo esc_html( date( 'M', $date ) ); ?></span>
										<span class="day"><?php echo esc_html( date( 'j', $date ) ); ?></span>
									</div>

									<h3 class="time">
										<?php echo esc_html( E3_Challenge::get_field( 'start_time' ) ); ?> - <?php echo esc_html( E3_Challenge::get_field( 'end_time' ) ); ?>
									</h3>

									<h2><?php the_title(); ?></h2>

									<a href="<?php the_permalink(); ?>">Learn More</a>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->
		<?php
		endwhile;
		// End of the loop.
		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
