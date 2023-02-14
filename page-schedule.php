<?php
/**
 * The template for displaying the Schedule page.
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

			get_template_part( 'template-parts/content', 'page' );
			?>
			<div>
				<?php
				if ( have_rows( 'weekly_schedule' )):?>
					<table>
						<caption>
						<?php
						$myArray = get_field_object( 'weekly_schedule');
						echo $myArray['label'];
						?>
						</caption>
						<thead>
							<tr>
								<th>
									<?php
									$myArray = get_sub_field_object( 'date');
									echo $myArray['label'];
									?>
								</th>
								<th>
									<?php
									$myArray = get_sub_field_object( 'course');
									echo $myArray['label'];
									?>
								</th>
								<th>
									<?php
									$myArray = get_sub_field_object( 'instructor');
									echo $myArray['label'];
									?>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while ( have_rows( 'weekly_schedule' )) : the_row(); ?>
							<tr>
								<td><?php echo get_sub_field( 'date' ); ?></td>
								<td><?php echo get_sub_field( 'course' ); ?></td>
								<td><?php echo get_sub_field( 'instructor' ); ?></td>
							</tr>
							<?php
							endwhile;
							?>
						</tbody>
					</table>
					<?php
				endif;
				?>
			</div>
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
