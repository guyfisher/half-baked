var oldonload = window.onload;

if ( typeof oldonload != 'function' ) {
	window.onload = function() { halfbaked() };
}
else {
	window.onload = function() { oldonload(); halfbaked() };
}

function halfbaked() {

	/* Scriptaculous Accordion */

	if ($("half-baked-accordion")) {
		$("half-baked-accordion").visualEffect("accordian", { headingSelector: "h3", sectionSelector: "div.widget_content" });
	}

	/* Scriptaculous Slider */

	if ($("postmeta_slider")) {
		$("postmeta_slider").hide();
		$("postmeta_toggle").onclick = function() { new Effect.toggle($("postmeta_slider"), "blind", { duration: 0.5 }); return false; }
	}

}