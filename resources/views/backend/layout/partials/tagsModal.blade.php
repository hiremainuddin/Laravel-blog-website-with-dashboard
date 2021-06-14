<!-- create category -->
<div class="modal fade" id="addtagModal">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="addTag">
			@csrf
			<div class="modal-header">
				<h4 class="modal-title">Add Tag</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label id="input">Tag Name</label>
					<input type="text" name="tag_name" id="tag_name" class="form-control" placeholder="Tag name">
					<small class="text-danger" id="tag_name_help"></small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Create</button>	
				<button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>	
			</div>
         </form>
		</div>
	</div>	
</div>

<!--Edit Tag -->
<div class="modal fade" id="editTagModal">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="editTag">
			@csrf
			<div class="modal-header">
				<h4 class="modal-title">Update Tag</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<input type="hidden" name="tag_id" id="tag_id" class="form-control">
				</div>
				<div class="form-group">
					<label id="input">Tag Name</label>
					<input type="text" name="edit_tag_name" id="edit_tag_name" class="form-control" placeholder="Tag name">
					<small class="text-danger" id="edit_tag_name_help"></small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Update</button>	
				<button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>	
			</div>
         </form>
		</div>
	</div>	
</div>