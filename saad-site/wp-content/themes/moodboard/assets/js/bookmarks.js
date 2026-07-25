/**
 * homeiliora — client-side bookmarks ("Saved").
 * No account needed: saved posts live in localStorage. Powers the single-post
 * "Save this idea" toggle, a save button on every card, the nav count badge,
 * and the /saved/ page listing.
 */
( function () {
	'use strict';

	var KEY = 'homeiliora_saved_v1';

	function read() {
		try {
			var v = JSON.parse( localStorage.getItem( KEY ) );
			return Array.isArray( v ) ? v : [];
		} catch ( e ) {
			return [];
		}
	}
	function write( arr ) {
		try {
			localStorage.setItem( KEY, JSON.stringify( arr ) );
		} catch ( e ) {}
	}
	function indexOf( arr, url ) {
		for ( var i = 0; i < arr.length; i++ ) {
			if ( arr[ i ].url === url ) {
				return i;
			}
		}
		return -1;
	}
	function isSaved( url ) {
		return indexOf( read(), url ) !== -1;
	}
	function toggle( item ) {
		var arr = read();
		var i = indexOf( arr, item.url );
		if ( i !== -1 ) {
			arr.splice( i, 1 );
		} else {
			arr.unshift( item );
		}
		write( arr );
		refresh();
		return i === -1; // true if it is now saved
	}
	function removeUrl( url ) {
		var arr = read();
		var i = indexOf( arr, url );
		if ( i !== -1 ) {
			arr.splice( i, 1 );
			write( arr );
			refresh();
		}
	}

	function absUrl( href ) {
		try {
			return new URL( href, window.location.origin ).href;
		} catch ( e ) {
			return href;
		}
	}
	function meta( prop ) {
		var el = document.querySelector(
			'meta[property="' + prop + '"], meta[name="' + prop + '"]'
		);
		return el ? el.getAttribute( 'content' ) : '';
	}

	/* ---- Nav count badge ---------------------------------------------- */
	function updateNav() {
		var n = read().length;
		var links = document.querySelectorAll( 'a[href$="/saved/"], a[href$="/saved"]' );
		Array.prototype.forEach.call( links, function ( a ) {
			var badge = a.querySelector( '.saved-badge' );
			if ( ! badge ) {
				badge = document.createElement( 'span' );
				badge.className = 'saved-badge';
				a.appendChild( badge );
			}
			badge.textContent = n ? String( n ) : '';
			badge.style.display = n ? '' : 'none';
		} );
	}

	/* ---- Single-post "Save this idea" toggle -------------------------- */
	function currentPost() {
		var canon = document.querySelector( 'link[rel="canonical"]' );
		var titleEl = document.querySelector( '.wp-block-post-title' );
		var nicheEl = document.querySelector( '.single-post__niche a, .single-post__niche' );
		return {
			url: absUrl( canon ? canon.href : window.location.href ),
			title: ( titleEl ? titleEl.textContent : ( meta( 'og:title' ) || document.title ) ).trim(),
			img: meta( 'og:image' ),
			niche: nicheEl ? nicheEl.textContent.trim() : '',
			ts: 0,
		};
	}
	function wireSingle() {
		if ( ! document.body.classList.contains( 'single' ) ) {
			return;
		}
		var btn = document.querySelector( '.single-post__pin a' );
		if ( ! btn ) {
			return;
		}
		var item = currentPost();
		function paint() {
			var saved = isSaved( item.url );
			btn.textContent = saved ? 'Saved ✓' : 'Save this idea';
			btn.classList.toggle( 'is-saved', saved );
			btn.setAttribute( 'aria-pressed', saved ? 'true' : 'false' );
		}
		btn.setAttribute( 'role', 'button' );
		btn.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			item.ts = Date.now();
			toggle( item );
			paint();
		} );
		paint();
	}

	/* ---- Save button on every card ------------------------------------ */
	function cardItem( card ) {
		var link = card.querySelector( '.wp-block-post-title a' ) ||
			card.querySelector( '.moodboard-card__image a' );
		var titleEl = card.querySelector( '.wp-block-post-title' );
		var img = card.querySelector( '.moodboard-card__image img' );
		var nicheEl = card.querySelector( '.moodboard-card__niche a, .moodboard-card__niche' );
		if ( ! link ) {
			return null;
		}
		return {
			url: absUrl( link.getAttribute( 'href' ) ),
			title: ( titleEl ? titleEl.textContent : link.textContent ).trim(),
			img: img ? ( img.currentSrc || img.src ) : '',
			niche: nicheEl ? nicheEl.textContent.trim() : '',
			ts: 0,
		};
	}
	function wireCards() {
		var cards = document.querySelectorAll( '.moodboard-card' );
		Array.prototype.forEach.call( cards, function ( card ) {
			if ( card.dataset.savewired === '1' ) {
				return;
			}
			var item = cardItem( card );
			if ( ! item ) {
				return;
			}
			card.dataset.savewired = '1';
			var host = card.querySelector( '.moodboard-card__image' ) || card;
			host.classList.add( 'has-savebtn' );
			var btn = document.createElement( 'button' );
			btn.type = 'button';
			btn.className = 'save-btn';
			function paint() {
				var saved = isSaved( item.url );
				btn.classList.toggle( 'is-saved', saved );
				btn.setAttribute( 'aria-pressed', saved ? 'true' : 'false' );
				btn.setAttribute( 'aria-label', saved ? 'Remove from saved' : 'Save this idea' );
				btn.innerHTML = saved ? '✓ Saved' : '+ Save';
			}
			btn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				e.stopPropagation();
				item.ts = Date.now();
				toggle( item );
			} );
			paint();
			btn._paint = paint;
			host.appendChild( btn );
		} );
	}
	function repaintCards() {
		document.querySelectorAll( '.save-btn' ).forEach( function ( b ) {
			if ( b._paint ) {
				b._paint();
			}
		} );
	}

	/* ---- /saved/ page listing ----------------------------------------- */
	function renderSaved() {
		var app = document.getElementById( 'saved-app' );
		if ( ! app ) {
			return;
		}
		var arr = read();
		if ( ! arr.length ) {
			app.innerHTML =
				'<div class="saved-empty">' +
				'<p class="saved-empty__title">Nothing saved yet.</p>' +
				'<p class="saved-empty__text">Tap <strong>Save</strong> on any idea and it will show up here — stored on this device, no account needed.</p>' +
				'<p><a class="wp-block-button__link wp-element-button" href="/">Browse ideas</a></p>' +
				'</div>';
			return;
		}
		var html = '<div class="moodboard-grid">';
		arr.forEach( function ( it ) {
			html +=
				'<div class="moodboard-card">' +
				( it.img
					? '<figure class="moodboard-card__image"><a href="' + esc( it.url ) + '"><img src="' + esc( it.img ) + '" alt="" loading="lazy"/></a></figure>'
					: '' ) +
				'<div class="moodboard-card__body">' +
				( it.niche ? '<p class="moodboard-card__niche saved-card__niche">' + esc( it.niche ) + '</p>' : '' ) +
				'<h3 class="wp-block-post-title"><a href="' + esc( it.url ) + '">' + esc( it.title ) + '</a></h3>' +
				'<button type="button" class="saved-remove" data-url="' + esc( it.url ) + '">Remove</button>' +
				'</div></div>';
		} );
		html += '</div>';
		app.innerHTML = html;
		app.querySelectorAll( '.saved-remove' ).forEach( function ( b ) {
			b.addEventListener( 'click', function () {
				removeUrl( b.getAttribute( 'data-url' ) );
			} );
		} );
	}
	function esc( s ) {
		return String( s || '' ).replace( /[&<>"']/g, function ( c ) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ c ];
		} );
	}

	function refresh() {
		updateNav();
		repaintCards();
		renderSaved();
	}

	function init() {
		wireSingle();
		wireCards();
		updateNav();
		renderSaved();
		// keep in sync across tabs
		window.addEventListener( 'storage', function ( e ) {
			if ( e.key === KEY ) {
				refresh();
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
