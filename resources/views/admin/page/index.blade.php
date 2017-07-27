@extends('admin.layout')	
@section('title')
Pages
@endsection
@section('heading')
	CMS Pages
@endsection
@section('content')
	<div class="row">
				<div class="col-md-12">
					@include('flash::message')
					<div class="portlet box">
						
						<div class="portlet-body">
							<div>
								<div class="row">
							
								</div>
							
									<table  class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									  Title
								</th>
								<th>
									  Action
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($pages AS $page)
									<tr>
										<td><?php echo $i; ?></td>
										<td>
											{{ $page->title }}	
										</td>
																				
										<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/pages/'.base64_encode($page->id),'method' => 'post' ]) !!}
												<a href="pages/{{Crypt::encrypt($page->id)}}/edit" style="color:orange" title="Edit" class="btn btn-circle btn-icon-only btn-default"><span class="icon-pencil" aria-hidden="true" style="color:orange;"></span></a>
												{!! Form::hidden('table','pages',['class' => 'form-control']) !!}
											{!! Form::close() !!}
										</td>
										</td>
									</tr>
									<?php $i+=1; ?>
									@endforeach
							</tbody>
							</table>
								</div>
						
						</div>
					</div>
				</div>
			</div>
@endsection