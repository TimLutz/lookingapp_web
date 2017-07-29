@extends('admin.layout')
@section('title')
	Properties	
@endsection
@section('content')
<h3 class="page-title">
Properties
</h3><br>
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url(getenv('adminurl')) }}">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{ url(getenv('adminurl').'/properties/') }}">Manage Properties</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
<!--
	<a href="{{ url('admin/plan/add-new-plan') }}" class="btn btn-sm blue pull-right"> Add Plan </a>
-->
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
			<div class="row">
				<div class="col-md-15">
					
					<!-- Begin: life time stats -->
					<div class="portlet">
						<div class="portlet-body">
							<div class="table-container">
								
								
								@if(isset($userid))
								<input type="hidden" name="action" value="properties/list-properties/{{$userid}}"/>
									@else
									<input type="hidden" name="action" value="properties/list-properties"/>
									@endif	
									
								<div class="table-actions-wrapper">
									<span>
									</span>

										
								</div>
								
								<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_realtor">
								<thead>
								<tr role="row" class="heading">
<!--
									<th width="2%">
										<input type="checkbox" name="selectall" class="group-checkable">
									</th>
-->
									<th width="5%">
										 S.No.
									</th>
									<th width="15%">
										User name
									</th>
									<th width="15%">
										User type
									</th>
									<th width="15%">
										Property Name
									</th>
									

									<th width="10%">
										 Property Address
									</th>

									<th width="10%">
										Rooms
									</th>

									<th class="a" width="15%">
										 Actions &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									</th>

								</tr>
								<tr role="row" class="filter">
									
<!--
									<td></td>
-->
									
									<td>
										
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="username" id="username" autocomplete="off">	
									</td>
									<td>
									{!! Form::select('typeuser', array(''=>'--select--','1' => 'Realtor', '2' => 'Houseowner','4'=>'Both'),null,['class' => 'form-control form-filter input-sm', 'id' => 'typeuser']) !!}
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="propname" id="propname" autocomplete="off">
									</td>
									
									<td>
										<input type="text" class="form-control form-filter input-sm" name="propaddress" id="propaddress" autocomplete="off">

										</td>
									<td>
<!--
										<input type="text" class="form-control form-filter input-sm" name="phone" id="phone" autocomplete="off">
-->
										
										</td>
									
									<td>
									<button style="display:none;" class="btn btn-sm yellow filter-submit margin-bottom"></button>
									<button title="Reset" class="btn btn-sm red filter-cancel">Reset</button>	
									</td>
								


								</tr>
								</thead>
								<tbody>
									
								</tbody>
								</table>
								
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		<!-- Pop up starts here-->
			
        <!--Pop-Up Ends here-->
			@include('admin.properties.popup')
@endsection
@section('js')
<script>
jQuery(document).ready(function() {
	
	$(document).on("click", "#view", function () {
		
		
        /***********user ajax view *******/
        var url_for_user_view = adminname+'/properties/showprop';

        

        var userid = $(this).attr("userid");
        var token ="{{csrf_token()}}";
        $.ajax({
            url: path+url_for_user_view,
          
            type: "POST",
            data: {id: userid,_token:token},
            dataType: "JSON",
            success: function (result) {
                
                if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   console.log(result);
                   if(result.user)
                    $('#name_user').text(result.user.name);
                    else
                    $('#name_user').text('NA');
                    
                    if(result.reslutset.property_name)
                     $('#prop_name').text(result.reslutset.property_name);
                     else
                     $('#prop_name').text('NA');
                     
                     if(result.reslutset.property_address)
                     $('#prop_address').text(result.reslutset.property_address);
                      else
                     $('#prop_address').text('NA');
                     
                     if(result.propattrs)
                     $('#prop_attrs').text(result.propattrs);
                     else
                     $('#prop_attrs').text('NA');
                       
                  
					
                   $('#myModal').modal('show');
                   
                   
                }
            }
        });
        /***********user ajax view ends here*******/

    });
	
	$(document).on("click", "#deletetask", function () {
		
		//alert('sdjfldsl');
        var deleteLink = path+'/'+adminname+'/'+$(this).attr('deleteLink');
        //alert(deleteLink);
        bootbox.confirm("Are you sure you want to delete?", function (result) {
            if (result) {
                window.location = deleteLink;
            }
        });
    });
    
   
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/property.js') }}"></script>
@endsection


