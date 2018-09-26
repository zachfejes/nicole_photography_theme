<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

	<div class="row">
		<div class="col-sm-12 noPadding">

			<div class="home">

				<section class="landing">
					<div class="carousel">
						<ul>

						<?php 
							$args =  array( 
								'numberposts' => '5',
								'post_type' => 'photo-story',
							);
							$custom_query = new WP_Query( $args );
							while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

								<li>
									<?php 
										$img_args = array(
											'class' => 'carouselImage', 
											'title' => $post->post_title,
											'alt' => $post->post_title
										);
										the_post_thumbnail('full', $img_args); 
									?>
									<div class="titles">
										<p><?php echo $post->post_title; ?></p>
										<a href="<?php echo get_permalink($post->ID); ?>">Read Story</a>
									</div>
								</li>

							<?php
							endwhile;
							wp_reset_query();
							?>
						</ul>
					</div>
				</section>
			</div>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

	<?php get_footer(); ?>