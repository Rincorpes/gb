<?php
/**
 * Set the upgrade message
 * 
 * @since gb 1.0
 * 
 * @global string $wp_version WordPress version.
 */
function gb_upgrade_message()
{
	return sprintf(__('gb theme requires at least WordPress 4.7. You are running version %s. Please upgrade WordPress and try again.', 'gb'), $GLOBALS['wp_version']);
}

/**
 * Prevent switching to gb theme on old versions of WordPress.
 * and switch to the default theme
 * 
 * @since gb 1.0
 */
function gb_switch_theme()
{
	switch_theme(WP_DEFAULT_THEME);
	unset($_GET['activated']);
	add_action('admin_notices', 'gb_upgrade_notice');
}
add_action('after_switch_theme', 'gb_switch_theme');

/**
 * Add a message for unsuccessful theme switch.
 * 
 * @since gb 1.0
 */
function gb_upgrade_notice()
{
	$message = gb_upgrade_message();
	printf('<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions lower than 4.7.
 * 
 * @since gb 1.0
 */
function gb_customize()
{
	wp_die(gb_upgrade_message(), '', array('back_link' => true));
}
add_action('load-customize.php', 'gb_customize');

/**
 * Prevent the Theme Preview from being loaded on WordPress versions lower than 4.7.
 * 
 * @since gb 1.0
 */
function gb_preview()
{
	if (isset($_GET['preview']))
		wp_die(gb_upgrade_message());
}
add_action('template_redirect', 'gb_preview');
?>