<?php $sliderPosts = gb_get_posts(array('posts_per_page' => '4')); ?>

<div class="slider">

	<?php while ( $sliderPosts->have_posts() ) : $sliderPosts->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post-thumbnail">
				<?php if(has_post_thumbnail()): ?>
					<?php the_post_thumbnail('large'); ?>
				<?php else:?>
					<span class="image-not-found">Imagen no encontrada</span>
				<?php endif; ?>
			</div>

			<div class="post-wrapper">
				<div class="post-category">
					<span class="label label-primary"><?php the_category(', '); ?></span>
				</div>
				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="post-info">
					<span class="fa fa-user"></span>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="nofollow">
						<em><?php echo get_the_author(); ?></em>
					</a> el 
					<?php echo get_the_date(); ?>
				</div>
			</div>
		</article>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

	<div class="slider-navbar">
		<a class="prev" href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="next" href="#"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>