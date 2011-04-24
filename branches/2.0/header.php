<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11"><!-- XFN Profile for Blogroll Relationships -->

<?php
echo "\t<title>" . get_bloginfo('name');
if (is_search()) {
	echo ' &raquo; ' . get_search_query();
}
else if (is_404()) {
	echo ' &raquo; 404';
}
else echo wp_title('&raquo;', false);
echo "</title>\n";
?>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<meta name="theme" content="Half-Baked" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory') ?>/scripts/niftycorners/niftyCorners.css" />

	<link rel="bookmark" href="#content" title="Skip to Content" />
	<link rel="bookmark" href="#sidebar" title="Skip to Sidebar" />
	<link rel="bookmark" href="#search" title="Skip to Search Form" />

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="RSS Feed" />
	<link rel="alternate" type="application/atom+xml" href="<?php bloginfo('atom_url') ?>" title="Atom Feed" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	
	<?php
	wp_enqueue_script('prototype');
	wp_enqueue_script('scriptaculous-effects');
	wp_head(); /* Plugin API Hook */
	?>

	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/scripts/accordion.js"></script><!-- Scriptaculous Accordion (http://codefluency.com/2006/7/16/scriptaculous-accordian/) -->
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/scripts/niftycorners/niftycube.js"></script><!-- Nifty Corners (http://html.it/articoli/niftycube/) -->
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/scripts/half-baked.js"></script>

</head>

<body<?php echo((is_single() || is_page()) ? ' class="document"' : '') /* If single post or page, add class for document layout ... */ ?>>

<!-- Running Head -->

<div id="head">
	<?php
	if (is_home() && !is_paged()) { // If home page, omit redundant link ...
		echo "<h1 class=\"homepage\">" . get_bloginfo('name') . "</h1>\n";
	}
	else echo "<h1><a href=\"" . get_bloginfo('url') . '/">' . get_bloginfo('name') . "</a></h1>\n"; // Else, add link to home page ...
	?>
	<p id="tagline"><?php bloginfo('description') ?></p>
	<?php half_baked_contact() ?>
</div><!-- End of Running Head -->

<!-- Content Container -->

<div id="content">

<hr />
