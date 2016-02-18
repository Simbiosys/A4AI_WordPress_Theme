<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */

 require_once(plugin_dir_path(__FILE__) . "/renderization/utils/report_utils.php");

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

//////////////////////////////////////////////////////////////////////////////////////////
//                                   Custom post type
//////////////////////////////////////////////////////////////////////////////////////////

$_DEBUG = TRUE;

add_action('init', 'custom_post_types');

function custom_post_types() {
	// Reports

	register_post_type('report',
		array(
			'public' => true,
			'labels' => array(
				'name' => __( 'Reports' ),
				'singular_name' => __( 'Report' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Report' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Report' ),
				'new_item' => __( 'New Report' ),
				'view' => __( 'View Report' ),
				'view_item' => __( 'View Report' ),
				'search_items' => __( 'Search Reports' ),
				'not_found' => __( 'No Reports found' ),
				'not_found_in_trash' => __( 'No Reports found in Trash' ),
				'parent' => __( 'Parent Report' ),
				'all_items' => __( 'All Reports' )
			),
			'menu_icon' => get_stylesheet_directory_uri() . '/images/dashboard/report.png',
			'hierarchical' => false,
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
			'show_in_menu' => false,
			'rewrite' => array('slug' => 'affordability-report/report')
		)
	);

	// Report items

	register_post_type('report_item',
		array(
			'public' => true,
			'labels' => array(
				'name' => __( 'Report Items' ),
				'singular_name' => __( 'Report Item' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Report Item' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Report Item' ),
				'new_item' => __( 'New Report Item' ),
				'view' => __( 'View Report Item' ),
				'view_item' => __( 'View Report Item' ),
				'search_items' => __( 'Search Report Items' ),
				'not_found' => __( 'No Report Items found' ),
				'not_found_in_trash' => __( 'No Report Items found in Trash' ),
				'parent' => __( 'Parent Report Item' ),
				'all_items' => __( 'All Report Items' )
			),
			'menu_icon' => get_stylesheet_directory_uri() . '/images/dashboard/report.png',
			'hierarchical' => false,
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
			'show_in_menu' => false
		)
	);
}

add_action('admin_menu', 'report_register');

////////////////////////////////////////////////////////////////////////////////
//
////////////////////////////////////////////////////////////////////////////////

function report_register() {
    add_menu_page(
        'Reports',     // page title
        'Reports',     // menu title
        'manage_options',   // capability
        'reports',     // menu slug
        'reports_render', // callback function
				get_stylesheet_directory_uri() . '/images/dashboard/report.png',
				26
    );
}

function reports_render() {
		require_once(plugin_dir_path(__FILE__) . '/inc/lightncandy/lightncandy.php');
    global $title;
		global $_DEBUG;

		$template = "reports";
		$path = plugin_dir_path(__FILE__) . "/renderization/dashboard";
    $file = "$path/views/$template.hbs";

		if ($_DEBUG || !file_exists("$path/compiled-views/$template.php")) {
	    if (file_exists($file)) {
				$file = file_get_contents($file);

				$compiledTemplate = LightnCandy::compile($file, Array(
						'flags' => LightnCandy::FLAG_STANDALONE | LightnCandy::FLAG_SPVARS,
						'helpers' => array(
							'selected_item' => function ($args) {
								return $args[0] == $args[1] ? "selected" : "";
							},
							'get_item_index' => function ($args) {
								return intval($args[0]) + 0.5;
							},
              'format_table' => function ($args) {
                return str_replace("{{caption}}", "", $args[0]);
              }
						)
				));

				file_put_contents("$path/compiled-views/$template.php", $compiledTemplate);
			}
		}

		$renderer = include("$path/compiled-views/$template.php");

		$reports = get_reports();
		$first = count($reports) > 0 ? $reports[0] : NULL;

		$selected = NULL;

		if (isset($_GET["report"])) {
			$selected = get_post($_GET["report"]);
		}

		if ($selected) {
			$selected = $selected->to_array();
		}
		else {
			$selected = $first;
		}

		$items = get_report_items($selected["ID"]);

		echo $renderer(array(
			"title" => $title,
			"reports" => $reports,
			"items" => $items,
			"selected" => $selected,
			"root" => get_stylesheet_directory_uri(),
			"host" => get_home_url()
		));
}

function get_reports() {
	$reports = get_posts(array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_name',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'report',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'any',
		'suppress_filters' => true
	));

	$processed = array();

	foreach ($reports as $report) {
		array_push($processed, $report->to_array());
	}

	return $processed;
}

////////////////////////////////////////////////////////////////////////////////
//                         REPORT ITEM EXTRA INFO
////////////////////////////////////////////////////////////////////////////////

