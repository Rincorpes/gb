<section class="col-md-4">
	<?php if ( ! dynamic_sidebar( 'front-page' ) ) : ?>

		<?php get_template_part('src/widget', 'suscribe'); ?>
		<?php get_template_part('src/widget', 'social-buttons'); ?>

		<?php gb_get_ad('sidebar', 'square', 'adsense'); ?>
		
		<?php get_template_part('src/widget', 'donate'); ?>
	<?php endif; ?>
</section>