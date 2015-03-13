<?php
/**
 * @package WebFoundation
 * @subpackage A4AI
 */
?>
<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="<?php echo of_get_option('meta_headid'); ?>" data-template-set="html5-reset-wordpress-theme">

	<meta charset="<?php bloginfo('charset'); ?>">

        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->

	<?php if (is_search()) echo '<meta name="robots" content="noindex, nofollow" />'; ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">

	<meta name="description" content="<?php bloginfo('description'); ?>" />

	<?php if (true == of_get_option('meta_author')) echo '<meta name="author" content="'.of_get_option("meta_author").'" />'; ?>

	<?php if (true == of_get_option('meta_google')) echo '<meta name="google-site-verification" content="'.of_get_option("meta_google").'" />'; ?>

	<meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">

	<meta name="viewport" content="width=device-width">

	<?php if (true == of_get_option('head_favicon')) {
	echo '<link rel="shortcut icon" href="'.of_get_option("head_favicon").'" />';
	} ?>

	<?php if (true == of_get_option('head_apple_touch_icon')) {
	echo '<link rel="apple-touch-icon" href="'.of_get_option("head_apple_touch_icon").'">';
	} ?>

	<link href='http://fonts.googleapis.com/css?family=Chivo:400,900|PT+Serif:400,700|Archivo+Black|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css' />
	<!--<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/styles/a4ai.css" />-->
	<link rel="stylesheet" href="http://192.168.1.150:9000/styles/a4ai.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/styles/font-awesome.min.css">


    <link rel='stylesheet' id='touchcarousel-frontend-css-css'  href='<?php echo get_site_url(); ?>/wp-content/plugins/touchcarousel/touchcarousel/touchcarousel.css?ver=3.5.2' type='text/css' media='all' />
	<link rel='stylesheet' id='touchcarousel-skin-grey-blue-css'  href='<?php echo get_site_url(); ?>/wp-content/plugins/touchcarousel/touchcarousel/grey-blue-skin/grey-blue-skin.css?ver=3.5.2' type='text/css' media='all' />

	<script src="<?php bloginfo( 'template_directory' ); ?>/_/js/modernizr-2.6.2.dev.js"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/_/js/sharer.js"></script>

	<!-- Important Owl stylesheet -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/inc/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/inc/owl-carousel/owl.theme.css">
	<script src="<?php bloginfo( 'template_directory' ); ?>/_/js/jquery-1.9.1.min.js"></script>

	<!-- Application-specific meta tags -->
	<?php if (true == of_get_option('meta_app_win_name')) {
	echo '<!-- Windows 8 -->';
	echo '<meta name="application-name" content="'.of_get_option("meta_app_win_name").'" /> ';
	echo '<meta name="msapplication-TileColor" content="'.of_get_option("meta_app_win_color").'" /> ';
	echo '<meta name="msapplication-TileImage" content="'.of_get_option("meta_app_win_image").'" />';
	} ?>

	<?php if (true == of_get_option('meta_app_twt_card')) {
	echo '<!-- Twitter -->';
	echo '<meta name="twitter:card" content="'.of_get_option("meta_app_twt_card").'" />';
	echo '<meta name="twitter:site" content="'.of_get_option("meta_app_twt_site").'" />';
	echo '<meta name="twitter:title" content="'.of_get_option("meta_app_twt_title").'">';
	echo '<meta name="twitter:description" content="'.of_get_option("meta_app_twt_description").'" />';
	echo '<meta name="twitter:url" content="'.of_get_option("meta_app_twt_url").'" />';
	} ?>

	<?php if (true == of_get_option('meta_app_fb_title')) {
	echo '<!-- Facebook -->';
	echo '<meta property="og:title" content="'.of_get_option("meta_app_fb_title").'" />';
	echo '<meta property="og:description" content="'.of_get_option("meta_app_fb_description").'" />';
	echo '<meta property="og:url" content="'.of_get_option("meta_app_fb_url").'" />';
	echo '<meta property="og:image" content="'.of_get_option("meta_app_fb_image").'" />';
	} ?>


	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="body-wrapper">
    <div id="TopNav">

        <div class="wrapper">

        	<a style="display: none">Join Us</a>

					<button id="mobile-menu" type="button" class="js-menu-trigger sliding-menu-button">
						<i class="fa fa-bars"></i>
					</button>

					<div class="Social">
						<a href="http://www.facebook.com/allianceforaffordableinternet" title="Facebook" class="Facebook" target="_blank">
							<i class="fa fa-facebook"></i>
							<span>Facebook</span>
						</a>
						<a href="https://twitter.com/a4a_internet" title="Twitter" class="Twitter" target="_blank">
							<i class="fa fa-twitter"></i>
							<span>Twitter</span>
						</a>
						<a href="<?php echo esc_url( home_url( '/rss' ) ); ?>" title="RSS" class="RSS" target="_blank">
							<i class="fa fa-rss"></i>
							<span>RSS</span>
						</a>
					</div>

					<!-- Google Translator (script at bottom of the page) -->
					<div class="language-selector">
						<div id="translator-wrapper" class="translator">
							<label>Automatic translation: </label>
						</div>
					</div>
					<!-- -->

					<h3>A global coalition working to make broadband affordable for all</h3>

        </div>

    </div>

		<!-- MOBILE MENU  -->
		<nav class="js-menu sliding-menu-content mobile-menu">
			<?php wp_nav_menu( array('menu' => 'Main') ); ?>
			<!-- Google Translator (script at bottom of the page) -->
			<div class="language-selector-mobile">
				<div id="translator-wrapper-mobile" class="translator">
					<label>Automatic translation</label>
				</div>
			</div>
			<!-- -->
		</nav>
		<script>
			$(document).ready(function(){
				$('.js-menu-trigger').on('click touchstart',function(e) {
					if (!$(".mobile-menu ul.menu").hasClass("processed")) {
						$(".mobile-menu li.menu-item-has-children").append("<a class='down' href='javascript:void(0)'><i class='fa fa-angle-down fa-2x'></i></a>");

						$('.mobile-menu a.down').on('click touchstart', function(e) {
							var subMenu = $(this).parent().find(".sub-menu");

							if (!subMenu.hasClass("opened")) {
								subMenu.addClass("opened").slideDown("slow")

								$(this).parent().find("i.fa-angle-down")
								.removeClass("fa-angle-down")
								.addClass("fa-angle-up");

								e.preventDefault();
							}
							else {
								subMenu.removeClass("opened").slideUp("slow")

								$(this).parent().find("i.fa-angle-up")
								.removeClass("fa-angle-up")
								.addClass("fa-angle-down");

								e.preventDefault();
							}
						});

						$(".mobile-menu ul.menu").addClass("processed");
					}

					if (!$(".mobile-menu").hasClass("opened")) {
						$(".mobile-menu").slideDown("slow");
						e.preventDefault();

						$(".mobile-menu").addClass("opened");
					}
					else {
						$(".mobile-menu").slideUp("slow");
						e.preventDefault();

						$(".mobile-menu").removeClass("opened");
					}
				});
			});
		</script>
		<!-- -->

    <header id="Header" role="header">

        <div class="wrapper">

	        <h1>
            	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                	<img src="<?php bloginfo( 'template_directory' ); ?>/_/images/layout/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
           		</a>
            </h1>

            <nav id="Nav" role="navigation">
                <div class="Search"><a href="#" title="Search"><i class="fa fa-search"></i> <span>Search</span></a></div>
                <?php include (TEMPLATEPATH . '/sidebar-homepage.php'); ?>
                <?php wp_nav_menu( array('menu' => 'Main') ); ?>
            </nav>

        </div>

    </header>

