$(document).ready(function() {

  var map;
  function initialize() {
    var mapOptions = {
      zoom: 8,
      center: new google.maps.LatLng(21.0944968, -86.811012)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  }

  google.maps.event.addDomListener(window, 'load', initialize);


	jQuery.fn.jplist.settings = {
      
      /**
      * LIKES: jquery ui range slider
      */
      starsSlider: function ($slider, $prev, $next){

        $slider.slider({
          min: 0
          ,max: 5
          ,range: true
          ,values: [0, 5]
          ,slide: function (event, ui){
            $prev.text(ui.values[0] + ' stars');
            $next.text(ui.values[1] + ' stars');
          }
        });
      }
      
      /**
      * LIKES: jquery ui set values
      */
      ,starsValues: function ($slider, $prev, $next){
        $prev.text($slider.slider('values', 0) + ' stars');
        $next.text($slider.slider('values', 1) + ' stars');
      }
      
      /**
      * PRICES: jquery ui range slider
      */
      ,pricesSlider: function ($slider, $prev, $next){

        $slider.slider({
          min: 0
          ,max: 500
          ,range: true
          ,values: [0, 500]
          ,slide: function (event, ui){
            $prev.text('$' + ui.values[0]);
            $next.text('$' + ui.values[1]);
          }
        });
      }

      /**
      * PRICES: jquery ui set values
      */
      ,pricesValues: function ($slider, $prev, $next){

        $prev.text('$' + $slider.slider('values', 0));
        $next.text('$' + $slider.slider('values', 1));
      }
      
      /**
      * VIEWS: jquery ui range slider
      */
      ,tripAdvisorSlider: function ($slider, $prev, $next){

        $slider.slider({
          min: 0
          , max: 4000
          , range: true
          , values: [0, 4000]
          , slide: function (event, ui) {
            $prev.text(ui.values[0] + ' views');
            $next.text(ui.values[1] + ' views');
          }
        });
      }

      /**
      * VIEWS: jquery ui set values
      */
      ,tripAdvisorValues: function ($slider, $prev, $next){
        $prev.text($slider.slider('values', 0) + ' views');
        $next.text($slider.slider('values', 1) + ' views');
      }
    };

  $(".rslides").responsiveSlides({
	  auto:false,
    speed: 800,
    prevText: "Previous",
    nextText: "Next", 
  	nav:true,
  });

  $('#hotelsLF').jplist({       
    itemsBox: '.list', 
    itemPath: '.list-item',
    panelPath: '.jplist-panel',
    effect: 'fade',
  });

});