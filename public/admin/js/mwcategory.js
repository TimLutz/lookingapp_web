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
            src: $("#datatable_ajax_for_category"),
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
            dataTable: { 
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": path+adminname+'/'+action, // ajax source
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
                },
                "aoColumnDefs" : [
				 {
				   'bSortable' : false,
				   'aTargets' : [ 0,3,4,5 ]
				 }],
                "order": [
                    [0, "desc"]
                ],
                "language": {
                  "emptyTable": "No Categories."
                }
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
		$("#datatable_ajax_for_category input").not('input[type="checkbox"]').on('keyup',function (e) {
			$('.filter-submit').click();  
		});
		$("#datatable_ajax_for_category select").not('input[type="checkbox"]').on('keyup change',function (e) {
			$('.filter-submit').click();  
	   });
   }
   var refreshRecords = function () {
	   var $myTable = $("#datatable_ajax_for_category").dataTable( { bRetrieve : true } );
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