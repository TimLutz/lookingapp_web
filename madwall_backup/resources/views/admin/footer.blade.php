</div>
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2016 &copy; {{ config('app.website_name') }}.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="{{ asset( 'public/admin/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery-migrate.min.js' ) }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset( 'public/admin/js/jquery-ui.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.blockui.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.uniform.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-switch.min.js' ) }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset( 'public/admin/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/select2.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/jquery.multi-select.js' ) }}"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/dataTables.tableTools.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/dataTables.colReorder.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset( 'public/admin/js/dataTables.bootstrap.js') }}"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ asset( 'public/admin/js/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/daterangepicker.js' ) }}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{ asset( 'public/admin/js/fullcalendar.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.easypiechart.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.sparkline.min.js' ) }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset( 'public/admin/js/bootbox.min.js' ) }}" type="text/javascript" ></script>


<script src="{{ asset( 'public/admin/js/waitMe.js') }}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/waitMe.min.js') }}" type="text/javascript"></script>

<script src="{{ asset( 'public/admin/js/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/index.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/tasks.js') }}" type="text/javascript"></script>

<script src="{{ asset( 'public/admin/js/jquery.dataTables.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/dataTables.bootstrap.js') }}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/bootstrap-datepicker.js') }}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/datatable.js' ) }}"></script>

<script src="{{ asset( 'public/admin/js/table-advanced.js') }}"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-typeahead.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/path.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/loader.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/pnotify.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/contacts.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/common-user.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/common.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/components-dropdowns.js') }}" type="text/javascript"></script>

<script href="{{ asset('public/admin/js/order.js') }}"type="text/javascript"></script>
<script src="{{ asset('public/admin/js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 3000);
    });
	$(document).ready(function(){
        setTimeout(function() {
            $('.alert-danger').fadeOut('slow');
        }, 6000);
    });
	</script>
	

	<script type="text/javascript">
		
$(document).ready(function(e) {
    $(".msgcross").click( function() {
    $(".commonmessagemain").removeClass("active");
    
    });
    setTimeout(function() {
    $(".commonmessagemain").removeClass("active");
},7000);
});
		</script>

@yield('js')

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {  
	
	var d = new Date();
var n = d.toString();
//This will give you like MST, according to browser's time
var timeZone = (n.split("(")[1]).replace(")", ""); 
$("#timezone").val(timezone);
console.log(timeZone);
	     
	      $("#statusnoti").live('click',function() {
			 var token = "{{ csrf_token() }}";
	 var noteid = $(this).attr('notificationid');
	
	
	$.ajax({
		dataType: 'json',
		method:'post',
		
		url: path+'/'+adminname+'/notification',
		data: 'id='+ noteid+'&_token='+ token,
		
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			alert(data.status);
			if(data.success == true){
				removeLoader();
				$(".notificationappend").html(data.htmlnoti);
				//~ showSuccessMessage('success');
			}	
			else
			{		
				showErrorMessage('Data not Added.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			removeLoader();
					
			}
		
	});
	
	});	     
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
     ComponentsDropdowns.init();
   TableAdvanced.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
