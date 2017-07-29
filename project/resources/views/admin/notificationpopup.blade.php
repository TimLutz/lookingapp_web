{{-- */use repositories\CommonRepository;/* --}}
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<?php $count = count($notifications); ?>
					<span class="badge badge-default">
					{{$count}} </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							
							<h3><span class="bold">{{$count}} pending</span> notifications</h3>
<!--
							<a href="extra_profile.html">view all</a>
-->
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								
								@foreach($notifications as $notification)
								<?php 
								$common = new CommonRepository();
								$time = strtotime($notification->created_at);
								$delay = $common->humanTiming($time);
								
								?>
								<li>
									<?php $noteid = Crypt::encrypt($notification['id']) ?>
									@if(in_array($notification['type'], array("task_requested", "task_completed", "task_deleted","task_rescheduled")))
									<a href="{{ url(getenv('adminurl').'/tasks') }}" id="statusnoti" notificationid = "{{ $noteid }}">
									@elseif(in_array($notification['type'], array("note_created", "note_updated")))
									<a href="{{ url(getenv('adminurl').'/notes/index') }}" id="statusnoti" notificationid = "{{ $noteid }}">
									@else
									<a href="javascript:;" id="statusnoti" notificationid = "{{ $noteid }}">
									@endif	
									<span class="time">{{$delay}} ago</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									{{$notification->content}} </span>
									</a>
								</li>
								@endforeach
								
							</ul>
						</li>
					</ul>
			 
