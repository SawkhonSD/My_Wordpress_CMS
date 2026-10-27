/**
 * Warta Nusa - interaksi dasar: menu seluler dan tombol kembali ke atas.
 */
( function () {
	'use strict';

	// Toggle menu seluler.
	var toggle = document.querySelector( '.menu-toggle' );
	var menu = document.getElementById( 'primary-menu' );

	if ( toggle && menu ) {
		toggle.addEventListener( 'click', function () {
			var open = menu.classList.toggle( 'toggled' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );
	}

	// Tombol kembali ke atas.
	var topBtn = document.querySelector( '.back-to-top' );
	if ( topBtn ) {
		window.addEventListener( 'scroll', function () {
			topBtn.classList.toggle( 'visible', window.scrollY > 600 );
		}, { passive: true } );
		topBtn.addEventListener( 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}
}() );
