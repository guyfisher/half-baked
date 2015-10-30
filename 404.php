<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;404&nbsp;]</h2><!-- Document Title -->

<!-- Main Content -->

<div id="main" class="page">
	<div class="highlight"><!-- Message -->
		<div class="message error">
			<h3><?php _e( 'Page Not Found', 'half-baked' ); ?></h3>
			<p><?php printf( __( 'Sorry, the page you&rsquo;re looking for cannot be found on %s.', 'half-baked' ), '<em>' . get_bloginfo() . '</em>' ); ?></p>
		</div>
	</div>
	<p>
		<?php
			$half_baked_url_abbr = esc_attr__( 'Uniform Resource Locator', 'half-baked' );
		 	printf( __( 'If you got here by using a bookmark or by following a link, it&rsquo;s either broken or out of date. If you entered the <acronym title="%s">URL</acronym> in your browser&rsquo;s address bar, double check it. It&rsquo;s probably misspelled.', 'half-baked' ), $half_baked_url_abbr );
		?>
	</p>
	<p><?php _e( 'You might find what you&rsquo;re looking for by browsing the archives or by using the search box in the sidebar.', 'half-baked' ); ?></p>
	<p><?php printf( __( 'If that doesn&rsquo;t work, you can start fresh on the <a href="%s">home page</a>.', 'half-baked' ), home_url() ); ?></p>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>
