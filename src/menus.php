<?php
/**
 * Set all menus menus config here
 */

/**
 * Register menus
 *
 * @since gb 1.0
 */
register_nav_menus(
	array(
		'top' => __('Navbar Top', 'gb'),
		'social' => __('Navbar Social', 'gb'),
		'primary' => __('Navbar Primary', 'gb'),
		'footer' => __('Navbar Footer', 'gb')
		));

/**
 * Get a custom navar.
 *
 * @since 1.0
 *
 * @example Wherever you need to add a navbar you junt need to know
 * its nice name and you can pass any class you want to add to the
 * `<ul>` tag and your custom walher params.
 *
 * 		<php gb_navbar('nicename', 'center', array('nav_item_has_children_class' => 'my-dropdown-class')); ?>
 * 
 * @uses wp_nav_menu();
 *
 * @param string $name The nicename for the menu, the one you used in the `register_nav_menu()` function
 * @param string $classes The classes you want to add to the HTML `<ul>` tag
 * @param array $walker_params The params you want to add to the walker.
 * 
 * 			Acepter params in $walker_params array:
 *
 * 			'nav_item_class' The class for each `<li>` inside the main `<ul>`
 * 			'nav_item_has_children_class' If the itam has an `<ul>` inside, add the class you want
 *			'nav_item_has_children_link_class' The class for each link inside a item that hass children
 *			'nav_item_has_children_link_extras' If you need some extra HTML attrs.
 *			'nav_children_class'  The class for the children `<ul>`
 */
function gb_navbar($name, $classes = null, $walker_params = null)
{
	if ($classes) $classes = ' ' . $classes;

	$default_wolker_params = array(
		'nav_item_class' => 'nav-item',
		'nav_item_has_children_class' => 'dropdown',
		'nav_item_has_children_link_class' => 'dropdown-toggle',
		'nav_item_has_children_link_extras' => 'data-toggle="dropdown"',
		'nav_children_class' => 'dropdown-menu',
		);

	$walker_params = ($walker_params && is_array($walker_params)) ? array_merge($default_wolker_params, $walker_params) : $default_wolker_params;

	$parmas = array(
		'container' => false,
		'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav' . $classes . '">%3$s</ul>',
		'theme_location' => $name,
		'fallback_cb' => false,
		'depth' => 5,
		'walker' => new Prymary_Nav_Walker(),
		'nav_item_class' => $walker_params['nav_item_class'],
		'nav_item_has_children_class' => $walker_params['nav_item_has_children_class'],
		'nav_item_has_children_link_class' => $walker_params['nav_item_has_children_link_class'],
		'nav_item_has_children_link_extras' => $walker_params['nav_item_has_children_link_extras'],
		'nav_children_class' => $walker_params['nav_children_class']
		);
	wp_nav_menu($parmas);
}

/**
 * Primary nav walker
 * This class will help you to custom each menu
 *
 * @since 1.0
 */
class Prymary_Nav_Walker extends Walker_Nav_Menu
{
	/**
	 * Force Walker has_children var into $arg array
	 */
	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
	{
		$id_field = $this->db_fields['id'];

		if (is_object($args[0]))
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
	/**
	 * The start elemment
	 */
	public function start_el(&$output, $item, $depth, $args)
	{
		$classes = array();
		$classes[] = 'slug-' . sanitize_html_class(sanitize_title($item->title));
		$classes[] = $args->nav_item_class;
		$classes[] = ($item->current OR $item->current_item_ancestor OR $item->current_item_parent) ? 'active' : '';
		$classes[] = ($args->has_children) ? $args->nav_item_has_children_class : '';

		for ($i = 0; $i <= count($item->classes); $i++)
			$classes[] = (! preg_match('/menu|current-?(.*)/', $item->classes[$i])) ? $item->classes[$i] : '';

		$classes = trim(implode(' ', $classes));

		// Open the elemment
		$output .= '<li class="' . $classes .'">';

		// Avoid redundant titles
		! empty($item->attr_title)
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';

		! empty($item->url)
			and $attributes .= ' href="' . esc_attr($item->url) . '"';

		// Show rel attr
		! empty($item->xfn)  
			and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';

		! empty($item->class)
			and $attributes .= ' class="' . esc_attr($item->class) . '"';

		$attributes .= ($args->has_children) ? ' class="' . $args->nav_item_has_children_link_class . ' ' . $args->nav_item_has_children_link_extras . ' data-toggle="dropdown"' : '';

		$attributes  = trim($attributes);
		$title       = apply_filters('the_title', $item->title, $item->ID);

		$caret = ($args->has_children) ? '<span class="fa fa-caret-down">' : '';

		switch ($title) {
			case 'facebook':
				$title = '<span class="fa fa-facebook"></span>';
				break;
			
			case 'twitter':
				$title = '<span class="fa fa-twitter"></span>';
				break;
			
			case 'rss':
				$title = '<span class="fa fa-rss"></span>';
				break;
		}

		$anchor = "{$args->before}<a {$attributes}>{$args->link_before}{$title} {$caret}</a>" . $args->link_after . $args->after;

		// Ad a filter for plugins if they need it
		$output .= apply_filters(
			'walker_nav_menu_start_el'
			,   $anchor
			,   $item
			,   $depth
			,   $args
		);
	}
	/**
	 * The end element
	 */
	function end_el(&$output)
	{
		$output .= '</li>';
	}
	/**
	 * Start children element
	 */
	function start_lvl(&$output, $depth = 0, $args = Array() )
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent</span><ul class=\"{$args->nav_children_class}\">\n";
	}
}
?>