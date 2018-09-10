var app = {
	init: function() {
		this.win  = $( window );
		this.doc  = $( document );
		this.body = $( 'body' );

		// Initialize parts and components.
		for ( var name in this ) {

			// Does the part or component have an "init" function?
			if ( 'function' === typeof( this[ name ].init ) ) {

				// Does the part or component have a selector of type "string"?
				if ( 'string' === typeof this[ name ].selector ) {
					var element = $( this[ name ].selector );

					// Does the selector find any elements?
					if ( 0 < element.length ) {

						// If elements was found using the selector,
						// set the "element" property of the part or component to the resulting jQuery object
						// and run the "init" function.
						this[ name ].element = element;

						this[ name ].init();
					}

				} else {

					// If no selector was found, run the "init" function.
					this[ name ].init();
				}
			}
		}

		this.body.addClass( 'is-loaded' );
	},
};

// init
$( function() {
	app.init();
});
