</div>
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 &copy; 2015 Looking
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

<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ asset('assets/global/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('js/bootbox.min.js') }}"></script>


<script src="{{ asset('js/waitMe.js') }}"></script>
<script src="{{ asset('js/waitMe.min.js') }}"></script>
<script src="{{ asset('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/tasks.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/global/scripts/datatable.js') }}"></script>


<script src="{{ asset('assets/admin/pages/scripts/table-advanced.js') }}"></script>
<script src="{{ asset('js/bootstrap-typeahead.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/path.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/loader.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pnotify.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/contacts.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/common-user.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/components-dropdowns.js') }}" type="text/javascript"></script>

<script type="text/javascript" href="{{ asset('plugins/order.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
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
			//~ alert(data.status);
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
