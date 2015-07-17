/* Sidebar*/

$(document).ready(function(){

	//mostrar categoria
	$(document).on("click", "#mostrar-sidebar", function(){
		$( '.sidebarDesplegable' ).slideDown('slow');
		$( '#mostrar-sidebar' ).css('display','none');
		$( '#ocultar-sidebar' ).css('display','block');
	} );

	//ocultar categoria
	$(document).on("click", "#ocultar-sidebar", function(){
		$( '.sidebarDesplegable' ).slideUp('slow');
		$( '#ocultar-sidebar' ).css('display','none');
		$( '#mostrar-sidebar' ).css('display','block');
	} );


});

	

