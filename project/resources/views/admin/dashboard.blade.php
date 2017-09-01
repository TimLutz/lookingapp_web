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
				<a href="{{ url(getenv('adminurl').'/users') }}">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="glyphicon glyphicon-screenshot"></i>
						</div>
						<div class="details">
							<div class="number">
								{{ $users }}
							</div>
							<div class="desc">
								Users
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/users') }}">
						More Info<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</a>
				</div>


				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="{{ url(getenv('adminurl').'/users/banned') }}">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="glyphicon glyphicon-home"></i>
						</div>
						<div class="details">
							<div class="number">
								{{$banuser}}
							</div>
							<div class="desc">
								 Banned user
							</div>
						</div>
						<a class="more" href="{{ url(getenv('adminurl').'/users/banned') }}">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
						</a>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<!-- <a href="{{ url(getenv('adminurl').'/users') }}"> -->
					<a href="javascript:void(0)">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="glyphicon glyphicon-registration-mark"></i>
						</div>
						<div class="details">
							<div class="number">
								 {{$reports}}
							</div>
							<div class="desc">
								 Reports
							</div>
						</div>
						<!-- <a class="more" href="{{ url(getenv('adminurl').'/users') }}"> -->
						<a class="more" href="javascript:void(0)">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<!-- <a href="{{ url(getenv('adminurl').'/properties') }}"> -->
					<a href="javascript:void(0);">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-cube"></i>
						</div>
						<div class="details">
							<div class="number">
								{{$photos}}
							</div>
							<div class="desc">
								 Photos
							</div>
						</div>
						<!-- <a class="more" href="{{ url(getenv('adminurl').'/properties') }}"> -->
						<a class="more" href="javascript:void(0);">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<!-- <a href="{{ url(getenv('adminurl').'/users') }}"> -->
					<a href="javascript:void(0);">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-cube"></i>
						</div>
						<div class="details">
							<div class="number">
								{{$profiletext}}
							</div>
							<div class="desc">
								 Profile Text
							</div>
						</div>
						<!-- <a class="more" href="{{ url(getenv('adminurl').'/users') }}"> -->
						<a class="more" href="javascript:void(0);">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					</a>
				</div>
				
			
@endsection
