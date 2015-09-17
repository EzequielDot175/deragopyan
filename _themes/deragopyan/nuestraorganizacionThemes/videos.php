<?php 
/**
*
* Template Name: Nuestra Organizacion - videos
*
 *
 * @package Deragopyan
 */



 ?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/subheader.php"; ?>

 <?php
    // TO SHOW THE PAGE CONTENTS
    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
        <div class="entry-content-page">
            <?php the_content(); ?> <!-- Page Content -->
        </div><!-- .entry-content-page -->

    <?php
    endwhile; //resetting the page loop
    wp_reset_query(); ?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/pageFooter.php"; ?>

