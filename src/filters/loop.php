<?php
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
add_filter('excerpt_more', 'gb_excerpt_more');


/**
 * Get posts filtered
 *
 * @since 1.0
 */
function gb_get_posts($params = array())
{
	$posts_per_page = (isset($params['posts_per_page'])) ? $params['posts_per_page'] : '10';
	$offset = (isset($params['offset'])) ? $params['offset'] : '';

	$sliderPosts = new WP_Query(
		array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => 'ASC',
			'posts_per_page' => $posts_per_page,
			'offset' => $offset
			)
		);
	return $sliderPosts;
}

/**
 * Get the title from the loop
 *
 * @since 1.0
 */
function gb_get_loop_title()
{
	$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

	if (is_category()) : $title = __( 'Categoria' , 'gb' ) . ' : ' . single_cat_title( '', false );
	elseif (is_tag()) : $title = __( 'Etiqueta' , 'gb' ) . ' : ' . single_tag_title( '', false);
	elseif (is_month()) : $title = __( 'Archivos Mensuales' , 'gb' ) . ' : ' . get_the_date('F Y');
	elseif (is_year()) : $title = __( 'Archivos Anuales' , 'gb' ). ' : ' . get_the_date('Y');
	elseif (is_search()) : $title = __( 'Buscar resultados de' , 'gb' ) . ' : ' . get_search_query();
	elseif (is_author()) : $title = __( 'Autor de Archivos', 'gb' ) . ' : ' . $curauth->display_name;
	elseif (is_archive()) : $title = __( 'Archivo' , 'gb' );
	endif;
	
	return $title;
}
?>