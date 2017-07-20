<?php
/**
 * Facebook Function to loads its script.
 *
 * @since 1.0
 */
function gb_facebook() {
	if (! EXTERNAL_SCRIPTS)
		return;
	else
		include 'js-facebook.php';
}
add_action('wp_footer', 'gb_facebook', 99);