<div class="panel panel-default what-is-bitcoin">
	<div class="panel-heading">
		<h3>Educate</h3>
	</div>
	<div class="panel-body">
		<?php
		$page = get_page_by_title('¿Qué es Bitcoin?');
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'single-post-thumbnail');
		//print_r($page);
		?>
		<a href="<?php echo get_permalink($page->ID); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $page->post_title; ?>" title="<?php echo $page->post_title; ?>"></a>
	</div>
</div>