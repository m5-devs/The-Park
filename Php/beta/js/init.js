//Initialize materialize
(function($){
  $(function(){

	$('.button-collapse').sideNav();
	$('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space

//Initialize modals
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});

//Activate masonry grid
function loadMsnry() {
	$('.grid').masonry({
	percentPosition: true,
	columnWidth: '.grid-sizer',
	itemSelector: '.grid-item',
	transitionDuration: 0,
	gutter: 18
	});
}

//Side nav drawer
$('.button-collapse').sideNav({
		menuWidth: 300, // Default is 240
		edge: 'right', // Choose the horizontal origin
		closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
	}
);

//Custom options for dropdown menus
$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: true, // Activate on hover
		belowOrigin: false // Displays dropdown below the button
	}
);

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

//Google analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-66265305-1', 'auto');
ga('send', 'pageview');

//Materialize dropdowns
$(document).ready(function() {
	//Settings for dropdown menus. Doesn't work when put in init.js
	$('.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrain_width: false, // Does not change width of dropdown to that of the activator
			hover: false, // Activate on hover
			belowOrigin: true // Displays dropdown below the button
		}
	);
});

