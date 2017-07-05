<?php
/**
 * Facebook Function to load its script
 *
 * @since 1.0
 */
if ( !function_exists('gb_adsense') ) : 
	function gb_adsense() {
?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-3376736209557061",
	    enable_page_level_ads: true
	  });
	</script>
<?php
	}
endif;