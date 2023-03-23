window.addEventListener('DOMContentLoaded', event => {

   /* <div class="img-wrapper">
        <img id="img-original" class="" src="<?php // echo esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) ); ?>" alt="<?php // the_title(); ?>" width="600" height="400" >
        <div id="img-zoom" class="img-zoom-result"></div> 
    </div> */
    function imageZoom(imgID, resultID) {
        var img, lens, result, cx, cy;
       img = document.getElementById(imgID);
        
       result = document.getElementById(resultID);
       // result.height = img.height;



       lens= document.createElement("DIV");
       lens.setAttribute("class", "img-zoom-lens" );
       img.parentElement.insertBefore(lens, img);
        
       cx = (result.offsetWidth / lens.offsetWidth); // 600 / 40 = 560
        
       cy = result.offsetHeight / lens.offsetHeight;

       result.style.backgroundImage = "url('" + img.src + "')";
       result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px"; // 840 x 15 = 12600
       // result.setAttribute("width", img.width);
       // result.setAttribute("height", img.height);
       
       img.addEventListener("mousemove", moveLensNow);
       lens.addEventListener("mousemove", moveLensNow);
       lens.addEventListener("touchmove", moveLensNow);
       img.addEventListener("touchmove", moveLensNow);
    
       // img.addEventListener('mousemove', function (e) {
        function moveLensNow(e) {
           e.preventDefault();
           var pos, x, y;
           pos = getCursorPos(e);		 	 
        
           x = pos.x - (lens.offsetWidth / 2); // should be 20	
            y = pos.y - (lens.offsetHeight / 2);
        
            if (x > img.width - lens.offsetWidth) {
               x = img.width - lens.offsetWidth;				
           }		
           if (x < 0) { 
               x = 0;  
           }
           if (y > img.height - lens.offsetHeight) {
               y = img.height - lens.offsetHeight;				
           }
           if (y < 0) {
               y = 0; 
           }
           
           lens.style.left = pos.x + "px";
            
           lens.style.top = pos.y + "px";
            
           result.style.backgroundPosition = "-" + (pos.x * cx) + "px -" + (pos.y * cy) + "px";
        
       
           function getCursorPos(e) {
               console.log('in getcursor');
               // console.log(e);
               var a, x = 0, y = 0;
               e = e || window.event;
               a = img.getBoundingClientRect();
           //	console.log("img bounding rect ", a);
               x = e.pageX - a.left;  // horizontal coordinate of touch point relative to viewport in px
           //	console.log("e pageX ", e.pageX);
               y = e.pageY - a.top;
           //	console.log("window page xoffset ", window.pageXOffset);  // from scrolling page
               x = x - window.pageXOffset;
               y = y - window.pageYOffset;
               console.log("cursor x is ", x); 
               return { x : x, y : y }; // x 528  y 606
           }
       }
     }
    
   imageZoom("img-original", "img-zoom");
});
