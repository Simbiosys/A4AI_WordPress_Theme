<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */

	// Options Framework (https://github.com/devinsays/options-framework-plugin)
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
		require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
	}

	// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_setup() {
		load_theme_textdomain( 'html5reset', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
		register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'html5reset_setup' );

	// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_scripts_styles() {
		global $wp_styles;

		// Load Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		// Load Stylesheets
//		wp_enqueue_style( 'html5reset-reset', get_template_directory_uri() . '/reset.css' );
//		wp_enqueue_style( 'html5reset-style', get_stylesheet_uri() );

		// Load IE Stylesheet.
//		wp_enqueue_style( 'html5reset-ie', get_template_directory_uri() . '/css/ie.css', array( 'html5reset-style' ), '20130213' );
//		$wp_styles->add_data( 'html5reset-ie', 'conditional', 'lt IE 9' );

		// Modernizr
		// This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
		wp_enqueue_script( 'html5reset-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );

	}
	add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );


	function loadscroll()
	{
    wp_enqueue_style('bxstyle', get_template_directory_uri() . '/_/js/jquery.classyscroll.css');
	wp_enqueue_script('bxstyle', get_template_directory_uri() . '/_/js/jquery.mousewheel.js');
    wp_enqueue_script('bxscript', get_template_directory_uri() . '/_/js/jquery.classyscroll.js', array('jquery'));
	}
	add_action('init', 'loadscroll');



	// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

//		 Add the site name.
		$title .= get_bloginfo( 'name' );

//		 Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

//		 Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'html5reset' ), max( $paged, $page ) );
//FIX
//		if (function_exists('is_tag') && is_tag()) {
//		   single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
//		elseif (is_archive()) {
//		   wp_title(''); echo ' Archive - '; }
//		elseif (is_search()) {
//		   echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
//		elseif (!(is_404()) && (is_single()) || (is_page())) {
//		   wp_title(''); echo ' - '; }
//		elseif (is_404()) {
//		   echo 'Not Found - '; }
//		if (is_home()) {
//		   bloginfo('name'); echo ' - '; bloginfo('description'); }
//		else {
//		    bloginfo('name'); }
//		if ($paged>1) {
//		   echo ' - page '. $paged; }

		return $title;
	}
	add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );




//OLD STUFF BELOW


	// Load jQuery
	if ( !function_exists( 'core_mods' ) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script( 'jquery' );
				wp_register_script( 'jquery', ( "//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ), false);
				wp_enqueue_script( 'jquery' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'core_mods' );
	}

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');

	// Custom Menu
//	register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

	add_action( 'init', 'my_custom_menus' );

	function my_custom_menus() {
		register_nav_menus(
			array(
				'primary' => __( 'Main Menu', 'html5reset' ),
				'secondary' => __( 'Footer Menu', 'html5reset' )
			)
		);
	}

	// Widgets
	function html5reset_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets', 'html5reset' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}



function include_widget_categories($args){
$incl = "36,20,4,22"; // The IDs of the categories
$args["include"] = $incl;
return $args;
}
add_filter("widget_categories_args","include_widget_categories");


//home Sidebar
	if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Homepage Sidebar',
'id' => 'homepage-sidebar',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}

//post page Sidebar
	if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Postpage Sidebar',
'id' => 'postpage-sidebar',
'description' => 'Appears as the sidebar on the custom single post page',
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}

	add_action( 'widgets_init', 'html5reset_widgets_init' );

	// Navigation - update coming from twentythirteen
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}


	// Replaces the excerpt "more" text by a link
	function new_excerpt_more($more) {
		   global $post;
		return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Read more</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');


function get_post_comments_count($id){

$num_comments = get_comments_number($id);

	if ( $num_comments == 0 ) {
			echo "No Comments";
		} elseif ( $num_comments > 1 ) {
			echo $num_comments . "Comments";
		} else {
			echo "1 Comment";
		}

}

add_image_size( 'home-post', 473, 271, true );


/*SHARE*/

function get_share_icons($id){


	//facebook
	echo '<a onclick="shareFbWindow(\' '. get_permalink($id) . '&t=' . get_the_title($id) . '\')" alt="Share on Facebook" title="Share on Facebook" class="Facebook social-network"><i class="fa fa-facebook"></i><span>Facebook</span></a>';

	//twitter

	echo '<a onclick="shareTwWindow(\'' . get_the_title($id) . ' -&url=' . get_permalink($id) . '&via=a4a_internet\')" alt="Tweet This Post" title="Tweet This Post" class="Twitter social-network"><i class="fa fa-twitter"></i><span>Twitter</span></a>';

	//Google

	echo '<a onclick="shareGoogleWindow(\'' . get_the_title($id) . ' -&url=' . get_permalink($id) . '&via=A4AIUsername\')" alt="Share This Post" title="Share This Post" class="Google social-network"><i class="fa fa-google-plus"></i><span>Google+</span></a>';

}

/*SEARCH BOX*/

function wpshock_search_filter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array('post','page') );
    }
    return $query;
}
add_filter('pre_get_posts','wpshock_search_filter');

