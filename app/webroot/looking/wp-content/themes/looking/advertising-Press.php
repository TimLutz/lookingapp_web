<?php get_header(); 
/*Template Name:advertising-Press*/
?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php /*?><h2 class="posttitle"><?php the_title(); ?></h2>
			<div class="postentry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><?php */?>
			<section class="advertisting-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 advertisting-bannerLft">
                            <span><img src="<?php the_field('common_banner'); ?>" alt=" " /></span>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                            <div class="advertisting-bannerRht">
                                <h1>
                                <?php the_field('common_heading'); ?>
                                <span><?php the_field('common_sub_heading'); ?></span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="advertisting-body">
            <div class="container">
                <div class="row advertisting_rowArea">
                    <div class="col-sm-12">
					<?php the_field('advertising_area'); ?>
                    </div>
                </div>
                <div class="row advertisting_rowArea">
                    <div class="col-sm-12">
                    <span><img src="<?php the_field('partenrships_and_events_area_image'); ?>" alt=" "></span>
					<?php the_field('partenrships_and_events_area'); ?>
                    </div>
                </div>
                <div class="row advertisting_rowArea">
                    <div class="col-sm-12">
                    <?php the_field('press_content_area'); ?>
                    </div>
                </div>
            </div>
            <div class="press_area">
                <?php /*?><div class="snd_aro">
                    <a href="#"><img alt=" " src="<?php bloginfo('template_url'); ?>/images/up-aro.jpg"></a>
                    <a href="#"><img alt=" " src="<?php bloginfo('template_url'); ?>/images/down-aro.jpg"></a>
                </div><?php */?>
                <div class="container">
                <div class="gray_box">
                    <div class="gray_box_inner">
                        <div class="gray_box_innerAro"><img src="<?php bloginfo('template_url'); ?>/images/advisting-aro.png" alt=" "></div>
                       <?php the_field('press_links_under_quote'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h2><?php the_field('press_link_heading'); ?></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                <?php if(get_field('press_link__multy_link_area')): ?>
								 <?php while(has_sub_field('press_link__multy_link_area')): ?>
                                  <li><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('description'); ?></a></li>
                                <?php endwhile ?>
                                <?php endif ?>
                                </ul>
                            </div>
                            <div class="col-sm-6 press_rht">
                            <ul>
                                <?php if(get_field('press_link__multy_link_area_right')): ?>
								 <?php while(has_sub_field('press_link__multy_link_area_right')): ?>
                                  <li><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('description'); ?></a></li>
                                <?php endwhile ?>
                                <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                 </div>
                 </div>
                </div>
              </section>
			
		</div>

		<?php endwhile; else: ?>

		<div class="post">
			<h2 class="posttitle"><?php _e('Not Found') ?></h2>
			<div class="postentry"><p><?php _e('Sorry, no posts matched your criteria.'); ?></p></div>
		</div>

		<?php endif; ?>

	</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
