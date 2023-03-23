import Testimonial from './modules/testimonial-new';
import LessonVideo from './modules/lessonVideo';
import LessonPDF from './modules/lessonPDF';
import LessonGallery from './modules/lessonGallery';
import { Tooltip, Toast, Popover } from 'bootstrap';
import Cookies from 'js-cookie';
const Isotope = require('isotope-layout');

var lessonVideo = new LessonVideo();
var lessonPDF = new LessonPDF();
var lessonGallery = new LessonGallery();
var bodyElement = document.querySelector('body'); 
if ( bodyElement.classList.contains('home') || bodyElement.classList.contains('about') ) { 
	var testimonial = new Testimonial();  
}

var data = {
	'root_url'    : coachingData.root_url, 
	'api_url'     : coachingData.api_url,
	'api_nonce'   : coachingData.api_nonce,
	'currentpage' : coachingData.page,
	'bannerimg'   : coachingData.bannerimg,
  }; 
console.log(coachingData.bannerimg);
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
if ( tooltipTriggerList ) { 
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new Tooltip(tooltipTriggerEl)
	});
}

var filtersElem = document.querySelector('.filters-button-group');
 
if (filtersElem) {
 
	// init Isotope was .gridlayout
	const iso = new Isotope( '.gridlayout', {
		// options
		 itemSelector: '.grid-item',
			layoutMode: 'fitRows',
			//resize: true, 
	});   
	 
	// filter functions
	var filterFns = {
	};
	// bind filter button click
	var filtersElem = document.querySelector('.filters-button-group');
	filtersElem.addEventListener( 'click', function( event ) {
		// only work with buttons
		if ( !event.target.matches( 'button' ) ) {
			return;
		}
		var filterValue = event.target.getAttribute('data-filter');
		// use matching filter function
		filterValue = filterFns[ filterValue ] || filterValue;
		iso.arrange({ filter: filterValue });
	 
		
	});
	// change is-checked class on buttons
	var buttonGroups = document.querySelectorAll('.button-group');
	for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
		var buttonGroup = buttonGroups[i];
		radioButtonGroup( buttonGroup );
	}
	
	function radioButtonGroup( buttonGroup ) {
		buttonGroup.addEventListener( 'click', function( event ) {
			// only work with buttons
			if ( !event.target.matches( 'button' ) ) {
				return;
			}
			buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
			event.target.classList.add('is-checked');
		});
	} 
	
var list = document.getElementById('blog-list'); 

 
const layoutToggle = document.querySelectorAll('.switch-input');
		
var list = document.getElementById('blog-list'); 
 
 
	let lastValue = '';
 
		for ( var i=0; i < layoutToggle.length; i++ ) {       
		 
			layoutToggle[i].addEventListener("click", function (e) {
				
				if (this.value !== lastValue) { 
					
					if ( list.getAttribute( 'data-layout' ) == 'grid' ) {
						 if (list.getAttribute( 'data-layout' ) !== this.value) {
							list.setAttribute( 'data-layout', 'list' );
							iso.layout('fitRows');
							iso.arrange();
						}
					}
					// this value grid last value list current attribute is list 
					if ( list.getAttribute( 'data-layout' ) == 'list' ) {
						 if (list.getAttribute( 'data-layout' ) !== this.value) {
							list.setAttribute( 'data-layout', 'grid' );
							iso.layout('fitrows');
							iso.arrange();
						}
					}    
			}
			lastValue = this.value;    
	 
			});
			
		} 

} 

( function() {

	const offcanvasToggle = document.querySelectorAll('[data-bs-toggle="offcanvas-collapse"]');
	const offcanvasCollapse = document.querySelector('.offcanvas-collapse');
	if ( ! offcanvasToggle ) {
			return;
	}
	if ( ! offcanvasCollapse ) {
			return;
	}
	for ( var i=0; i < offcanvasToggle.length; i++ ) {
		var toggleButtons = offcanvasToggle[i];

		toggleButtons.addEventListener("click", function () {
			offcanvasCollapse.classList.toggle("open");
		})
 }
}() );
 ( function() {
	const navbarToggler = document.getElementsByClassName('navbar-toggler');
 
	if (navbarToggler[0]) {
		navbarToggler[0].addEventListener('click', function (event) {
			event.preventDefault();
			var span = navbarToggler[0].getElementsByTagName('span');  
			span[0].classList.toggle('menu-open');
			span[0].classList.toggle('menu-open-spin');
			span[0].classList.toggle('menu-close');
			span[0].classList.toggle('menu-close-spin');
		});
	}
}() );

