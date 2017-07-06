<?php
/**
 * Google Analytics Function to load its script*
 *
 * @since 1.0
 */
if ( !function_exists('gb_google_analytics') ) : 
	function gb_google_analytics() {
		if (! EXTERNAL_SCRIPTS)
			return;
		else
			include 'scripts/analitycs.php';
	}
endif;
// add_action('wp_head', 'gb_google_analytics');