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
		btn.innerHTML = '<span class="pinit-btn__icon" aria-hidden="true">P</span> Pin it';
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
