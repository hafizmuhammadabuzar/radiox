// JavaScript Document

//Scroll Up/Down Code
$(document).ready(function($){
	$("a").on('click', function (e) {
		//Only do the smooth scrolling If the link has a hash and the link is pointing to this same page.
		if (this.hash !== "" && this.pathname == window.location.pathname) {
			e.preventDefault();
			
			var target = this.hash;
			var topOffset = 0; //#top should default to 0 so no need to calculate the difference between top and top
		
			if (target != "#top") { //If the target is not "#top", then calculate topOffset 
				var topOffset = $(target).offset().top;
			}
	
			$('html, body').stop().animate({
				'scrollTop': topOffset
			}, 900, 'swing', function () {
				window.location.hash = target;
			});		
		}
	});
});