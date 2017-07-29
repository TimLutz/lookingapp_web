
<div class="portlet box">
<div class="portlet-body">
@include('errors.user_error')
<div class="form-group">
    {!! Form::label('url_name', 'Url: ',['class' => 'required-star']) !!} <span class="star">*</span>
    {!! Form::text('url_name',null,['class' => 'form-control','size' => '5x2']) !!}
</div>
<span class="star">For Example :https://www.youtube.com/embed/3PqxT1VqyNc</span>
<div class="form-group">    
 {!! Form::label('sort_num', 'Order Number: ',['class' => 'required-star']) !!} <span class="star">*</span> 
 {!! Form::text('sort_num',null,['class' => 'form-control','size' => '5x2']) !!}
 </div>
 <div class="form-group">    
 {!! Form::label('title', 'Title: ',['class' => 'required-star']) !!} <span class="star">*</span> 
 {!! Form::text('title',null,['class' => 'form-control','size' => '5x2']) !!}
 </div>
  <div class="form-group">    
 {!! Form::label('subtitle', 'Sub-title: ',['class' => 'required-star']) !!} <span class="star">*</span> 
 {!! Form::text('subtitle',null,['class' => 'form-control','size' => '5x2']) !!}
 </div>
 <div class="form-group">    
 {!! Form::label('description', 'Description: ',['class' => '']) !!}
 {!! Form::textarea('description',null,['class' => 'form-control','size' => '5x2']) !!}
 </div>

@include('partials.status', ['status' => $videos->status])

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>
</div>
</div>

