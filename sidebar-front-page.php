<section class="col-md-4">
	<?php if ( ! dynamic_sidebar( 'front-page' ) ) : ?>
		<?php gb_get_ad('sidebar', 'square', 'adsense'); ?>

		<?php get_template_part('src/widget', 'donate'); ?>
		<?php get_template_part('src/widget', 'coindesk'); ?>

		<?php gb_get_ad('sidebar', 'vertical', 'chitika'); ?>

		<?php get_template_part('src/widget', 'twitter'); ?>
	<?php endif; ?>
</section>