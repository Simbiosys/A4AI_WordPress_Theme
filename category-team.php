<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
 
 <?php
 	function get_position($data) {
 		if (is_array($data)) {
 			if (count($data) == 0)
 				return "";

 			return $data[0];
 		}
 		
 		return $data;
 	}
 ?>
  
    <div id="Roll">
    	
        <div class="wrapper">
        	<div class="ListBlog">
 			
            
             <h2 class="Title">Team</h2>
             
               <div class="articles_container"> 

		<?php $cat_num=0; ?>
        
        <?php $team= ''; ?>

		<?php if (have_posts()) : ?>

			<?php   $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		    query_posts("cat=58&paged=$paged&orderby=date&order=ASC"); ?>
            
			<?php while (have_posts()) : the_post(); ?>
	   		
            <?php global $cat_num;
		   $cat_num++; ?> 
           
           <?php $my_title = get_the_title($ID); 
           $my_title = str_replace(' ','-',$my_title); ?>
            
 
            
            		 <?php $my_title = get_the_title($ID); 
                     $my_title = str_replace(' ','-',$my_title); ?>
           
           
				<div class="team_box">             <!--DIV-SHOWN-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="Head">
				<div class="image_blog_home">
                    <?php the_post_thumbnail( 'grid-size' ); ?>
				</div>
                </div>
                        <div class="Content">
                        
                            <div class="entry">
								<h2><?php the_title(); ?></h2>
                                <h3><?php echo get_position(post_custom('position')); ?></h3>

                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                    </div>
                    
                    <div class="popup_container" style="display:none">
                    <div id="pop_box<?php echo $cat_num ?>">             <!--DIV-HIDDEN-POPUP-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="Head">
				<div class="image_blog_home">
                    <?php echo get_the_post_thumbnail($page->ID, 'grid-size'); ?>
				</div>
                </div>
                        <div class="Content">
                            <div class="entry">
								<h2><?php the_title(); ?></h2>
                                <h3><?php echo get_position(post_custom('position')); ?></h3>
                                <p><?php
								$content = get_the_content();
								print $content;
									?></p>
                            </div>
                        </div>
                    </article>
                    </div></div>

			<?php endwhile; ?>

			<?php post_navigation(); ?>
			
	<?php else : ?>

		<h2><?php _e('Nothing Found','html5reset'); ?></h2>

	<?php endif; ?>
    
    
        			</div>
                
                
               </div>
                
            
            </div>
        
        
        </div>
<script>

jQuery(document).ready(function($){
	
	var popup = window.location.hash;
	
if ( popup != "" ) {
   $.colorbox({transition:"fade", speed:"300", width:"40%", height:"80%", innerWidth:false, innerHeight:false, maxWidth:"80%", maxHeight:"80%", top:false, right:false, bottom:false, left:false, fixed:false, open:true, opacity:"0.8", inline:true, href: popup});
}

  $(".pop_up").click(function () {
        var addressValue = $(this).attr("href");
        window.location.hash = addressValue;
    });
	
	$("#cboxOverlay, #cboxClose").click(function () {
        window.location.hash = "#";
    });

});

</script>


<?php get_footer(); ?>
