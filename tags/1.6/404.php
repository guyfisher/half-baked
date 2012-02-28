<?php get_header(); /* WordPress Header Template */ ?>

<h2>[&nbsp;404&nbsp;]</h2><!-- Document Title -->

<!-- Main Content -->

<div id="main" class="page">
	<div class="highlight"><!-- Message -->
		<div class="message error">
			<h3>Page Not Found</h3>
			<p>Sorry, the page you&rsquo;re looking for cannot be found on <em><?php bloginfo('name') ?></em>.</p>
		</div>
	</div>
	<p>If you got here by using a bookmark or by following a link, it&rsquo;s either broken or out of date. If you entered the <acronym title="Uniform Resource Locator">URL</acronym> in your browser&rsquo;s address bar, double check it. It&rsquo;s probably misspelled.</p>
	<p>You might find what you&rsquo;re looking for by browsing the archives or by using the search box in the sidebar.</p>
	<p>If that doesn&rsquo;t work, you can start fresh on the <a href="<?php echo(home_url()) ?>/">home page</a>.</p>
</div><!-- End of Main Content -->

<?php get_sidebar(); /* WordPress Sidebar Template */ ?>

<?php get_footer(); /* WordPress Footer Template */ ?>
