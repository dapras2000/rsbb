window.observe('load', function() {
	$$(".dropdown li").each( function(li) {
		li.observe("mouseover", function(e) {
			li.addClassName("hover");
			li.down("ul").setStyle( {
				visibility: "visible"
			});
		});
		li.observe("mouseout", function(e) {
			li.removeClassName("hover");
			li.down("ul").setStyle( {
				visibility: "hidden"
			});
		});
	});
});