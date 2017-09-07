<?php get_header();
/*Template Name:contact*/
 ?>

	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php /*?><section class="advertisting-banner">
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
            </section><?php */?>
            <section class="advertisting-body">
            <div class="container">
                <div class="row advertisting_rowArea">
                    <div class="col-sm-12 contact_area">
                        <h2><?php the_title(); ?></h2>
                       	<?php the_content(); ?>
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
