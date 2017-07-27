var TableAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }
    
    var handleRecords = function () {
		
		var action = $('input[name="action"]').val();

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax_for_cms"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            "processing": true,
			"serverSide": true,
            "emptyTable": "No Categories.",
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": path+adminname+'/'+action, // ajax source
                    //~ "data": function(data) {
						//~ data.token = $('meta[name="csrf-token"]').attr('content')
					//~ },
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
                },
                "aoColumnDefs" : [
				 {
				   'bSortable' : false,
				   'aTargets' : [0,2,3,4]
				 }],
                "order": [
                    [0, "desc"]
                ],
                "language": {
                  "emptyTable": "No Cms."
                }// set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
				bootbox.confirm("Are you sure you want to use this action?", function (result) {
            if (result) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                var $myTable = $("#datatable_ajax_for_plan").dataTable( { bRetrieve : true } );
				$myTable.fnDraw();
                showSuccessMessage('Multiple Plan Deleted Successfully');
          }
	});
          
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    
   var customFunction = function () {
			$("#datatable_ajax_for_cms input").not('input[type="checkbox"]').on('keyup',function (e) {
					$('.filter-submit').click();  
			});
			$("#datatable_ajax_for_cms select").not('input[type="checkbox"]').on('keyup change',function (e) {
					$('.filter-submit').click();  
			});
   }
   var refreshRecords = function () {
	   var $myTable = $("#datatable_ajax_for_cms").dataTable( { bRetrieve : true } );
		$myTable.fnDraw();
   }

    return {

        //main function to initiate the module
        init: function () {
            initPickers();
            handleRecords();
        },
         update: function () {
            customFunction();
        },
        refresh: function () {
            refreshRecords();
        }

    };

}();