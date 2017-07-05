<?php
/**
 * This function in the hook after_theme_setup action
 * If you don't know what you're doing, please don't chage any of this.
 *
 * @since gb 1.0
 */
function gb_theme_support()
{
	/**
	 * RSS support.
	 */
	add_theme_support('automatic-feed-links');

	/**
	 * Let WordPress manage the document title.
	 *
	 * @see https://codex.wordpress.org/Title_Tag
	 */
	add_theme_support('title-tag');

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 *
	 * @see https://codex.wordpress.org/Theme_Markup
	 */
	add_theme_support('html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			)
		);

	/**
	 * Enable support for Post Formats.
	 *
	 * @see http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
			)
		);

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * `thumbnail` Thumbnail (default 150px x 150px max)
	 * `medium` Medium resolution (default 300px x 300px max)
	 * `large` Large resolution (default 640px x 640px max)
	 * `full` Original image resolution (unmodified)
	 * the_post_thumbnail(array(100,100)); Other resolutions
	 *
	 * @see https://codex.wordpress.org/Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Default thumbnail size
	 * 125 pixels wide by 125 pixels tall, crop mode
	 */
	set_post_thumbnail_size(125, 125, true);

	/**
	 * Enable support for custom Logo
	 *
	 * @example To get the image src:
	 * 
	 * $custom_logo_id = get_theme_mod( 'custom_logo' );
	 * $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	 * echo $image[0];
	 *
	 * @see https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo',
		array(
			'height' => 50,
			'width' => 300,
			'flex-height' => true,
			'flex-width' => true,
			'header-text' => array('site-title', 'site-description')
			)
		);
} 
add_action('after_setup_theme', 'gb_theme_support', 2);
?>