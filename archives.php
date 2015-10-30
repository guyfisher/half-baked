<?php

/*
Template Name: Archives
*/

$half_baked_published = $wpdb->get_row("SELECT COUNT(*) AS count_posts, MIN(post_date) AS min_post_date FROM $wpdb->posts WHERE post_type = 'post' AND post_status= 'publish'");

get_header(); /* WordPress Header Template */

?>

<h2><?php the_title() ?></h2><!-- Document Title -->

<!-- Single Page Meta Information -->

<div id="postmeta">
	<div class="dateline"><?php printf( __( 'Updated on %s', 'half-baked'), get_the_modified_date() ); ?>&nbsp;&nbsp;<?php edit_post_link( '<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/edit.gif" width="16" height="16" alt="' . esc_attr__( 'Edit this page', 'half-baked' ) . '" />' ); ?></div>
</div>

<!-- Main Content -->

<div id="main" class="page">
	<p><?php printf( __( 'There have been %1$d posts published on %2$s since %3$s. You can browse through them by date, category or keyword.', 'half-baked' ), $half_baked_published->count_posts, '<em>' . get_bloginfo() . '</em>', date_i18n( get_option( 'date_format' ), strtotime( $half_baked_published->min_post_date ) ) ); ?></p>
	<h3><?php _e( 'Archives by Date', 'half-baked' ); ?></h3>
	<ul class="get_archives">
		<?php wp_get_archives(); ?>
	</ul>
	<h3><?php _e( 'Archives by Category', 'half-baked' ); ?></h3>
	<ul class="list_categories">
		 <?php wp_list_categories('show_count=1&hide_empy=0&title_li='); ?>
	</ul>
	<h3><?php _e( 'Archives by Keyword', 'half-baked' ); ?></h3>
	<p class="tag_cloud"><?php wp_tag_cloud('smallest=.85&largest=2&unit=em') ?></p>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>