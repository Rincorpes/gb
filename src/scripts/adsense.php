<?php
/**
 * Facebook Function to load its script
 *
 * @since 1.0
 */
function gb_google_adsense() {
	if (! EXTERNAL_SCRIPTS)
		return;
	else
		include 'js-adsense.php';
}
add_action('wp_footer', 'gb_google_adsense', 99);