import axios from "axios";
import  'regenerator-runtime/runtime';
 
class LessonGallery {

  constructor() {  
      
    // 1. describe and create object
    
    axios.defaults.headers.common["X-WP-Nonce"] = coachingData.api_nonce; 
    this.resultsDiv = document.getElementById('ajax-content'); 
      
    if(!this.resultsDiv) {
      return;
    }
    this.openButton = document.querySelectorAll('.slide-link'); 
     
    this.results = [];
    this.data = {
    'root_url'    : coachingData.root_url, 
    'api_url'     : coachingData.api_url,
    'api_nonce'   : coachingData.api_nonce      
    };
    this.activeBtn = null;
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

  // add autoplay in slide tag
  async getResults(e) {

    
      var id = e.getAttribute("data-id");
      
      this.insertHTML();
      
      this.galleryImages = document.querySelector('.gallery-images');      
     
    try {
      const response = await axios.get(coachingData.root_url + "/wp-json/coaching/v1/lesson_slide/" +  id   );       
      
      const slideResults = response.data; 
                
      const list1 = slideResults.slides.map(item => item.slidesImages);
     
      const slideCount = list1[0].length;
         
      let counter = 0; // add to galleryImages
     this.slideImg = document.getElementById("expandedImg");
       
         for (let i = 0; i < slideCount; i++) {
        //   console.log("i count ", i);
           if (counter == 0) {
             
           this.galleryImages.innerHTML += `<div class="col">${list1.map(item => `<img class="image active" width="1280" height="720" src="${item[i]}" >`)}</div>`;             
           
            this.slideImg.src = list1[0][0];

            this.slideImg.parentElement.style.display = "block";

          }
          else {
           this.galleryImages.innerHTML += `<div class="col">${list1.map(item => `<img class="image" width="1280" height="720" src="${item[i]}" >`)}</div>`;
          }
          counter++;
        }
   
    } catch (e) {
     console.log(e);
    }
      
    this.imgs = document.querySelectorAll('.image');      
    this.activeBtn = this.imgs[0];   
    this.expandImg = document.getElementById("expandedImg");     
    
    this.imgs.forEach(el => {      
           
        el.addEventListener("click", (event) => {
         
            event.preventDefault();
         
            this.expandImg.src = event.target.src;
            
            this.expandImg.parentElement.style.display = "block";

            event.currentTarget.classList.add("active");
           
            if ((this.activeBtn != null && this.activeBtn != event.currentTarget)) {
                
                this.activeBtn.classList.remove("active");
            }
            this.activeBtn = event.currentTarget; 
                
        })
    })
  }
  
   
  insertHTML() {

    this.resultsDiv.innerHTML = '<div class="container"><div class="row m-3"><div class="col-sm-12"><img id="expandedImg" style="width:100%" ></div></div><div id="gallery" class="container"><div class="gallery-images row row-cols-3 row-cols-md-4 row-cols-lg-6 gy-3 flex-wrap"></div></div></div> '; 
     
  } 
} // end lessonGallery class
 
 
export default LessonGallery;
