<aside class="categories panel panel-default">
	<div class="panel-heading">
		<h3><?php echo __( 'Categorias' , 'gb'); ?></h3>
	</div>
	<div class="panel-body">
		<ul class="list-group">
			<?php $categories = get_categories( ); foreach ($categories as $cat): ?>
				<li class="list-group-item">
					<a href="<?php echo get_category_link( $cat->term_id ) ?>" class="<?php echo $cat->slug; ?>" rel="nofollow"><?php echo $cat->name; ?></a>
				</li>		
			<?php endforeach; ?>
		</ul>
	</div>
</aside>