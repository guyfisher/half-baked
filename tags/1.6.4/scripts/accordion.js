/* 2006 Bruce Williams (http://codefluency.com)
 * MIT license
 * Comments/Improvements Welcome
 */
Effect.Accordian =	function(element) {
  element = $(element);
  var options = Object.extend({
    headingSelector: 'h4',
    sectionSelector: 'div',
    showSection: 1,
    duration: 0.5
  }, arguments[1] || {});

  headings = $$('#'+element.id+' '+options.headingSelector);
  sections = $$('#'+element.id+' '+options.sectionSelector);

  function showSection(section) {
	  if(section.visible()) return false;
    sections.each(function(e){
      if(e == section) {
	      e.visualEffect('blind_down', {duration:options.duration});
	    } else {
		    e.visualEffect('blind_up', {duration:options.duration});
		  }
    })
  }

  headings.each(function(e,index){
	  e.style.cursor = 'pointer';
    e.onclick = function(){ 
	    headings.each(function(h){ h.removeClassName('active'); })
	    this.addClassName('active');
	    showSection(sections[index]); 
	  };
  });

  sections.each(function(s,ind){ 
	  if(!options.showSection || (ind + 1 != options.showSection))
  	  s.hide(); 
    else
      s.show();
	});
  if(options.showSection) {
	  headings[options.showSection - 1].addClassName('active');
  }
}