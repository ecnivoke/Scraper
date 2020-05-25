
function test(){
	$('h1').click(function(){
		$('.container').hide();
	});
}

$(document).ready( function(){
	// Call functions
	test();
});
