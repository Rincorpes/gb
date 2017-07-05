<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<main class="col-md-8" role="main">
				<?php gb_get_ad('main', 'horizontal', 'adsense'); ?>

				<?php if (! is_home()): ?>
				<h1 class="page-header"><?php	echo gb_get_loop_title(); ?></h1>
				<?php endif; ?>

				<?php $i = 1; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('the-post'); ?>>
						<header class="the-post-header">
							<div class="the-post-thumbnail">
								<?php if(has_post_thumbnail()): ?>
									<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="nofollow">
										<?php the_post_thumbnail('large'); ?>
									</a>
								<?php else:?>
									<span class="image-not-found">Imagen no encontrada</span>
								<?php endif; ?>
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
							<h2 class="the-post-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
						</header>
						<div class="the-post-content">
							<?php the_excerpt( __( 'Saber más;' , 'gb' ) ); ?>
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

					<?php
					if (is_home() && $i == 5) {
						gb_get_ad('main', 'horizontal', 'adsense');
					}
					$i++;
					?>

				<?php endwhile; ?>

				<div class="pagination-container">
					<?php gb_paginate_links( ) ?>
				</div>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>