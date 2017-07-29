<div class="modal fade" id="myModaltechnician" role="dialog">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Technician Assigned</h4>
                                        </div>
                                        <div class="modal-body">	
											<?php //echo $tasks->status; ?>
                                           
							
										
										
										{!! Form::open(array('method' => 'POST','id'=>'changetechnician')) !!}
										   <div class="form-body">
										<div class="row">
											<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('technician', 'Select Technician: ',['class' => 'control-label','id' => 'statusdata']) !!} <span class="star"></span>
											
											<div id="appenddata">
												</div>
											
											
										
										<div class="col-md-6">
										<div class="form-group">
										{!! Form::label('assigned_date', 'Date: ',['class' => 'control-label']) !!}<span class="star">*</span>
										<div class="input-group margin-bottom-5">
										<input type="text" class="form-control start_date form-filter input-sm" readonly name="assigned_date" placeholder="To">
										<span class="input-group-btn">
										<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
										</div>
										<label class="help-block"></label>
										</div>
										</div>							
										
											
											<label class="help-block"></label>
									</div>
								{!! Form::hidden('tasktime',null,['class' => 'form-control','id' => 'technicianperforming']) !!}
									</div>
									</div>
									<div class="box-footer"> 
								{!! Form::button('submit',['id'=>'updatetechnician','class' => 'btn btn-primary']) !!}   	
	
									</div><!-- /.col -->
										</div>
										
										{!! Form::close() !!}
										
										
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn green" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
