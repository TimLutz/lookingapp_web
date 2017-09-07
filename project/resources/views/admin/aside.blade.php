<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
						<i class="fa fa-bars"></i>
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				
				<li class="@if(isset($active) && $active == 'dashboard') active @endif">
					<a href="{{ url(getenv('adminurl').'') }}">
					<i class="glyphicon glyphicon-dashboard"></i>
					<span class="title">
					Dashboard </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'users' || $active == 'banned') active @endif">
					<a href="javascript:;">
					<i class="icon-list"></i>
					<span class="title">Users</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="@if($active == 'users') active @endif">
							<a href="{{ url(getenv('adminurl').'/users') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							All Users</a>
						</li>
						<li class="@if($active == 'banned') active @endif">
							<a href="{{ url(getenv('adminurl').'/users/banned') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							Banned Users</a>
						</li>
					</ul>
				</li>
				<li class="@if(isset($active) && $active == 'current' || $active == 'Archive') active @endif">
					<a href="javascript:void(0)">
					<i class="icon-list"></i>
					<span class="title">Reports Users</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="@if($active == 'current') active @endif">
							<!-- <a href="javascript:void(0)"> -->
							<a href="{{ url(getenv('adminurl').'/reports') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							Current Users</a>
						</li>
						<li class="@if($active == 'Archive') active @endif">
							<!-- <a href="javascript:void(0)"> -->
							<a href="{{ url(getenv('adminurl').'/reports/archiveindex') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							Archived Users</a>
						</li>
					</ul>
				</li>
				
				<li class="@if(isset($active) && $active == 'photos') active @endif">
					<a href="{{ url(getenv('adminurl').'/photos') }}">
					<!-- <a href="javascript:void(0)"> -->
					<i class="icon-list"></i>
					<span class="title">
					Photos </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'profiletext') active @endif">
					<a href="{{ url(getenv('adminurl').'/profiletext') }}">
					<!-- <a href="javascript:void(0)"> -->
					<i class="icon-list"></i>
					<span class="title">
					Profile Text </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'free' || $active == 'paid') active @endif">
					<a href="javascript:void(0)">
					<i class="icon-list"></i>
					<span class="title">Restrictions</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="@if($active == 'free') active @endif">
							<!-- <a href="javascript:void(0)"> -->
							<a href="{{ url(getenv('adminurl').'/userrestriction') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							Free Users</a>
						</li>
						<li class="@if($active == 'paid') active @endif">
							<!-- <a href="javascript:void(0)"> -->
							<a href="{{ url(getenv('adminurl').'/userrestriction/paid') }}">
							<i class="glyphicon glyphicon-pushpin"></i>
							Paid Users</a>
						</li>
					</ul>
				</li>
				<li class="@if(isset($active) && $active == 'trials') active @endif">
					<a href="{{ url(getenv('adminurl').'/trials') }}">
					<!-- <a href="javascript:void(0)"> -->
					<i class="icon-list"></i>
					<span class="title">
					Trials </span>
					</a>
				</li>	
				<li class="@if(isset($active) && $active == 'template') active @endif">
					<a href="{{ url(getenv('adminurl').'/template') }}">
					<i class="icon-list"></i>
					<span class="title">
					Templates </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'pages') active @endif">
					<a href="{{ url(getenv('adminurl').'/pages') }}">
					<i class="fa fa-link"></i>
					<span class="title">
					Settings</span>
					</a>
				</li>

				
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->

	
