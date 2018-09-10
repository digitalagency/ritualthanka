app.theme = {

	init: function() {
		this.bindUIActions();
	},

	bindUIActions: function() {
		app.body
			.on( 'click', '.js-gravity-forms-submit', function() {
				$( this ).addClass( 'btn-loading' );
			});

		if ( $( window ).height() > $( '.page-wrapper' ).height() ) {
			$( '.page-wrapper' ).addClass( 'newheight' );
		} else {
			$( '.page-wrapper' ).removeClass( 'newheight' );
		}

		new WOW().init();

		// Messonary
		var $grid = $( '.grid' ).masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			percentPosition: true,
			resize: true,
		});
		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
			$grid.masonry( 'layout' );
		});
	},
};
