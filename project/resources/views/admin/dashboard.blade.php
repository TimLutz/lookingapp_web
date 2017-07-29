@extends('admin.layout')
@section('title')
Dashboard
@endsection
@section('content')
<?php //$common = new CommonRepository(); ?>

			
			<h3 class="page-title">
			{{ ucfirst($active) }}
			</h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/tasks') }}">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="glyphicon glyphicon-screenshot"></i>
						</div>
						<div class="details">
							<div class="number">
								{{$tasks}}
							</div>
							<div class="desc">
								Total Tasks
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/tasks') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</a>
				</div>


				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/users') }}">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="glyphicon glyphicon-home"></i>
						</div>
						<div class="details">
							<div class="number">
								{{ $houseowners }}
							</div>
							<div class="desc">
								Total House Owners
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/users') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
						</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/users') }}">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="glyphicon glyphicon-registration-mark"></i>
						</div>
						<div class="details">
							<div class="number">
								 {{ $realtors }}
							</div>
							<div class="desc">
								Total Realtors
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/users') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/properties') }}">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-cube"></i>
						</div>
						<div class="details">
							<div class="number">
								{{ $properties }}
							</div>
							<div class="desc">
								Total Property
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/properties') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/users') }}">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-cube"></i>
						</div>
						<div class="details">
							<div class="number">
								{{ $both }}
							</div>
							<div class="desc">
								Total Both
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/users') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>
				
			
@endsection
