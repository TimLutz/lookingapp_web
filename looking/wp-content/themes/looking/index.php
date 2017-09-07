<?php get_header(); ?>
	<div id="content">
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
    <div class="container">	
     <div class="row">
            <section class="blog_section">
            <div class="col-md-8 col-sm-8 col-xs-12">
	        <?php if (have_posts()) : ?>
		    <?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class="row blog_block">
                	<div class="col-sm-4">
                    	<div class="blog_image"><?php the_post_thumbnail(''); ?></div>
                    </div>
                    <div class="col-sm-8">
                    	<div class="blog_content">
                        <h3><?php the_time(get_option('date_format').', '.get_option('time_format')) ?> <!-- <?php _e('by') ?> <?php the_author() ?> --></h3>
                        <p><?php the_content(); ?></p>
                        </div>
                    </div>
                </div>		
				<div class="postmetadata">
					<?php if( function_exists('the_tags') ) 
						the_tags(__('Tags: '), ', ', '<br />'); 
					?>
					<?php _e('Category:') ?> <?php the_category(', ') ?>&nbsp;&nbsp;|&nbsp;
					<?php comments_popup_link(__('Comment'), __('1 Comment'), __('% Comments')); ?>
					<?php edit_post_link(__('Edit'), '&nbsp;|&nbsp;&nbsp;', ''); ?>
				 </div>
			</div>
           
           
		<?php endwhile; ?>
        <div class="navigation">
                <div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries')) ?></div>
                <div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;')) ?></div>
            </div>
         </div>
		    <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="blog_sideber">
            	<?php get_sidebar(); ?>
             </div>
            </div>
            
		
	    <?php else : ?>
		 <div class="post">
			<h2 class="posttitle"><?php _e('Not Found') ?></h2>
			<div class="postentry"><p><?php _e('Sorry, no posts matched your criteria.'); ?></p></div>
		</div>

	    <?php endif; ?>
 
    </section>
    </div>
    </div>
	</div>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>
