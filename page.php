<?php
get_header(); /* WordPress Header Template */
if (have_posts()): while (have_posts()): the_post(); /* WordPress Loop */
?>

<h2><?php the_title() ?></h2><!-- Document Title -->

<!-- Single Page Meta Information -->

<div id="postmeta">
	<div class="dateline">Updated on <?php the_modified_date(); edit_post_link('<img class="icon" src="' . get_template_directory_uri() . '/images/sanscons/edit.gif" width="16" height="16" alt="Edit this page" />', '&nbsp;&nbsp;'); ?></div>
</div>

<!-- Main Content -->

<div id="main" class="page-post">
	<?php the_content() ?>
	<div class="link-pages">
		<?php wp_link_pages(); echo("\n"); ?>
	</div>
	<?php comments_template(); /* WordPress Comments Template */ ?>
<?php endwhile; endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>