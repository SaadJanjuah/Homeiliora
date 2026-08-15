/**
 * homeiliora — keep the sticky ad rails off the hero photograph.
 *
 * The rails are position:fixed and vertically centred, so any full-bleed
 * photographic band runs underneath them — the hero at the top of the
 * homepage, and the "Get Inspired" band below the grid. An ad unit sitting on
 * top of a photograph looks broken and is the kind of placement ad networks
 * object to.
 *
 * They are hidden while any of those bands is on screen and fade back in once
 * all of them have scrolled away. Pages without such a band are untouched, and
 * if IntersectionObserver is unavailable the rails simply behave as before.
 */
( function () {
	'use strict';

	var bands = document.querySelectorAll( '.home-hero, .get-inspired' );
	var rails = document.querySelectorAll( '.ad-rail' );

	if ( ! bands.length || ! rails.length || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	// Tracked per band, because two of them can be on screen at once on a tall
	// window — hiding on one and showing on the other would flicker.
	var visible = new Set();

	function sync() {
		Array.prototype.forEach.call( rails, function ( rail ) {
			rail.classList.toggle( 'ad-rail--behind-hero', visible.size > 0 );
		} );
	}

	// Hidden from the outset: the hero is on screen when the page loads, and
	// waiting for the first callback would let the rails flash over it.
	Array.prototype.forEach.call( rails, function ( rail ) {
		rail.classList.add( 'ad-rail--behind-hero' );
	} );

	var io = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				visible.add( entry.target );
			} else {
				visible.delete( entry.target );
			}
		} );
		sync();
	}, { threshold: 0 } );

	Array.prototype.forEach.call( bands, function ( band ) {
		io.observe( band );
	} );
} )();
