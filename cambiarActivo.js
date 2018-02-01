var selector = '#topheader';
$(selector).on( 'click', function () {
	$('li.active').removeClass( 'active' );
	$(selector).addClass( 'active' );
});
