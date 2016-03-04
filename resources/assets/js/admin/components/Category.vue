<style>
	
</style>

<template>	
	<div class="panel panel-flat">
		<div class="panel-heading">
			<legend class="text-bold panel-title">Category</legend>
		</div>
		<div class="panel-body">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="icon-plus22 position-right"></i> Add Category</button>
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th><strong>Id</strong></th>
						<th><strong>Category</strong></th>
						<th><strong>Slug</strong></th>
						<th class="text-center"><strong>Actions</strong></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="category in categories">
						<td>{{ category.id }}</td>
						<td>{{ category.name }}</td>
						<td>{{ category.slug }}</td>
						<td class="text-center">
							<a v-on:click="editCategory(category)" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal_edit" data-popup="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
							<a v-on:click="deleteCategory(category)" class="btn btn-default btn-xs" data-popup="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal Add Category -->
	<div id="modal_add" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Add Category</h3>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" action="#">
						<fieldset class="content-group">
							
							<div class="form-group">
		                    	<label class="control-label col-lg-4">Parent Category</label>

		                    	<div class="col-lg-8">

		                            <select v-model="newCategory.parent_id" name="select" class="form-control">
		                                <option value="0" selected>-- None --</option>
		                                <option v-for="category in categories" value="{{ category.id }}">{{ category.name }}</option>
		                            </select>
		                        </div>
		                    </div>

							<div class="form-group">
								<label class="control-label col-lg-4">Category</label>
								<div class="col-lg-8">
									<input v-model="newCategory.name" type="text" class="form-control">
								</div>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="modal-footer">
					<button v-on:click="resetAdd()" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button v-on:click="addCategory()" type="button" class="btn btn-primary" data-dismiss="modal">Add Category</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal Add Category -->

	<!-- Modal Edit Category -->
	<div id="modal_edit" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Edit Category</h3>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" action="#">
						<fieldset class="content-group">
							
							<div class="form-group">
		                    	<label class="control-label col-lg-4">Parent Category</label>

		                    	<div class="col-lg-8">

		                            <select v-model="editedCategory.parent_id" name="select" class="form-control">
		                                <option value="0">
		                                	-- None --
		                                </option>
		                                <option v-for="category in categories" value="{{ category.id }}" >{{ category.name }}</option>
		                            </select>
		                        </div>
		                    </div>

							<div class="form-group">
								<label class="control-label col-lg-4">Category</label>
								<div class="col-lg-8">
									<input v-model="editedCategory.name" value="{{ edit.name }}" type="text" class="form-control"> 
								</div>
							</div>
						</fieldset>
					</form>
				</div>

				<div class="modal-footer">
					<button v-on:click="cancelEdit(editedCategory)" type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
					<button v-on:click="updateCategory(editedCategory)" type="button" class="btn btn-primary" data-dismiss="modal">Update Category</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Modal Add Category -->
</template>

<script>
	var objCategory = function () {
		return {
			id: 0,
			slug: '',
			name: '',
			parent_id: 0,
			created_at: null,
			updated_at: null
		}
	}

	module.exports = {
		data() {
			return {
				categories: null,
				newCategory: new objCategory(),
				editedCategory: new objCategory(),
			}
		},

		methods: {
			/**
			 * Mengambil semua data kategori dari database
			 * @return {void}
			 */
			fetch() {
				this.$http.get('categories').then(function (response) {
					this.categories = response.data.categories;
				}, function (response) {
					// Error proccess API
				});
			},

			/**
			 * Membuat kategori baru
			 * @return {void}
			 */
			addCategory() {
				var category = this.newCategory;

				this.$http.post('categories', category).then(function (response) {
					var data = response.data;

					if (data.status_code == 422) {
						this.error = data.message;
					} else if (data.status == 'success') {
						this.categories.push(category);
						console.log(category);

						this.resetAdd();
					}
				}, function (response) {
					// Error proccess API
				});
			},

			/**
			 * Menghapus data newCategory
			 * @return {void}
			 */
			resetAdd() {
				this.newCategory = {
					name: '',
					parent_id: 0
				}
			},

			/**
			 * Memasukkan kategori yang akan di edit ke variabel modify dan beforeModify
			 * @param  {object}  category Kategori yang akan di perbarui
			 * @return {void}
			 */
			editCategory(category) {
				this.beforeEditCache = {
					name: category.name,
					parent_id: category.parent_id
				};

				this.editedCategory = category;
			},

			/**
			 * Menghapus data modify menjadi default
			 * @return {void}
			 */
			cancelEdit(category) {
				// Mengembalikan category dalam cache
				category.name = this.beforeEditCache.name;
				category.parent_id = this.beforeEditCache.parent_id;

				this.editedCategory = null;
			},

			updateCategory(category) {
				console.log(category.$index);
				// this.$http.put('categories/' + category.id, category).then(function (response) {
				// 	this.beforeEditCache = category;
				// 	this.editedCategory = null;
				// }, function (response) {
				// 	// 
				// })
			},

			/**
			 * Menghapus kategori
			 * @param  {object} category
			 * @return {void}
			 */
			delete(category) {
				this.$http.delete('category/' + category.id).then(function (response) {
					this.categories.$remove(category);
				}, function (response) {
					// 
				})
			}
		},

		ready() {
			this.fetch();
		}
	}
</script>