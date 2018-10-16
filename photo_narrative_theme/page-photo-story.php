<?php /* Template Name: Photo Stories */ ?>
<?php get_header(); ?>

	<div class="row">
		<div class="col-sm-12">

			<?php 
				$args =  array( 
					'post_type' => 'photo-story',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$custom_query = new WP_Query( $args );
            	while ($custom_query->have_posts()) : $custom_query->the_post(); 
					$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

				<div class="blog-post">
					<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

					<?php if ( has_post_thumbnail() ) {?>
						<div class="row">
							<div class="col-md-4">
								<?php	the_post_thumbnail('thumbnail'); ?>
							</div>
							<div class="col-md-6">
								<?php the_excerpt(); ?>
							</div>
						</div>
						<?php } else { ?>
						<?php the_excerpt(); ?>
					<?php } ?>

				</div><!-- /.blog-post -->

				<?php endwhile; ?>
		</div> <!-- /.col -->
	</div> <!-- /.row -->

	<?php get_footer(); ?>