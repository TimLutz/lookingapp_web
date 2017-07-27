</div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<script src="{{ asset( 'public/admin/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery-ui.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery-migrate.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.blockui.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.uniform.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-switch.min.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/moment.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/moment-timezone.js' ) }}"></script> //moment-timezone.js
<script src="{{ asset( 'public/admin/js/metronic.js') }}" type="text/javascript"></script>

<script src="{{ asset( 'public/admin/js/waitMe.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/waitMe.min.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.fancybox.pack.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/wysihtml5-0.3.0.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/bootstrap-wysihtml5.js' ) }}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.ui.widget.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/tmpl.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/load-image.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/canvas-to-blob.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/jquery.blueimp-gallery.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/jquery.iframe-transport.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/jquery.sparkline.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/inbox.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/index.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/bootbox.min.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/pnotify.all.min.js')}}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/jquery.dataTables.min.js' )}}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/dataTables.bootstrap.js')}}" type="text/javascript" ></script>
<script src="{{ asset( 'public/admin/js/datatable.js' ) }}"></script>

<script src="{{ asset( 'public/admin/js/dataTables.tableTools.min.js' )}}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/dataTables.colReorder.min.js' )}}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/loader.js')}}" type="text/javascript"></script>
<script src="{{ asset( 'public/admin/js/common.js')}}" type="text/javascript"></script>

<script src="{{ asset( 'public/admin/js/custom.js' ) }}"></script>
<script src="{{ asset( 'public/admin/js/path.js' ) }}"></script>

<script>
jQuery(document).ready(function() {       
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	$('#logout').click( function( e ){
		e.preventDefault();
		bootbox.confirm({
    	message: "Are you sure you want to logout?",
	    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn-success'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn-danger'
	        }
	    },
	    callback: function (result) {
	    	if( result ){
				$('#logout-form').submit();
	    	}
	    }
});

	});
	
   	//TableAdvanced.init();

});

</script>

<script type="text/javascript">
	$(document).ready(function(){
        setTimeout(function() {
            $('.flashMessage').fadeOut('slow');
        }, 3000);

        setTimeout(function() {
        	$('.alert-danger').fadeOut('slow');
    	}, 3000);

    });
	</script>
@yield('js')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>