
jQuery(document).ready(function($) {
	$(document).foundation();

	var circles = $('.orbit-bullets-container').clone(true, true);
	$('.slide-content-right').append(circles);
});