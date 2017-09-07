<?php 
/*Template Name:Blog*/
get_header(); ?>
	<div id="content">
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
    <div class="container">	
     <div class="row">
            <section class="blog_section">
            <div class="col-md-12 col-sm-12 col-xs-12">
	        <?php if (have_posts()) : ?>
		    <?php while (have_posts()) : the_post(); ?>
            <?php
				$lastposts = get_posts('numberposts=-1');
				foreach($lastposts as $post) :
				setup_postdata($post);
			?>
			<div class="post" id="post-<?php the_ID(); ?>">
                <div class="row blog_block">
                	<div class="col-sm-3">
                    	<div class="blog_image"><?php the_post_thumbnail(''); ?></div>
                    </div>
                    <div class="col-sm-9">
                    	<div class="blog_content">
                        <h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <h3>
						<?php /*?><?php the_time(get_option('date_format').', '.get_option('')) ?> <!-- <?php _e('by') ?> <?php the_author() ?> --><?php */?>
                        <?php the_date('Y-m-d'); ?>
                        &nbsp;|&nbsp;
                        <?php if( function_exists('the_tags') ) 
						the_tags(__('Tags: '), ', ', '<br />'); 
						?>
						<?php _e('Category:') ?>  <?php the_category(', ') ?>&nbsp;&nbsp;|&nbsp;
						<?php comments_popup_link(__('Comment'), __('1 Comment'), __('% Comments')); ?>
						<?php edit_post_link(__('Edit'), '&nbsp;|&nbsp;&nbsp;', ''); ?>
                        
                        </h3>
                        <p><?php the_content(); ?></p>
                        </div>
                        <div class="read_more"><a href="<?php the_permalink() ?>">Read More</a></div>
                    </div>
                </div>		
				<?php /*?><div class="postmetadata">
					<?php if( function_exists('the_tags') ) 
						the_tags(__('Tags: '), ', ', '<br />'); 
					?>
					<?php _e('Category:') ?> <?php the_category(', ') ?>&nbsp;&nbsp;|&nbsp;
					<?php comments_popup_link(__('Comment'), __('1 Comment'), __('% Comments')); ?>
					<?php edit_post_link(__('Edit'), '&nbsp;|&nbsp;&nbsp;', ''); ?>
				 </div><?php */?>
			</div>
           
           <?php endforeach; ?>
		<?php endwhile; ?>
        <div class="navigation">
                <div class="alignleft">PREVIOUS</div>
                <div class="alignright">NEXT</div>
            </div>
         </div>
		    <?php /*?><div class="col-md-4 col-sm-4 col-xs-12">
            <div class="blog_sideber">
            	<?php get_sidebar(); ?>
             </div>
            </div><?php */?>
            
		
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
