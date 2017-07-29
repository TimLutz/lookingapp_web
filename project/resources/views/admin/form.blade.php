<div class="portlet box">
    <div class="portlet-body">
        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!} <span class="star">*</span>
            {!! Form::text('question',null,['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('answer', 'Answer: ') !!} <span class="star">*</span>
			{!! Form::textarea('answer',null,['id' => 'txtEditor','class' => 'form-control','rows'=>'5','cols'=>'10']) !!}
        </div>
		<div class="form-group">    
		{!! Form::label('sort_num', 'Order Number: ',['class' => 'required-star']) !!} <span class="star">*</span> 
		{!! Form::text('sort_num',null,['class' => 'form-control','size' => '5x2']) !!}
		</div>
		
		@include('partials.status', ['status' => $faq->status])
		<div class="form-group">
            {!! Form::hidden('testing',null,['id' => 'hide_template','class' => 'form-control']) !!}
        </div>
    <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            <a href="{{ url('admin/faqs') }}" class="btn default">Back</a>
        </div>
    </div>
</div>
