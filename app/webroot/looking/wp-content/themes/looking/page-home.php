<?php get_header(); 
/*Template Name: Home*/
?>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php /*?><h2 class="posttitle"><?php the_title(); ?></h2><?php */?>
			<?php /*?><div class="postentry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><?php */?>
			<section class="first_block" style="background-image:url(<?php bloginfo('template_url'); ?>/images/block-img1.jpg); background-repeat:no-repeat; background-position:0 0;

background-size:cover; height:563px;" >

	<div class="container">

		<div class="row">

			<div class="col-sm-6 first_blockLft">
				<?php the_content(); ?>
				<ul>

				<li><a href="<?php the_field('app_button_link'); ?>"><img src="<?php the_field('app_button'); ?>" alt=" " /></a></li>

				<?php /*?><li><a href="<?php the_field('google_play_button_link'); ?>"><img src="<?php the_field('google_play_button'); ?>" alt=" " /></a></li><?php */?>

				</ul>

			</div>

			<div class="col-sm-6 first_blockRht">

				<span><img src="<?php the_field('first_row_image'); ?>" alt=" "></span>

			</div>

		</div>

	</div>

</section>
            <section class="snd_block" >
              <div class="container">            
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><?php the_field('the_smarter_heading'); ?></h2>
                            <?php the_field('the_smarter_content'); ?>
                            <div class="snd_multiSection">
                                <ul>
                                <?php if(get_field('the_smarter_three')): ?>
								 <?php while(has_sub_field('the_smarter_three')): ?>
                                 <li style="background-image: url('<?php the_sub_field('image_icon'); ?>'); background-repeat:no-repeat; 
                                 background-position:right top;">
                                 <h3><?php the_sub_field('heading'); ?></h3>
                                 <?php the_sub_field('sub_heading'); ?>
                                 </li>
                                <?php endwhile ?>
                                <?php endif ?>
                                </ul>
                            </div>
                            
                        </div>	
            		
                    </div>
            
                    
            
                </div>
            <div class="snd-bg"><img src="<?php the_field('the_smarter_image'); ?>" alt=" "></div>
            </section>
            <section id="feateres" class="thd_block" style="background:url(<?php bloginfo('template_url'); ?>/images/block-img2.jpg) no-repeat 0 0; height:520px; background-size:cover;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><?php the_field('outstanding_features_heading'); ?></h2>
                            <?php the_field('outstanding_features_content'); ?>
                        </div>            
                        <div class="thd_block_three">            
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 thd_blockLft">           
                                <ul class="left_content">
                                <?php if(get_field('outstanding_features_left')): ?>
								 <?php while(has_sub_field('outstanding_features_left')): ?>
                                 <li style="background-image: url('<?php the_sub_field('outstanding_features_icon'); ?>'); background-repeat:no-repeat; 
                                 background-position:left top;">
                                 <h3><?php the_sub_field('heading'); ?></h3>
                                 <?php the_sub_field('sub_heading'); ?>
                                 </li>
                                <?php endwhile ?>
                                <?php endif ?>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mob_hide">
                                <span class="thd_mdl"><img src="<?php the_field('outstanding_features_image'); ?>" alt=" "></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 thd_blockRht">
                                <ul>
                                <?php if(get_field('outstanding_features_right')): ?>
								 <?php while(has_sub_field('outstanding_features_right')): ?>
                                 <li style="background-image: url('<?php the_sub_field('outstanding_features_icon'); ?>'); background-repeat:no-repeat; 
                                 background-position:right top;">
                                 <h3><?php the_sub_field('heading'); ?></h3>
                                 <?php the_sub_field('sub_heading'); ?>
                                 </li>
                                <?php endwhile ?>
                                <?php endif ?>           
                                </ul>            
                            </div>            
                        </div>           
                    </div>
                </div>            
            </section>
            <section class="four_block">           
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><?php the_field('looking_4_now_heading'); ?></h2>
            				<?php the_field('looking_4_now_content'); ?>
                        </div>
                        <div class="four_two">
                            <div class="col-sm-5 mob_hide">
                                <span><img src="<?php the_field('looking_4_now_right_image'); ?>" alt=" "></span>
                            </div>
                            <div class="col-sm-7 four_twoRht">
							<?php the_field('looking_4_now_right_content'); ?>
                            <ul>
            				<?php if(get_field('key_features_content')): ?>
								 <?php while(has_sub_field('key_features_content')): ?>
                                 <li style="background-image: url('<?php the_sub_field('key_features_icon'); ?>'); background-repeat:no-repeat; 
                                 background-position:LEFT 3px;">
                                 <?php the_sub_field('key_features_sub_content'); ?>
                                 </li>
                                <?php endwhile ?>
                                <?php endif ?>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="fifth_block" style="background:url(<?php bloginfo('template_url'); ?>/images/block-img2.jpg) no-repeat 0 0; background-size:cover; height:484px;">
            <div class="fifth_blockCircle"><span><b class="icon-User_favourites"></b></span></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><?php the_field('looking_4_dates_heading'); ?></h2>
                            <?php the_field('looking_4_dates_heading_content'); ?>
                        </div>
                        <div class="fifth_blockTwo">
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <h3><?php the_field('key_dating_features_heading'); ?></h3>
                                <ul>
                                <?php if(get_field('key_dating_features_content')): ?>
								 <?php while(has_sub_field('key_dating_features_content')): ?>
                                 <li style="background-image: url('<?php the_sub_field('key_dating_features_icon'); ?>'); background-repeat:no-repeat; 
                                 background-position:right top;">
                                 <?php the_sub_field('key_dating_features_content'); ?>
                                 </li>
                                <?php endwhile ?>
                                <?php endif ?>
                                </ul>           
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mob_hide"><span>
                            <img src="<?php the_field('key_dating_features_right_image'); ?>" alt=" "></span></div>
            
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

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
