<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="sidebar-toggler-wrapper">
				<div class="sidebar-toggler"></div>
			</li>
			<li class="@if(isset($active) && $active == 'dashboard') active @endif">
				<a href="{{ url( 'admin/dashboard' ) }}">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>
			 <li class="@if(isset($active) && $active == 'Jobseekerswaitlist') active @endif @if(isset($active) && $active == 'approvedjobseeker') active @endif">
				<a href="">
					<i class="glyphicon glyphicon-pushpin"></i>
					<span class="title">Employees</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="@if(isset($active) && $active == 'Jobseekerswaitlist') active @endif">
						<a href="{{ url( 'admin/list-waitingemployee' ) }}">
						<i class="glyphicon glyphicon-tower"></i>&nbsp; Waitlist</a>
					</li>
					 <li class="@if(isset($active) && $active == 'approvedjobseeker') active @endif" >
						<a href="{{ url( 'admin/list-approvedemployee' ) }}">
						<i class="glyphicon glyphicon-leaf"></i>&nbsp; Approved</a>
					</li>
				</ul>
			</li> 
		
			<li class="@if(isset($active) && $active == 'employerwaitlist') active @endif @if(isset($active) && $active == 'approvedemployer') active @endif">
				<a href="">
					<i class="icon-rocket"></i>
					<span class="title">Employers</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="@if(isset($active) && $active == 'employerwaitlist') active @endif">
						<a href="{{ url( 'admin/list-employerwaitlist' ) }}">
						<i class="glyphicon glyphicon-tower"></i> &nbsp; Waitlist</a></li>
					<li class="@if(isset($active) && $active == 'approvedemployer') active @endif">
						<a href="{{ url( 'admin/list-approvedemployer' ) }}">
							<i class="glyphicon glyphicon-leaf"></i>&nbsp; Approved</a></li>
				</ul>
			</li>

			<li class="@if(isset($active) && $active == 'allJobs') active @endif">
				<a href="{{ url( 'admin/list-jobs' ) }}">
					<i class="fa fa-tasks"></i>
					<span class="title">Jobs</span>
				</a>
			</li>
<!--
			<li>
				<a href="javascript:;">
					<i class="icon-diamond"></i>
					<span class="title">Payments</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li><a href="#">To Receive</a></li>
					<li><a href="#">To Pay</a></li>
				</ul>
			</li>-->

			

			
			<li class="@if(isset($active) && $active == 'emails') active @endif">
				<a href="{{ url( 'admin/list-emails' ) }}"> 
				<i class="icon-envelope-open"></i>
				<span class="title">Manage Emails</span>
			</a>
			</li>
			<li class="@if(isset($active) && $active == 'categories') active @endif">
				<a href="{{ url( 'admin/list-categories' ) }}">
					<i class="fa fa-tags"></i>
					<span class="title">Manage Categories</span>
				</a>
			</li>
			
			<li class="@if(isset($active) && $active == 'subcategories') active @endif">
				<a href="{{ url( 'admin/list-subcategories' ) }}">
					<i class="fa fa-list-alt"></i>
					<span class="title">Manage Subcategories</span>
				</a>
			</li>	
		
			<li class="@if(isset($active) && $active == 'skills') active @endif">
				<a href="{{ url( 'admin/list-skills' ) }}">
					<i class="fa fa-asterisk"></i>
					<span class="title">Manage Skills</span>
				</a>
			</li>
			
			<li class="@if(isset($active) && $active == 'cms') active @endif">
				<a href="{{ url( 'admin/list-cms' ) }}">
				<i class="fa fa-bolt"></i>
				<span class="title">Manage CMS</span>
				</a>
			</li>

			<li class="@if(isset($active) && $active == 'contacts') active @endif">
				<a href="{{ url( 'admin/list-contacts' ) }}">
				<i class="fa fa-phone"></i>
				<span class="title">Contact Us</span>
				</a>
			</li>
			
			<li class="@if(isset($active) && $active == 'faq') active @endif">
				<a href="{{ url( 'admin/list-faqs' ) }}">
				<i class="fa fa-question-circle"></i>
				<span class="title">FAQ</span>
				</a>
			</li>
			<li class="@if(isset($active) && $active == 'generalinfo') active @endif">
				<a href="{{ url( 'admin/list-generalinfo' ) }}">
				<i class="glyphicon glyphicon-list-alt"></i>
				<span class="title">General Information</span>
				</a>
			</li>
			<!-- <li class="">
				<a href="{{ url( 'admin/list-commissions' ) }}">
					<i class="icon-home"></i>
					<span class="title">Manage Commission</span>
				</a>
			</li> -->
		</ul>
	<!-- END SIDEBAR MENU -->
	</div>
</div>