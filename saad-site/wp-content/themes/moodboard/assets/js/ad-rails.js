/**
 * homeiliora — keep the sticky ad rails off the hero photograph.
 *
 * The rails are position:fixed and vertically centred, so once the hero went
 * full-bleed they began floating over the photograph near the top of the
 * homepage. An ad unit sitting on top of the hero image looks broken and is
 * the kind of placement ad networks object to.
 *
 * They are hidden while any part of the hero is on screen and fade back in
 * once it has scrolled away. Pages without a hero are untouched, and if
 * IntersectionObserver is unavailable the rails simply behave as before.
 */
( function () {
	'use strict';

	var hero = document.querySelector( '.home-hero' );
	var rails = document.querySelectorAll( '.ad-rail' );

	if ( ! hero || ! rails.length || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	function setHidden( hidden ) {
		Array.prototype.forEach.call( rails, function ( rail ) {
			rail.classList.toggle( 'ad-rail--behind-hero', hidden );
		} );
	}

	// Hidden from the outset: the hero is on screen when the page loads, and
	// waiting for the first callback would let the rails flash over it.
	setHidden( true );

	new IntersectionObserver( function ( entries ) {
		setHidden( entries[ 0 ].isIntersecting );
	}, { threshold: 0 } ).observe( hero );
} )();
