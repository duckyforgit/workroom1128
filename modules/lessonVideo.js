import axios from "axios";
import  'regenerator-runtime/runtime';
class LessonVideo {

  constructor() {  
      
    // 1. describe and create object
    
      axios.defaults.headers.common["X-WP-Nonce"] = coachingData.api_nonce; 
      this.resultsDiv = document.getElementById('ajax-content');
      if(!this.resultsDiv) {
        return;
      }     
      this.openButton = document.querySelectorAll('.video-link');
     
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
          console.log(e.currentTarget);         
          this.getResults(e.target);
        });
      });      
  }
   
  // add autoplay in video tag
  async getResults(e) {   
  
    var id = e.getAttribute("data-id");      
    
    try {
      const response = await axios.get(coachingData.root_url + "/wp-json/coaching/v1/lesson_video/" +  id   );
      const videoResults = response.data;
      console.log(videoResults);
      this.resultsDiv.innerHTML = `
      <div class="container"><div class="video-wrapper" >    
      <video class="lessonVideo" height="720" controls="" preload="metadata" playsinline="">
       ${videoResults.video.map(item => `<source src="${item.video_url}" type="video/mp4">`)}
       Your browser does not support HTML5 video.</video></div></div>`;
      this.isSpinnerVisible = false;
    } catch (event) {
      console.log(e);
    }
  }                      

}  // end lesson class
 

export default LessonVideo;
