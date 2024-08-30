 $(document).ready(function () {
	var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin:10,
        loop: true,
		dots:true,
		nav:true,
		items:6,
        responsive: {
          0: {
            items: 1
          },
          480: {
            items: 2
          },
		  767: {
            items: 3
          },
		  992: {
            items: 4
          },
          1000: {
            items:5,
          }
        }
      });
	  
  });
  $(document).ready(function() {

    "use strict";
    
    $(window).scroll(function() {

        "use strict";
        
        $(".page").each(function() {

            "use strict";
            
            var bb = $(this).attr("id");
            var hei = $(this).outerHeight();
            var grttop = $(this).offset().top - 110;  
            if ($(window).scrollTop() > grttop - 1 && $(window).scrollTop() < grttop + hei - 1) {
                var uu = $(".nav li a[href='#" + bb + "']").parent().addClass("active");
            } else {
                var uu = $(".nav li a[href='#" + bb + "']").parent().removeClass("active");
            }
        });
    });
});
  $(function() {
	
	"use strict";

  $('.nav li a[href*=#]:not([href=#])').click(function() { 
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 110
        }, 1300);
        return false;
      }
    }
  });
}); 

