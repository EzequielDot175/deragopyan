<?php get_header(); ?>
<?php include 'tiempo.php'; $tiempo = new Wheater(); ?>
<script src="<?php bloginfo('template_directory') ?>/js/fn.js"></script>

<?php $imgUri = get_site_url()."/wp-content/themes/deragopyan/img/"; ?>
<div id='menu' class="menu">
	<div class="cont-center">
		<a href="<?php echo get_site_url(); ?>"><div class="logo-small"></div></a>
		<div class="menufixed">
			<?php wp_nav_menu( array( 'menu' => 'Menu home' ) ); ?>
		</div>
	</div>
</div>

<div class="cont-center subcontrols">
	<div class="cell one">
		<a href="">
			<img src="<?php echo(IMG); ?>mail.png" alt="email">
		</a>
		<a href="">
			<img src="<?php echo(IMG); ?>world.png" alt="world">
		</a>
		<a href="">
			<img src="<?php echo(IMG); ?>/shutdown.png" alt="shutdown">
		</a>
	</div>

	<div class="cell two"></div>

	<div class="cell three">
		<div class="right">
			<div class="calendar">
	 			<div class="calendar-img"></div>
	 			<span><?php $tiempo->fecha(); ?></span>
	 			<img src="<?php echo(IMG); ?>humedad-02.png" alt="" style="position:relative;top:-10px;">
	 		</div>
			<div class="temperature"><span>T<?php $tiempo->temperatura(); ?>°</span></div>
	 		<div class="humedad">
	 			<span>H<?php $tiempo->humedad(); ?>%</span>
	 		</div>
	 		
		</div>
	</div>
</div>

<div class="subMenuFixed"></div>

<!--sidebar + titulo fixed -->
<script>
	jQuery(document).ready(function($) {
	     $(window).on('scroll', function(event) {
	        fixed ();
	        $(window).resize(function() {
				fixed ();
			});	
	    });     
	});


	function fixed (){
		 event.preventDefault();
	     var navPosition = $('.sectionName').offset().top;
	     console.log(navPosition);

	     if (navPosition > 100) {
	     	//menu
	     	$('.menu').addClass('menu-Fixed');
	     	//titulo
	     	$('.sectionName').addClass('TFixed');
	     	//sidebar
	     	var windowWidth = $(window).width();
	     	var posicion = (windowWidth - 900 - 203 )/2;
			$('.sidebarRightFixed').css({
				'right' : posicion +'px'
			});
	     	$('.sidebarRightFixed').addClass('SRFixed');
			$('.sidebarLeftFixed').addClass('SLFixed');
			$('.contenedorLeftFixed').addClass('CLFixed');
	     }else{
	     	//menu
	     	$('.menu').removeClass('menu-Fixed');
	     	//titulo
	     	$('.sectionName').removeClass('TFixed');
	     	//sidebar
	     	$('.sidebarRightFixed').removeClass('SRFixed');
			$('.sidebarLeftFixed').removeClass('SLFixed');
			$('.contenedorLeftFixed').removeClass('CLFixed');
	     }

	    //sidebar en pagina con slider
		if (navPosition > 450) {
	     	$('.sidebarRight2Fixed').css({
				'right' : posicion +'px'
			});
	     	$('.sidebarRight2Fixed').addClass('SRFixed');
	    }else{
	     	$('.sidebarRight2Fixed').removeClass('SRFixed');
		}
	}

</script>

