@include('admin.header')

@include('admin.aside')
<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<section class="page-title">
				<h1>
					@yield('heading')
				</h1>
			</section>
			
			@yield('content')
			
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- END CONTENT -->

@include('admin.footer')


