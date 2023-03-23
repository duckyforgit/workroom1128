import $ from 'jquery';
 
class Lesson {

  constructor() {
   
    this.resultsDiv = document.getElementById('ajax-content');     
    
    this.links      = document.getElementsByClassName('list-link');

    //this.testimonialCount = 0;
    this.data = {
      'root_url'    : lessonData.root_url, 
      'api_url'     : lessonData.api_url,
      'api_nonce'   : lessonData.api_nonce,
      'currentpage' : lessonData.current_page,
      'max_page'    : lessonData.max_page
    }; 
        
    this.events();

     console.log(this.data);
  } 
 
//var btn = document.getElementById("2609");
 //  2. events
  events() {       
     
      var i;
      for ( i = 0; i < this.links.length; i++) {

           
       // links[i].addEventListener('click', loadData);
       this.links[i].addEventListener('click', function (event) {

            event.preventDefault();
            var targetElement = event.target || event.srcElement;
            //var atts = targetElement.getAttribute('data-url');
            var id = targetElement.getAttribute('data_id');
            

           const url =  'http://localhost/wordpress/wp-json/coaching/v1/lesson/' + id;
           fetch(url)
              .then(response => {
                  console.log(response);
                  return response.json();
              })
              
              .then(data => {
                  // Prints result from `response.json()` in get Request
                 // console.log("DATA", data)
                 console.log(data.class_slides);
                  let outputData = 
                      'http://localhost/wordpress/wp-json/coaching/v1/lesson/' + this.id;
                  
                 
                      outputData += "<p> " + data.id + "</p>";
                      outputData += "<p>" + data.class_video + "</p>";
                      outputData += "<div>" + data.class_slides + "</div>"; 
                          
                   
                  const main = document.getElementById('mainContent');
                  main.innerHTML = sanitizeHTML(outputData);
               
               })
              .catch(error => console.error(error))
            
        })
      }
   }
 // 3. methods   
loadData(id) {

  var linkID = id;
     
  var resultArea = this.resultsDiv;
 // this.id =  this.linkID.attr('data_id');
  var counter = 0; 
  const url =  'http://localhost/wordpress/wp-json/coaching/v1/lesson/' + linkID;
                                     
  console.log(url);
  // fetch(url, {
  //   credentials: 'same-origin'
  // })
  fetch(url)
      .then(response => {
          console.log(response);
          return response.json();
      })
      
      .then(data => {
          // Prints result from `response.json()` in get Request
          console.log("DATA", data)
          console.log(data.length);
          let outputData = 
              'http://localhost/wordpress/wp-json/coaching/v1/lesson/' + this.id;
          outputData +=
              '<div class="" ><p>ID</p><p>TITLE</p></div>';
         
              outputData += "<p> " + data.id + "</p><p>" + data
                  .title + "</p>";
              outputData += "<p> " + data.order_in_series + "</p><p>" + data
                  .class_video + "</p>";
                  
           
          const main = document.getElementById('mainContent');
          main.innerHTML = outputData;
       
       })
      .catch(error => console.error(error)) 
  
  } // end 
                                
                                 

}  // end lesson class
 

export default Lesson;
