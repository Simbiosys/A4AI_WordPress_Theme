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

        	<div id="carousel_container" class="carousel_events">
        		<?php echo get_touchcarousel(3); ?>
        	</div>

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
								<?php if ($_GET['sort'] == 'date'){ echo 'class="active"'; } ?>>Event Date</a>
								<a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=relevance'; ?>"
								<?php if ($_GET['sort'] == 'relevance'){ echo 'class="active"'; } ?>>Relevance</a>
							</div>
							<a style="float: right;" data-type="older" href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=older'; ?>"
							<?php if ($_GET['sort'] == 'older'){ echo 'class="active"'; } ?>>Older Events &raquo;</a>
						</div>

                <h2 class="Title">Events</h2>

                <?php $todaysDate = date('m/d/Y');
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


			 if ($_GET['sort'] == '' || $_GET['sort'] == 'date' ){


	 			 $today = date('m-d-Y');
     			 query_posts(array(
    			 'cat' => 19,
    			 'posts_per_page' => 10,
    			 'paged' => $paged,
     			 'meta_key' => 'event_date',
     			 'orderby' => 'meta_value',
     			 'order' => 'DESC',
   				 'meta_query' => array(
         	     array(
         		'key' => 'event_date',
        		'meta-value' => $value,
                'value' => $today,
                'compare' => '>=',
                'type' => 'CHAR'
        	 )
     	 )
  	 ));
	}
		 //query_posts("cat=19&paged=$paged&meta_key=event_date&orderby=meta_value&order=DESC");


                if($_GET['sort'] == 'title') query_posts("cat=19&paged=$paged&orderby=title&order=ASC");

				if($_GET['sort'] == 'relevance') query_posts("cat=19&paged=$paged&orderby=comment_count&order=DESC");

				if($_GET['sort'] == 'older') {

					 $today = date('m-d-Y');
     			 query_posts(array(
    			 'cat' => 19,
    			 'posts_per_page' => 10,
    			 'paged' => $paged,
     			 'meta_key' => 'event_date',
     			 'orderby' => 'meta_value',
     			 'order' => 'DESC',
   				 'meta_query' => array(
         	     array(
         		'key' => 'event_date',
        		'meta-value' => $value,
                'value' => $today,
                'compare' => '<',
                'type' => 'CHAR'
        	 )
     	 )
  	 ));
					};


				if (have_posts()) : while (have_posts()) : the_post(); ?>

                 <?php $post_num++; ?>

                 <?php   if ($post_num <= 3){ ?>

                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <div class="Head">
				<div class="image_blog_home">
                           <a class="shadow" href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?></a>

                     <?php 	$string_event = get_post_meta($post->ID, 'event_date', true);
							$date = explode('/', $string_event);
							$month = $date[0];
							$day   = $date[1];
							$year  = $date[2]; ?>




                           <div class="event_items">
                           <h2><?php echo  $day; ?></h2>
                           <h3><?php  if ( $month=="01" || $month=="1") { echo "January"; } else if ( $month=="02" || $month=="2") { echo "February"; } else if ( $month=="03" || $month=="3") { echo "March"; } else if ( $month=="04" || $month=="4") { echo "April"; } else if ( $month=="05" || $month=="5") { echo "May"; } else if ( $month=="06" || $month=="6") { echo "June"; } else if ( $month=="07" || $month=="7") { echo "July"; } else if ( $month=="08" || $month=="8") { echo "August"; } else if ( $month=="09" || $month=="9") { echo "September"; } else if ( $month=="10") { echo "October"; } else if ( $month=="11") { echo "November"; } else if ( $month=="12") { echo "December"; }?></h3>
                           <p><?php echo $year; ?></p>
                           <h3><?php echo  get_post_meta(get_the_id(), 'time-event', true); ?></h3>
                           </div>

				</div>
                        </div>

                        <div class="Content">

                            <div class="entry">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<h6 class="metadata"><?php posted_on(); ?></h6>
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

                        <div class="Head">
				<div class="image_blog_home">
                           <a class="shadow" href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?></a>

                      <?php  $number_meta=  get_post_meta(get_the_id(), 'number-date', true);
					if ($number_meta == "") {   $number_meta = $number;} else {?>
                           <div class="event_items">
                           <h2><?php echo  get_post_meta(get_the_id(), 'number-date', true); ?></h2>
                           <h3><?php echo  get_post_meta(get_the_id(), 'month-date', true); ?></h3>
                           <p><?php echo  get_post_meta(get_the_id(), 'year', true); ?></p>
                           <h3><?php echo  get_post_meta(get_the_id(), 'time-event', true); ?></h3>
                           </div>
                       <?php } ?>
				</div>
                        </div>

                        <div class="Content">

                            <div class="entry">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<h6 class="metadata"><?php posted_on(); ?></h6>
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
