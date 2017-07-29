<div class="modal fade" id="myModal" role="dialog">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Task Status</h4>
                                        </div>
                                        <div class="modal-body">	
											<?php //echo $tasks->status; ?>
                                           
							
										
										
										{!! Form::open(array('method' => 'POST','url' => '/'.getenv('adminurl').'/updatestatus','id'=>'changestatus')) !!}
										   <div class="form-body">
										<div class="row">
											<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('status', 'Status: ',['class' => 'control-label','id' => 'statusdata']) !!} <span class="star"></span>
											
											{!! Form::select('status', array('1' => 'Normal', '2' => 'Declined','3' => 'Accepted','4'=>'Completed'),null,['class' => 'form-control','id' => 'status']) !!}
											
											
											<label class="help-block"></label>
									</div>
								{!! Form::hidden('tasktime',null,['class' => 'form-control','id' => 'taskperforming']) !!}
									</div>
									</div>
									<div class="box-footer"> 
								{!! Form::button('submit',['id'=>'updatestatus','class' => 'btn btn-primary']) !!}   	
	
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
