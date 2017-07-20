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
	wp_register_script('jquery',  gb_get_script('jquery', 'uri'), array(), gb_get_script('jquery', 'version'), true);
	wp_enqueue_script('jquery');
	/**
	 * Bootstrap script
	 */
	wp_register_script('bootstrap',  gb_get_script('bootstrap', 'uri'), array(), gb_get_script('bootstrap', 'version'), true);
	wp_enqueue_script('bootstrap');
	/**
	 * Ganemosbits script
	 */
	wp_register_script('gb',  gb_get_script('gb', 'uri'), array(), gb_get_script('gb', 'version'), true);
	wp_enqueue_script('gb');
	/**
	 * HTML5shiv. Needed to make work bootstrap in ie
	 * This script uses an HTML conditional. It will appear only on ie lower than 9
	 */
	wp_enqueue_style('html5shiv', gb_get_script('html5shiv', 'uri'), array(), gb_get_script('html5shiv', 'version'));
	wp_style_add_data('html5shiv', 'conditional', 'lt IE 9');

	/**
	 * Adding styles to the head
	 *
	 * Bootstrap style
	 */
	wp_enqueue_style('bootstrap', gb_get_styles('bootstrap', 'uri'), array(), gb_get_styles('bootstrap', 'version'),'all');
	wp_enqueue_style('font-awesome', gb_get_styles('fa', 'uri'), array(), gb_get_styles('fa', 'version'),'all');
	/**
	 * Base Style
	 */
	wp_enqueue_style('base-style', gb_get_styles('base', 'uri'), array(), gb_get_styles('base', 'version'),'all');
} /* end site scripts */
add_action('wp_enqueue_scripts', 'gb_site_scripts', 999);
?>