add_post_type_support('page', 'excerpt'); //excerpt for pages



/*MENU*/


add_action('admin_menu', 'team_menu');
function team_menu() {
add_submenu_page('edit.php', 'Team', 'Team', 'manage_options', 'edit.php?category_name=team' ); }



add_action('admin_menu', 'featured_menu');
function featured_menu() {
add_submenu_page('edit.php', 'Featured', 'Featured', 'manage_options', 'edit.php?category_name=home-featured' ); }


add_action('admin_menu', 'news_and_events_menu');
function news_and_events_menu() {
add_submenu_page('edit.php', 'News', 'News', 'manage_options', 'edit.php?category_name=news' ); }


add_action('admin_menu', 'events_calendar_menu');
function events_calendar_menu() {
add_submenu_page('edit.php', 'Events Calendar', 'Events Calendar', 'manage_options', 'edit.php?category_name=events-calendar' ); }


add_action('admin_menu', 'from_the_blog_menu');
function from_the_blog_menu() {
add_submenu_page('edit.php', 'Blog', 'Blog', 'manage_options', 'edit.php?category_name=blog' ); }


add_action('admin_menu', 'press_releases_menu');
function press_releases_menu() {
add_submenu_page('edit.php', 'Press Releases', 'Press Releases', 'manage_options', 'edit.php?category_name=press-releases' ); }


add_action('admin_menu', 'talks_menu');
function talks_menu() {
add_submenu_page('edit.php', 'Talks and Appearances', 'Talks and Appearances', 'manage_options', 'edit.php?category_name=talks-and-appearances' ); }


add_action('admin_menu', 'm_research_menu');
function m_research_menu() {
add_submenu_page('edit.php', 'Members Research', 'Members Research', 'manage_options', 'edit.php?category_name=members-research' ); }



add_action('admin_menu', 'white_menu');
function white_menu() {
add_submenu_page('edit.php', 'White Papers', 'White Papers', 'manage_options', 'edit.php?category_name=white-papers' ); }



add_action('admin_menu', 'newsletter_menu');
function newsletter_menu() {
add_submenu_page('edit.php', 'Newsletters', 'Newsletters', 'manage_options', 'edit.php?category_name=newsletter' ); }





/* sorts the post based on a date value in custom fields
*/
function wdw_query_orderby_postmeta_date( $orderby ){
    $new_orderby = str_replace( "wp_postmeta.meta_value", "STR_TO_DATE(wp_postmeta.meta_value, '%m/%d/%Y')", $orderby );
    return $new_orderby;
}




/*ADMIN PANEL FOR MEMBERS*/
/**
 * Disable admin bar on the frontend of your website
 * for subscribers.
 */
function themeblvd_disable_admin_bar() {
	if( ! current_user_can('edit_posts') )
		add_filter('show_admin_bar', '__return_false');
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );

/**
 * Redirect back to homepage and not allow access to
 * WP admin for Subscribers.
 */
function themeblvd_redirect_admin(){
	if ( ! current_user_can( 'edit_posts' ) ){
		wp_redirect( site_url() );
		exit;
	}
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );



?>
