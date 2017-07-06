<?php
/**
 * Facebook Function to loads its script.
 *
 * @since 1.0
 */
if ( !function_exists('gb_facebook') ) : 
	function gb_facebook() {
		if (! EXTERNAL_SCRIPTS)
			return;
		else
			include 'scripts/facebook.php';
	}
endif;