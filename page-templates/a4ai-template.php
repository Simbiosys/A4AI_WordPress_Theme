<?php
/**
 * Template Name: A4AI Page
 *
 * @package WordPress
 * @subpackage A4AI
 * @since 1.0
 */
	require_once(get_stylesheet_directory().'/renderization/controller.php');

	$controller = Controller::getInstance();
	$renderer = $controller->renderer;

	global $post;
	$post_slug = $post->post_name;
	$post_type = $post->post_type;

	$template = $post_type == 'report' ? $post_type : $post_slug;

	get_header();
	$html = $renderer->renderTemplate($template);

	if (!$html) {
		echo '<main class="content">';
		echo '<div class="container">';
				$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$template'");
				if ($id) {
					echo apply_filters('the_content', get_post($id)->post_content);
				} else {
					echo '404';
				}
			echo '</div></main>';
	} else {
		echo $html;
	}

	get_footer();
	die();
?>
