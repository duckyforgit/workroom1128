/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 *
 * http://cssmenumaker.com/blog/wordpress-3-drop-down-menu-tutorial/
 */
( function() {
	const header = document.getElementById( 'masthead');
	const siteNavigation = document.getElementById( 'mobile-nav' );


const button = document.querySelector('#mobile-click');
const msg = document.querySelector('#mobile-nav');

let aria = button.getAttribute( 'aria-expanded');
	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}
    const mobileBar = document.getElementById( 'mobile-bar');
	//const button = document.getElementById( 'mobile-click' );

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];
 
	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}
// button.addEventListener('click', ()=>{


//   msg.classList.toggle('reveal');
// })
	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', ()=> {
		//console.log(button);
		// alert('button clicked');
		//siteNavigation.classList.toggle( 'toggled' );
	
     var ul =    menu.getElementsByTagName("ul");
// console.log(button.getAttribute( 'aria-expanded' ));
   
  //document.getElementsByTagName("button")[0].setAttribute("class", "democlass");  
   
  //var aria = btn.getAttribute("aria-expanded");
   
  //btn.setAttribute("aria-expanded", "true" );
 //siteNavigation.classList.add("toggled");
		 if ( button.getAttribute( 'aria-expanded' ) == 'false' ) {
			 
		 	button.setAttribute( 'aria-expanded', 'true' );
		 	siteNavigation.classList.add( 'open' );
		 } else {
			 
			button.setAttribute( 'aria-expanded', 'false' );
			siteNavigation.classList.remove( 'open' );
		 }
	} );

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			//siteNavigation.classList.remove( 'toggled' );
			//button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( let link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
		//const url = link.attr('href');
		console.log(link);
        	//window.location = link;
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( let link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
		//const url = link.attr('href');
		console.log(link);
        	// window.location = link;
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( type === 'focus' || type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( type === 'touchstart' ) {
			const menuItem = this.parentNode;
			preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}
}() );
