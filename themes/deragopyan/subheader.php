<?php get_header(); ?>
<?php include 'tiempo.php'; $tiempo = new Wheater(); ?>
<script src="<?php bloginfo('template_directory') ?>/js/fn.js"></script>

<?php $imgUri = get_site_url()."/wp-content/themes/deragopyan/img/"; ?>
<div class="subheader">
	<div class="cont-center">
		<div class="logo">
			<a href="<?php echo get_site_url(); ?>"><img src="<?php echo(IMG) ?>deragopyan.png" alt="logo"></a>
		</div>
		<div class="nav">
			<?php wp_nav_menu( array( 'menu' => 'Menu home' ) ); ?>
		</div>
	</div>

</div>

<div class="cont-center subcontrols">
	<div class="cell one">
		<a href="">
			<img src="<?php echo(IMG); ?>/mail.png" alt="email">
		</a>
		<a href="">
			<img src="<?php echo(IMG); ?>/world.png" alt="world">
		</a>
		<a href="">
			<img src="<?php echo(IMG); ?>/shutdown.png" alt="shutdown">
		</a>
	</div>

	
	<div class="cell two">
		
	</div>
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

<div class="subMenuFixed">
		<div class="cont-center">
			<a href="<?php echo get_site_url(); ?>"><div class="logo-small"></div></a>
			<div class="menufixed">
				<?php wp_nav_menu( array( 'menu' => 'Menu home' ) ); ?>
			</div>
		</div>
</div>
<script>
	jQuery(document).ready(function($) {
	     $(window).on('scroll', function(event) {
	         event.preventDefault();
	         var navPosition = $('.subMenuFixed').offset().top;
	         if (navPosition > 150) {
	         	$('.subMenuFixed').animate({opacity: 1,zIndex: 100},0);
	         	//$('.subMenuFixed').fadeIn('fast');
	         }else{
	         	$('.subMenuFixed').animate({opacity: 0,zIndex: -1},0);
	         	//$('.subMenuFixed').fadeOut('fast');
	         }
	     });     
	});
</script>

<!--sidebar fixed -->
<script>
	jQuery(document).ready(function($) {
	     $(window).on('scroll', function(event) {

	        sidebarfixed ();
			titulofixed ();

	        $(window).resize(function() {
				sidebarfixed ();
			});
			
	     });     
	});


	function sidebarfixed (){

		event.preventDefault();
		var navPosition = $('.subMenuFixed').offset().top;
		var windowWidth = $(window).width();
		posicion = (windowWidth - 900 - 203 )/2;

		//sidebar standard
		if (navPosition > 150) {
	     	$('.sidebarRightFixed').css({
				"position":"fixed",
				'top' : '161px',
				'right' : posicion +'px'
			});
			$('.sidebarLeftFixed').css({
				"position":"fixed",
				'top' : '161px',
			});
			$('.contenedorLeftFixed').css({
				"margin-left":"200px"
			});
	    }else{
	     	$('.sidebarRightFixed').css({
				"position":"relative",
				'top' : '0',
				'right' : '0'
			});
			$('.sidebarLeftFixed').css({
				"position":"relative",
				'top' : '0',
			});
			$('.contenedorLeftFixed').css({
				"margin-left":"0px"
			});
		}

		//sidebar en pagina con slider
		if (navPosition > 450) {
	     	$('.sidebarRight2Fixed').css({
				"position":"fixed",
				'top' : '161px',
				'right' : posicion +'px'
			});
	    }else{
	     	$('.sidebarRight2Fixed').css({
				"position":"relative",
				'top' : '0',
				'right' : '0'
			});
		}
	}

	// titulo fixed
	function titulofixed (){

		event.preventDefault();
		var navPosition = $('.subMenuFixed').offset().top;
		var windowWidth = $(window).width();

		//sidebar en pagina con slider
		if (navPosition > 150) {
	     	$('.sectionName').css({
				"position":"fixed",
				'top' : '99px',
				'width' : '100%',
				'z-index' : '10',
			});
	    }else{
	     	$('.sectionName').css({
				"position":"relative",
				'top' : '0',
			});
		}
	}
</script>
<!--sidebar titulo -->