<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

<script>
	HomePageCarousel.querySelector("#carousel-list");
	<?php
		$story_array = get_posts( array('numberposts' => '5', 'post_type' => 'photo-story') );
		$num_of_stories = sizeof($story_array);
	?>
	HomePageCarousel.length(<?php echo $num_of_stories; ?>);
</script>

	<div class="row">
		<div class="col-sm-12 noPadding">

			<div class="home">

				<section class="landing">
					<div id="carousel" class="carousel">
						<ul id="carousel-list" class="slide0">

						<?php 
							$args =  array( 
								'numberposts' => '5',
								'post_type' => 'photo-story',
							);
							$custom_query = new WP_Query( $args );
							$slideIndex = 0;
							while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

								<li key="<?php echo $slideIndex; ?>">
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
								$slideIndex++;
							endwhile;
							wp_reset_query();
							?>
						</ul>
						<div class="dotButtons">
							<?php
								for($i = 0; $i < $num_of_stories; $i++) {
									?>

										<button 
											id="slideButton<?php echo $i; ?>"
											class="slideButton"
											onClick="HomePageCarousel.currentIndex(<?php echo $i; ?>);"
										>
										</button>

									<?php
								}
							?>
						</div>
					</div>
				</section>

				<section class="buttonSection">
					<button onClick="HomePageCarousel.prevSlide();">Prev</button>
					<button onClick="HomePageCarousel.nextSlide();">Next</button>
				</section>
			</div>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

	<?php get_footer(); ?>