<?php get_header(); ?>

	<div id="content">
	 <div class="container">	
     <div class="row">
      <section class="blog_section">
            <div class="col-sm-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php /*?><h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2><?php */?>
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
                    </div>
                </div>
			
		</div>
        <div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link', 'Previous') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;', 'Next') ?></div>
		</div>
        </div>  
        
        
        
	<?php endwhile; else: ?>
	      
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
	
