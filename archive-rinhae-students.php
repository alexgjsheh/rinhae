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
				post_type_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

			$args = array(
                'post_type'      => 'rinhae-students',
                'posts_per_page' => -1,
				'order'          => 'ASC',
				'orderby'        => 'title',
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
				echo '<section class="student-archive-container">';
                while( $query->have_posts() ) :
                    $query->the_post(); 
					$the_post_id = get_the_ID();
					$article_terms = wp_get_post_terms( $the_post_id, 'rinhae-student-type');

                    ?>
                    <article>
                        <h2><?php the_title();?></h2> <?php
						the_post_thumbnail();
						the_excerpt(); 
						foreach ($article_terms as $term) :
							?>
							<p>Specialty: <a href="<?php echo esc_url(get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a> </p>
						<?php
						endforeach;
						?>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
                echo '</section>';
            endif; 
			?>
			

	</main><!-- #main -->

<?php
get_footer();