function report_item_hidden_meta_box_markup($object) {
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	$report = get_post_meta($object->ID, "meta-box-report-id", true);
	$post = NULL;
	$report_name = "";
	$order = "";
  $number = "";
	$type = "";
	$checked = FALSE;
	$table = "";
	$chart = "";

	if (empty($report) && isset($_GET["report"])) {
		$report = $_GET["report"];
	}

	if (!empty($report)) {
		$post = get_post($report);
		$report_name = $post->post_title;
		$order = get_post_meta($object->ID, "meta-box-order", true);
    $number = get_post_meta($object->ID, "meta-box-number", true);
		$type = get_post_meta($object->ID, "meta-box-block-type", true);
		$checked = get_post_meta($object->ID, "meta-box-highlighted-icon", true) == 'on';
		$table = get_post_meta($object->ID, "meta-box-table-type", true);
		$chart = get_post_meta($object->ID, "meta-box-chart-type", true);
	}

	if (empty($order) && isset($_GET["order"])) {
		$order = $_GET["order"];
	}

	if ($order == -1) {
		$all_items = get_report_items($report);
		$order = count($all_items) + 1;
	}

	$checked = $checked ? 'checked' : '';
	$check_to_show = $type == 'highlighted' ? '' : 'data-hidden';

	$path = plugin_dir_path(__FILE__) . "/renderization/dashboard/data/tables.json";
	$tables = json_decode(utf8_encode(file_get_contents($path)), TRUE);
	$table_to_show = $type == 'table' ? '' : 'data-hidden';

	$path = plugin_dir_path(__FILE__) . "/renderization/dashboard/data/charts.json";
	$charts = json_decode(utf8_encode(file_get_contents($path)), TRUE);
	$chart_to_show = $type == 'chart' ? '' : 'data-hidden';
  ?>
  <div>
		<input type="hidden" name="meta-box-report-id" class="" value="<?= $report ?>" />
		<input type="text" name="report_name" class="width-100" value="<?= $report_name ?>" readonly />
		<label for="order" class="margin-top-10 display-block">Order</label>
		<input type="text" id="order" name="meta-box-order" class="width-100" value="<?= $order ?>" readonly />
    <label for="number" class="margin-top-10 display-block">Chapter number (leave it empty to be incremental)</label>
		<input type="text" id="number" name="meta-box-number" class="width-100" value="<?= $number ?>" />
		<label for="type" class="margin-top-10 display-block">Block type</label>
		<select id="type" name="meta-box-block-type" class="width-100">
			<optgroup label="Block Types">
				<option value="text" <?= selected_item($type, 'text') ?>>Text</option>
				<option value="highlighted" <?= selected_item($type, 'highlighted') ?>>Highlighted box</option>
				<option value="table" <?= selected_item($type, 'table') ?>>Data table</option>
				<option value="chart" <?= selected_item($type, 'chart') ?>>Chart</option>
			</optgroup>
			<optgroup label="Headings">
				<option value="heading_1" <?= selected_item($type, 'heading_1') ?>>1st Level Heading (i.e., 1)</option>
				<option value="heading_2" <?= selected_item($type, 'heading_2') ?>>2nd Level Heading (i.e., 1.1)</option>
				<option value="heading_3" <?= selected_item($type, 'heading_3') ?>>3rd Level Heading (i.e., 1.1.1)</option>
				<option value="heading_4" <?= selected_item($type, 'heading_4') ?>>4th Level Heading (i.e., 1.1.1.1)</option>
				<option value="heading_5" <?= selected_item($type, 'heading_5') ?>>5th Level Heading (i.e., 1.1.1.1.1)</option>
			</optgroup>
		</select>
		<p class="margin-top-10 margin-bottom-0 overflow-hidden" <?= $check_to_show ?> id='check'>
			<label for="icon" class="float-left">Show icon</label>
			<input type="checkbox" id="icon" name="meta-box-highlighted-icon" <?= $checked ?> class="float-right" />
		</p>
		<div <?= $table_to_show ?> id="table_container">
			<label for="table" class="margin-top-10 display-block">Table</label>
			<select id="table" name="meta-box-table-type" class="width-100">
				<option value='' disabled selected>Select a table</option>
				<? foreach ($tables as $year => $year_tables): ?>
							<optgroup label="<?= $year ?>">
								<? foreach ($year_tables["tables"] as $name => $table_data):
										$name_to_show = ucwords(str_replace("-", " ", $name));
								?>
									<option value="<?= $year . ":" . $name ?>" <?= selected_item($table, $year . ":" . $name) ?>><?= $name_to_show ?></option>
								<? endforeach; ?>
							</optgroup>
				<? endforeach; ?>
			</select>
		</div>
		<div <?= $chart_to_show ?> id="chart_container">
			<label for="chart" class="margin-top-10 display-block">Chart</label>
			<select id="chart" name="meta-box-chart-type" class="width-100">
				<option value='' disabled selected>Select a chart</option>
				<? foreach ($charts as $year => $year_charts): ?>
							<optgroup label="<?= $year ?>">
								<? foreach ($year_charts["charts"] as $name => $chart_data):
										$name_to_show = $chart_data["name"];
								?>
									<option value="<?= $year . ":" . $name ?>" <?= selected_item($chart, $year . ":" . $name) ?>><?= $name_to_show ?></option>
								<? endforeach; ?>
							</optgroup>
				<? endforeach; ?>
			</select>
		</div>
	</div>
	<script>
		var menuItem = document.getElementById('toplevel_page_reports');

		if (menuItem) {
			menuItem.className = menuItem.className + " current";

			var anchor = menuItem.querySelector("a");

			if (anchor) {
				anchor.className = anchor.className + " current";
			}
		}

		document.getElementById('type').onchange = function(event) {
			var check = document.getElementById('check');
			var table_container = document.getElementById('table_container');
			var chart_container = document.getElementById('chart_container');

			if (this.value == 'highlighted') {
				check.removeAttribute('data-hidden');
			}
			else {
				check.setAttribute('data-hidden', '');
				check.checked = false;
			}

			if (this.value == 'table') {
				table_container.removeAttribute('data-hidden');
			}
			else {
				table_container.setAttribute('data-hidden', '');
			}

			if (this.value == 'chart') {
				chart_container.removeAttribute('data-hidden');
			}
			else {
				chart_container.setAttribute('data-hidden', '');
			}
		}
	</script>
  <?php
}

