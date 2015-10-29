/* Inicializar componentes */
$(document).ready(function(){
	$('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
	/* para llamar la funcion de menu responsive */
	$(".button-collapse").sideNav();//
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	  });
	$('select').material_select();// inicializar los select de la pagina
	$('ul.tabs').tabs();

	/* animacion de ventana */
	setTimeout(function (){
		$('#animacionIntroLeft').addClass('animated slideOutLeft');
	    $('#animacionIntroRight').addClass('animated slideOutRight');
	    $('#animacionIntroLogo').addClass('animated zoomOut');
	    $('#animacionIntroLogo').css("z-index","-1");
	}, 2000);
	$('.materialboxed').materialbox();// para ampliacion de imagenes 
	$('.parallax').parallax();// inicializar parallax
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

	setTimeout(function (){
		if($(".news-panel").hasClass('grid')){
			$('.grid').masonry({	
				itemSelector: '.item'	  
			});
		}			
	}, 2000);
	
	$(".followBtn").on("click",function(){
		id=$(this).data('open');
		$(".modales").switchClass("activeM","inActiveM",1000);
		$("#"+id).switchClass("inActiveM","activeM",1000);
		$('.button-collapse').sideNav('hide');
	});
 
	$(".material-icons").on("click",function(){
		id=$(this).data('close');
		$("#"+id).switchClass("activeM","inActiveM",1000);
	});
	/* los tooltips de la pagina*/
	$('.tooltipped').tooltip({delay: 50});

	$(".new").hover(function(){
		var id=$(this).data("key");
		$(".line_news").switchClass("animated fadeInleft","line_new",100);
		$("#wrap_line_"+id).removeClass("line_new");
		$("#wrap_line_"+id).addClass("animated fadeInleft");
	},
		function(){
			var id=$(this).data("key");

			$("#wrap_line_"+id).removeClass("line_new");
			$("#wrap_line_"+id).addClass("animated fadeInleft");
		}
	);
 });

/* Funciones al cambiar el tamaño de la pantalla */
$(window).resize(function(){
    ajustar();
});

function ajustar(){

}