<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<main class="col-md-8" role="main">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('the-post'); ?>>
						<header class="the-post-header">
							<div class="page-header the-post-title">
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="the-post-info">
								<ul class="list-unstyled list-inline">
									<li>
										<span class="glyphicon glyphicon-user"></span>
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="nofollow">
											<i><?php echo get_the_author(); ?></i>
										</a>
									</li>
									<li>
										<span class="glyphicon glyphicon-folder-open"></span>
										<b><?php echo __( 'Publicado en' , 'gb' ) . ': ';?></b>
										<?php the_category(', '); ?>
									</li>
									<li>
										<span class="glyphicon glyphicon-time"></span> El <?php echo get_the_date(); ?>
									</li>
									<li>
										<span class="glyphicon glyphicon-comment"></span>
										<?php comments_popup_link( '0', '1', '%' ); ?>
									</li>
								</ul>
							</div>
						</header>
						<div class="the-post-content">
							<?php gb_get_ad('main', 'horizontal', 'adsense'); ?>
							<?php the_content(); ?>
						</div>
						<footer class="the-post-footer">
							<?php $tags_list = get_the_tag_list('<span class="label label-primary">', '</span><span class="label label-primary">', '</span>'); ?>
		
							<?php if ( $tags_list ): ?>

								<div class="the-post-tags">
									<span class="glyphicon glyphicon-tags"></span>
									<?php echo $tags_list ; ?>
								</div>

							<?php endif; ?>

							<?php edit_post_link(__( 'Editar', 'gb' )); ?>
						</footer>
					</article>

					<?php gb_get_ad('main', 'horizontal', 'adsense'); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>