function report_item_add_custom_meta_box() {
  add_meta_box("report-item-hidden-meta-box", "Report", "report_item_hidden_meta_box_markup", "report_item", "side", "high", null);
}

add_action("add_meta_boxes", "report_item_add_custom_meta_box");

function save_meta_box_field($post_id, $name) {
	$value = "";

	if (isset($_POST[$name])) {
    $value = $_POST[$name];
  }

  update_post_meta($post_id, $name, $value);
}

function save_report_item($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if (!current_user_can("edit_post", $post_id))
        return $post_id;

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slugs = array("report_item");

    if (!in_array($post->post_type, $slugs))
        return $post_id;

    save_meta_box_field($post_id, "meta-box-report-id");
		save_meta_box_field($post_id, "meta-box-order");
    save_meta_box_field($post_id, "meta-box-number");
		save_meta_box_field($post_id, "meta-box-block-type");
		save_meta_box_field($post_id, "meta-box-highlighted-icon");
		save_meta_box_field($post_id, "meta-box-table-type");
		save_meta_box_field($post_id, "meta-box-chart-type");

		// Update order numbers when there is a conflict
		$report = get_post_meta($post_id, "meta-box-report-id", true);
		$order = intval(get_post_meta($post_id, "meta-box-order", true));
		$all_items = get_report_items($report);

		usort($all_items, function($a, $b) {
			$a_order = floatval($a["meta-box-order"]);
			$b_order = floatval($b["meta-box-order"]);

			$a_id = $a["ID"];
			$b_id = $b["ID"];

			if ($a_order == $b_order) {
				return $a_id == $post_id ? 1 : -1;
			}

			return ($a_order < $b_order) ? -1 : 1;
		});

		for ($i = 0; $i < count($all_items); $i++) {
			$item = $all_items[$i];
			$current_order = $i + 1;

			$item_id = $item["ID"];
			$item_order = intval($item["meta-box-order"]);

			//if ($item_order != $current_order && $item_id != $post_id) {
			update_post_meta($item_id, 'meta-box-order', $current_order);
			//}
		}
}

add_action("save_post", "save_report_item", 10, 3);

////////////////////////////////////////////////////////////////////////////////
//                      FORCE REPORT ITEMS TO BE PRIVATE
////////////////////////////////////////////////////////////////////////////////

function filter_post_data($data , $postarr) {
	if ($postarr['post_status'] == 'trash') {
		return $data;
	}

  if (!empty($data['guid']) && $data['post_type'] == 'report_item') {
  	$data['post_status'] = 'private';
	}

  return $data;
}

add_filter('wp_insert_post_data', 'filter_post_data', '99', 2);

////////////////////////////////////////////////////////////////////////////////
//                        REDIRECTION AFTER DELETION
////////////////////////////////////////////////////////////////////////////////

