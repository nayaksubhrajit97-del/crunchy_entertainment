( function( api ) {

	// Extends our custom "grand-hotel" section.
	api.sectionConstructor['grand-hotel'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );