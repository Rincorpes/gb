<?php

/**
 * Google Analytics Function
 */
if ( !function_exists('gb_google_analytics') ) : 
	function gb_google_analytics() {
		if (! DEV_ENV) :
?>
<!-- The google analytics script -->
 	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-49238263-3', 'auto');
	  ga('send', 'pageview');

	</script>
<!-- End of the Google Analytics script -->
<?php
	endif;
	}
endif;
add_action('wp_head', 'gb_google_analytics');