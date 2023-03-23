import axios from "axios";
import 'regenerator-runtime/runtime';
class LessonPDF {

  constructor() {  
      
    // 1. describe and create object
    
    axios.defaults.headers.common["X-WP-Nonce"] = coachingData.api_nonce; 
    this.resultsDiv = document.getElementById('ajax-content');  
    if(!this.resultsDiv) {
      return;
    }
    
    this.openButton = document.querySelectorAll('.pdf-link');
     
    this.data = {
    'root_url'    : coachingData.root_url, 
    'api_url'     : coachingData.api_url,
    'api_nonce'   : coachingData.api_nonce      
    };
     
    this.events();
  }
  events() {
    
    this.openButton.forEach(el => {
        el.addEventListener("click", (e) => {
          e.preventDefault();
          this.getResults(e.target);
 
          
        });
    });
      
  }
 
  // add autoplay in pdf tag
  async getResults(e) {
      
    var id = e.getAttribute("data-id");
     
    try {
      const response = await axios.get(coachingData.root_url + "/wp-json/coaching/v1/lesson_pdf/" +  id   );
      
      const pdfResults = response.data;
      
      this.resultsDiv.innerHTML = `
      <div class="pdf-wrapper">
       ${pdfResults.pdf.map(item => `<object data="${item.pdf_url}" width="1200" height="900" aria-label="Embed of Mod1Class1Worksheets." src="${item.pdf_url}" type="application/pdf">`)}
       </div> 
       <div>
       `; 
      /* this.resultsDiv.innerHTML = `
      <div class="pdf-wrapper"  >
       ${pdfResults.pdf.map(item => `<object data="${item.pdf_url}" width="1200" height="900" aria-label="Embed of Mod1Class1Worksheets." src="${item.pdf_url}" type="application/pdf">
       <embed src="${item.pdf_url}" type="application/pdf"><p>It appears you don't have a the proper plugin to load this in your browser. You can <a href="${item.pdf_url}">click here to access the resource.</a></p>`)}
       </div> 
       <div>
       `; */
      this.isSpinnerVisible = false;
    } catch (event) {
      console.log(e);
    }
  }                   

}  // end lesson class
 

export default LessonPDF;
