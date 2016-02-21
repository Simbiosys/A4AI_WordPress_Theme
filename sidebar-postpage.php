<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */
?>
 <div id="sidebar" class="sidebar">

 <h3 class="widget-title">Related Categories</h3>
 <ul>
<?php

	global $post;

	$cats = get_the_category($post->ID);

	$catid = $cats[0]->cat_ID;

	while ($catid) {

	  $cat = get_category($catid);

	  $catid = $cat->category_parent;

	  $catParent = $cat->cat_ID;

	}



	$categories = get_categories('child_of='.$catParent);

	foreach ($categories as $category) {

		echo '<li><a href="'.get_category_link($category->cat_ID).'">'.$category->cat_name.'</a></li>';

	}

?>
</ul>
</div>
