var ww = document.body.clientWidth;
$(document).ready(function() {
	/*$(".nav li a span").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})*/
	var i=0;
	$(".toggleMenu").click(function(e) {
		i++;
		if(i%2==0)
		{
			$(".rmenu").css("height","40px");
		}
		else
		{
			$(".rmenu").css("height","auto");
		}
		e.preventDefault();
		$(this).toggleClass("active");
		$(".nav").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 769) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".nav").hide();
		} else {
			$(".nav").show();
		}
		$(".nav li").unbind('mouseenter mouseleave');
		$(".nav li .parent").unbind('click').bind('click', function(e) {
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 769) {
		$(".toggleMenu").css("display", "none");
		$(".nav").show();
		$(".nav li").removeClass("hover");
		$(".nav li a").unbind('click');
		$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	$(this).toggleClass('hover');
		});
	}
}

