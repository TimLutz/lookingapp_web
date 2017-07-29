<!-- Add comment Modal-->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<form id="comment_form" method="post" accept-charset='UTF-8'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" id="order_id" value="">
				<input type="hidden" name="order_status" id="orderstatus" value="">
				<p class="modaltext">Add Comment</p>
				<textarea class="col-md-12" style="resize: none;" name="comment" id="comment" rows="5"></textarea>
				
			</form>
			<span id="msg" class="text-danger"></span>
			</div>
			<div class="modal-footer">
				<button type="button" id="comment" class="btn btn-primary updatecomment">Comment</button>
				<button type="button" class="btn btn-default statusexit" data-dismiss="modal">Cancel</button>
				
			</div>
		</div>
	</div>
</div>
<!--End Reason for delete Modal-->
