<?php ?>
<div class="photo-story">
	<section class="landing">
		<h1 class="story-title">
			<?php the_title(); ?>
		</h1>

		<hr />

		<p class="story-narrative">
			<?php the_content(); ?>
		</p>
	</section>

	<section class="story-gallery">

		<?php

			$meta = get_post_meta($post->ID, 'story_photos_meta_box_gallery', true);
			$meta_html = null;
			if ($meta) {
					// $meta_html .= '<ul class="galleryList">';
					$meta_array = explode(',', $meta);
					$num_of_photos = sizeof($meta_array);
					$i = 0;
					$extra = floor($num_of_photos/3);

					foreach ($meta_array as $meta_gall_item) {
						$col_length = floor($num_of_photos/3);
						if($extra > 0) {
							$col_length += 1;
						}

						if($i == 0 || $i % $col_length == 0) {
							?>
								<ul>
							<?php
						}
						?>
						
							<li>
								<div class="photoContainer">
									<img id="<?php echo esc_attr($meta_gall_item); ?>" src="<?php echo wp_get_attachment_url($meta_gall_item); ?>">
									<div class="hoverEffect"><div /></div>
								</div>
							</li>

						<?php

						if($i % $col_length == $col_length - 1) {
							?>
								</ul>
							<?php
							
							$extra--;
							$i = -1;
						}

						$i++;
					}
			}

		?>

	</section>

</div><!-- /.blog-post -->