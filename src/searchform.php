<?php
/**
 * Search Form
 */
if (!function_exists('gb_search_form')) : 
	function gb_search_form( $form ) {
	
		$form = '
			<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '">
				<div class="input-group">
					<input id="s" class="form-control input-sm" name="s" type="text" placeholder="Buscar" value="' . get_search_query() . '">
					<span class="input-group-addon"><span class="fa fa-search"></span></span>
				</div>
			</form>
	    ';
	
	    return $form;
	}
endif;
add_filter( 'get_search_form', 'gb_search_form' );
?>