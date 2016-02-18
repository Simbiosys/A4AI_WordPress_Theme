<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */

require_once(get_stylesheet_directory().'/renderization/controller.php');

$controller = Controller::getInstance();
$renderer = $controller->renderer;

$template = '404';

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
