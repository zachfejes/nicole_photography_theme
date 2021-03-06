<?php 
	$meta = get_post_meta($post->ID, 'story_photos_meta_box_gallery', true);
	$meta_html = null;
	$num_of_photos = 0;

	if ($meta) {
		$meta_array = explode(',', $meta);
		$num_of_photos = sizeof($meta_array);
		$i = 0;
		$n = 1;
		$extra = floor($num_of_photos/3);
	}
?>

<div class="photo-story">

	<script>
		GalleryLoader.initialize(<?php echo $num_of_photos; ?>, "#story-gallery");
	</script>

	<section class="landing">
		<h1 class="story-title">
			<?php the_title(); ?>
		</h1>

		<hr />

		<p class="story-narrative">
			<?php the_content(); ?>
		</p>
	</section>

	<section id="story-gallery" class="story-gallery clearfix loading">

		<div class="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></div>

		<?php

			if ($meta) {
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
								<img 
									id="<?php echo esc_attr($meta_gall_item); ?>" 
									src="<?php echo wp_get_attachment_url($meta_gall_item); ?>"
									onclick="openModal();currentSlide(<?php echo $n; ?>)"
									onLoad="GalleryLoader.setLoadedByIndex(true, <?php echo $n - 1; ?>);"
									onError="GalleryLoader.setLoadedByIndex(true, <?php echo $n - 1; ?>);"
								>
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
					$n++;
				}
			}

		?>

	</section>

	<div id="myModal" class="modal">
		<button class="close cursor" onclick="closeModal()"><i class="fa fa-times"></i></button>
		<div class="modal-content">

			<?php
				$i = 1;
				foreach ($meta_array as $meta_gall_item) {
					?>
						<div class="mySlides">
							<div class="numbertext"><?php echo $i.'/'.$num_of_photos; ?></div>
							<img src="<?php echo wp_get_attachment_url($meta_gall_item); ?>">
						</div>
					<?php
					$i++;
				}
			?>

			<!-- Next/previous controls -->
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>

			<!-- Caption text -->

			<div class="caption-container">
				<p id="caption"></p>
			</div>

		</div>
	</div>

</div><!-- /.blog-post -->