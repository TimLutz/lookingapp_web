{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}



<footer id="footer">
			<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup">
<form action="//debutinfotech.us12.list-manage.com/subscribe/post?u=15f4d20d591f1b4376725c868&amp;id=92f033deb3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-submit" target="_blank" novalidate>
   <h2>Sign up for Specials</h2>
    <div id="mc_embed_signup_scroll" class="row-area">
	
<div class="mc-field-group field-holder">
	<!--label for="mce-FNAME">Name </label-->
	<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="Name">
	
</div>
<div class="mc-field-group field-holder">
	<!--label for="mce-EMAIL">E-mail</label-->
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="E-mail">

</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_15f4d20d591f1b4376725c868_92f033deb3" tabindex="-1" value=""></div>
    <div class="field-holder"><input type="submit" value="submit" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>


<!--End mc_embed_signup-->
				<!--form class="form-submit" action="#">
					<h2>Sign up for Specials</h2>
					<div class="row-area">
						<div class="field-holder">
							<input type="text" placeholder="Name">
						</div>
						<div class="field-holder">
							<input type="email" placeholder="E-mail">
						</div>
						<div class="field-holder">
							<input type="submit" value="submit">
						</div>
					</div>
				</form-->
				<ul class="footer-links">
					<li><a href="{{url('locations')}}">Locations</a></li>
					<li><a href="{{url('products')}}">Products</a></li>
					<li><a href="{{url('faqs')}}">FAQ</a></li>
					<li><a href="{{url('aboutus')}}">About Us</a></li>
					<li><a href="http://www.capitolsheds.com/newsandviews/" target="_blank">Blog</a></li>
					<li><a href="{{ url('product/request-query')}}">Request a Quote</a></li>
					<li><a href="{{url('links')}}">Link Exchange</a></li>
				</ul>
				
				
						<?php   
         // get total users from settings
						$total_visitor = CommonRepository::getvistors();



						?>
				<div class="frame-area">
					<ul class="list-holder vistr">
						<li>VISITORS</li>
						<li>{{ $total_visitor}}</li>
					</ul>
					<div class="image-holder"><a href="http://www.bbb.org/richmond/business-reviews/tool-and-utility-sheds/capitol-sheds-inc-in-barboursville-va-26007242/#bbbonlineclick" target="_blank"><img src="{{ url('images/img9.jpg') }}" alt="image description" height="39" width="105"/></a></div>
					<ul class="social-networks">
						<li><a href="http://www.twitter.com/capitolsheds" target = "_blank"><i class="icon-twitter"></i></a></li>
						<li class="facebook"><a href="http://www.facebook.com/capitolsheds" target = "_blank"><i class="icon-social-facebook"></i></a></li>
						<li class="googleplus"><a href="//plus.google.com/105391738898560181533?prsrc=3" target = "_blank"><i class="icon-google"></i></a></li>
					</ul>
				</div>
				
				<p>&copy; 2016    <a href="{{url('privacy-policy')}}">Privacy Policy</a></p>
			</div>
		</footer>
	</div>
	
	
<script src="{{ asset('js/frontend/jquery-1.11.2.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/frontend/jquery.main.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/frontend/loader.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/frontend/waitMe.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/frontend/pnotify.all.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/frontend/pnotifycommon.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/path.js') }}" type="text/javascript"></script>
		
	<script type="text/javascript">
var addthis_config = {
     ui_cobrand: "Capitol Sheds"}
var addthis_config = {
     data_track_linkback: true
}
</script><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=capitolsheds"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/54e3826d3fc587e101fe938b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script src="{{ asset('js/frontend/jquery.validate.min.js') }}" type="text/javascript"></script>
<script>
	$( document ).ready(function() {
		
		/******************* closing view pop up on clicking esc key {start}****************/
			$(document).keyup(function(e) {
			if (e.keyCode === 27) {
			$('.close').click()

			}  // esc
			});
		/******************* closing view pop up on clicking esc key {end}****************/
		
  $("#mc-embedded-subscribe-form").validate({
                rules: {
                  
                    EMAIL: {
                        required: true,
                        email: true
                    },
                   
                },
                messages: {
					 EMAIL: {
                        required: "Email is Required",
                        email: "Please enter a valid email address"
                    }
                  
                    
                },
});
			});
</script>

@yield('js')
</body>
</html>
