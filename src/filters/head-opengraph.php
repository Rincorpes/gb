<?php
/**
 * Add Open graph and twitter meta tags.
 *
 * @since 1.0
 */
function gb_opengrapf()
{
	echo '<meta property="og:title" content="' . gb_get_title() . '"/>';
	echo '<meta property="og:type" content="' . gb_get_page_type() . '"/>';
	echo '<meta property="og:url" content="' . get_site_url() . '"/>';
	echo '<meta property="og:image" content = "' . gb_get_page_image() . '"/>';
	echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>';
	echo '<meta property="og:description" content="' . gb_get_page_description() . '"/>';
	echo '<meta property="og:locale" content="es_LA"/>';
	//echo '<meta property="fb:admins" content="ID de facebook admin"/>';
	//echo '<meta property="fb:app_id" content="ID de la aplicacion en facebook"/>';
}
add_action('wp_head', 'gb_opengrapf', 10);
?>