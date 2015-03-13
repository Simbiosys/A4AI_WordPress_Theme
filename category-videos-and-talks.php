<?php
/**
* @package WebFoundation
* @subpackage A4AI
*/

get_header(); ?>



    <div id="Roll">
        <div class="wrapper">
        	<div class="ListBlog">

<?php $sort= ''; $tags= ''; ?>

            <div id="organize_by_posts">
              <p>ORGANIZE BY</p>
              <div>
                <a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=date'; ?>" 
                <?php if ($_GET['sort'] == 'date'){ echo 'class="active"'; } ?>
                <?php if ($_GET['sort'] == ''){ echo 'class="active"'; } ?>>Date</a>
                <a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=title'; ?>"
                <?php if ($_GET['sort'] == 'title'){ echo 'class="active"'; } ?>>Title</a>
                <a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=relevance'; ?>"
                <?php if ($_GET['sort'] == 'relevance'){ echo 'class="active"'; } ?>>Relevance</a>
              </div>
            </div>

           <div id="show_cat">
            <ul id="cat_list">
            <li class="all_category <?php if ($_GET['tags'] == ''){ echo 'current-cat'; } ?>"><a href="<?php echo esc_url( home_url( '/category/news/talks-and-appearances' ) ); ?>" >All</a></li>

			 <?php $tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );

			foreach ( (array) $tags as $tag ) {

			if($_GET['tags'] == $tag->name) {$my_class = "current-cat";} else {$my_class = "";}

			echo '<li class="'.$my_class.'"><a href="' .  str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?tags='.$tag->name.'' . '" rel="tag">' . $tag->name . ' (' . $tag->count . ') </a></li>';
             }?>
             </ul>
            </div>




                <h2 class="Title">Videos and Talks</h2>

                <?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts('paged=$paged&cat=20&orderby=date&order=DESC');


                if($_GET['sort'] == 'title') query_posts('paged=$paged&cat=20&orderby=title&order=ASC');

				if($_GET['sort'] == 'date') query_posts('paged=$paged&cat=20&orderby=date&order=DESC');

				if($_GET['sort'] == 'relevance') query_posts('paged=$paged&cat=20&orderby=comment_count&order=DESC');

				if($_GET['tags']) query_posts('paged=$paged&cat=20&tag='.$_GET['tags'].'');

				$cat_num=0;
				$class_url = '';
				$meta_text = '';


				if (have_posts()) : while (have_posts()) : the_post(); ?>

                  <?php global $cat_num; $cat_num++;

				       if ($cat_num <= 3){

					global $class_url; global $meta_text;
				    $video_meta=  get_post_meta(get_the_id(), 'video', true);
					if ($video_meta == "") {
						$class_url = '';
						$meta_text = "Read More";
						$meta_url = '';
						} else {
						$class_url = "popup".$cat_num;
						$meta_text = "See Video";
						} ?>


                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">      <!--DIV-SHOWN-->
                        <div class="Head">
				<div class="image_blog_home">
                            		<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'grid-size' ); ?></a>
				</div>
                        </div>
                        <div class="Content">
                            <div class="entry">
								<h2><a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<h4><?php echo  get_post_meta(get_the_id(), 'subtitle', true); ?></h4>
                            </div>
                            <footer>
                            	<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
                            	<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><h3><?php echo $meta_text ?></h3></a>
                            </footer>
                        </div>
                    </article>


                     <div class="popup_container" style="display:none">
                    <div id="pop_box<?php echo $cat_num ?>">             <!--DIV-HIDDEN-POPUP-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <h3><?php echo  get_post_meta(get_the_id(), 'subtitle', true); ?></h3>
                        <div class="Head">
				<?php echo  get_post_meta(get_the_id(), 'video', true); ?>
                		</div>
                        <div class="Content">
                            <div class="entry">
                                <p><?php
								$content = get_the_content();
								print $content;?></p>
                          <a class="meta_url" target="_blank" title="See video in a new tab" href="<?php the_permalink() ?>"><?php the_permalink() ?></a>


                            </div>
                        </div>
                    </article>
                    </div></div> <!--END popup container & popup_box-->

                      <?php } else { ?>

                      <?php   if ($cat_num == 4){ ?>
                   		<a class="ViewAll" id="show_more">show more</a>
					<?php } ?>


            <div class="ListNews hidden_news">


             <?php global $class_url; global $meta_text;
				    $video_meta=  get_post_meta(get_the_id(), 'video', true);
					if ($video_meta == "") {
						$class_url = '';
						$meta_text = "Read More";
						$meta_url = '';
						} else {
						$class_url = "popup".$cat_num;
						$meta_text = "See Video";
						} ?>


                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">      <!--DIV-SHOWN-->
                        <div class="Head">
				<div class="image_blog_home">
                            		<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'grid-size' ); ?></a>
				</div>
                        </div>
                        <div class="Content">
                            <div class="entry">
								<h2><a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<h4><?php echo  get_post_meta(get_the_id(), 'subtitle', true); ?></h4>
                            </div>
                            <footer>
                            	<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
                            	<a class="<?php echo $class_url ?>" href="<?php the_permalink() ?>"><h3><?php echo $meta_text ?></h3></a>
                            </footer>
                        </div>
                    </article>


                     <div class="popup_container" style="display:none">
                    <div id="pop_box<?php echo $cat_num ?>">             <!--DIV-HIDDEN-POPUP-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <h3><?php echo  get_post_meta(get_the_id(), 'subtitle', true); ?></h3>
                        <div class="Head">
				<?php echo  get_post_meta(get_the_id(), 'video', true); ?>
                		</div>
                        <div class="Content">
                            <div class="entry">
                                <p><?php
								$content = get_the_content();
								print $content;?></p>
                          <a class="meta_url" target="_blank" title="See video in a new tab" href="<?php the_permalink() ?>"><?php the_permalink() ?></a>


                            </div>
                        </div>
                    </article>
                    </div></div> <!--END popup container & popup_box-->

                    </div><!--END hidden news-->

            			<?php } ?>

                <?php endwhile; ?>

                <?php else : ?>

                    <h2><?php _e('These are all available articles at this moment','html5reset'); ?></h2>

                <?php endif; ?>


                			<?php global $cat_num;
								    if ($cat_num <= 3){
                   					echo '<div class="navigation show_navi">';
									echo '	<div class="prev-posts">'.previous_posts_link('Newer Entries &raquo;').'</div>';
									echo '	<div class="next-posts">'.next_posts_link('&laquo; Older Entries').'</div>';
									echo '</div>';
									} else {
									echo '<div class="navigation">';
									echo '	<div class="prev-posts">'.previous_posts_link('Newer Entries &raquo;').'</div>';
									echo '	<div class="next-posts">'.next_posts_link('&laquo; Older Entries').'</div>';
									echo '</div>';

									}
								?>






        <script>

  $("#show_more").click(function () {
  $(".hidden_news").fadeIn("slow");
  $(".navigation").fadeIn("slow");
  $("#show_more").fadeOut("slow");

});

    </script>



                </div>

            </div>


        </div>

    </div>






<?php get_footer(); ?>
