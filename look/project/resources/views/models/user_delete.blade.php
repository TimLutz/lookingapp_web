	<!-- Delete Record Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5>Confirm Delete</h5>
			</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="record_id" id="record_id"/>
				<input type="hidden" name="table_name" id="table_name"/>
				<input type="hidden" name="action_name" id="action"/>
				<p class="modaltext">Are you sure you want to delete these records?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button type="button" id="multiple_record" class="btn btn-primary" data-dismiss="modal">Yes</button>
			</div>
		</div>
	</div>
</div>
<!--End Delete Record Modal-->