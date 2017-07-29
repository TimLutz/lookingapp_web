<!-- Status Modal-->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5>Confirm Change</h5>
			</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="record_id" id="record_id"/>
				<input type="hidden" name="table_name" id="table_name"/>
				<input type="hidden" name="action_name" id="action"/>
				<p class="modaltext">Are you sure you want to change status of records?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button type="button" value="1" class="btn btn-primary change_multiple_status">Active</button>
				<button type="button" value="0" class="btn btn-primary change_multiple_status">Inactive</button>
			</div>
		</div>
	</div>
</div>
<!--End Status Modal-->