<?php
/**
 * Add basic meta tags at the begining of the header.
 *
 * @since 1.0
 */
function gb_add_metatags()
{
	echo '<meta charset="UTF-8">';
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
}
add_action('wp_head', 'gb_add_metatags', 0);

function gb_opengrapf()
{
	global $page, $paged; 

	$title = wp_title( '|', false, 'right' ); 
	$title .= get_bloginfo( 'name' );

	if (is_home() || is_front_page())
		$title .= " | Bitcoin para todos"; 
	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Página %s', 'gb' ), max( $paged, $page ) );

	$type = 'website';
	if (is_single()) $type = 'article';

	$image = '';
	if (is_single()) {
		global $post;
	$thumbID = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_url( $thumbID );
	} else {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		$image = $image[0];
	}

	$description = '';
	$site_description = get_bloginfo( 'description', 'display' );

	if (is_home() || is_front_page() || is_page()) {
		$description = $site_description;
	}

	if (is_single()) {
		$page_id = get_queried_object_id();
		$excerpt = wp_trim_words( get_the_excerpt( $page_id ) );

		if( $excerpt != '' )
			$description = esc_attr( $excerpt );
	}

	if( is_category() ) {

		$cat_id = get_queried_object_id();
		$description = wp_trim_words( wp_strip_all_tags( strip_shortcodes( category_description( $cat_id ) ) ) );

		if( $description != '' )
			$description = esc_attr( $description );
	}

	echo '<meta name="description" content="' . $description . '" />';
	echo '<meta property="og:title" content="' . $title . '"/>';
	echo '<meta property="og:type" content="' . $type . '"/>';
	echo '<meta property="og:url" content="' . get_site_url() . '"/>';
	echo '<meta property="og:image" content = "' . $image . '"/>';
	echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>';
	echo '<meta property="og:description" content="' . $description . '"/>';
	echo '<meta property="og:locale" content="es_LA"/>';
	//echo '<meta property="fb:admins" content="ID de facebook admin"/>';
	//echo '<meta property="fb:app_id" content="ID de la aplicacion en facebook"/>';
	echo '<meta name="twitter:card" content="summary">';
	echo '<meta name="twitter:site" content="@ganemosbits">';
	echo '<meta name="twitter:creator" content="@rincorpes">';
	echo '<meta name="twitter:image" content="' . $image . '">';
	echo '<meta name="twitter:title" content="' . $title . '">';
	echo '<meta name="twitter:description" content="' . $description . '">';
}
add_action('wp_head', 'gb_opengrapf', 10);
?>