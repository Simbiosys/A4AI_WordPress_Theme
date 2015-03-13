<?php
/**
 * @package WebFoundation
 * @subpackage A4AI
 */
?>

	</div>


    <footer id="Footer" class="source-org vcard copyright">

        <div id="Members">
            <div class="wrapper">
            	<h4>Global Sponsors of the Alliance for Affordable Internet</h4>
            	<div class="Image"><img src="<?php bloginfo( 'template_directory' ); ?>/_/images/layout/members.jpg" alt="Members"></div>
            </div>

                <div class="Cont">
            <h4>Members of the Alliance for Affordable Internet</h4>
        <div id="Members_slider">
                <?php echo do_shortcode('[members-list list="Members tab" search=false alpha=false pagination=false pagination2=false sort=false]'); ?>
	</div>

	</div>

        </div>


        <div id="FooterLinks">
            <div class="wrapper">
                <nav role="navigation">
                    <?php wp_nav_menu( array('menu' => 'Main') ); ?>
                </nav>
            </div>
        </div>

        <div id="Signature">
            <div class="wrapper">
            	<h1>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php bloginfo( 'template_directory' ); ?>/_/images/layout/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    </a>
                    <a href="http://webfoundation.org/" title="Powered by the Web Foundation">
                        <img src="<?php bloginfo( 'template_directory' ); ?>/_/images/layout/wf-logo.png" alt="Web Foundation">
                    </a>
                </h1>
                <nav role="navigation">
                    <?php wp_nav_menu( array('menu' => 'footer') ); ?>
                </nav>
            </div>
        </div>

    </footer>
	</div>

	<?php wp_footer(); ?>

    <script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){
          i['GoogleAnalyticsObject']=r;
          i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();
          a=s.createElement(o),m=s.getElementsByTagName(o)[0];
          a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                              })
        (window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-11069364-2', 'a4ai.org');
        ga('send', 'pageview');
    </script>
    <script type='text/javascript' src='<?php echo get_site_url(); ?>/wp-content/plugins/touchcarousel/touchcarousel/jquery.touchcarousel.min.js?ver=1.0'></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/inc/owl-carousel/owl.carousel.js"></script>
    <script>
/*
          var ww = 8015;
        function animateMembers(w) {
          if (!w || w == 1000) { w = ww; }
          $('#Members_slider #tern_members').animate({"left": "-="+w}, 100000, 'linear', function() {
              $(this).attr("style", "left: 0px; width: "+w+"px;");
              animateMembers(w);
            });
        }

          jQuery(document).ready(function () {
              var numItems = $('.tern_wp_members_list').length;
              numItems = numItems/2;
              $('#tern_members').width(numItems*229);
              var width_all = $('#slider_container').width();
              if (!width_all) { width_all = $('#Members_slider').width(); }
              var num_click = 1;

              $( "#right_butt" ).click(function() {
                  if( num_click <= Math.ceil(numItems/3)-1 ){
                    num_click++;
                    $( "#tern_members" ).animate({ "left": "-=681px" } );  }
                });
              $( "#left_butt" ).click(function(){
                  if (  parseInt($('#tern_members').css('left'), 10) < 0   ) {
                    $( "#tern_members" ).animate({ "left": "+=681px" } );
                    num_click--;
                  }
                });

              var E = $('#Members_slider #tern_members');
              animateMembers(E.width());
            });
*/
		$(document).ready(function() {
 			$("#Footer .members").owlCarousel({
 				responsive:{
        			0:{
            			items: 2,
            			nav: false,
            			dots: false
        			},
        			600:{
            			items: 4,
            			nav: false,
            			dots: false
        			},
        			1000:{
            			items: 5,
            			nav: false
        			}
    			},
      			loop: true,
      			autoplay: true,
    			autoplayTimeout: 1500,
    			autoplayHoverPause: true
 			});
 		});
    </script>
  </body>
</html>
