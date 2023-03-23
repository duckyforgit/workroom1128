import axios from "axios";
import  'regenerator-runtime/runtime';
 
import {Carousel} from "bootstrap";

class LessonSlide {

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
      this.carouselInner = document.querySelector('.carousel-inner');
    
      
     var prev = document.getElementById('prev');
     prev.disabled = false;   
     
    try {
      const response = await axios.get(coachingData.root_url + "/wp-json/coaching/v1/lesson_slide/" +  id   );  
      
      const slideResults = response.data; 
     
 console.log(slideResults);
      
      const list1 = slideResults.slides.map(item => item.slidesImages);
     // console.log(list1);
      // const list2 = list1.map(slides => ({ detail: slides }));
    //  let slideCount = (slideResults.slide[0]['count']);
     const slideCount = list1[0].length;
     console.log(slideCount);

     for (let i = 0; i < slideCount; i++) {
      this.resultsDiv.innerHTML += `
      <div class="pdf-wrapper"  >  ${list1.map(item => `<img src="${item[i]}" >`)}<div>`;
      // let counter = 0; // add to carousel-inner
      //   for (let i = 0; i < slideCount; i++) {
      //     if (counter == 0) {
      //      this.carouselInner.innerHTML += `<div class="carousel-item active">
      //      ${list1.map(slides => `<img src="${slides[i]}" >`)}

      //      ${list1.map(slides => `<img class="img" src="${slides[i]}" >`)}
      //      </div>`;
      //     }
      //     else {
      //      this.carouselInner.innerHTML += `<div class="carousel-item   ">
      //      ${list1.map(slides => `<img src="${slides[i]}" >`)}
      //      </div>`;
      //     }
            
          }
   
    } catch (event) {
     console.log(event);
    }
    
  } 
  imageGallery() {
    const current = document.querySelector('#current');
const imgs = document.querySelector('.imgs');
const img = document.querySelectorAll('.imgs img');
const opacity = 0.6;

// Set first img opacity
img[0].style.opacity = opacity;

imgs.addEventListener('click', imgClick);

  function imgClick(e) {
    // Reset the opacity
    img.forEach(img => (img.style.opacity = 1));

    // Change current image to src of clicked image
    current.src = e.target.src;

    // Add fade in class
    current.classList.add('fade-in');

    // Remove fade-in class after .5 seconds
    setTimeout(() => current.classList.remove('fade-in'), 500);

    // Change the opacity to opacity var
    e.target.style.opacity = opacity;
  }
  /*  html
   <div class="main-img">
    <img src="https://preview.ibb.co/gxVppG/img1.jpg" id="current">
  </div>

  <div class="imgs">
    <img src="https://preview.ibb.co/gxVppG/img1.jpg">
    <img src="https://preview.ibb.co/iZ3Lww/img2.jpg">
    <img src="https://preview.ibb.co/iQsPOb/img3.jpg">
    <img src="https://preview.ibb.co/gFFdib/img4.jpg">
    <img src="https://preview.ibb.co/hS5ppG/img5.jpg">
    <img src="https://preview.ibb.co/goKtGw/img6.jpg">
    <img src="https://preview.ibb.co/bSWjOb/img7.jpg">
    <img src="https://preview.ibb.co/i2o9pG/img8.jpg">
  </div> */

}
  insertHTML() {

    this.resultsDiv.innerHTML = '<div id="carouselExampleIndicators" class="carousel slide" carousel-multi-item"   data-interval="false" ><div class=" carousel-inner"></div></div></div><button id="prev" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button><button id="next" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button></div>'; 
     
  } 
} // end lessonSlide class
 
 
export default LessonSlide;
