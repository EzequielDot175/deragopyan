<!--busqueda-->
	<div class="busqueda-avanzada">
		<div  class="boton-sidebar">
			<img id="mostrar-sidebar" src="http://www.deragopyan.com/wp-content/themes/deragopyan/img/flecha-galerry-bottom.png" alt="">
			<img id="ocultar-sidebar" class="oculta" src="http://www.deragopyan.com/wp-content/themes/deragopyan/img/flecha-galerry-top.png" alt="">
			<div class="search">
				<?php get_search_form(); ?>
			</div>
			<!--sidebar-->
			<div class="cont-center">
				<div class="sidebar">
					
					<div class="column1 mr sidebarDesplegable">
						<input type="text" placeholder="Búsqueda avanzada" class="search-input">
						<div class="filter-btn" >
							<span class="numbers number-1">1</span>
							<input type="text" placeholder="FECHA" class="date-input" id="calendar">
						</div>
						<div class="filter-btn" > 
							<span class="numbers number-2">2</span>
							<span class="text">NOMBRE</span>
							<span class="small-arrow-down"></span>
						</div>
						<div class="filter-btn">
							<span class="numbers number-2">3</span>
							<span class="text">CATEGORIA</span>
							<span class="small-arrow-down"></span>
						</div>
						<div class="filter-btn">
							<span class="numbers number-2">4</span>
							<input type="text" placeholder="PALABRA CLAVE" class="date-input">
						</div>
						<div class="submit-search-form">
							<button>FILTRAR</button>
						</div>
					</div>
				</div>
			</div>
			<!--//sidebar-->
		</div>
	</div>
	<!--busqueda-->