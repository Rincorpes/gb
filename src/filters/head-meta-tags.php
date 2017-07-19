<?php
/**
 * Add the initial meta tags.
 *
 * @since 1.0
 */
function gb_meta_tags()
{
	echo '<meta charset="UTF-8">';
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
}
add_action('wp_head', 'gb_meta_tags', 0);

/**
 * Add description metatag
 *
 * @since 1.1.0
 */
function gb_description_meta_tag()
{
	echo '<meta name="description" content="' . gb_get_page_description() . '" />';
}
add_action('wp_head', 'gb_description_meta_tag', 10);
?>