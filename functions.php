<?php
/**
 * All gb functions and utilities
 * Do not edit this content unless you know what you're doing.
 *
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gb
 */

/**
 * Disallow facebook and twitter widgets, disallow social buttons
 * widgets, disallow ads and use third party scrips in local
 *
 * This is usefull in local when you don't have a good internet
 * conection.
 *
 * @since 1.0
 */
define('EXTERNAL_SCRIPTS', false);

/**
 * Version
 *
 * @since 1.1.0
 */
define('GB_VERSION', '1.1.12');

/**
 * Allow cdn
 *
 * @since 1.1
 */
define('CDN', false);

/**
 * IE support
 *
 * @since 1.1
 */
define('IE_SUPPORT', true);

/**
 * Get function file located in the functions directory
 *
 * @since gb 1.0
 * 
 * @param string $file_name Name of the function file without extention
 * @return string
 */
function gb_get_function_path($file_name)
{
	return get_template_directory() . '/src/' . $file_name . '.php';
}

/**
 * gb only works in WordPress 4.7 or later.
 * 
 * @since gb 1.0
 *
 * @global string $wp_version WordPress version.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
	require gb_get_function_path('setup/back-compat');
	return;
}

/**
 * Set the maximum allowed width for any content in the theme,
 * like oEmbeds and images added to posts.
 * 
 * Priority 0 to make it available to lower priority callbacks.
 * 
 * @since gb 1.0
 * 
 * @global int $content_width
 */
function gb_content_width() {

	$content_width = 760;

	/**
	 * Filter gb content width of the theme.
	 *
	 * @since gb 1.0
	 *
	 * @param $content_width int
	 */
	$GLOBALS['content_width'] = apply_filters('gb_content_width', $content_width);
}
add_action('after_setup_theme', 'gb_content_width', 0);

/**
 * Make gb theme available for translation
 * Translations can be filed in the /languages/ directory
 * 
 * @since gb 1.0
 */
add_action('after_setup_theme', function(){
	load_theme_textdomain('gb', get_template_directory() . '/languages');
});

/**
 * <html> tag with ie support
 *
 * @since 1.1
 */
function gb_html_tag($attr = array())
{
	$id = (isset($attr['id'])) ? 'id="' . $attr['id'] . '"' : '';

	echo '
	<!--[if lt IE 7 ]> <html' . $id . ' lang="' . $attr['lang'] .'" class="' . $attr['class'] .' ie6"> <![endif]-->
	<!--[if IE 7 ]> <html' . $id . ' lang="' . $attr['lang'] .'" class="' . $attr['class'] .' ie7"> <![endif]-->
	<!--[if IE 8 ]> <html' . $id . ' lang="' . $attr['lang'] .'" class="' . $attr['class'] .' ie8"> <![endif]-->
	<!--[if IE 9 ]> <html' . $id . ' lang="' . $attr['lang'] .'" class="' . $attr['class'] .' ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html' . $id . ' lang="' . $attr['lang'] .'" class="' . $attr['class'] .'"> <!--<![endif]-->
	';
}

/**
 * Get page title
 *
 * @since 1.1.0
 */
function gb_get_title()
{
	global $page, $paged; 

	$title = wp_title( '|', false, 'right' ); 
	$title .= get_bloginfo( 'name' );

	if (is_home() || is_front_page())
		$title .= " | Bitcoin para todos"; 
	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Página %s', 'gb' ), max( $paged, $page ) );

	return $title;
}

/**
 * Get page type for opengraph
 *
 * @since 1.1.0
 */
function gb_get_page_type()
{
	$type = 'website';

	if (is_single()) $type = 'article';

	return $type;
}

/**
 * Get image for opengraph and twitter cards
 *
 * @since 1.1.0
 */
function gb_get_page_image()
{
	$image = '';

	if (is_single()) {
		global $post;

		$thumbID = get_post_thumbnail_id($post->ID);
		$image = wp_get_attachment_url($thumbID);
	} else {
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id , 'full');

		$image = $image[0];
	}

	return $image;
}

/**
 * Get page description
 *
 * @since 1.1.0
 */
function gb_get_page_description()
{
	$description = '';
	$site_description = get_bloginfo( 'description', 'display' );

	if (is_home() || is_front_page() || is_page())
		$description = $site_description;

	if (is_single()) {
		$page_id = get_queried_object_id();
		$excerpt = wp_trim_words(get_the_excerpt($page_id));

		if($excerpt != '')
			$description = esc_attr($excerpt);
	}

	if(is_category()) {

		$cat_id = get_queried_object_id();
		$description = wp_trim_words(wp_strip_all_tags(strip_shortcodes(category_description($cat_id))));

		if($description != '')
			$description = esc_attr($description);
	}

	return $description;
}

/**
 * Get Scripts params
 *
 * @since 1.1
 */
function gb_get_script($script, $index = null, $cdn = CDN)
{
	$local_jquery_uri = get_template_directory_uri() . '/assets/js/lib/jquery-3.1.0.min.js';
	$cdn_jquery_uri = 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js';

	$local_bootstrap_uri = get_template_directory_uri() . '/assets/js/lib/bootstrap.min.js';
	$cdn_bootstrap_uri = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js';

	$local_html5shiv_uri = get_theme_file_uri('/assets/js/HTML5shiv.js');
	$cdn_html5shiv_uri = 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js';

	$scripts = [
		'jquery' => [
			'uri' => ($cdn) ? $cdn_jquery_uri : $local_jquery_uri,
			'version' => '3.2.1',
		],
		'bootstrap' => [
			'uri' => ($cdn) ? $cdn_bootstrap_uri : $local_bootstrap_uri,
			'version' => '3.3.7',
		],
		'html5shiv' => [
			'uri' => ($cdn) ? $cdn_html5shiv_uri : $local_html5shiv_uri,
			'version' => '3.7.3',
		],
		'gb' => [
			'uri' => get_template_directory_uri() . '/assets/js/gb.js',
			'version' => GB_VERSION,
		],
	];

	if ($index)
		return $scripts[$script][$index];
	else
		return $scripts[$script];
}

