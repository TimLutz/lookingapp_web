@include('header')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="col-md-4">
					@include('sidebar')
				</div>
				<div class="col-md-8">
            	@include('errors.user_error')
                
                    <?php
                        foreach($services As $service)
                        {
                            $charges = '';
                            $total = 0;
                            ?>
                            <div class="col-md-6">
                                <p>
                                   <?php echo $service['title']; ?> 
                                </p>
                                <h1>
                                    <?php 
                                     /*   if(Session::get('addtional_charges'))
                                        {
                                            $charges = SESSION::get('addtional_charges');
                                        }
                                        $total = $charges + $service['value'];*/
                                        echo $total = $service['total']; 
                                    ?>
                                </h1>
                                <p>
                                   <?php 
                                        echo $service['description']; 
                                    ?> 
                                </p>
                                {!! Form::open(['url'=>'user/booked']) !!}
                                <input type="hidden" name="service" value="<?php if(isset($service['title']) && $service['title'] != ''){ echo trim($service['title']); } ?>">
                                <input type="hidden" name="amount" value="<?php echo trim($total); ?>">
                                <input type="submit" name="book" id="book" value="Booking">
                                {!! Form::close() !!}
                            </div>
                            <?php
                        }
                    ?>
			</div>
		</div>
	</div>
@include('footer')