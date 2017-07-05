<?php
/**
 * Operation cleanup!
 * Let's make this shit looks as anything but a wordpress theme
 *
 * @since gb 1.0
 */
function gb_cleanup()
{
	/**
	 * Remove all head links
	 */
	add_action('init', 'gb_remove_headlinks');
	/**
	 * Remove injected CSS for recent comments widget
	 */
	add_filter('wp_head', 'gb_remove_wp_widget_recent_comments_style', 1);
	/**
	 * Clean up comment styles in the head
	 */
	add_action('wp_head', 'gb_remove_recent_comments_style', 1);
	/**
	 * Clean up gallery output in wp
	 */
	add_filter('gallery_style', 'gb_gallery_style');
	/**
	 * My own personal excerpt
	 */
	add_filter('excerpt_more', 'gb_excerpt_more');
	/**
	 * Remove WordPress version
	 */
	add_action('init', 'gb_remove_wp_version');
	/**
	 * Hide admin bar please!
	 */
	add_action('init', 'gb_hide_admin_bar');
}
add_action( 'after_setup_theme', 'gb_cleanup', 3);

/**
 * Function to remove head links
 *
 * @since gb 1.0
 */
function gb_remove_headlinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'adjacent_posts_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
}

/**
 * Remove injected CSS for recent comments widget
 *
 * @since gb 1.0
 */
function gb_remove_wp_widget_recent_comments_style()
{
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

/**
 * Clean up comment styles in the head
 *
 * @since gb 1.0
 *
 * @global $wp_widget_factory
 */
function gb_remove_recent_comments_style()
{
	global $wp_widget_factory;

	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

/**
 * Remove injected CSS from gallery
 *
 * @since gb 1.0
 *
 * @param $css string
 * @return string
 */
function gb_gallery_style($css)
{
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * This removes the annoying […] to a Read More link
 *
 * @since gb 1.0
 *
 * @param string $more
 * @return string
 */
function gb_excerpt_more($more)
{
	return '<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Más', 'gb') . get_the_title($post->ID).'">'. __('... Saber más &raquo;', 'gb') .'</a>';
}

/**
 * Remove WordPress version
 *
 * @since 1.0
 */
function gb_remove_wp_version()
{
	remove_action('wp_head', 'wp_generator');
	add_filter('the_generator', '__return_false');
}

/**
 * REMOVE THE ADMIN BAR :)
 *
 * @since gb 1.0
 */
function gb_hide_admin_bar()
{
	add_filter('show_admin_bar', '__return_false');
}
?>