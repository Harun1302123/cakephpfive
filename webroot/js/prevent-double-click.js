	$( "form" ).on( "submit", function( e ) {
		$(this).submit(function() {
			return false;
		});
		return true;
	});

	