( function() {
// bind a click event to the 'u-skip-link' link for accessibility
	// https://www.bignerdranch.com/blog/web-accessibility-skip-navigation-links/
	let skipLinks = document.querySelector('.skip-link');
	if(! skipLinks) {
		return;
	}
		skipLinks.addEventListener("click", function (event) {
			event.preventDefault();
			// strip the leading hash and declare
			// the content we're skipping to
			let skipTo = document.querySelectorAll('#');
			skipTo.hash = event.target.getAttribute('href').split('#')[1];
			//var skipTo="#"+this.href.split('#')[1];

			// Setting 'tabindex' to -1 takes an element out of normal 
			// tab flow but allows it to be focused via javascript
			skipTo.setAttribute('tabindex', -1).addEventListener("blur, focusout", function () {
				
					// when focus leaves this element, 
					// remove the tabindex attribute
					this.removeAttribute('tabindex');

			}).focus(); // focus on the content container
	})
})();


 
const cookie = document.getElementById('cookie-notice');
const cookieButton = document.getElementById('cookie-notice-accept-cookie');  
 
if (Cookies.get('wr_visit_time')) {
	 
	cookie.classList.remove('visible');
		
 }
if (cookieButton) {   
	cookieButton.addEventListener("click", (e) => {
		e.preventDefault();
		cookie.classList.remove('visible'); 
		Cookies.set('wr_visit_time', 'cookie-accepted', 
				{ secure: true }, 
				{ sameSite: 'strict' }, 
				{  path: '/' });  
	});
}
// let landing = document.getElementById('landing');
// let selectHeader = document.getElementById('main-nav');
// if ( landing ) {
//   selectHeader.classList.remove('fixed-top');
//   landing.classList.add('newheight');
//   landing.classList.remove('noheight');
//   change_text();
// }
 
// window.onload = () => {
window.addEventListener('load', () => {
 
	let landingdiv = document.querySelector('#hidden-div');
	let body = document.querySelector ('body');
	let mainnav = document.querySelector('#main-nav');
	if (Cookies.get('wr_landing_displayed')) {
	 
		return;
			
	} 
	if ( landingdiv ) {
			 
		setTimeout( new_slide, 6000);
		
		function new_slide() {
			landingdiv.classList.toggle('open');
			
			landingdiv.insertAdjacentHTML(
				"beforeend",
				`
				<div id="landing" class="container container--landing">
					<div class="row">
						<div class="col-12 col-lg-6">
							<img src="http://localhost/deliberatedoing/wp-content/themes/workroom1128/dist/img/banner-book.jpg" alt="Step by Step Guide sample pages">
						</div>
						<div class="col-12 col-lg-6">
							<h2>A simple step-by-step guide.</h2>
							<h3>Manage your career - expectations, purpose and happiness.</h3>
							<ul class="checkmark" >
								<li>Part 1. Learn to gauge what "reasonable expectations" should look like.</li>
								<li>Part II. Use the 3 pillars of Service, Development, and Legacy to help you generate purpose in your career, whether you're staying put or looking to move on.<br>
								These pillars are applicable whether you are happily employed, miserably employed, or not employed at all!
								</li>
								<li>Part III. Learn to depend on yourself for happiness through personal growth.</li>
							</ul>
							<button id="continue" class="btn btn-primary">Continue</button>
						</div>
					</div>	
				</div>
				`
			);
			body.classList.toggle('overflow');
			mainnav.classList.toggle('fixed-top');
			let button = document.querySelector('#continue');
			console.log(button);
			if (button) {
				button.addEventListener('click', function (event) {
					event.preventDefault();
					landingdiv.classList.toggle('open');
					body.classList.toggle('overflow');
					mainnav.classList.toggle('fixed-top');
					Cookies.set('wr_landing_displayed', 'cookie-accepted', 
						{ secure: true }, 
						{ sameSite: 'strict' }, 
						{  path: '/' }
					);
				});
			}
		}
	}
});	

