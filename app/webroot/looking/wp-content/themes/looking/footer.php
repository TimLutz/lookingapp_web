<footer class="bottom">
	<div class="container">
		<div class="ftr-logo">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(__('Footer logo area','twentytwelve')) ) : else : ?>
           <p>You have not assigned any widget for this section.</p>
           <?php endif; ?>
		</div>
		<div class="ftr_cell">
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(__('LOOKING on iOS','twentytwelve')) ) : else : ?>
               <p>You have not assigned any widget for this section.</p>
               <?php endif; ?>
		</div>
		<div class="ftr_cell anroyed">
		   <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(__('LOOKING on Android','twentytwelve')) ) : else : ?>
           <p>You have not assigned any widget for this section.</p>
           <?php endif; ?>
		</div>
		<div class="ftr_cell2">
			<h2>About LOOKING</h2>
			<ul>
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'menu_id' => 'Secondary menu' ) ); ?>
            
			</ul>
		</div>
        
		<div class="ftr_cell3">
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(__('Social','twentytwelve')) ) : else : ?>
               <p>You have not assigned any widget for this section.</p>
               <?php endif; ?>
			<?php /*?><h2>Follow US</h2>
			<ul>
			<li><a href="#">
			<img src="<?php bloginfo('template_url'); ?>/images/ftr-img4-n.png" 

onmouseover="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img4.png'"

onmouseout="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img4-n.png'"

border="0" alt=""/>

			</a></li>

			<li><a href="#">

			<img src="<?php bloginfo('template_url'); ?>/images/ftr-img5-n.png" 

onmouseover="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img5.png'"

onmouseout="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img5-n.png'"

border="0" alt=""/>

			</a></li>

			<li><a href="#">

			<img src="<?php bloginfo('template_url'); ?>/images/ftr-img6-n.png" 

onmouseover="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img6.png'"

onmouseout="this.src='<?php bloginfo('template_url'); ?>/images/ftr-img6-n.png'"

border="0" alt=""/>

			</a></li>

			</ul><?php */?>

		</div>

		<div class="signup_pnl">
		<h3>Subscribe to our newsletter for useful tips, updates, and resources </h3>
			<?php echo do_shortcode ('[contact-form-7 id="98" title="Footer Signup"]') ?>
		</div>

	</div>

</footer>
<?php wp_footer(); ?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	if(window.location.href.indexOf("#feateres") > -1) {
      setTimeout(function() {

		window.scrollTo(0, 0);
	  }, 1);
	   setTimeout(function() {

		$('html, body').animate({
        scrollTop: $("#feateres").offset().top
    }, 2000);
	  }, 500);
    }
	if(window.location.href=='http://unifiedinfotech.co.in/webroot/team1/looking/#feateres') {
		$(".move_down").click(function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $("#feateres").offset().top
			}, 2000);
		});
	}
	
});

$(document).ready(function(){
	if(window.location.href.indexOf("archives") > -1) {
      $("#menu-item-17").addClass('current-menu-item')
    }
});


</script>



</body>
</html>
