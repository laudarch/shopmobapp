$(document).ready(function(){
	$('a.top').click(function() {
		event.preventDefault();
		$(document).scrollTop(0);
	});
});