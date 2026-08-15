/**
 * homeiliora — light / dark theme toggle.
 *
 * The site always starts light. Clicking the header button stores an explicit
 * choice in localStorage, and dark applies only once that choice is dark; the
 * operating system's preference is not consulted anywhere.
 * Applying the stored choice is NOT this file's job — an inline snippet in
 * <head> does that before first paint (see moodboard_theme_no_flash_script in
 * functions.php), so a reader who chose dark never sees a flash of light. This
 * file only wires the button, keeps its label honest, and syncs other tabs.
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
	/**
	 * The theme actually on screen right now.
	 *
	 * Light unless the reader has explicitly chosen dark. The operating
	 * system's preference is deliberately not consulted: dark.css has no
	 * prefers-color-scheme rule, so reading it here would report "dark" on a
	 * dark-themed machine while the page in front of the reader was light.
	 */
	function active() {
		return root.getAttribute( 'data-theme' ) === 'dark' ? 'dark' : 'light';
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
