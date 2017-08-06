$(document).ready(function(){
    $('.slider').slider({
        indicators: false,
        height: 500
    });
    smoothScroll.init({
        selectorHeader: '#header', // Selector for fixed headers
        speed: 1000, // Integer. How fast to complete the scroll in milliseconds
        easing: 'easeOutQuart', // Easing pattern to use
        updateURL: true // Boolean. If true, update the URL hash on scroll
    });
});

$(window).scroll(function() {
    if ($(window).scrollTop() === 0) {
        $('nav').removeClass('opaque z-depth-1');
    } else {
        $('nav').addClass('opaque z-depth-1');
    }
});

//Extends jQuery, create javascript object from html form
$.fn.serializeObject = function() {
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};