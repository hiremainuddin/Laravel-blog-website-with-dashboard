<!-- create category -->
<div class="modal fade" id="addCateModal">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="addCategory">
			@csrf
			<div class="modal-header">
				<h4 class="modal-title">Add Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label id="input">Category Name</label>
					<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category name">
					<small class="text-danger" id="category_name_help"></small>
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

<!--Edit create category -->
<div class="modal fade" id="editCateModal">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="editCategory">
			@csrf
			<div class="modal-header">
				<h4 class="modal-title">Update Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<input type="hidden" name="category_id" id="category_id" class="form-control">
				</div>
				<div class="form-group">
					<label id="input">Category Name</label>
					<input type="text" name="edit_category_name" id="edit_category_name" class="form-control" placeholder="Category name">
					<small class="text-danger" id="edit_category_name_help"></small>
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