<script type='text/javascript'>
 $(function() {
  $('.Search').click(function() {
   if( $("#sidebar_home").is(":hidden") ) {
    $("#sidebar_home").fadeIn("slow");
   }
   else
   {
    $("#sidebar_home").fadeOut("slow");
   }
   });
  });
 </script>

 <script>
$(document).ready(function(){
    $("label[for='membership-requirements']").addClass("popup_1");
	$("label[for='membership-categories']").addClass("popup_2");
	$("label[for='advisory-council']").addClass("popup_3");

});


jQuery.browser = {};
jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());

</script>

<script type="text/javascript">
$(document).ready(function(){
    //  When user clicks on tab, this code will be executed
    $(".touchcarousel li").click(function() {
        //  First remove class "active" from currently active tab
        $(".touchcarousel li").removeClass('first');

        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("first");

        //  Hide all tab content
        $(".meta-item").hide();

        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");

        //  Show the selected tab content
        $(selected_tab).fadeIn();

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    //  When user clicks on tab, this code will be executed
    $("#Tab_list li").click(function() {
        //  First remove class "active" from currently active tab
        $(".Panel_home").removeClass('Active');

        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("Active");

        //  Hide all tab content
        $(".Panel").hide();

        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");

        //  Show the selected tab content
        $(selected_tab).fadeIn();
        
        $(document).ready(function() {
 			$("#slider_container .members").owlCarousel({
 				responsive:{
        			0:{
            			items: 2,
            			nav: true,
            			dots: false
        			},
        			600:{
            			items: 4,
            			nav: true,
            			dots: false
        			},
        			1000:{
            			items: 5,
            			nav: true
        			}
    			},
      			loop: true,
      			dots: true,
      			nav: true,
      			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
 			});
 		});

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
});

</script>



<style type="text/css">
		.touchcarousel.tc-layout-4 .touchcarousel-item {
	width: 110px;
	min-height: 90px;
	margin-right: 5px;
	position: relative;
	overflow: hidden;


}
.touchcarousel.tc-layout-4 .touchcarousel-item p {
	margin: 0;
	padding: 0;
}
.touchcarousel.tc-layout-4 .touchcarousel-item a.tc-state {
	display: block;
	width: 170px;
	height: 90px;
	position: relative;
	text-decoration: none;
	color: #3e4245;

	-webkit-transition: color 0.2s ease-out;
    -moz-transition: color 0.2s ease-out;
    -ms-transition: color 0.2s ease-out;
    -o-transition: color 0.2s ease-out;
    transition: color 0.2s ease-out;
}
.touchcarousel.tc-layout-4 .touchcarousel-item img {
	max-width: none;
	border: 0;
	margin: 0;
}
.touchcarousel.tc-layout-4 .touchcarousel-item img,
.touchcarousel.tc-layout-4 .touchcarousel-item h4,
.touchcarousel.tc-layout-4 .touchcarousel-item span {
	position: relative;
	margin: 0;
	padding: 0;
	border: 0;
}
.touchcarousel.tc-layout-4 .tc-block {
	margin: 0 4px 3px 8px
}

.touchcarousel.tc-layout-4 .touchcarousel-item h4 {
	font-size: 14px;
	line-height: 1.4em;
	padding: 0;
	text-decoration: none;
	font-family: 'Helvetica Neue', Arial, serif;

}
.touchcarousel.tc-layout-4 .touchcarousel-item a.tc-state:hover {
	color: #13937a;
}
.touchcarousel.tc-layout-4 .touchcarousel-item span {
	font-size: 12px;
	color: #666;
}

		</style>


		<script type="text/javascript">
			function googleTranslateElementInit() {
				var options = {pageLanguage: 'en', includedLanguages:
			'en,es,ar,bn,zh-CN,fr,de,hi,ja,pt,ru,sw,it,sv,da,nl,ko,pl,ha,tr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false};

				var mobile_menu = document.getElementById("mobile-menu");
				var translator_wrapper = document.getElementById("translator-wrapper");
				var translator_wrapper_mobile = document.getElementById("translator-wrapper-mobile");

				var google_translate_element = document.createElement("div");
				google_translate_element.id = "google_translate_element";

				if (mobile_menu.offsetParent === null)
					translator_wrapper.appendChild(google_translate_element);
				else
					translator_wrapper_mobile.appendChild(google_translate_element);

				new google.translate.TranslateElement(options, 'google_translate_element');
			}

			window.onresize = function(event) {
				var mobile_menu = document.getElementById("mobile-menu");
				var translator_wrapper = document.getElementById("translator-wrapper");
				var translator_wrapper_mobile = document.getElementById("translator-wrapper-mobile");
				var google_translate_element = document.getElementById("google_translate_element");

				if (mobile_menu.offsetParent === null) {
					if (google_translate_element.parentNode !== translator_wrapper) {
						translator_wrapper.appendChild(google_translate_element);
					}
				}
				else {
					if (google_translate_element.parentNode !== translator_wrapper_mobile) {
						translator_wrapper_mobile.appendChild(google_translate_element);
					}
				}
			};
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <div id="MainContent">
