<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<main class="col-md-8" role="main">
				<article class="the-post">
					<header class="the-post-header">
						<div class="the-post-title">
							<h1><?php echo __('No encontrado'); ?></h1>
						</div>
					</header>
					<div class="the-post-content">
						<p>
							<?php echo __('¡Oops! No pudimos encontrar lo que buscas... Por favor utiliza el buscador.'); ?>
						</p>
					</div>
				</article>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>