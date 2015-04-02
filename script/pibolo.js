$(document).ready(function () {

	initPath();
	arraySections = [];
	$('.wrapper > div').each(function () {
		arraySections.push($(this).attr('class'));
	});
	isAnimating = false;
	var dureeAnim = 1000;

	$('.redirectA').click(function() {
		$('html, body').animate(".a");
	});
	$('.redirectB').click(function() {
		$('html, body').animate(".b");
	});


	var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
	};

	if (isMobile.any())
	{
	    window.location.replace("http://cv.brainsnotdead.com/mobile/");
	}


	$('.diapoReals img').click(function (e) {
		e.preventDefault();
		unbindScroll();

		var activeLi = $(this).parent();
		var index = activeLi.parent().children().index(activeLi);

		$('<div>', {'class': 'diapoContainer'})
		.load('popin.html .container', function () {
			$('#iview').iView({
					pauseTime: 10000,
					directionNav: false,
					controlNav: true,
					tooltipY: -15,
					startSlide: index
				});

			$('<div>', {class : 'diapoDismisser'}).prependTo($('.diapoContainer'));
			$('<div>', {class : 'close'}).prependTo($('.container'));
		})
		.css({opacity:0})
		.appendTo($('body'))
		.animate({opacity:1}, 2000);
	});

	$(document).on("click", '.diapoDismisser,.close',function() {
		$('.diapoContainer').fadeOut(1000, function () {
			$(this).remove();
			$('.diapoDismisser').remove();
			bindScroll();
		});
	});

	function bindScroll(){
		$(document).on({"mousewheel": handleScroll,
					"DOMMouseScroll": ("onmousewheel" in document) ? null : handleScroll});	
	}
	
	function unbindScroll(){
		$(document).off("mousewheel").off("DOMMouseScroll");
	}

	function goToDiv (name) {
		if (isAnimating)
			return;
		else
			isAnimating = true;
		window.location.hash = '#'+name;
		$(".wrapper > div").filter(":visible");

		$.fn.scrollPath("scrollTo", name, dureeAnim, "easeInOutSine",function(){
			isAnimating = false;

			var className=window.location.hash.replace("#", "");
			$('.' + className).fadeIn(2000);
		});
	}	

	function checkForHashInURL () {
		
		if (window.location.hash != ""){
			
			var hash=window.location.hash.replace("#", "");

			
			if (arraySections.indexOf(hash) > 0){
			       
				goToDiv(hash);
			}
                      
		}
	}
	
	$("nav").find("a").each(function() {
		var target = $(this).attr("href").replace("#", "");

		$(this).click(function(e) {
			if (isAnimating)
				e.preventDefault();
			if (target != window.location.hash.replace("#", "")) {
				goToDiv(target);
			}
		});
	});

	bindScroll();
	/* ===================================================================== */
	function handleScroll (event) {

		var currentSection = window.location.hash.replace('#', "");

		if (currentSection == "")
			currentSection = "pres";

		var currentIndex = arraySections.indexOf(currentSection);
		
		var nextIndex;
		if (event.originalEvent.wheelDelta >= 0) {
			nextIndex = (currentIndex -1) < 0 ? arraySections.length -1 : currentIndex-1;
		}
		else {
			nextIndex = (currentIndex +1) >= arraySections.length ? 0 : currentIndex+1;
		}

		var nextSection = arraySections[nextIndex];

	    goToDiv(nextSection);
	    
	}
	checkForHashInURL();
});

function initPath() {
	$.fn.scrollPath("getPath")
		// Move to 'start' element
		.moveTo(400, 300, {name: "pres"})
		// Line to 'description' element
		.arc(400, 1600, 1300, -Math.PI/2, 0, false, {name: "reals"})
		//2000,1600
		.arc(400, 1600, 1300, 0, Math.PI/2, false)		
		.lineTo(-100, 2900, {name: "nextreals"}) 
		.arc(400, 2900, 800, Math.PI, Math.PI/2, true)
		.arc(400, 4500, 800, -Math.PI/2, 0, false, {rotate: Math.PI/2, name: "contact"})
		.lineTo(400, 300, {rotate: 0});

	$(".wrapper").scrollPath({drawPath: false, wrapAround: true});
}