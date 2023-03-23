import axios from "axios";
import  'regenerator-runtime/runtime'; 
 
class Totalpages {

  constructor() {
    axios.defaults.headers.common["X-WP-Nonce"] = coachingData.api_nonce; 
    this.resultsDiv = document.getElementById('totalpages');
	if ( ! this.resultsDiv) {
        return;
    }
   // this.openButton = $("#load_more_button");
	this.openButton = document.getElementById('loadpages');
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
//   events() {     
//     this.openButton.on("click", this.getResults.bind(this));   
//    }
   events() {
    this.openButton.addEventListener("click", (e) => {
        e.preventDefault();
       // console.log('in events');
           
        this.getResults(e.target);
    });       
  }
// 3. methods   
// getResults() {
  async getResults(e) {   
  
   // var id = e.getAttribute("data-id");      
    
    try {
		const response = await axios.get(coachingData.root_url + "/wp-json/coaching/v1/testimonials/" );
	
		const testimonialResults = response.data;
	  console.log(response.data);
		var button = this.openButton;
		var counter = 0;
		// let lang = '<div class="row gx-3">${testimonialResults.testimonials.map(item => `<div class="col-sm-12 col-md-6 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`
		// let nodes = langs.map(lang => {
		// 	let li = document.createElement('li');
		// 	li.textContent = lang;
		// 	return li;
		// });
		this.resultsDiv.innerHTML +=(` 
             ${testimonialResults.testimonials.length ? '<div class="row gx-3">' : '<p>No general information matches that search.</p>'}
               ${testimonialResults.testimonials.map(item => `<div class="col-sm-12 offset-md-1 col-md-5 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`).join('')}
            ${testimonialResults.testimonials.length ? '</div>' : ''}
             `);
      	// this.resultsDiv.append(`
		// 	${testimonialResults.testimonials.length ? '<div class="row gx-3">' : '<p>No general information matches that search.</p>'}
		// 	${testimonialResults.testimonials.map(item => `<div class="col-sm-12 col-md-6 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`).join('')}
		//  ${testimonialResults.testimonials.length ? '</div>' : ''}
		//   `);
		
    	coachingData.current_page++;
		console.log(coachingData.current_page);
		  //   var resultArea2 =  ('<div class="container"><div class="video-wrapper" ><video class="lessonVideo" height="720" controls="" preload="metadata" playsinline="">${videoResults.video.map(item => `<source src="${item.video_url}" type="video/mp4">`)}Your browser does not support HTML5 video.</video></div></div>`');

		if ( coachingData.current_page == response.max_page ) {  
			button.remove(); // if last page, remove the button
		}        
      
    } 	catch (e) {
      		console.log(e);
		// this.openButton.remove();
    }
 
 // $.ajax({
 //     beforeSend: (xhr) => {
 //        xhr.setRequestHeader('X-WP-Nonce', coachingData.api_nonce);
 //     },   
  //    url: coachingData.root_url + '/wp-json/coaching/v1/testimonials',    
  //    type: 'GET',
  //    data: { 
  //       'root_url'     : coachingData.root_url,          
  //       'api_nonce'    : coachingData.api_nonce,
  //       'current_page' : coachingData.current_page,
  //       'max_page'     : coachingData.max_page
         
   //     },
    //   success: (response) => {         
    //     if (! response) {
    //        button.remove();
    //     }
    //     else 
    //     { 
    //     // loop through testimonials and write each in cell
    //       this.resultsDiv.append(` 
    //          ${response.testimonials.length ? '<div class="row gx-3">' : '<p>No general information matches that search.</p>'}
    //            ${response.testimonials.map(item => `<div class="col-sm-12 offset-md-1 col-md-5 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`).join('')}
    //         ${response.testimonials.length ? '</div>' : ''}
    //          `);
          
    //       coachingData.current_page++;
          
    //       if ( coachingData.current_page == response['max_page'] ) {  
    //         $('#load_more_button').remove(); // if last page, remove the button
    //       }           
    //     }
    //   },  // success
    //   error: (response) => {
    //      console.log(response);
    //   }
    // });  
  } // end ajax
}  // end testimonial class
 

export default Testimonial;
