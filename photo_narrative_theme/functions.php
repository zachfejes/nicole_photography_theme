<?php

// Add scripts and stylesheets
function photo_narrative_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css', array() );
	wp_enqueue_style( 'photoStory', get_template_directory_uri() . '/css/photoStory.css', array() );
	wp_enqueue_style( 'header', get_template_directory_uri() . '/css/header.css', array() );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
	wp_enqueue_script( 'headerScrollControl', get_template_directory_uri() . '/js/headerScrollControl.js', array() );
	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array() );
}
add_action( 'wp_enqueue_scripts', 'photo_narrative_scripts' );

function admin_photo_narrative_style() {
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
    wp_enqueue_style('photoStoryAdmin', get_template_directory_uri() . '/css/photoStoryAdmin.css');
}
add_action('admin_enqueue_scripts', 'admin_photo_narrative_style');

// Add Google Fonts
function photo_narrative_google_fonts() {
	wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
	wp_register_style('Cinzel', 'https://fonts.googleapis.com/css?family=Cinzel');
	wp_register_style('QuattrocentoSans', 'https://fonts.googleapis.com/css?family=Quattrocento+Sans');
	wp_enqueue_style( 'OpenSans');
	wp_enqueue_style( 'Cinzel' );
	wp_enqueue_style( 'QuattrocentoSans' );
}
add_action('wp_print_styles', 'photo_narrative_google_fonts');

// WordPress Titles
add_theme_support( 'title-tag' );

// Custom settings
function custom_settings_add_menu() {
	add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
	<div class="wrap">
	  <h1>Custom Settings</h1>
	  <form method="post" action="options.php">
		 <?php
			 settings_fields( 'section' );
			 do_settings_sections( 'theme-options' );      
			 submit_button(); 
		 ?>          
	  </form>
	</div>
  <?php }

  // Twitter
