/**
 * homeiliora — Pinterest "Save" hover button on images.
 * Adds a Pin-It overlay to content, hero, and card images so a single
 * Pinterest visitor can re-pin without hunting for a share button.
 */
( function () {
	'use strict';

	var SELECTORS = [
		'.wp-block-post-content img',
		'.single-post__hero img',
		'.moodboard-card__image img',
		'.wp-block-post-featured-image img',
	];

	function pinUrl( pageUrl, mediaUrl, description ) {
		return 'https://www.pinterest.com/pin/create/button/?url=' +
			encodeURIComponent( pageUrl ) +
			'&media=' + encodeURIComponent( mediaUrl ) +
			'&description=' + encodeURIComponent( description || document.title );
	}

	function decorate( img ) {
		if ( ! img || img.dataset.pinit === '1' ) {
			return;
		}
		// Skip tiny images (icons, avatars, logos).
		var w = img.naturalWidth || img.width || 0;
		if ( w && w < 200 ) {
			return;
		}
		var host = img.closest( 'figure' ) || img.parentElement;
		if ( ! host ) {
			return;
		}
		img.dataset.pinit = '1';
		host.classList.add( 'has-pinit' );

		var media = img.currentSrc || img.src;
		var desc = img.getAttribute( 'alt' ) || document.title;

		var btn = document.createElement( 'a' );
		btn.className = 'pinit-btn';
		btn.href = pinUrl( window.location.href, media, desc );
		btn.target = '_blank';
		btn.rel = 'noopener nofollow';
		btn.setAttribute( 'aria-label', 'Save this image to Pinterest' );
		// Icon only. The label lives in aria-label and the title tooltip — a
		// text pill this size covered a third of the card.
		btn.title = 'Save to Pinterest';
		btn.innerHTML =
			'<svg class="pinit-btn__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' +
			'<path d="M12 2a10 10 0 0 0-3.6 19.3c-.1-.8-.2-2 0-2.9l1.2-5s-.3-.6-.3-1.5c0-1.4.8-2.4 1.8-2.4.9 0 1.3.6 1.3 1.4 0 .9-.6 2.2-.9 3.4-.2 1 .5 1.9 1.5 1.9 1.9 0 3.2-2.4 3.2-5.2 0-2.1-1.5-3.7-4.1-3.7-3 0-4.8 2.2-4.8 4.6 0 .9.3 1.5.7 2 .2.2.2.3.1.5l-.2.8c0 .3-.2.4-.5.2-1.3-.5-1.9-2-1.9-3.6 0-2.7 2.3-5.9 6.8-5.9 3.6 0 6 2.6 6 5.4 0 3.7-2.1 6.5-5.1 6.5-1 0-2-.6-2.3-1.2l-.6 2.5c-.2.8-.7 1.7-1.1 2.3A10 10 0 1 0 12 2z"/>' +
			'</svg>';
		host.appendChild( btn );
	}

	function run() {
		var imgs = document.querySelectorAll( SELECTORS.join( ',' ) );
		Array.prototype.forEach.call( imgs, decorate );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', run );
	} else {
		run();
	}
} )();
