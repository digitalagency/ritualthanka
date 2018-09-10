app.scrollToTop = {
	init: function( ) {
		this.bindSCActions( );
	},

	bindSCActions: function() {
		$( '.scrollToTop' ).hide( );

		// fade in #back-top
		$( function() {
			$( window ).scroll( function() {
				if ( 100 > $( this ).scrollTop( ) ) {
					$( '.scrollToTop' ).fadeOut( );
				} else {
					$( '.scrollToTop' ).fadeIn( );
				}
			});

			// scroll body to 0px on click
			$( '.scrollToTop' ).click( function( ) {
				$( 'body,html' ).animate({
					scrollTop: 0,
				}, 800 );
				return false;
			});
		});
	},
};
