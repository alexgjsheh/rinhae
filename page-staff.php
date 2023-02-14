<?php
/**
 * The template for displaying the Staff page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rinhae
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<!-- outputting block editor content -->
					<?php the_content(); ?>
				<!-- output Staff category -->
				<?php
				$terms = get_terms( 
					array(
						'taxonomy' => 'rinhae-staff-category',
					) 
				);
				if ( $terms && ! is_wp_error( $terms ) ) {
					foreach ( $terms as $term ) {
						?>
						<h2><?php echo esc_html( $term->name ); ?></h2>
						<!-- output each staff post-->
						<?php
						$args = array(
							'post_type'      => 'rinhae-staff',
							'posts_per_page' => -1,
							'order'          => 'ASC',
							'orderby'        => 'title',
							'tax_query'      => array (
								array (
									'taxonomy' => 'rinhae-staff-category',
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
							),
						);
						
						$query = new WP_Query( $args );
						
						if ( $query -> have_posts() ){
							while ( $query -> have_posts() ) {
								$query -> the_post();
						
								if ( function_exists( 'get_field' ) ) {
									if ( get_field( 'staff_biography' ) ) {
										echo '<h3 id="'. esc_attr( get_the_ID() ) . '">' . esc_html( get_the_title() ) .'</h3>';
										echo '<p>' . the_field( 'courses') . '</p>';
										echo '<p>' . the_field( 'staff_biography') . '</p>';
									}
									if (get_field( 'instructor_website' )) {
										echo '<a href="'. esc_html( get_field( 'instructor_website') ) .'">' .' Instructor Website</a>';
									}
									}
								}
							}
							wp_reset_postdata();
						}
						?>
						<?php
					}
				?>
				</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
