<?php get_header(); ?>
<?php include 'tiempo.php'; $tiempo = new Wheater(); ?>

<?php $imgUri = get_site_url()."/wp-content/themes/deragopyan/img/"; ?>
<div class="subheader">
	<div class="cont-center">
		<div class="search">
			<?php get_search_form(); ?>
		</div>
		<div class="logo">
			<img src="<?php echo(IMG) ?>deragopyan.png" alt="logo">
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
			<div class="temperature"><span>T<?php $tiempo->temperatura(); ?>°</span></div>
	 		<div class="humedad">
	 			<span>H<?php $tiempo->humedad(); ?>%</span>
	 			<img src="<?php echo(IMG); ?>time.png" alt="" style="position:relative;top:-10px;">
	 		</div>
	 		<div class="calendar">
	 			<span><?php $tiempo->fecha(); ?></span>
	 			<div class="calendar-img"></div>
	 		</div>
		</div>
	</div>
</div>

<div class="subMenuFixed">
		<div class="cont-center">
			<div class="logo-small">
				
			</div>
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
	         	$('.subMenuFixed').animate({opacity: 1,zIndex: 100},100);
	         }else{
	         	$('.subMenuFixed').animate({opacity: 0,zIndex: -1},100);

	         }
	     });     
	});
</script>