function my_trash_action($post_id) {
	$post_type = get_post_type($post_id);

	if ('report_item' != $post_type && 'report' != $post_type) {
		return;
	}

	// Reorder items
	if ('report_item' == $post_type) {
		$report = get_post_meta($post_id, "meta-box-report-id", true);
		$all_items = get_report_items($report);

		usort($all_items, function($a, $b) {
			$a_order = $a["meta-box-order"];
			$b_order = $b["meta-box-order"];

			if ($a_order == $b_order) {
				return 0;
			}

			return ($a_order < $b_order) ? -1 : 1;
		});

		$current_order = 1;

		for ($i = 0; $i < count($all_items); $i++) {
			$item = $all_items[$i];
			$item_id = $item["ID"];

			if ($item_id == $post_id) {
				continue;
			}

			$item_order = intval($item["meta-box-order"]);

			if ($item_order != $current_order) {
				update_post_meta($item_id, 'meta-box-order', $current_order);
			}

			$current_order++;
		}
	}

	wp_redirect(home_url('/wp-admin/admin.php?page=reports'));
	exit;
}

add_action('trashed_post', 'my_trash_action');

////////////////////////////////////////////////////////////////////////////////
//                               ADMIN CUSTOM CSS
////////////////////////////////////////////////////////////////////////////////

add_action('admin_head', 'my_custom_css');

function my_custom_css() {
	$path = plugin_dir_path(__FILE__) . "/renderization/dashboard/css/reports.css";
	echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">';
	echo "<style>" . file_get_contents($path) . "</style>";
}

////////////////////////////////////////////////////////////////////////////////
//                             AJAX ACTIONS
////////////////////////////////////////////////////////////////////////////////

add_action('wp_ajax_move', 'ajax_move');

function ajax_move() {
	$id = $_POST["id"];
	$direction = $_POST["direction"];

	$report = get_post_meta($id, "meta-box-report-id", true);
	$order = intval(get_post_meta($id, "meta-box-order", true));

	$new_order = $order + ($direction == "up" ? -1 : +1);

	// Find existing one at that position
	$existing = get_posts(array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_title',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => 'meta-box-order',
		'meta_value'       => $new_order,
		'post_type'        => 'report_item',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'any',
		'suppress_filters' => true
	));

	$modified = array();

	foreach ($existing as $element) {
		update_post_meta($element->ID, 'meta-box-order', $order);

		array_push($modified, $element->ID);
	}

	update_post_meta($id, 'meta-box-order', $new_order);

  echo json_encode(array(
		"success" => TRUE,
		"id" => $id,
		"direction" => $direction,
		"order" => $order,
		"new_order" => $new_order,
		"modified" => $modified
	));

  die();
}

add_action('wp_ajax_drag', 'ajax_drag');

function ajax_drag() {
	$elements = $_POST["elements"];

	$result = array();

	for ($i = 0; $i < count($elements); $i++) {
		$id = $elements[$i];

		if (!get_post($id)) {
			continue;
		}

		update_post_meta($id, 'meta-box-order', $i + 1);

		$result[$id] = array(
			"index" => $i,
			"new_index" => $i + 1
		);
	}

	echo json_encode(array(
		"success" => TRUE,
		"elements" => $elements,
		"result" => $result
	));

	die();
}

add_action('wp_ajax_anchor', 'ajax_anchor');

function ajax_anchor() {
	$element = $_POST["element"];
  $value = $_POST["value"];

	update_post_meta($element, 'meta-box-anchor', $value);

	echo json_encode(array(
		"success" => TRUE
	));

	die();
}

////////////////////////////////////////////////////////////////////////////////
//										REDIRECT AFTER SAVE REPORT ITEM
////////////////////////////////////////////////////////////////////////////////

function my_redirect_after_save_report_item($location, $post_id) {
	if ('report_item' == get_post_type($post_id)) {
    $report = get_post_meta($post_id, "meta-box-report-id", true);
		$order = get_post_meta($post_id, "meta-box-order", true);
    $url = "admin.php?page=reports";

    if (!empty($report)) {
      $url = "$url&report=$report";
    }

  	$location = admin_url("$url#block-" . $order);
  }

	return $location;
}

add_filter('redirect_post_location', 'my_redirect_after_save_report_item', 10, 2);

////////////////////////////////////////////////////////////////////////////////
//										    RENDER TEMPLATE FOR REPORTS
////////////////////////////////////////////////////////////////////////////////

add_filter('single_template', function($original) {
  global $post;
  $post_type = $post->post_type;

	if ($post_type == 'report') {
		return get_template_directory() . '/page-templates/a4ai-template.php';
	}

  return $original;
});

////////////////////////////////////////////////////////////////////////////////
//																		AUX
////////////////////////////////////////////////////////////////////////////////

function selected_item($a, $b) {
	return $a == $b ? "selected" : "";
}

////////////////////////////////////////////////////////////////////////////////
//													ADD CSS TO DASHBOARD
////////////////////////////////////////////////////////////////////////////////
function my_theme_add_editor_styles() {
    add_editor_style('/renderization/dashboard/css/private.css');
}

add_action('admin_init', 'my_theme_add_editor_styles');