( function() {
	
	"use strict";
	
	/**
	 * Easy selector helper function
	 */
	const select = (el, all = false) => {
		el = el.trim()
		if (all) {
		return [...document.querySelectorAll(el)]
		} else {
		return document.querySelector(el)
		}
	}
	
 
	/**
	 * Easy event listener function
	 */
	const on = (type, el, listener, all = false) => {
		let selectEl = select(el, all)
		if (selectEl) {
			if (all) {
				selectEl.forEach(e => e.addEventListener(type, listener))
			} else {
				selectEl.addEventListener(type, listener)
			}
		}
	}
	
	
 

	/**
	 * Easy on scroll event listener 
	 */
	const onscroll = (el, listener) => {
		el.addEventListener('scroll', listener)
	}
	
	/**
	 * Toggle .scrolled class to #topbar and #bottombar when page is scrolled
	 */
	 
	//let selectHeader = select('#main-nav');  
	// let selectTop = select('#topbar');
	// if (selectHeader) {
	// 	const headerScrolled = () => {  
	// 		if (window.scrollY > 1) {
	// 		//	selectHeader.classList.add('fixed-top');
			
	// 		} else {
	// 		//	selectHeader.classList.remove('fixed-top');
				
	// 		}
	// 	}
	// 	window.addEventListener('load', headerScrolled)
	// 	onscroll(document, headerScrolled)
	// }
 
	
	/**
	 * Back to top button
	 */
	let backtotop = select('.back-to-top')
	if (backtotop) {
		const toggleBacktotop = () => {
		if (window.scrollY > 100) {
			backtotop.classList.add('active')
		} else {
			backtotop.classList.remove('active')
		}
		}
		window.addEventListener('load', toggleBacktotop)
		onscroll(document, toggleBacktotop)
	}
	
	/**
	 * Scrolls to an element with header offset
	 */
	 const scrollto = (el) => {
		let header = select('#main-nav')
		let offset = header.offsetHeight

		let elementPos = select(el).offsetTop
		window.scrollTo({
			top: elementPos - offset,
			behavior: 'smooth'
		})
	}
	/**
	 * Scroll with offset on links with a class name .scrollto
	 */
	
	on('click', '.scrollto', function(e) {
		if (select(this.hash)) {
		e.preventDefault()
	
		let navbar = select('#navbar');
		scrollto(this.hash)
		}
	}, true)
	
	/**
	 * Scroll with ofset on page load with hash links in the url
	 */
	window.addEventListener('load', () => {
		if (window.location.hash) {
			if (select(window.location.hash)) {
				scrollto(window.location.hash)
			}
		}
	});
})();

	/**
	 * Popup modal for book give-away. The animation effect of this component is dependent on the prefers-reduced-motion media query. https://getbootstrap.com/docs/5.2/getting-started/accessibility/#reduced-motion.
	 */
	 
	//  var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
	//   keyboard: false, focus:true
	// })
	//  if (myModal) {
	//   myModal.addEventListener('shown.bs.modal', () => {
	//     myInput.focus()
	//   })
	// }
/* Accordion arrow */
// const accordionButtons = document.querySelectorAll('.accordion-button');  

// this.accordionButtons.forEach(el => {
//   el.addEventListener("click", (e) => {
//     e.preventDefault();
//     if(this.e.attr('aria-expanded', 'true')) {

//     }

		
//   });
// });


// $(document).on( function() {
 // let imagesLoaded = require('imagesloaded'); 
	// var $grid2 = $('.container-images').imagesLoaded( function() {
	//   $grid2.masonry({
	// 	itemSelector: '.grid-item',
	// 	// "horizontalOrder": true,
	//   "columnWidth": 250,
	//   // "gutter": 10,
	//   "isFitWidth": true,
	// 	// percentPosition: true
	//   });
	// });
	// var $grid = $('.grid').isotope({
	//   // main isotope options
	//   percentPosition: true,
	//   itemSelector: '.grid-item',
	//   // set layoutMode
	//   layoutMode: 'masonry',
	//   resize:true,
	//   // options for masonry layout mode
	//   masonry: {
	//     columnWidth: '.grid-sizer',
	//     "gutter": 10, 
	//   }
	// })
	
	
	// $('.grid').masonry({
	//   percentPosition: true,
	//   itemSelector: '.grid-item',
	//   resize:true,
	//   columnWidth: '.grid-sizer',
	//   gutter: 20
	// });

	// $('.grid').masonry({
	//   itemSelector: '.grid-item',
	//   columnWidth: 160,
	//   gutter: 20
	// });
// }); 
