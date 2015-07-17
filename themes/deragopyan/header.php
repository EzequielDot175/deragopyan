<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Deragopyan
 */

$path =  $_SERVER["REQUEST_URI"];
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="<?php bloginfo('template_directory') ?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_directory') ?>/js/fn.js"></script>
<?php wp_head(); ?>
</head>

<script>
$(function(){

     $('a[href*=#]').click(function() {

     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
         && location.hostname == this.hostname) {

             var $target = $(this.hash);

             $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

             if ($target.length) {

                 var targetOffset = $target.offset().top;

                 $('html,body').animate({scrollTop: targetOffset}, 1300);

                 return false;

            }
       }
   });
});



</script>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="menuNone">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-mininav"></a>
        <div class="search-mininav">
        <?php get_search_form(); ?>
        </div>    
	</div>
	
	<div id="content" class="site-content">
