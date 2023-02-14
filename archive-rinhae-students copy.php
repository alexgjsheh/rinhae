<?php
/**
 * The template for displaying Students archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rinhae
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$terms = get_terms(
				array(
					'taxonomy' => 'rinhae-student-type'
				)
			);

			if($terms && ! is_wp_error($terms) ){
				foreach($terms as $term){
					$args = array(
						'post_type'      => 'rinhae-students',
						'posts_per_page' => -1,
						'order'          => 'ASC',
						'orderby'        => 'title',
						'tax_query'      => array(
							array(
								'taxonomy' => 'rinhae-student-type',
								'field'    => 'slug',
								'terms'    => $term->slug,
							)
						),
					);
			 
			$query = new WP_Query( $args );
			 
			if ( $query -> have_posts() ){
				while ( $query -> have_posts() ) {
					$query -> the_post();
			?>
				<h2><?php the_title();?></h2> <?php
					the_post_thumbnail();
					the_excerpt(); ?>
					<a href="<?php echo get_term_link( $term ); ?>"><?php echo esc_html( $term->name ); ?></a>
				<?php
				}
				wp_reset_postdata();
				}
			}
			}
			?>
			

	</main><!-- #main -->

<?php
get_footer();
