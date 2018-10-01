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
									<div class="darkLayer"></div>
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
											class="slideButton <?php if($i == 0) { echo "active"; } ?>"
											onClick="HomePageCarousel.currentIndex(<?php echo $i; ?>);"
										>
										</button>

									<?php
								}
							?>
						</div>
					</div>
				</section>

				<section class="about">
					<div class="news">
						<p>Nicole is currently waiting for Zach to finish her website.</p>
					</div>
					<div class="aboutPhoto">
						<img src="" alt="This should be a photo of Nicole" />
					</div>
					<div class="blurb">
						<p>This is some text that makes up a blurb about Nicole!</p>
					</div>
				</section>

				<section class="recent">

					<h2>Recent Stories</h2>

					<hr />

					<ul>
						<?php
							$args =  array( 
								'numberposts' => '5',
								'post_type' => 'photo-story',
							);
							$custom_query = new WP_Query( $args );
							$slideIndex = 0;
							while ($custom_query->have_posts()) : $custom_query->the_post(); 
						?>

								<li>
									<img src="" alt="" />
									<div class="titles">
										<p></p>
										<a></a>
									</div>
								</li>

						<?php
								$slideIndex++;
							endwhile;
							wp_reset_query();
						?>
					</ul>
				</section>
			</div>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

	<?php get_footer(); ?>