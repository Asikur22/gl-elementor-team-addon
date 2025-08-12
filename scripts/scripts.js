;(
	function ( $ ) {
		$( window ).on( "elementor/frontend/init", function () {
			elementorFrontend.hooks.addAction( "frontend/element_ready/gl-ele-team.default", function ( scope, $ ) {
				var element = $( scope ).find( '.swiper-container' );
				var options = element.data( 'settings' );
				
				if ( options.nav != false ) {
					options.nav = {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					}
				}
				
				if ( options.dots != false ) {
					options.dots = {
						el: '.swiper-pagination',
						type: 'custom',
						clickable: true,
						renderCustom: function ( swiper, current, total ) {
							return '<b>' + current + '</b> / ' + total;
						}
					}
				}
				
				if ( options.autoplay != false ) {
					options.autoplay = {
						delay: options.autoplayTimeout
					}
				}
				
				if ( options ) {
					new Swiper( element, {
						slidesPerView: options.items,
						spaceBetween: options.margin.size,
						loop: options.loop,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						pagination: options.dots,
						autoplay: options.autoplay,
						disableOnInteraction: options.autoplayHoverPause
					} );
				}
				
				console.log( options );
			} );
		} )
	}
)( jQuery );