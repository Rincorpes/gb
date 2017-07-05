<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<main class="col-md-8" role="main">

				<?php get_template_part('src/slider'); ?>

				<?php gb_get_ad('main', 'horizontal', 'adsense'); ?>

				<?php get_template_part('src/older-posts'); ?>

				<?php gb_get_ad('main', 'horizontal', 'adsense'); ?>

				<div class="row">
					<div class="col-md-12">
						<?php get_template_part('src/edu'); ?>
					</div>
					<div class="col-sm-6">
						<?php get_template_part('src/widget', 'suscribe'); ?>
					</div>
					<div class="col-sm-6">
						<?php get_template_part('src/widget', 'facebook'); ?>
					</div>
				</div>
			</main>

			<?php get_sidebar('front-page'); ?>
		</div>
	</div>

<?php get_footer(); ?>