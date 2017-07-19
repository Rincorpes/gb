<?php
/**
 * Add Twitter meta tags.
 *
 * @since 1.1.0
 */
function gb_twitter_card()
{
	echo '<meta name="twitter:card" content="summary">';
	echo '<meta name="twitter:site" content="@ganemosbits">';
	echo '<meta name="twitter:creator" content="@rincorpes">';
	echo '<meta name="twitter:image" content="' . gb_get_page_image() . '">';
	echo '<meta name="twitter:title" content="' . gb_get_title() . '">';
	echo '<meta name="twitter:description" content="' . gb_get_page_description() . '">';
}
add_action('wp_head', 'gb_twitter_card', 10);
?>