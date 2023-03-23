import $ from 'jquery';
 
class Testimonial {

  constructor() {
   
    this.resultsDiv = $("#testimonialList__results");     
    this.openButton = $("#load_more_button");
    this.testimonialCount = 0;
    this.data = {
      'root_url'    : coachingData.root_url, 
      'api_url'     : coachingData.api_url,
      'api_nonce'   : coachingData.api_nonce,
      'currentpage' : coachingData.current_page,
      'max_page'    : coachingData.max_page
    }; 
      
    this.events();
     
  } 

 //  2. events
  events() {     
    this.openButton.on("click", this.getResults.bind(this));   
   }

// 3. methods   
getResults() {

  var button = $(this);
     
  var resultArea = this.resultsDiv;
  var counter = 0;  
  $.ajax({
      beforeSend: (xhr) => {
         xhr.setRequestHeader('X-WP-Nonce', coachingData.api_nonce);
      },   
      url: coachingData.root_url + '/wp-json/coaching/v1/testimonials',    
      type: 'GET',
      data: { 
         'root_url'     : coachingData.root_url,          
         'api_nonce'    : coachingData.api_nonce,
         'current_page' : coachingData.current_page,
         'max_page'     : coachingData.max_page
         
        },
      success: (response) => {         
        if (! response) {
           button.remove();
        }
        else 
        { 
          console.log(response.current_page);
          // current page is 2 max-page - 4  testimonials start with Sheri
          // loop through testimonials and write each in cell
          this.resultsDiv.append(` 
             ${response.testimonials.length ? '<div class="row gx-3">' : '<p>No general information matches that search.</p>'}
               ${response.testimonials.map(item => `<div class="col-sm-12 offset-md-1 col-md-6 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`).join('')}
            ${response.testimonials.length ? '</div>' : ''}
             `);
          
          coachingData.current_page++;
          
          if ( coachingData.current_page == response['max_page'] ) {  
            $('#load_more_button').remove(); // if last page, remove the button
          }           
        }
      },  // success
      error: (response) => {
         console.log(response);
      }
    });  
  } // end ajax
}  // end testimonial class
 

export default Testimonial;
