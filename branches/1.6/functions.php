<?php /* Custom PHP Functions for Half-Baked WordPress Theme */

if (!isset($content_width)) $content_width = 640; // Define global content width.

add_theme_support( 'automatic-feed-links' ); // Enable automatic RSS feed links.

function half_baked_contact() {

	/* Echos a link to any page with a slug matching "contact" ... or a link to the administrator's e-mail address. */

	global $wpdb;

	$contact_id = $wpdb->get_var("SELECT ID from $wpdb->posts WHERE post_name = 'contact' AND post_type = 'page' AND post_status = 'publish'");

	if (is_null($contact_id)) {
		$contact_email = antispambot('mailto:' . get_option('admin_email'));
		echo "<p id=\"contact\"><a href=\"$contact_email\" title=\"Send an e-mail message to " . get_bloginfo('name') . '">Contact ' . get_bloginfo('name') . "</a></p>\n";
	}
	else echo '<p id="contact"><a href="' . get_permalink($contact_id) . '">Contact ' . get_bloginfo('name') . "</a></p>\n";

}

function half_baked_about() {

	/* Echos a link to any page with a slug matching "about" ... or a link to the WordPress home page. */

	global $wpdb;

	$about_id = $wpdb->get_var("SELECT ID from $wpdb->posts WHERE post_name = 'about' AND post_type = 'page' AND post_status = 'publish'");

	if ($about_id) {
		echo '<p id="about"><a href="' . get_permalink($about_id) . '">About ' . get_bloginfo('name') . "</a></p>\n";
	}
	else echo "<p id=\"about\" class=\"wplink\"><a href=\"http://wordpress.org/\">Powered by WordPress</a></p>\n";

}

function half_baked_subcategories() {

	/* Echos a comma-separated list of links to subcategories of the current category archive. */

	global $cat;

	$category = get_category($cat);
	$subcategories = get_categories('child_of=' . $category->cat_ID . '&orderby=name');

	if (empty($subcategories)) return;

	$count = count($subcategories);
	echo '<p>Subcategories: ';
	foreach ($subcategories as $key => $value) {
		echo '<a href="' . get_category_link($value->cat_ID) . '" title="' . $value->category_description . '">' . $value->cat_name . '</a>';
		if ($key < $count) echo ', ';
	}
	echo "</p>\n";

}

function half_baked_comments($comments) {

	/* Splits the comments for a post into comments and trackbacks and returns a multidimensional array. Inspired by Binary Moon (http://www.binarymoon.co.uk/2006/04/wordpress-tips-and-tricks/). */

	// $comments = Array of post comments

	if ($comments) {
		$split_comments = array('comments' => array(), 'trackbacks' => array());
		foreach ($comments as $comment) {
			if ($comment->comment_type == 'trackback' || $comment->comment_type == 'pingback') {
				$split_comments['trackbacks'][] = $comment;
			} else {
				$split_comments['comments'][] = $comment;
			}
		}
		return $split_comments;
	}

}

/* Hooks & Filters */

function half_baked_embed_defaults($embed_sizes) { /* Filter default embedded media width on home page. */
	if (is_home()) {
		$embed_sizes['width'] = 450;
	}
	return $embed_sizes;
}
add_filter('embed_defaults', 'half_baked_embed_defaults');

function half_baked_search_form($form) { /* Filter invalid role attribute from default search form. */
	return str_replace('role="search" ', '', $form);
}
add_filter('get_search_form', 'half_baked_search_form');

/* Sidebar Widgets */

if (function_exists('register_sidebar')) {
	register_sidebar(array('name' => 'Main Sidebar', 'description' => 'Widgets displayed in the main sidebar', 'before_widget' => "\t" . '<div id="%1$s" class="widget %2$s">' . "\n", 'after_widget' => "\n\t\t</div>\n\t</div>\n", 'before_title' => "\t\t<h3>", 'after_title' => "</h3>\n\t\t<div class=\"widget_content\">\n"));
	register_sidebar(array('name' => 'Accordion', 'description' => 'Widgets displayed inside the Half-Baked Accordion widget', 'before_widget' => "\t\t\t" . '<div id="%1$s" class="widget %2$s">' . "\n", 'after_widget' => "\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n", 'before_title' => "\t\t\t\t<h3>", 'after_title' => "</h3>\n\t\t\t\t<div class=\"widget_content\">\n\t\t\t\t\t<div class=\"scriptaculous\">\n"));
}

function half_baked_widgets_ini() {

	/* Initializes the custom widgets built into the Half-Baked theme. */

	if (!function_exists('register_sidebar_widget')) {
		return;
	}

	function widget_half_baked_search($args) { // Search Widget
		extract($args);
		echo $before_widget;
		echo $before_title . 'Search' . $after_title;
		get_search_form();
		echo $after_widget;
	}
	$widget_ops = array('classname' => 'widget_search', 'description' => 'A search form for the Half-Baked theme');
	wp_register_sidebar_widget('search', 'Search', 'widget_half_baked_search', $widget_ops);

	function widget_half_baked_accordion($args) { // Accordion Widget
		if (is_home()) {
			extract($args);
			echo $before_widget;
			echo "\t\t<div class=\"accordion_content\">\n";
			dynamic_sidebar('Accordion');
			echo "\t\t</div>\n";
			echo "\t</div>\n";
		}
	}
	$widget_ops = array('classname' => 'widget_half_baked_accordion', 'description' => 'A Scriptaculous Accordion for the Half-Baked theme');
	wp_register_sidebar_widget('half-baked-accordion', 'Half-Baked Accordion', 'widget_half_baked_accordion', $widget_ops);

	function widget_half_baked_meta($args) { // Meta Widget
		extract($args);
		echo $before_widget;
		echo $before_title . 'Meta' . $after_title;
		include TEMPLATEPATH . '/meta.php';
		echo $after_widget;
	}
	$widget_ops = array('classname' => 'widget_meta', 'description' => 'Meta information and login link for the Half-Baked theme');
	wp_register_sidebar_widget('meta', 'Meta', 'widget_half_baked_meta', $widget_ops);

}

add_action('widgets_init', 'half_baked_widgets_ini');

?>
