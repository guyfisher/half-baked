=== Half-Baked ===

Contributors: guyfisher
Tags: red, dark, two-columns, left-sidebar, fluid-layout, sticky-post, threaded-comments, translation-ready
Requires at least: 4.1
Tested up to: 4.4
Stable tag: trunk

A bold red, two-column theme that splits the index pages of your WordPress blog right down the middle.

== Description ==

The Half-Baked theme is a bold red, two-column theme that splits the index pages of your WordPress blog right down the middle. It has a fluid layout that's accented with rounded corners and Paul Jarvis's twotone icons.

The Half-Baked theme is widget-aware, and you can highlight some of your sidebar content inside of Bruce Williams's Scriptaculous Accordion. There's also a Scriptaculous toggle for your post meta-data and a pair of rollover icons that link to your Contact and About pages.

== Installation ==

1. Make sure you're using the latest version of WordPress.
2. Put the half-baked theme folder in your WordPress themes directory.
3. Activate the Half-Baked theme on your WordPress themes administration panel.

= Accordion Widget =

The Half-Baked theme's built-in accordion widget displays any widgets you choose inside a Scriptaculous accordion. Go to the widgets administration panel and add the Half-Baked Accordion widget to the Main Sidebar widget list. Next, open the Accordion widget list and add the widgets that you want displayed inside the Half-Baked Accordion.

Every widget that you add to the Accordion widget list must have a title. If a widget doesn't have a title, it won't have a heading when it's displayed, and your users won't be able to open it by clicking on its heading.

== Frequently Asked Questions ==

= How do the rollover icons at the top and bottom of each page work? =

The rollover icons at the top and bottom of each page will automatically link to pages with "contact" and "about" slugs. If there are no pages with those slugs, the top icon will link to the blog's e-mail address and the bottom icon will link to the WordPress website.

== Changelog ==

= 1.7 =

* Added support for localization

= 1.6.6 =

* Fixed TypeError in Scriptaculous DOM loaded function
* Fixed missing instance parameter in accordion widget
* Fixed text domain problem in meta widget
* Added support for auto-generated title tags

= 1.6.5 =

* Replaced flexible-width tags with fluid-layout tags

= 1.6.4 =

* Fixed accordion script enqueueing conflict

= 1.6.3 =

* Ported built-in widgets to Widgets API
* Updated template tags
* Updated styles for main content headings
* Updated styles for core widgets
* Removed backward compatibility for out of date WordPress versions
* Removed built-in search widget
* Removed support for third party plugins
* Added filter on wp_title template tag
* Added styles for page navigation submenus

= 1.6.2 =

* Fixed extra closing div tag inside untitled widgets
* Fixed misalignment of calendar widget
* Removed Author URI from style sheet file header
* Added styles for built-in menu widget

= 1.6.1 =

* Fixed invalid hr element in footer template
* Updated bloginfo template tags
* Replaced Sanscons with GPL-compatible twotone icon set
* Replaced last comma in category and tag lists with "and" separator
* Removed brackets from ellipses at end of excerpts
* Added support for fluid images and videos
* Added theme setup function
* Added styles to clear heading elements below floated content

= 1.6 =

* Fixed subcategories trailing comma on category index pages
* Fixed redundant database queries in archives template
* Fixed ARIA role attribute in search form
* Replaced Nifty Corners Cube script with border-radius property
* Replaced script elements with wp_enqueue_scripts action
* Replaced hard-coded comment form with comment_form template tag
* Reordered bookmark links for post excerpts
* Edited description for built-in accordion widget
* Added support for threaded comments
* Added support for automatic feed links
* Added maximum width for uploaded images and embedded media
* Added styles for sticky posts, gallery captions and post author comments

= 1.5.1 =

* Fixed accordion widget resizing bug
* Fixed missing page title on static front page
* Fixed aligned images and image borders
* Replaced hard-coded date and time formats with admin settings
* Replaced deprecated template tags
* Added body_class and comment_class template tags
* Added descriptions for sidebars and built-in widgets

= 1.5 =

* Fixed broken navigation and duplicate posts in More Posts loop
* Fixed subcategories error on category index pages
* Fixed invalid search box markup
* Added styles for screen reader text and kbd element

= 1.4 =

* Updated template tags
* Cleaned up custom variables
* Added support for sticky posts

= 1.3 =

* Added tagline to header template
* Added tags to post meta-data

= 1.2 =

* Updated plugin compatibility
* Added support for Gravatars
* Added support for image alignment

= 1.1 =

* Removed built-in links widget

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.7 =

This version adds support for language translations.

== Credits ==

The Half-Baked WordPress Theme is copyright (c) 2007 by Guy M. Fisher. It is free software licensed under the GNU General Public License 2.0 (http://gnu.org/licenses/gpl-2.0.html).

FitVids copyright (c) 2011 Chris Coyier and Dave Rupert
Redistributed under the WTFPL license (http://gnu.org/philosophy/license-list.html#WTFPL)
http://fitvidsjs.com/

Scriptaculous Accordion copyright (c) 2006 Bruce Williams
Redistributed under the MIT License (http://gnu.org/philosophy/license-list.html#Expat)
http://codefluency.com/

twotone icons copyright (c) 2008 Paul Jarvis
Redistributed under the PERL5 License (http://gnu.org/philosophy/license-list.html#PerlLicense)
http://twotiny.googlecode.com/