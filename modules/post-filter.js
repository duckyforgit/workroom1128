/**
 * File post-filter.js.
 *
 * Handles filtering of post categories to display posts on blog home page.
 */
import Isotope from '../modules/isotope.pkgd.min';

( function() {
let body = document.querySelector('body');
if ( !body.classList.contains( 'blog' ) ) { 
	return;
}

 // filter functions
var filterFns = {
};
 
// store filter for each group
var filters = {};
 
var iso = new Isotope( '.grid', {

  itemSelector: '.o-grid-item',
  filter: function( itemElem1, itemElem2 ) {

    var isMatched = true;

    for ( var prop in filters ) {
      var filter = filters[ prop ];
       
      // use function if it matches
      filter = filterFns[ filter ] || filter;
      // test each filter
      var filterType = typeof filter;
      if ( filter && filterType == 'function' ) {
        isMatched = filter( itemElem2 );
      } else if ( filter ) {
       // isMatched = matchesSelector( itemElem2, filter );
        isMatched = itemElem2.matches(filter);
      }
      // break if not matched
      if ( !isMatched ) {
        break;
      }
    }
    
    return isMatched;
  }
  
})

document.querySelector('#filters').addEventListener( 'click', function( event ) {
  // only work with buttons - doesn't work here
  // if ( !matchesSelector( event.target, 'button' ) ) {
  //  return;
  //}
  if ( !event.target.matches('button') ) {
   return;
  }
  // get group key
  var buttonGroup = event.target.parentNode;
  var filterGroup = buttonGroup.getAttribute('data-filter-group');
  // set filter for group
  filters[ filterGroup ] = event.target.getAttribute('data-filter');
  // arrange, and use filter fn
  iso.arrange();
});

// change is-checked class on buttons
var buttonGroups = document.querySelectorAll('.button-group');
for ( var i=0; i < buttonGroups.length; i++ ) {
  var buttonGroup = buttonGroups[i];
  radioButtonGroup( buttonGroup );
}

function radioButtonGroup( buttonGroup ) {
  buttonGroup.addEventListener( 'click', function( event ) {
  // only work with buttons - doesn't work here
  //  if ( !matchesSelector( event.target, 'button' ) ) {
  //    return;
  //  }
    if ( !event.target.matches('button') ) {
     return;
  }
    buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
    event.target.classList.add('is-checked');
  });
}



	
}() );