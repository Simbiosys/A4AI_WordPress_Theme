<?php
/**
* @package WebFoundation
* @subpackage A4AI
*
*/

get_header(); ?>

<div id="news_container">

	<div id="Featured">

        <div class="events_header Holder">


        <div id="events_cont"></div>

        	<div id="carousel_container" class="carousel_events"><?php echo get_touchcarousel(3); ?></div>

</div>

    </div>


    <div id="Roll">

        <div class="wrapper">
        	<div class="ListBlog">



<?php $sort= ''; ?>
<?php $post_num=0; ?>


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

                <h2 class="Title">White Papers</h2>

                <?php
				 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				 query_posts("cat=62&paged=$paged&orderby=date&order=DESC");

                if($_GET['sort'] == 'title') query_posts("cat=62&paged=$paged&orderby=title&order=ASC");

				if($_GET['sort'] == 'date') query_posts("cat=62&paged=$paged&orderby=date&order=DESC");

				if($_GET['sort'] == 'relevance') query_posts("cat=62&paged=$paged&orderby=comment_count&order=DESC");


				if (have_posts()) : while (have_posts()) : the_post(); ?>

                 <?php $post_num++; ?>

                 <?php   if ($post_num <= 3){ ?>

                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">


                        <div class="Content">

                            <div class="entry">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

                                <?php  $author= get_post_meta(get_the_id(), 'author', true); ?>
                                <?php  $institution= get_post_meta(get_the_id(), 'institution', true); ?>
                                <?php  $date_research= get_post_meta(get_the_id(), 'date_research', true); ?>
								<?php if( $author != '') { ?>
                                <h6 class="metadata author">Author: <?php echo $author ?> </h6>
                                <?php } ; ?>
                                <?php if( $institution != '') { ?>
                                <h6 class="metadata author">Institution: <?php echo $institution ?> </h6>
                                <?php } ; ?>
                                <?php if( $date_research != '') { ?>
                                <h6 class="metadata author">Date of Research: <?php echo $date_research ?> </h6>
                                <?php } ; ?>


                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="postmetadata">
                            <a class="moretag" href="<?php the_permalink() ?>">Read more</a>
                                <h3 class="Tags"><?php the_tags('',' | '); ?></h3>
                                <h3 class="Social">
		                            <strong>SHARE</strong>
									<?php get_share_icons($page->ID); ?>
                                    <a href="<?php comments_link(); ?>" class="Comments"><i class="fa fa-comment"></i> <?php get_post_comments_count($page->ID); ?></a>

                                </h3>

                            </footer>
                        </div>

                    </article>




                   <?php }else { ?>


                    <?php   if ($post_num == 4){ ?>
                   		<a class="ViewAll" id="show_more">show more</a>
					<?php } ?>


            <div class="ListNews hidden_news">


                     <article <?php post_class() ?> id="post-<?php the_ID(); ?>">


                        <div class="Content">

                            <div class="entry">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

                                <?php  $author= get_post_meta(get_the_id(), 'author', true); ?>
								<?php if( $author != '') { ?>
                                <h6 class="metadata author">Author: <?php echo $author ?> </h6>
                                <?php } ; ?>
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="postmetadata">
                            <a class="moretag" href="<?php the_permalink() ?>">Read more</a>
                                <h3 class="Tags"><?php the_tags('',' | '); ?></h3>
                                <h3 class="Social">
		                            <strong>SHARE</strong>
									<?php get_share_icons($page->ID); ?>
                                    <a href="<?php comments_link(); ?>" class="Comments"><i class="fa fa-comment"></i> <?php get_post_comments_count($page->ID); ?></a>

                                </h3>

                            </footer>
                        </div>

                    </article>



                                  </div>
                    <?php }  ?>


                <?php endwhile; ?>

                <?php else : ?>

                    <h2><?php _e('These are all available articles at this moment','html5reset'); ?></h2>

                <?php endif; ?>

                				<?php global $post_num;
								    if ($post_num <= 3){
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
