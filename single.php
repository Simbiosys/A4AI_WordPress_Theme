<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-Wordpress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



 	<?php $video_meta=  get_post_meta(get_the_id(), 'video', true); ?>    <!--GET THE VIDEO URL-->
	<?php $img_post =  get_the_post_thumbnail($page->ID, 'home-post')?>   <!--GET IMG POST-->
	<?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>             <!--GET CAPTION-->

       <div id="post_container">

       <div id="article_container">

        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <?php 	$string_event = get_post_meta($post->ID, 'event_date', true);
			$date = explode('/', $string_event);
			$month = $date[0];
			$day   = $date[1];
			$year  = $date[2]; ?>

            	<?php if ($string_event != ""){ ?>
            <h6 class="metadata" style="font-size:11px"><?php posted_on(); ?></h6>
			<h1 class="entry-title"><?php the_title(); ?></h1>
            <div id="after_title_post">
            <h6 class="metadata_event"><?php  if ( $month=="01" || $month=="1") { echo "January"; } else if ( $month=="02" || $month=="2") { echo "February"; } else if ( $month=="03" || $month=="3") { echo "March"; } else if ( $month=="04" || $month=="4") { echo "April"; } else if ( $month=="05" || $month=="5") { echo "May"; } else if ( $month=="06" || $month=="6") { echo "June"; } else if ( $month=="07" || $month=="7") { echo "July"; } else if ( $month=="08" || $month=="8") { echo "August"; } else if ( $month=="09" || $month=="9") { echo "September"; } else if ( $month=="10") { echo "October"; } else if ( $month=="11") { echo "November"; } else if ( $month=="12") { echo "December"; }?>
            <?php echo  $day; ?>, <?php echo $year; ?> | <?php echo  get_post_meta(get_the_id(), 'time-event', true); ?>
            </h6>

				<?php } else { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
            <div id="after_title_post">
            <h6 class="metadata"><h6 class="metadata"><?php posted_on(); ?></h6></h6>
            	<?php }  ?>


            <h3 class="Social">
		    <strong>SHARE</strong>
			<?php get_share_icons($page->ID); ?>
           <a href="<?php comments_link(); ?>" class="Comments"><i class="fa fa-comment"></i> <?php get_post_comments_count($page->ID); ?></a>
            </h3>
            </div>

            <?php if ($video_meta == "") { ?>           <!--CHECK IF THERE IS A VIDEO-->

           	 	<?php if ($img_post != "") { ?>        <!--CHECK IF THERE IS AN IMG-->
           	 		<div class="image_blog_home"><?php echo get_the_post_thumbnail($page->ID, 'home-post')?>
                		<?php if ($caption != "") { ?>  <!--CHECK IF THERE IS CAPTION-->
                		<div class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div></div>
						<?php } else { ?>
					</div>
				<?php }}?>

			<?php } else {?>

            <div class="single_video"><?php echo  get_post_meta(get_the_id(), 'video', true); ?></div>

            <?php } ?>


			<div class="entry-content">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

				<div id="tags_container"><?php the_tags( 'Tags: ', ', ', ''); ?></div>



			</div>


		</article>


<?php post_navigation(); ?>


<?php comments_template(); ?>

</div>


<?php include (TEMPLATEPATH . '/sidebar-postpage.php'); ?>


	<?php endwhile; endif; ?>


</div>

<?php get_footer(); ?>
