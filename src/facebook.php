<?php

/**
 * Facebook Function
 */
if ( !function_exists('gb_facebook') ) : 
	function gb_facebook() {
?>
<!-- The facebbok script -->
 	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '739367086215437',
	      xfbml      : true,
	      version    : 'v2.8'
	    });
	    FB.AppEvents.logPageView();
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
<!-- End of the facebbok script -->
<?php
	}
endif;