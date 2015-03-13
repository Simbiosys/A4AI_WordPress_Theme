<?php
/**
* @package WebFoundation
* @subpackage A4AI
* 
*/

get_header(); ?>

    
    
    <div id="Roll">
    	
        <div class="wrapper">
        	<div class="ListBlog">
             
            <div class="articles_container">    
            <h2 class="Title">Members </h2>
            <h2 class="Title"><p class="italic">Global Sponsors<p></h2>
                
                <?php echo do_shortcode("[members-list list='Global Sponsors' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title"><p class="italic">Private Sector<p></h2>
             
    			<?php echo do_shortcode("[members-list list='Private Sector' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title"><p class="italic">Public Sector-Academia<p></h2>
             
    			<?php echo do_shortcode("[members-list list='Public Sector' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title"><p class="italic">Civil Society-Foundations<p></h2>
                
                <?php echo do_shortcode("[members-list list='Civil Society' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
                </div>
                
                
               </div>
                
            
            </div>
        
        
        </div>

	

<?php get_footer(); ?>
