<div class="modal fade" id="myModaltechnician" role="dialog">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Task</h4>
                                        </div>
                                        <div class="modal-body">	
											<?php //echo $tasks->status; ?>
                                           
							
										
										
										{!! Form::open(array('method' => 'POST','id'=>'changetechnician')) !!}
										   <div class="form-body">
											   
											   
											   
											   
											   
											   <div class="row">
												   <div class="col-md-6">
											   <div class="form-group">
									
										
											{!! Form::label('start_datetime', 'Start Date & time: ',['class' => 'control-label']) !!} <span class="star"></span>
											<div class="input-group date form_datetime">
											
												{!! Form::text('start_datetime',null,['class' => 'form-control','id'=>'start_datetime','readonly']) !!}
											<label class="help-block"></label>
												<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
											<!-- /input-group -->
										</div>
									</div>
									 <div class="col-md-6">
									 <div class="form-group">
										
										
										{!! Form::label('end_datetime', 'End Date & time: ',['class' => 'control-label']) !!} <span class="star"></span>
										
											<div class="input-group date form_datetime">
												{!! Form::text('end_datetime',null,['class' => 'form-control','id'=>'end_datetime','readonly']) !!}
												<label class="help-block"></label>
												<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
											<!-- /input-group -->
										</div>
									</div>
											 </div>  
											   
											   
											   
											   
											   
										<div class="row">
			<div class="col-md-6">
			<div class="form-group">
			{!! Form::label('technician', 'Select Technician: ',['class' => 'control-label','id' => 'statusdata']) !!} <span class="star"></span>

			<div id="appenddata">
			</div>
			<label class="help-block"></label>
			</div>
			{!! Form::hidden('tasktime',null,['class' => 'form-control','id' => 'technicianperforming']) !!}
			</div>

	<div class="col-md-6">
	<div class="form-group">
	{!! Form::label('priority', 'Select Priority: ',['class' => 'control-label']) !!} <span class="star"></span>
	{!! Form::select('priority',array_replace(['' => '---Please select---','1'=>'High','2'=>'Medium','3'=>'Low']),null,['class' => 'form-control','id' => 'priority']) !!}
	<label class="help-block"></label>
	</div>
	</div>
									</div>
				<div class="row">
					<div class="col-md-12">
	<div class="form-group">
	{!! Form::label('note_detail', 'Notes: ',['class' => 'control-label']) !!} <span class="star"></span>
	{!! Form::textarea('note_detail',null,['class' => 'form-control short_textarea','id'=>'note_detail']) !!}
	<label class="help-block"></label>
	</div>
	</div>
				</div>
										</div>
										
										
										
										
                                        </div>
                                        <div class="modal-footer">
											{!! Form::button('submit',['id'=>'updatetechnician','class' => 'btn btn-primary technicianchangebutton']) !!}   	
                                            {!! Form::close() !!}
                                            <button type="button" class="btn green dismisspopup" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
