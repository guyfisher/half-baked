<?php
/**
 * Theme Functions
 *
 * Custom functions, default variable definitions and supported features.
 *
 * @package Half-Baked
 * @author Guy Fisher
 * @copyright Copyright © 2007 Guy M. Fisher
 * @license http://gnu.org/licenses/gpl-2.0.html
 */

/**
 * Sets up default variable definitions and supported features.
 *
 * @since 1.6.1
 *
 * @uses add_theme_support()
 */
function half_baked_setup_theme() {
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; // global content width
	}
	add_theme_support( 'automatic-feed-links' ); // automatic rss feed links
}
add_action( 'after_setup_theme', 'half_baked_setup_theme' );

/**
 * Enqueues scripts for output in <head> element.
 *
 * @since 1.6
 *
 * @uses wp_enqueue_script()
8 */
function half_baked_enqueue_scripts() {
	$theme = wp_get_theme();
	$template_directory_uri = get_template_directory_uri();
	wp_enqueue_script( 'fitvids', $template_directory_uri . '/scripts/jquery.fitvids.js', array( 'jquery' ), '1.0' ); // fluid videos
	wp_enqueue_script( 'accordion', $template_directory_uri . '/scripts/accordion.js', array( 'scriptaculous-effects' ) ); // accordion widget
	wp_enqueue_script( 'half-baked', $template_directory_uri . '/scripts/half-baked.js', array( 'fitvids', 'accordion' ), $theme->Version );
}
add_action( 'wp_enqueue_scripts', 'half_baked_enqueue_scripts' );

/**
 * Appends blog name to default page titles.
 *
 * Filters the page title string with the wp_title filter hook.
 *
 * @see wp_title()
 * @since 1.6.3
 *
 * @param string $title Page title string
 * @return string Page title string with blog name appended
 */
function half_baked_title( $title ) {
	if ( is_feed() ) {
		return $title;
	}
	return $title . get_bloginfo( 'name' );
}
add_filter( 'wp_title', 'half_baked_title' );

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
 * Removes brackets from ellipses at end of excerpts.
 *
 * Filters the excerpt more string with the excerpt_more filter hook.
 *
 * @see wp_trim_excerpt()
 * @since 1.6.1
 *
 * @param string $more Excerpt more string
 * @return string Excerpt more string replaced by unbracketed ellipsis
 */
function half_baked_excerpt_more( $more ) {
	return str_replace( '[...]', '&#8230;', $more );
}
add_filter( 'excerpt_more', 'half_baked_excerpt_more' );

/**
 * Replaces last comma in categories list with "and" separator.
 *
 * Filters the categories list with the_category filter hook.
 *
 * @see get_the_category_list()
 * @since 1.6.1
 *
 * @param string $thelist Categories list
 * @return string Categories list with last comma replaced by "and"
 */
function half_baked_category( $thelist ) {
	$last_comma = strrpos( $thelist, ', ' );
	if ( $last_comma === false ) {
		return $thelist;
	}
	else return substr_replace( $thelist, ' and ', $last_comma, 2 );
}
add_filter( 'the_category', 'half_baked_category' );

/**
 * Replaces last comma in tags list with "and" separator.
 *
 * Filters the tags list on single posts with the_tags filter hook.
 *
 * @see get_the_tag_list()
 * @since 1.6.1
 *
 * @param string $term_list Tags list
 * @return string Tags list with last comma replaced by "and"
 */
function half_baked_tags( $term_list ) {
	$last_comma = strrpos( $term_list, ', ' );
	if ( ! is_single() || $last_comma === false ) {
		return $term_list;
	}
	else return substr_replace( $term_list, ' and ', $last_comma, 2 );
}
add_filter( 'the_tags', 'half_baked_tags' );

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
				<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/bookmark.gif" width="16" height="16" alt="" />&nbsp;<a href="#comment-<?php comment_ID(); ?>" title="Permanent link to this comment">Bookmark</a>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/quote.gif" width="16" height="16" alt="" />&nbsp;' ) ) ); ?>
				<?php edit_comment_link( 'Edit', '&nbsp;&nbsp;<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/edit.gif" width="16" height="16" alt="" />&nbsp;' ); ?>
			</div>
		</div>
	<?php else : ?>
		<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/back-forth.gif" width="16" height="16" alt="Pingback" />&nbsp;<?php comment_author_link(); ?>
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

/**
 * Half-Baked Accordion widget child class
 *
 * Built-in Scriptaculous accordion widget for the Half-Baked theme.
 *
 * @see WP_Widget
 * @since Half-Baked 1.6.3
 */
class Half_Baked_Widget_Accordion extends WP_Widget {
	function __construct() {
		parent::__construct( 'half-baked-accordion', 'Half-Baked Accordion', array( 'classname' => 'widget_half_baked_accordion', 'description' => 'A Scriptaculous accordion for the Half-Baked theme. Drag this widget to the Main Sidebar to display the accordion and then drag the widgets you want displayed inside the accordion to the Accordion sidebar.' ) );
	}
	function widget( $args ) {
		extract( $args );
		echo $before_widget;
		echo "\t\t<div class=\"accordion_content\">\n";
		dynamic_sidebar( 'accordion' );
		echo "\t\t</div>\n";
		echo "\t</div>\n";
	}
}

/**
 * Meta widget child class
 *
 * Custom Half-Baked meta widget replaces the default meta widget.
 *
 * @see WP_Widget_Meta
 * @since Half-Baked 1.6.3
 */
class Half_Baked_Widget_Meta extends WP_Widget_Meta {
	function __construct() {
		WP_Widget::__construct( 'meta', __( 'Meta' ), array( 'classname' => 'widget_meta', 'description' => 'Meta information and login link for the Half-Baked theme' ) );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		get_template_part( 'meta' );
		echo $after_widget;
	}
}

/**
 * Registers main widget sidebar and accordion widget area.
 *
 * @since Half-Baked 1.6.3
 *
 * @uses register_sidebar()
 * @uses register_widget()
 */
function half_baked_widgets_init() {
	register_sidebar( array(
			'name' => 'Main Sidebar',
			'id' => 'main',
			'description' => 'Widgets displayed in the main sidebar',
			'before_widget' => "\t" . '<div id="%1$s" class="widget %2$s">' . "\n",
			'after_widget' => "\n\t</div>\n",
			'before_title' => "\t\t<h3>",
			'after_title' => "</h3>\n"
	) );
	register_sidebar( array(
			'name' => 'Accordion',
			'id' => 'accordion',
			'description' => 'Widgets displayed inside the Half-Baked Accordion widget',
			'before_widget' => "\t\t\t" . '<div id="%1$s" class="widget %2$s">' . "\n",
			'after_widget' => "\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n",
			'before_title' => "\t\t\t\t<h3>",
			'after_title' => "</h3>\n\t\t\t\t<div class=\"widget_content\">\n\t\t\t\t\t<div class=\"scriptaculous\">\n"
	) );
	register_widget( 'Half_Baked_Widget_Accordion' );
	register_widget( 'Half_Baked_Widget_Meta' );
}
add_action( 'widgets_init', 'half_baked_widgets_init' );

?>