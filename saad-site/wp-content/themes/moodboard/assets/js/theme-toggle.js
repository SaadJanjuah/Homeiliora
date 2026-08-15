/**
 * homeiliora — light / dark theme toggle.
 *
 * The default is whatever the visitor's device asks for; clicking the header
 * button stores an explicit choice in localStorage that overrides it from then
 * on, in either direction.
 * Applying the stored choice is NOT this file's job — an inline snippet in
 * <head> does that before first paint (see moodboard_theme_no_flash_script in
 * functions.php), so the page never flashes the wrong theme. This file only
 * wires the button, keeps its label honest, and syncs other tabs.
 */
( function () {
	'use strict';

	var KEY = 'homeiliora_theme_v1';
	var root = document.documentElement;

	function stored() {
		try {
			var v = localStorage.getItem( KEY );
			return ( v === 'dark' || v === 'light' ) ? v : null;
		} catch ( e ) {
			return null;
		}
	}
	function store( mode ) {
		try {
			localStorage.setItem( KEY, mode );
		} catch ( e ) {}
	}
	function devicePrefersDark() {
		return !! ( window.matchMedia && window.matchMedia( '( prefers-color-scheme: dark )' ).matches );
	}

	/**
	 * The theme actually on screen right now.
	 *
	 * An explicit choice wins; with none stored, the device decides — which
	 * has to match dark.css exactly, or the button would label and paint
	 * itself for a theme the reader isn't looking at.
	 */
	function active() {
		var explicit = root.getAttribute( 'data-theme' );
		if ( explicit === 'dark' || explicit === 'light' ) {
			return explicit;
		}
		return devicePrefersDark() ? 'dark' : 'light';
	}

	function paint() {
		var isDark = active() === 'dark';
		var buttons = document.querySelectorAll( '.theme-toggle' );
		Array.prototype.forEach.call( buttons, function ( btn ) {
			btn.setAttribute( 'aria-pressed', isDark ? 'true' : 'false' );
			btn.setAttribute( 'title', isDark ? 'Switch to light theme' : 'Switch to dark theme' );
		} );
	}

	function apply( mode ) {
		root.setAttribute( 'data-theme', mode );
		paint();
	}

	function init() {
		var buttons = document.querySelectorAll( '.theme-toggle' );
		if ( ! buttons.length ) {
			return;
		}
		Array.prototype.forEach.call( buttons, function ( btn ) {
			btn.addEventListener( 'click', function () {
				var next = active() === 'dark' ? 'light' : 'dark';
				store( next );
				apply( next );
			} );
		} );
		paint();

		// Follow the device while the reader has not picked a side themselves.
		// Only the button needs repainting — the CSS media query has already
		// re-coloured the page by the time this fires.
		if ( window.matchMedia ) {
			var mq = window.matchMedia( '( prefers-color-scheme: dark )' );
			var onChange = function () {
				if ( ! stored() ) {
					paint();
				}
			};
			if ( mq.addEventListener ) {
				mq.addEventListener( 'change', onChange );
			} else if ( mq.addListener ) {
				mq.addListener( onChange );
			}
		}

		// Keep other open tabs in step.
		window.addEventListener( 'storage', function ( e ) {
			if ( e.key !== KEY ) {
				return;
			}
			var v = stored();
			if ( v ) {
				apply( v );
			} else {
				root.removeAttribute( 'data-theme' );
				paint();
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
