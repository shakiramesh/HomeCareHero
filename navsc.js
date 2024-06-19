    
       
       document.addEventListener("DOMContentLoaded", function () {
           var currentPath = window.location.pathname.split('/').pop();
           var links = document.querySelectorAll('.menu li a');

           links.forEach(function (link) {
               if (link.getAttribute('href') === currentPath) {
                   link.classList.add('active');
               }
           });
       });
   

