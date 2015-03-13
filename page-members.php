<?php
/**
* @package WebFoundation
* @subpackage A4AI
* 
*/

get_header(); ?>

<div id="members_container">
    
    <div id="Roll">
    	
        <div class="wrapper">
        	<div class="ListBlog">
            
            
           
                
            <div class="articles_container"> 
            
            <h2 class="TitleMembers">Members </h2>   
            
            <h2 class="Title margin" style="margin: 0 0 10px 0">Global Sponsors</h2>
            <p>Global Sponsors are founder members of A4AI who contribute significant financial and practical support to the Alliance.</p>
                
                <?php echo do_shortcode("[members-list list='Global Sponsors' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title margin">Private Sector</h2>
             
    			<?php echo do_shortcode("[members-list list='Private Sector' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title margin">Public Sector / Academia</h2>
             
    			<?php echo do_shortcode("[members-list list='Public Sector' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
            <h2 class="Title margin">Civil Society / Foundations</h2>
                
                <?php echo do_shortcode("[members-list list='Civil Society' search=false alpha=false pagination=true pagination2=false sort=false]"); ?>
                
                </div>
                
                
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
  console.log(this)
        var addressValue = $(this).attr("href");
        window.location.hash = addressValue;
    });
	
	$("#cboxOverlay, #cboxClose").click(function () {
        window.location.hash = "#";
    });

});
</script>



	

<?php get_footer(); ?>
