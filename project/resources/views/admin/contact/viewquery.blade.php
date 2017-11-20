<div class="portlet-body">
	<div class="general-item-list">
		@if(count($contact))
			<div class="item">
				<div class="item-head">
					<div class="item-details">
						
						Name:
					</div>
				</div>
				<div class="item-body">
					<span class="notetxt">{{$contact->name}}</span>
				</div>
			</div>
			<div class="item">
				<div class="item-head">
					<div class="item-details">
						 
						Email:
					</div>
				</div>
				<div class="item-body">
					<span class="notetxt">{{$contact->email}}</span>
				</div>
			</div>
			<div class="item">
				<div class="item-head">
					<div class="item-details">
						
						Subject:
					</div>
				</div>
				<div class="item-body">
					<span class="notetxt">{{(isset($contact->subject) && !empty($contact->subject))?$contact->subject:' NA'}}</span>
				</div>
			</div>

			<div class="item">
				<div class="item-head">
					<div class="item-details">
						
						Message:
					</div>
				</div>
				<div class="item-body">
					<span class="notetxt">{{(isset($contact->message) && !empty($contact->message))?$contact->message:' NA'}}</span>
				</div>
			</div>
			<div class="item">
				<div class="item-head">
					<div class="item-details">
						
						Phone:
					</div>
				</div>
				<div class="item-body">
					<span class="notetxt">{{(isset($contact->phone) && !empty($contact->phone))?$contact->phone:' NA'}}</span>
				</div>
			</div>
		@else
			<div class="item">
				<div class="item-body">
					<span class="notetxt">No data found</span>
				</div>
			</div>
		@endif	
	</div>
</div>
