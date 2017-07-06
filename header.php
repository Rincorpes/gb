<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="es" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="es" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="es" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="es" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
	<?php wp_head(); ?>

	<?php gb_google_analytics(); ?>
</head>
<body <?php body_class(); ?>>
	
	<header role="banner">
		<div class="top-navbar navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-logo visible-xs pull-left">
						<img src="<?php bloginfo('template_url'); ?>/assets/images/ganemos-bits-logo.png">
					</a>
					<button
						type="button"
						class="navbar-toggle"
						data-toggle="collapse"
						data-target=".navbar-ex1-collapse">
						<span class="glyphicon glyphicon-menu-hamburger"></span>
					</button> 
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php gb_navbar('primary', 'navbar-left visible-xs'); ?>
					<?php gb_navbar('top', 'navbar-left'); ?>
					<span class="divider"></span>
					<?php gb_navbar('social', 'navbar-left'); ?>
					<div class="btn-group navbar-right hidden-xs">
						<button
							type="button"
							class="btn btn-primary navbar-btn dropdown-toggle"
							data-toggle="dropdown">
							<span class="fa fa-search"></span>
						</button>
						<div class="dropdown-menu searchform">
							<?php get_search_form(); ?>
						</div>
					</div>
					<div class="visible-xs searchform-mobile">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<?php gb_main_heading(); ?>
			<?php gb_get_ad('header', 'horizontal', 'chitika'); ?>
		</div>
		<nav class="bottom-navbar navbar navbar-default hidden-xs" role="navigation">
			<div class="container">
				<?php gb_navbar('primary', 'navbar-right'); ?>
			</div>
		</nav>
	</header>