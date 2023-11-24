( function( api ) {

	// Extends our custom "xolo" section.
	api.sectionConstructor['erapress'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );