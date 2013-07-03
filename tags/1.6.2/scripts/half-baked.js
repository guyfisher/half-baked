jQuery(document).ready(function($) {
	$(".post").fitVids();
});

document.observe("dom:loaded", function() {
	if ($("postmeta_slider")) {
		$("postmeta_slider").hide();
		$("postmeta_toggle").onclick = function() { new Effect.toggle($("postmeta_slider"), "slide", { duration: 0.5 }); return false; }
	}
	if ($("half-baked-accordion")) {
		$("half-baked-accordion").visualEffect("accordian", { headingSelector: "h3", sectionSelector: "div.widget_content" });
	}
});