<?php
/**
 * Register scripts and stylesheets
 *
 * @since gb 1.0
 */
function gb_site_scripts()
{
	/**
	 * Deregister wp jquery script so we can add the version we want
	 */
	wp_deregister_script('jquery');

	/**
	 * Adding scripts file in the footer
	 *
	 * jQuery
	 */
	wp_register_script('jquery',  get_template_directory_uri() . '/assets/js/lib/jquery-3.1.0.min.js', array(), '3.1.0', true);
	wp_enqueue_script('jquery');
	/**
	 * Bootstrap script
	 */
	wp_register_script('bootstrap',  get_template_directory_uri() . '/assets/js/lib/bootstrap.min.js', array(), '3.1.0', true);
	wp_enqueue_script('bootstrap');
	/**
	 * Ganemosbits script
	 */
	wp_register_script('gb',  get_template_directory_uri() . '/assets/js/gb.js', array(), '1.0.0', true);
	wp_enqueue_script('gb');
	/**
	 * HTML5shiv. Needed to make work bootstrap in ie
	 * This script uses an HTML conditional. It will appear only on ie lower than 9
	 */
	wp_enqueue_style('HTML5shiv', get_theme_file_uri( '/assets/js/HTML5shiv.js' ), array(), '3.6.2');
	wp_style_add_data('HTML5shiv', 'conditional', 'lt IE 9');

	/**
	 * Adding styles to the head
	 *
	 * Bootstrap style
	 */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.1.0','all');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '3.1.0','all');
	/**
	 * Base Style
	 */
	wp_enqueue_style('base-style', get_template_directory_uri() . '/style.css', array(), VBTWP_VERSION,'all');
} /* end site scripts */
add_action('wp_enqueue_scripts', 'gb_site_scripts', 999);
?>