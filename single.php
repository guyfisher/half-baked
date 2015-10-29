<?php
get_header(); /* WordPress Header Template */
if (have_posts()): while (have_posts()): the_post(); /* WordPress Loop */
?>

<h2><?php the_title() ?></h2><!-- Document Title -->

<!-- Single Post Meta Information -->

<div id="postmeta">
	<div class="dateline"><?php printf( __( 'Published on %s', 'half-baked'), get_the_date() ); ?>&nbsp;&nbsp;<?php edit_post_link( '<img class="icon" src="' . get_template_directory_uri() . '/images/twotone/edit.gif" width="16" height="16" alt="' . esc_attr__( 'Edit this post', 'half-baked' ) . '" />', '', '&nbsp;|&nbsp;' ); ?><a id="postmeta_toggle" href="#postmeta_slider" title="<?php esc_attr_e( 'More information about this post', 'half-baked' ); ?>"><img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/images/twotone/arrow-down.gif" width="16" height="16" alt="" /></a></div>
	<div id="postmeta_slider">
		<div class="scriptaculous">
			<dl>
				<dt><?php _e( 'Author', 'half-baked' ); ?></dt>
				<dd><?php printf( __( 'Posted by %1$s at %2$s', 'half-baked' ), '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a>', get_the_time() ); ?></dd>
				<?php if (get_the_category()) { ?>
				<dt><?php _e( 'Category', 'half-baked' ); ?></dt>
				<dd><?php _e( 'Filed under', 'half-baked' ); ?> <?php the_category(', '); ?></dd>
				<?php } if (get_the_tags()) { ?>
				<dt><?php _e( 'Keywords', 'half-baked' ); ?></dt>
				<dd><?php _e( 'Tagged with', 'half-baked' ); ?> <?php the_tags( '' ); ?></dd>
				<?php } ?>
			</dl>
		</div>
	</div>
</div>

<!-- Main Content -->

<div id="main" class="single-post">
	<?php the_content(); ?>
	<div class="link-pages"><!-- Pages Navigation -->
		<?php wp_link_pages(); echo("\n"); ?>
	</div>
	<?php comments_template(); /* WordPress Comments Template */ ?>
<?php endwhile; /* Stop Generating Post */ ?>
	<div class="prev-next"><!-- Posts Navigation -->
		<div class="prev"><?php previous_post_link('%link', '&laquo; %title') ?></div>
		<div class="next"><?php next_post_link('%link', '%title &raquo;') ?></div>
	</div>
<?php endif; /* Stop WordPress Loop */ ?>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>