/**
 * Get Styles params
 *
 * @since 1.1
 */
function gb_get_styles($style, $index = null, $cdn = CDN)
{
	$local_bootstrap_uri = get_template_directory_uri() . '/assets/css/bootstrap.min.css';
	$cdn_bootstrap_uri = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';

	$local_fa_uri = get_template_directory_uri() . '/assets/css/font-awesome.css';
	$cdn_fa_uri = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';

	$styles = [
		'bootstrap' => [
			'uri' => ($cdn) ? $cdn_bootstrap_uri : $local_bootstrap_uri,
			'version' => '3.3.7',
		],
		'fa' => [
			'uri' => ($cdn) ? $cdn_fa_uri : $local_fa_uri,
			'version' => '4.7.0',
		],
		'base' => [
			'uri' => get_template_directory_uri() . '/style.css',
			'version' => GB_VERSION,
		],
	];

	if ($index)
		return $styles[$style][$index];
	else
		return $styles[$style];
}

/**
 * Require external functions from the functions dir. In this case "src/"
 */

/**
 * Add theme support
 */
require_once gb_get_function_path('setup/theme-support');

/**
 * WordPress Head and other clean options
 */
require_once gb_get_function_path('setup/cleanup');

/**
 * Add meta tags to the head
 */
require_once gb_get_function_path('filters/head-meta-tags');

/**
 * Add opengrph meta tags to the head
 */
require_once gb_get_function_path('filters/head-opengraph');

/**
 * Add opengrph meta tags to the head
 */
require_once gb_get_function_path('filters/head-twitter-card');

/**
 * Register scripts and stylesheets
 */
require_once gb_get_function_path('scripts/enqueue-scripts');

/**
 * Load Google analytics function
 */
require_once gb_get_function_path('scripts/analytics');

/**
 * Load facebook function
 */
require_once gb_get_function_path('scripts/facebook');

/**
 * Load adSense function
 */
require_once gb_get_function_path('scripts/adsense');

/**
 * Load WordPress menus
 */
require_once gb_get_function_path('filters/menus');

/**
 * Load search form widget
 */
require_once gb_get_function_path('filters/searchform');

/**
 * Load Ads
 */
require_once gb_get_function_path('ads');

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
/**
 * Shows the paginate links
 *
 * @since 1.0
 */
if (!function_exists('gb_paginate_links')) : 
	function gb_paginate_links()
	{
	
		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
		$pagination = array(
			'base' => @add_query_arg('paged','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => true,
			'type' => 'list'
		);
	
		if( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
		if( !empty($wp_query->query_vars['s']) )
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	
		echo paginate_links( $pagination );
	}
endif;

/**
 * Shows comments
 *
 * @since 1.0
 */
if (!function_exists('gb_comments')) : 
	function gb_comments($comment, $args, $depth)
	{	
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$GLOBALS['comment'] = $comment;
				extract($args, EXTR_SKIP);
		?>
		<li class="media" id="comment-<?php comment_ID() ?>">

		    <div class="pull-left">
		      <div class="media-object">
		      	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		      </div>
		    </div>
			    
			    
			<div class="media-body">
		      <h4 class="media-heading"><?php echo get_comment_author_link(); ?></h4>

			  <div class="content">

				<?php if ($comment->comment_approved == '0') : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
				<?php endif; ?>

				<?php comment_text() ?>

				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>

				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __('%1$s a las %2$s'), get_comment_date(),  get_comment_time()) ?></a>
						<?php edit_comment_link(__('(Editar)'),'  ','' );
					?>
				</div>


			  </div>
		 
		    </div>

		</li>
		<?php
	}
endif;

/**
 * Subscribe form action
 *
 * @since 1.0
 */
function gb_subscribe()
{
	$apiKey = '19181c8755c60914bbdea2b7da939bb0-us15';
	$listId = '4999099b3b';

	$data['status'] = 'pending';
	$data['email'] = $_POST['email'];
	$data['name'] = (! empty($_POST['name'])) ? $_POST['name'] : '';

	$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	$memberId = md5(strtolower($data['email']));
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;
	$json = json_encode([
		'apykey' => $apiKey,
		'email_address' => $data['email'],
		'status' => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
	]);

	if (! empty($data['name'])) $json['merge_fields'] = array('FNAME' => $data['name']);

	$auth = base64_encode( 'user:' . $apiKey );

	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Content-Length: ' . $auth;

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array($headers));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	$result = curl_exec($ch);
	//$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$curlInfo = curl_getinfo($ch);

	curl_close($ch);

	echo json_encode($result, true);
	wp_die();
}
add_action('wp_ajax_gb_subscribe', 'gb_subscribe');
add_action('wp_ajax_nopriv_gb_subscribe', 'gb_subscribe');

function gb_main_heading()
{
	if (is_home() || is_front_page()) :
	?>
		<h1 class="text-hide pull-left hidden-xs">
			<?php echo the_custom_logo(); ?>
			<?php bloginfo('name'); ?>
		</h1>
	<?php
	else :
	?>
		<span class="h1 pull-left hidden-xs">
			<?php echo the_custom_logo(); ?>
		</span>
	<?php
	endif;
}
?>