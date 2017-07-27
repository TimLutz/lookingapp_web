<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			
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
<!--
				<li class="@if(isset($active) && $active == 'users') active @endif">
					<a href="{{ url(getenv('adminurl').'/dashboard/users') }}">
					<i class="icon-users"></i>
					<span class="title">
					Manage Users </span>
					</a>
				</li>
-->



				<!-- <li class="start @if($active == 'realtors' || $active == 'houseowners') active @endif open">
					<a href="javascript:;">
					<i class="icon-users"></i>
					<span class="title">Manage Users</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="@if($active == 'realtors') active @endif">
							<a href="{{ url(getenv('adminurl').'/users') }}">
							<i class="glyphicon glyphicon-registration-mark"></i>
							Manage Realtors</a>
						</li>
						<li class="@if($active == 'houseowners') active @endif">
						<a href="{{ url(getenv('adminurl').'/users/index-house') }}">
							<i class="glyphicon glyphicon-home"></i>
								Manage Houseowners</a>
						</li>
						
					</ul>
				</li> -->

				<li class="@if(isset($active) && $active == 'realtors') active @endif">
					<a href="{{ url(getenv('adminurl').'/users') }}">
					<i class="glyphicon glyphicon-user"></i>
					<span class="title">
					Manage Users </span>
					</a>
				</li>	


<!--

				<li class="@if(isset($active) && $active == 'realtors') active @endif">
					<a href="{{ url(getenv('adminurl').'/users') }}">
					<i class="icon-users"></i>
					<span class="title">
					Manage Realtors </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'houseowners') active @endif">
					<a href="{{ url(getenv('adminurl').'/users/index-house') }}">
					<i class="icon-users"></i>
					<span class="title">
					Manage Houseowners </span>
					</a>
				</li>
-->

				<li class="@if(isset($active) && $active == 'technicians') active @endif">
					<a href="{{ url(getenv('adminurl').'/users/index-technician') }}">
					<i class="glyphicon glyphicon-wrench"></i>
					<span class="title">
					Manage Technicians </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'properties') active @endif">
					<a href="{{ url(getenv('adminurl').'/properties') }}">
					<i class="fa fa-cube"></i>
					<span class="title">
					Manage Properties </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'timeslot') active @endif">
					<a href="{{ url(getenv('adminurl').'/timeslot') }}">
					<i class="glyphicon glyphicon-time"></i>
					<span class="title">
					Manage Timeslots </span>
					</a>
				</li>
				<li class="@if(isset($active) && $active == 'tasks') active @endif">
					<a href="{{ url(getenv('adminurl').'/tasks') }}">
					<i class="glyphicon glyphicon-screenshot"></i>
					<span class="title">
					Manage Tasks </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'tech-tasks') active @endif">
					<a href="{{ url(getenv('adminurl').'/tasks/index-techtask') }}">
					<i class="glyphicon glyphicon-link"></i>
					<span class="title">
					Manage Technician Tasks </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'client-feedback') active @endif">
					<a href="{{ url(getenv('adminurl').'/tasks/index-feedback') }}">
					<i class="glyphicon glyphicon-check"></i>
					<span class="title">
					Client's Feedback </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'notes') active @endif">
					<a href="{{ url(getenv('adminurl').'/notes/index') }}">
					<i class="glyphicon glyphicon-list-alt"></i>
					<span class="title">
					General Notes </span>
					</a>
				</li>
				
				<li class="@if(isset($active) && $active == 'pages') active @endif">
					<a href="{{ url(getenv('adminurl').'/pages') }}">
					<i class="fa fa-link"></i>
					<span class="title">
					Settings</span>
					</a>
				</li>
				</li>
				
				<li class="@if(isset($active) && $active == 'template') active @endif">
					<a href="{{ url(getenv('adminurl').'/template') }}">
					<i class="icon-envelope-open"></i>
					<span class="title">
					Templates </span>
					</a>
				</li>
				
<!--
				<li class="@if(isset($active) && $active == 'settings') active @endif">
					<a href="{{ url(getenv('adminurl').'/setting') }}">
					<i class="glyphicon glyphicon-record"></i>
					<span class="title">
					Settings </span>
					</a>
				</li>
-->
				
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->

	
