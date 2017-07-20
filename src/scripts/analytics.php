<?php
/**
 * Google Analytics Function to load its script*
 *
 * @since 1.0
 */
function gb_google_analytics() {
	if (! EXTERNAL_SCRIPTS)
		return;
	else
		include 'js-analitycs.php';
}
add_action('wp_head', 'gb_google_analytics', 99);