function setting_twitter() { ?>
	<input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function setting_instagram() { ?>
	<input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>" />
<?php }

function setting_facebook() { ?>
	<input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

function custom_settings_page_setup() {
	add_settings_section( 'section', 'All Settings', null, 'theme-options' );
	add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
	add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
	add_settings_field( 'instagram', 'Instagram URL', 'setting_instagram', 'theme-options', 'section' );
  
	register_setting('section', 'twitter');
	register_setting('section', 'facebook');
	register_setting('section', 'instagram');
}
add_action( 'admin_init', 'custom_settings_page_setup' );

// Support Featured Images
add_theme_support( 'post-thumbnails' );



// custom post
function create_post_photo_story() {
	register_post_type( 'photo-story',
			array(
			'labels' => array(
					'name' => __( 'Photo Stories' ),
					'singular_name' => __( 'Photo Story' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
			),
			'taxonomies' => array(
				'post_tag',
				'category',
			)
	));
	register_taxonomy_for_object_type( 'category', 'photo-story' );
	register_taxonomy_for_object_type( 'post_tag', 'photo-story' );
}
add_action( 'init', 'create_post_photo_story' );


/*
function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'photo-story', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
	global $post;  
		$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->

	<p>
		<label for="your_fields[text]">Input Text</label>
		<br>
		<input type="text" name="your_fields[text]" id="your_fields[text]" class="regular-text" value="<?php echo $meta['text']; ?>">
	</p>

	<p>
		<label for="your_fields[textarea]">Textarea</label>
		<br>
		<textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
	</p>

	<p>
		<label for="your_fields[checkbox]">Checkbox
			<input type="checkbox" name="your_fields[checkbox]" value="checkbox" <?php if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; ?>>
		</label>
	</p>

	<p>
		<label for="your_fields[select]">Select Menu</label>
		<br>
		<select name="your_fields[select]" id="your_fields[select]">
				<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
				<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
		</select>
	</p>

	<p>
		<label for="your_fields[image]">Image Upload</label><br>
		<input type="text" name="your_fields[image]" id="your_fields[image]" class="meta-image regular-text" value="<?php echo $meta['image']; ?>">
		<input type="button" class="button image-upload" value="Browse">
	</p>
	<div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>

	<script>
		jQuery(document).ready(function ($) {
		// Instantiates the variable that holds the media library frame.
		var meta_image_frame;
		// Runs when the image button is clicked.
		$('.image-upload').click(function (e) {
			// Get preview pane
			var meta_image_preview = $(this).parent().parent().children('.image-preview');
			// Prevents the default action from occuring.
			e.preventDefault();
			var meta_image = $(this).parent().children('.meta-image');
			// If the frame already exists, re-open it.
			if (meta_image_frame) {
			meta_image_frame.open();
			return;
			}
			// Sets up the media library frame
			meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: {
				text: meta_image.button
			}
			});
			// Runs when an image is selected.
			meta_image_frame.on('select', function () {
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			meta_image.val(media_attachment.url);
			meta_image_preview.children('img').attr('src', media_attachment.url);
			});
			// Opens the media library frame.
			meta_image_frame.open();
		});
		});
  	</script>

	<!-- End of fields -->

	<?php }

function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'your_fields', true );
	$new = $_POST['your_fields'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'your_fields', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'your_fields', $old );
	}
}
add_action( 'save_post', 'save_your_fields_meta' );
*/


function add_story_photos_meta_box() {
	add_meta_box(
		'story_photos_meta_box', // $id
		'Story Photos', // $title
		'show_story_photos_meta_box', // $callback
		'photo-story', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_story_photos_meta_box' );

// Field Array
$prefix = 'story_photos_meta_box_';
$custom_meta_fields = array(
    array(
        'label'=> 'Story Image Gallery',
        'desc'  => 'This is the gallery of images on the story page.',
        'id'    => $prefix.'gallery',
        'type'  => 'gallery'
    ),
);

function show_story_photos_meta_box($object) {
	global $custom_meta_fields, $post; 

	// $meta = get_post_meta( $post->ID, 'story_photos', true ); ?>

	<input type="hidden" name="story_photos_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

	<table class="form-table photoStoryAdminTable">
		<tbody>
		<?php
			foreach($custom_meta_fields as $field) {
				// get value of this field if it exists for this post
				$meta = get_post_meta($post->ID, $field['id'], true);
		?>
				<tr>
					<th>
						<?php
							echo '<input id="story_photos_meta_box_gallery" type="hidden" name="story_photos_meta_box_gallery" value="' . esc_attr($meta) . '" />
							<div class="shift8_gallery_button_container"><input id="story_photos_meta_box_gallery_button" type="button" value="Add Gallery" /></div>';
						?>
					</th>
					<td>
						<?php

							$meta_html = null;
							if ($meta) {
									$meta_html .= '<ul class="galleryList">';
									$meta_array = explode(',', $meta);
									foreach ($meta_array as $meta_gall_item) {
											$meta_html .= '<li><div class="story_photos_meta_box_gallery_container"><span class="story_photos_meta_box_gallery_close"><img id="' . esc_attr($meta_gall_item) . '" src="' . wp_get_attachment_thumb_url($meta_gall_item) . '"></span></div></li>';
									}
									$meta_html .= '</ul>';
							}
							echo '<span id="story_photos_meta_box_gallery_src">' . $meta_html . '</span>';
						?>
					</td>
				</tr>
		<?php
			}
		?>
		</tbody>
	</table>

	<script>
		var meta_gallery_frame;
        // Runs when the image button is clicked.
        jQuery('#story_photos_meta_box_gallery_button').click(function(e){

                //Attachment.sizes.thumbnail.url/ Prevents the default action from occuring.
                e.preventDefault();

                // If the frame already exists, re-open it.
                if ( meta_gallery_frame ) {
                        meta_gallery_frame.open();
                        return;
                }

                // Sets up the media library frame
                meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
                        title: story_photos_meta_box_gallery.title,
                        button: { text:  story_photos_meta_box_gallery.button },
                        library: { type: 'image' },
                        multiple: true
                });

                // Create Featured Gallery state. This is essentially the Gallery state, but selection behavior is altered.
                meta_gallery_frame.states.add([
                        new wp.media.controller.Library({
                                id:         'story_photos_meta_box_gallery',
                                title:      'Select Images for Gallery',
                                priority:   20,
                                toolbar:    'main-gallery',
                                filterable: 'uploaded',
                                library:    wp.media.query( meta_gallery_frame.options.library ),
                                multiple:   meta_gallery_frame.options.multiple ? 'reset' : false,
                                editable:   true,
                                allowLocalEdits: true,
                                displaySettings: true,
                                displayUserSettings: true
                        }),
                ]);

                meta_gallery_frame.on('open', function() {
                        var selection = meta_gallery_frame.state().get('selection');
                        var library = meta_gallery_frame.state('gallery-edit').get('library');
                        var ids = jQuery('#story_photos_meta_box_gallery').val();
                        if (ids) {
                                idsArray = ids.split(',');
                                idsArray.forEach(function(id) {
                                        attachment = wp.media.attachment(id);
                                        attachment.fetch();
                                        selection.add( attachment ? [ attachment ] : [] );
                                });
                     }
                });

                meta_gallery_frame.on('ready', function() {
                        jQuery( '.media-modal' ).addClass( 'no-sidebar' );
                });

                // When an image is selected, run a callback.
                //meta_gallery_frame.on('update', function() {
                meta_gallery_frame.on('select', function() {
                        var imageIDArray = [];
                        var imageHTML = '';
                        var metadataString = '';
                        images = meta_gallery_frame.state().get('selection');
                        imageHTML += '<ul class="galleryList">';
                        images.each(function(attachment) {
                                imageIDArray.push(attachment.attributes.id);
                                imageHTML += '<li><div class="story_photos_meta_box_gallery_container"><span class="story_photos_meta_box_gallery_close"><img id="'+attachment.attributes.id+'" src="'+attachment.attributes.sizes.thumbnail.url+'"></span></div></li>';
                        });
                        imageHTML += '</ul>';
                        metadataString = imageIDArray.join(",");
                        if (metadataString) {
                                jQuery("#story_photos_meta_box_gallery").val(metadataString);
                                jQuery("#story_photos_meta_box_gallery_src").html(imageHTML);
                                setTimeout(function(){
                                        ajaxUpdateTempMetaData();
                                },0);
                        }
                });

                // Finally, open the modal
                meta_gallery_frame.open();

		});
		
		jQuery(document.body).on('click', '.story_photos_meta_box_gallery_close', function(event){

			event.preventDefault();

			if (confirm('Are you sure you want to remove this image?')) {

					var removedImage = jQuery(this).children('img').attr('id');
					var oldGallery = jQuery("#story_photos_meta_box_gallery").val();
					var newGallery = oldGallery.replace(','+removedImage,'').replace(removedImage+',','').replace(removedImage,'');
					jQuery(this).parents().eq(1).remove();
					jQuery("#story_photos_meta_box_gallery").val(newGallery);
			}

		});
  	</script>

	<?php 
}

function save_story_photos_meta_box( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['story_photos_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'story_photos_meta_box_gallery', true );
	$new = $_POST['story_photos_meta_box_gallery'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'story_photos_meta_box_gallery', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'story_photos_meta_box_gallery', $old );
	}
}
add_action( 'save_post', 'save_story_photos_meta_box' );