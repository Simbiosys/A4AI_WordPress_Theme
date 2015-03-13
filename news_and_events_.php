<?php
/**
* @package WebFoundation
* @subpackage A4AI
*
*/


get_header(); ?>


	<div id="Featured">

        <div class="events_header Holder">


        <div id="events_cont"></div>



</div>

    </div>


    <div id="Roll">

        <div class="wrapper">
        	<div class="ListBlog">



<?php $sort= ''; ?>



            <div id="organize_by_posts">
							<p>ORGANIZE BY</p>
							<div>
								<a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=date'; ?>"
								<?php if ($_GET['sort'] == 'date'){ echo 'class="active"'; } ?>>Date</a>
								<a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=title'; ?>"
								<?php if ($_GET['sort'] == 'title'){ echo 'class="active"'; } ?>>Title</a>
								<a href="<?php echo str_replace(('?'.$_SERVER['QUERY_STRING']), '', $_SERVER['REQUEST_URI']).'/?sort=relevance'; ?>"
								<?php if ($_GET['sort'] == 'relevance'){ echo 'class="active"'; } ?>>Relevance</a>
							</div>
						</div>

                <h2 class="Title">News And events</h2>

                <?php
				query_posts('showposts=3&cat=4&orderby=date&order=DESC');


                if($_GET['sort'] == 'title') query_posts('showposts=3&cat=4&orderby=title&order=ASC');

				if($_GET['sort'] == 'date') query_posts('showposts=3&cat=4&orderby=date&order=DESC');

				if($_GET['sort'] == 'relevance') query_posts('showposts=3&cat=4&orderby=comment_count&order=DESC');


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

                    <h2><?php _e('These are all available articles at this moment','html5reset'); ?></h2>

                <?php endif; ?>

                <a class="ViewAll" id="show_more">show more</a>



        <script>

  $("#show_more").click(function () {
  $("#More-News").fadeIn("slow");
  $("#show_more").fadeOut("slow");

});

    </script>



            <a name="#More-News"></a>
            <div class="ListNews hidden_news" id="More-News">


                <?php
				query_posts('showposts=10&cat=4&orderby=date&order=DESC&offset=3');

                if($_GET['sort'] == 'title') query_posts('showposts=10&cat=4&orderby=title&order=ASC&offset=3');

				if($_GET['sort'] == 'date') query_posts('showposts=10&cat=4&orderby=date&order=DESC&offset=3');

				if($_GET['sort'] == 'relevance') query_posts('showposts=10&cat=4&orderby=comment_count&order=DESC&offset=3');

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

                    <h2><?php _e('These are all available articles at this moment','html5reset'); ?></h2>

                <?php endif; ?>


                <a href="<?php echo esc_url( home_url( '/news-archive' ) ); ?>" class="ViewAll">show all</a>



               </div>


            </div>


        </div>

    </div>






<?php get_footer(); ?>
