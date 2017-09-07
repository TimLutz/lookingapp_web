<?php get_header(); 
/*Template Name:health-safety*/
?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php /*?><h2 class="posttitle"><?php the_title(); ?></h2>
			<div class="postentry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><?php */?>
			<section class="advertisting-banner health_banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 advertisting-bannerLft">
                        <span><img src="<?php the_field('common_banner'); ?>" alt=" " /></span>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                        <div class="advertisting-bannerRht">
                            <h1>
                            <?php the_field('common_heading'); ?>
                            <span>Resources and tips to stay healthy and safe
</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <section class="advertisting-body health_body">
                <div class="container">
                    <div class="row advertisting_rowArea">
                        <div class="col-sm-12">
                        <?php the_field('saftey_tips_area'); ?>
                        </div>
                    </div>
                </div>
                <div class="health_row">
                <?php /*?><div class="snd_aro">
                    <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/up-aro.jpg" alt=" "></a>
                    <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/down-aro.jpg" alt=" "></a>
                </div><?php */?>
                <div class="container">
                    <div class="gray_box">
                        <div class="gray_box_inner">
                            <div class="gray_box_innerAro"><img alt=" " src="<?php bloginfo('template_url'); ?>/images/advisting-aro.png"></div>
                            <?php the_field('health_quote_1'); ?>
                        </div>
                    </div>
                    <h2><?php the_field('substance_abuse_heading'); ?></h2>
                    <div class="substance_leftGap">
					<?php the_field('substance_abuse_top'); ?>
                    </div>
                    <?php the_field('substance_abuse_bottom'); ?>
                </div>
                </div>
                <div class="health_row">
                <div class="container">
            
                    <div class="gray_box">
                        <div class="gray_box_inner">
                            <div class="gray_box_innerAro"><img alt=" " src="<?php bloginfo('template_url'); ?>/images/advisting-aro.png"></div>
                            <?php the_field('health_quote_2'); ?>
                        </div>
                    </div>
                    <div class="hiv_area">
                    <h2><?php the_field('hiv_heading'); ?></h2>
                    <?php the_field('hiv_content_area'); ?>
                </div>
              
                </div>
                </div>
                <div class="adisonal_area">
                    <div class="container">
                        <h2 class="adisinal_heading"><?php the_field('additional_health_heading'); ?></h2>
                        <div class="row">
                        <?php if(get_field('additional_health_multy_link_area')): ?>
						 <?php while(has_sub_field('additional_health_multy_link_area')): ?>
                         <div class="col-sm-6 adisonal_cell">
                                <h3><?php the_sub_field('multy_link_heading'); ?></h3>
                                <?php the_sub_field('multy_link_description'); ?>
                                <a href="<?php the_sub_field('websight_link'); ?>" target="_blank"><?php the_sub_field('websight_address'); ?></a>
                            </div>
                        <?php endwhile ?>
                        <?php endif ?>
                        </div>
                        <?php the_field('additional_health_bottom_content'); ?>
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
