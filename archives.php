<?php

/*
Template Name: Archives
*/

$half_baked_published = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND post_status= 'publish'");
$half_baked_first = $wpdb->get_var("SELECT MIN(post_date) FROM $wpdb->posts WHERE post_type = 'post' AND post_status= 'publish'");

get_header(); /* WordPress Header Template */

?>

<h2><?php wp_title('') ?></h2><!-- Document Title -->

<!-- Single Page Meta Information -->

<div id="postmeta">
	<div class="dateline">Updated on <?php echo(date('l, F j, Y')); edit_post_link('<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/edit.gif" width="16" height="16" alt="Edit this page" />', '&nbsp;&nbsp;'); ?></div>
</div>

<!-- Main Content -->

<div id="main" class="page">
	<p>There have been <?php echo($half_baked_published) ?> posts published on <em><?php bloginfo('name') ?></em> since <?php echo(date('F j, Y', strtotime($half_baked_first))) ?>. You can browse through them by date, category or keyword.</p>
	<p>If you&rsquo;re looking for a specific post, you can search for it by using the search box in the sidebar.</p>
	<h3>Archives by Date</h3>
	<ul class="get_archives">
		<?php wp_get_archives(); ?>
	</ul>
	<h3>Archives by Category</h3>
	<ul class="list_categories">
		 <?php wp_list_categories('show_count=1&hide_empy=0&title_li='); ?>
	</ul>
	<h3>Archives by Keyword</h3>
	<p class="tag_cloud"><?php wp_tag_cloud('smallest=.85&largest=2&unit=em') ?></p>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>