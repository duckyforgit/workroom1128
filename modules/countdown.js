
 // Set the date we're counting down to Get the next event
// var countDownDate = new Date("Aug 10, 2022 15:37:25").getTime();

// Update the count down every 1 second
// var x = setInterval(function() {

  // Get today's date and time
 // var now = new Date().getTime();

  // Find the distance between now and the count down date
 // var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
//   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
//   + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
//   if (distance < 0) {
//     clearInterval(x);
//     document.getElementById("demo").innerHTML = "EXPIRED";
//   }
// }, 1000);




class Countdown {

  constructor() {
   
    this.resultsDiv = document.getElementById('next-event');     
    
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
             
          
             // //localhost:3000/wordpress/lesson/class-1-why-you-are-held-back/
            //var atts = targetElement.getAttribute('data-url');
            var id = targetElement.getAttribute('data_id');
            
// wp-json/wp/v2/posts // wp-json/tribe/events/v1/events
  
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
