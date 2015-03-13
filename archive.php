<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
 
 <div id="archive_container">


		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2 class="Title"><?php single_cat_title(); ?></h2>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2 class="Title"><?php single_tag_title(); ?></h2>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2 class="Title"><?php the_time('F jS, Y'); ?></h2>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2 class="Title"><?php the_time('F, Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="Title">Archive for <?php the_time('Y'); ?></h2>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="Title">Author Archive</h2>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="Title">Blog Archives</h2>
			
			<?php } ?>

            <?php $cat_num=0; ?>
            
			<?php while (have_posts()) : the_post(); ?>
	   		
            	<?php $category = get_the_category(); ?>
               
                                
             <?php   if ($category[0]->cat_name == "Team"){ ?>        <!--TEAM-CATEGORY-->
             
           <?php global $cat_num;
		   $cat_num++; ?> 
           
				<div class="team_box">             <!--DIV-SHOWN-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="Head">
				<div class="image_blog_home">
                    <a title="<?php the_title(); ?>" class="popup<?php echo $cat_num ?>" href="#"><?php the_post_thumbnail( 'grid-size' ); ?></a>
				</div>
                </div>
                        <div class="Content">
                        
                            <div class="entry">
								<h2><a title="<?php the_title(); ?>" class="popup<?php echo $cat_num ?>" href="#"><?php the_title(); ?></a></h2>
                                <h6 class="metadata"><?php posted_on(); ?></h6>

                                <?php the_excerpt(); ?>
                                <a  title="<?php the_title(); ?>" class="moretag popup<?php echo $cat_num ?>" href="#">Read more</a>
                            </div>
                        </div>
                    </article>
                    </div>
                    
                    <div class="popup_container" style="display:none">
                    <div id="pop_box<?php echo $cat_num ?>">             <!--DIV-HIDDEN-POPUP-->
				 <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="Head">
				<div class="image_blog_home">
                    <?php echo get_the_post_thumbnail($page->ID, 'home-post'); ?>
				</div>
                </div>
                        <div class="Content">
                            <div class="entry">
								<h2><?php the_title(); ?></h2>
                                <h3><?php the_meta() ?></h3>
                                <p><?php
								$content = get_the_content();
								print $content;
									?></p>
                            </div>
                        </div>
                    </article>
                    </div></div>
				
				
                
				
				<?php }else { ?>
				
                <article <?php post_class() ?>>
				
						<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					
						<?php posted_on(); ?>

						<div class="entry">
							<?php the_content(); ?>
						</div>

				</article>
                
                <?php }  ?>

			<?php endwhile; ?>

			<?php post_navigation(); ?>
			
	<?php else : ?>

		<h2><?php _e('Nothing Found','html5reset'); ?></h2>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
