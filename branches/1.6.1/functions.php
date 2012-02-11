<?php
/**
 * Theme Functions
 *
 * Custom functions and variable definitions.
 *
 * @package Half-Baked
 * @author Guy Fisher
 * @copyright Copyright © 2007 Guy M. Fisher
 * @license http://gnu.org/licenses/gpl-2.0.html
 */

if (!isset($content_width)) $content_width = 640; // Define global content width.

add_theme_support( 'automatic-feed-links' ); // Enable automatic RSS feed links.

/**
 * Enqueues Scriptaculous Accordion and Half-Baked onLoad scripts.
 *
 * @since 1.6
 *
 * @uses wp_enqueue_script()
 */
function half_baked_enqueue_scripts() {
	$theme = get_theme( get_current_theme() );
	wp_enqueue_script( 'accordion', get_template_directory_uri() . '/scripts/accordion.js', array( 'scriptaculous-effects' ) );
	wp_enqueue_script( 'halfbaked', get_template_directory_uri() . '/scripts/half-baked.js', array( 'scriptaculous-effects', 'accordion' ), $theme['Version'] );
}
add_action( 'wp_enqueue_scripts', 'half_baked_enqueue_scripts' );

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

/**
 * Displays subcategories of current category.
 *
 * Echoes a comma-separated list of links to subcategories of current category in main index template.
 *
 * @uses get_categories()
 * @return string|null Echoes subcategories or returns null
 */
function half_baked_subcategories() {
	$subcategories = get_categories( array( 'parent' => get_query_var( 'cat' ) ) );
	if ( empty( $subcategories ) ) {
		return;
	}
	echo '<p>Subcategories: ';
	foreach ( $subcategories as $key => $value ) {
		if ( $key > 0 ) {
			if ( $key == count( $subcategories ) - 1 ) {
				echo ' and ';
			}
			else echo ', ';
		}
		echo '<a href="' . esc_url( get_category_link( $value->term_id ) ) . '" title="' . esc_attr( $value->description ) . '">' . $value->name . '</a>';
	}
	echo '</p>';
}

/**
 * Formats comments and pingbacks in comments loop.
 *
 * Callback function for wp_list_comments in comments template.
 *
 * @see Walker_Comment::start_el()
 * @since 1.6
 *
 * @param object $comment Current comment
 * @param array $args Formatting options
 * @param int $depth Depth of comment in reference to parents
 */
function half_baked_start_el( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
	<?php if ( 'comment' == get_comment_type() ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<h4>Comment by <?php comment_author(); ?></h4>
			<div class="comment-author vcard">
				<div class="avatar"><?php echo( get_avatar( $comment, 32 ) ); ?></div>
				<div class="dateline"><?php comment_date(); if ( $comment->comment_author_url ) comment_author_url_link( '', ' | ', '&nbsp;&raquo;' ); ?></div>
			</div>
			<?php if ( '0' == $comment->comment_approved ) { ?>
			<p><em>Your comment is awaiting moderation.</em></p>
			<?php } ?>
			<?php comment_text(); ?>
			<div class="bookmarks">
				<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/sanscons/document.gif" width="16" height="16" alt="" />&nbsp;<a href="#comment-<?php comment_ID(); ?>" title="Permanent link to this comment">Bookmark</a>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/comment.gif" width="16" height="16" alt="" />&nbsp;' ) ) ); ?>
				<?php edit_comment_link( 'Edit', '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/edit.gif" width="16" height="16" alt="" />&nbsp;' ); ?>
			</div>
		</div>
	<?php else : ?>
		<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/sanscons/trackback.gif" width="16" height="16" alt="Pingback" />&nbsp;<?php comment_author_link(); ?>
<?php
	endif;
}

/**
 * Enqueues comment reply script.
 *
 * Enqueues comment reply script if comment form is displayed and threaded comments are enabled.
 *
 * @link http://wpengineer.com/2358/enqueue-comment-reply-js-the-right-way/ WP Engineer
 * @since 1.6
 *
 * @uses wp_enqueue_script()
 */
function half_baked_enqueue_comment_reply() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'half_baked_enqueue_comment_reply' );

/**
 * Filters comment form fields and strings.
 *
 * Inserts <em> element in comment notes and removes allowed tags note.
 *
 * @since 1.6
 *
 * @param array $defaults Comment form fields and strings
 * @return array Filtered form fields and strings
 */
function half_baked_comment_form_defaults( $defaults ) {
	$defaults['comment_notes_before'] = str_replace( array( '<p class="comment-notes">', '</p>' ), array( '<p class="comment-notes"><em>', '</em></p>' ), $defaults['comment_notes_before'] );
	$defaults['comment_notes_after'] = '';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'half_baked_comment_form_defaults' );

/**
 * Inserts <fieldset> opening tag before comment form fields.
 *
 * @since 1.6
 */
function half_baked_comment_form_before_fields() {
	echo '<fieldset class="comment-form-fields">';
}
add_action( 'comment_form_before_fields', 'half_baked_comment_form_before_fields' );

/**
 * Inserts <fieldset> closing tag after comment form fields.
 *
 * @since 1.6
 */
function half_baked_comment_form_after_fields() {
	echo '</fieldset>';
}
add_action( 'comment_form_after_fields', 'half_baked_comment_form_after_fields' );

/* Hooks & Filters */

function half_baked_embed_defaults($embed_sizes) { /* Filter default embedded media width on home page. */
	if (is_home()) {
		$embed_sizes['width'] = 450;
	}
	return $embed_sizes;
}
add_filter('embed_defaults', 'half_baked_embed_defaults');

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
	$widget_ops = array('classname' => 'widget_half_baked_accordion', 'description' => 'A Scriptaculous accordion for the Half-Baked theme. Drag this widget to the Main Sidebar to display the accordion and then drag the widgets you want displayed inside the accordion to the Accordion sidebar.');
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
