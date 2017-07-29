@include('header')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="col-md-4">
					@include('sidebar')
				</div>
				<div class="col-md-8">
					{!! Form::open(['url'=>'user/quote','method'=>'post']) !!}
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label>
                                        Pick Up
                                    </label>
                                </div>
                                <div class="col-md-4 pickLocation form-group @if ($errors->has('pick_location')) has-error @endif">
                                    
                                    <?php 
                                     echo Form::text('pick_location',null,['class'=>'flow-control','id'=>'pick_location']);
                                     ?>
                                     <input type="hidden" value="" name="lat">
                                    <input type="hidden" value="" name="lng">
                                    @if ($errors->has('pick_location')) <p class="help-block">{{ $errors->first('pick_location') }}</p> @endif
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Drop off
                                    </label>

                                </div>
                                <div class="col-md-4 dropLocation form-group @if ($errors->has('drop_location')) has-error @endif">
                                    <?php
                                    echo Form::text('drop_location',null,['class'=>'flow-control','id'=>'drop_location']);
                                    ?>
                                     <input name="drop_lat" type="hidden" class="droplat">
                                    <input name="drop_lng" type="hidden" class="droplng">
                                    @if ($errors->has('drop_location')) <p class="help-block">{{ $errors->first('drop_location') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('mode_type')) has-error @endif">
                                <div class="col-md-2">
                                    <label>
                                        Mode Type
                                    </label>

                                </div>
                                <div class="col-md-10">
                                <?php
                                  foreach($modes AS $mode)
                                  {
                                    if($mode['status'] == '0')
                                    {
                                        ?>
                                            <div class="col-md-4">
                                            
                                            <?php
                                                 echo Form::radio('mode_type',$mode['id'],false,['class'=>'form-control','id'=>'mode_type','disabled'=>'disabled']);
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div class="col-md-4">
                                        <?php
                                        echo Form::radio('mode_type',$mode['id'],false,['class'=>'form-control','id'=>'mode_type']);
                                        ?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-md-8">
                                        <?php echo $mode['title'].'('.$mode['description'].')'; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                  }
                                  ?>

                                </div> 
                                @if ($errors->has('mode_type')) <p class="help-block">{{ $errors->first('mode_type') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <div class="col-md-2">
                                   <label>Email</label>
                                </div>
                                <div class="col-md-10">
                                    
                                    {!! Form::email('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Enter email']) !!}
                                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('mobile')) has-error @endif">
                                <div class="col-md-2">
                                   <label>Phone</label>
                                </div>
                                <div class="col-md-10">
                                
                                    {!! Form::text('mobile',null,['class'=>'form-control','id'=>'mobile','placeholder'=>'Enter Mobile']) !!}
                                    @if ($errors->has('mobile')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-6">
                                   
                                    <input type="submit" name="quote" value="Quote me" class="btn btn-primary">
                                </div>
                               
                            </div>    
                    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>	

@include('footer')