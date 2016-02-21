<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
 
 
 <div id="archive_container">
 

	<?php if (have_posts()) : ?>

		<h2 class="Title"><?php _e('Search Results','html5reset'); ?> for <strong><?php the_search_query(); ?></strong></h2>
        
        

		<?php  //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
        
		<?php //query_posts("cat=36,20,4,22&paged=$paged"); ?>
		
		<?php while (have_posts()) : the_post(); ?>

            	<?php $category = get_the_category(); ?>
               		<?php   if ($category[0]->cat_name != "Team"){ ?>     <!--EXCLUDE TEAM-CATEGORY-->
             
             
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

				<h6 class="metadata"><?php posted_on(); ?></h6>

				<div class="entry">

					<?php the_excerpt(); ?>

				</div>

			</article>
            
            <?php } ?>

		<?php endwhile; ?>

		<?php             
		echo '<div class="navigation show_navi">';
		echo '	<div class="prev-posts">'.previous_posts_link('Newest Results &raquo;').'</div>';
		echo '	<div class="next-posts">'.next_posts_link('&laquo; More Results').'</div>';
		echo '</div>';
		 ?>

	<?php else : ?>

		<h2><?php _e('Nothing Found','html5reset'); ?></h2>

	<?php endif; ?>

<?php //get_sidebar(); ?>
 
 </div>
 
 <script type='text/javascript'> $("#sidebar_home").fadeIn("slow"); </script>

<?php get_footer(); ?>
