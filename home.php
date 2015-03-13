<?php
/**
* @package WebFoundation
* @subpackage A4AI
* Template Name: home
*/

get_header(); ?>


		<div id="Featured">
			<div class="slider-wrapper">
				<div class="navigation-bottom"></div>
      	<div class="slider_home Holder Blue">
					<?php echo do_shortcode('[ef_slider]'); ?>
				</div>
			</div>
    </div>

    <div id="Tabs">

        <nav>
            <div class="wrapper">
                <ul id="Tab_list">
                    <li class="Panel_home Active"><a href="#Panel01" title="About"><span>About the Alliance</span></a></li>
                    <li class="Panel_home"><a href="#Panel02" title="Alliance Members"><span>Alliance Members</span></a></li>
                    <li class="Panel_home"><a href="#Panel03" title="Job Opportunities"><span>Job Opportunities</span></a></li>
                </ul>
            </div>
        </nav>

        <div class="Panels">
            <div class="wrapper">
            	<div class="Panel" id="Panel01" style="display: block">
	                <div class="Cont">
                        <h3>The Alliance for Affordable Internet</h3>
                        <p>...is a coalition of private sector, public sector, and civil society organisations who have come together to advance the shared aim of affordable access to both mobile and fixed-line Internet in developing countries.
						</p>
                        <div class="Button">
                            <a href="<?php echo esc_url( home_url( '/who-we-are/visionand-strategy' ) ); ?>" title="Discover more">Discover more</a>
                        </div>
                    </div>
                </div>


                <div class="Panel" id="Panel02">
	                <div class="Cont">
	                	<h3>Alliance for Affordable Internet Members</h3>
	                  <div id="slider_container">
	                    <?php echo do_shortcode('[members-list list="Members tab" search=false alpha=false pagination=false pagination2=false sort=false]'); ?>
										</div>
	                  <div id="button_members" class="Button">
	                    <a href="<?php echo esc_url( home_url( '/members' ) ); ?>" title="See all Members">See all Members</a>
	                  </div>
	                </div>
       					</div>

        <div class="Panel" id="Panel03">
                	<div class="Cont">
                        <h3>Job Opportunities</h3>
                        <p>Want to use your skills and talent to change the world for the better? Click below to check out exciting opportunities to join our team.</p>
                        <div class="Button">
                            <a href="<?php echo esc_url( home_url( '/get-involved/job-opportunities' ) ); ?>" title="Discover more">Discover more</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <div id="Roll">

        <div class="wrapper">
        	<div class="ListBlog">

                <?php
				query_posts('category_name=blog&showposts=1');
				if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <div class="Head">
				<div class="image_blog_home">
                            		<a class="shadow" href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?></a>
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

                <?php endwhile; ?>

                <?php //post_navigation(); ?>

                <?php else : ?>


                <?php endif; ?>

            </div>
			<div class="ListBlog">
                            <h2 class="Title"><a href="<?php echo esc_url( home_url( '/category/news' ) ); ?>">News</a></h2>

                <?php $post_num=0;
				query_posts('category_name=news&cat=-36&showposts=10');

				if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php $post_num++; ?>

                 <?php   if ($post_num <= 3){ ?>

                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <div class="Head">
				<div class="image_blog_home">
                            		<a class="shadow" href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?></a>
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
                      	<a class="ViewAll" id="show_more" style="float:left;">show more</a>
					<?php } ?>

                    <div class="ListNews hidden_news">


                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <div class="Head">
				<div class="image_blog_home">
                            		<a class="shadow" href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?></a>
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
								    if ($post_num >= 10){
								    $archive_link = esc_url(home_url("/category/news-and-events/news/"));
                   					echo "<a class='ViewAll show_navi' id='show_more' style='float:left;' href='$archive_link'>Visit Archive News</a>";
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


<div id="Talks">
            <div class="wrapper">
            	<h4>Talks and Appearances</h4>
            </div>
			<?php //echo TCHPCSCarousel(); ?>
        </div>



<?php get_footer(); ?>
