import axios from "axios";
import  'regenerator-runtime/runtime';
 
class Testimonial {

	constructor() {
		axios.defaults.headers.common["X-WP-Nonce"] = coachingData.api_nonce;
		this.resultsDiv = document.getElementById('testimonialList__results');
		if ( ! this.resultsDiv) {
			return;
		}
		this.openButton = document.getElementById('load_more_button');
		this.testimonialCount = 0;
		this.testimonialResults;
		this.data = {
			'root_url'    : coachingData.root_url,
			'api_url'     : coachingData.api_url,
			'api_nonce'   : coachingData.api_nonce,
			'page'        : coachingData.page,
		};			
		this.events();		 
	} 

 //  2. events

	events() {
		this.openButton.addEventListener("click", (e) => {
			e.preventDefault();
			this.getResults(e.target);
		});       
	}
// 3. methods
	async getResults(e) {		
		
		let pageno = parseInt(this.data.page);
		pageno += 1;
		
		axios.get(coachingData.root_url + "/wp-json/coaching/v1/testimonials?page=" +  pageno)
			.then(response=> {
				console.log(pageno);		
				return response.data;
			})
			.then(data => {
				console.log(data);
				this.data.page = pageno;
				let button = this.openButton;
				let counter = 0;
				let length = data.testimonials.length;
				this.resultsDiv.innerHTML += (`${data.testimonials.length ? '<div class="row gx-3">' : '<p>No general information matches that search.</p>'}${data.testimonials.map(item => `<div class="col-sm-12 offset-md-1 col-md-5 cell-testimonial"><blockquote>${item.clientTestimonial}<cite>${item.clientFirstName}</cite></blockquote></div>`).join('')}${data.testimonials.length ? '</div>' : ''}`);

				if ( pageno == data.max_page ) {  
					this.openButton.remove(); // if last page, remove the button
				}       
			})
			.catch(err => {
				console.error(err);
			});
	
		
	}
		
}  // end testimonial class
 

export default Testimonial;
