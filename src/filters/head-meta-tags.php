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
?>