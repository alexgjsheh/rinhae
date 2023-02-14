<?php
/**
 * The template for displaying a single Students post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rinhae
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			 
			$terms = get_the_terms( get_the_ID(), 'rinhae-student-type');
			$post_id = get_the_ID();

			if ( $terms && ! is_wp_error($terms) ) : ?>
				<article>
					<?php foreach ( $terms as $term ) : ?>
						<h2><?php esc_html_e( 'Meet Other ' . $term->name . ' Students', 'rinhae' ); ?></h2>
						<?php
						$args = array(
						'post_type'      => 'rinhae-students',
						'posts_per_page' => -1,
						'order'          => 'ASC',
						'orderby'        => 'title',
						'tax_query'      => array (
							array (
								'taxonomy' => 'rinhae-student-type',
								'field'    => 'name',
								'terms'    => $term->name,
							),
							),
						);
					
						$query = new WP_Query( $args );
						
						if ( $query -> have_posts() ) :
							echo '<nav class="service-links">';
							while ( $query -> have_posts() ) :
								$query -> the_post();
								$thisPostId = get_the_ID();
								if ($thisPostId !== $post_id) {
									echo '<p><a href="'.  esc_html(get_the_permalink()) .'">'. esc_html( get_the_title() ) .'</a></p>';
								}
							endwhile;
						endif;
							wp_reset_postdata();
							echo '</nav>';
						?>

					<?php endforeach; ?>

				</article>
			<?php endif; ?>
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
