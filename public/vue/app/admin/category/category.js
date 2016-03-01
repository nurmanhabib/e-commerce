new Vue({
	el: '#category',
	data: function() {
		return {
			status: '',
			categories: '',
			newCategory: {
				name: '',
				parent_id: 0
			},
			edit: {
				name: '',
				parent_id: ''
			}
		}
	},

	ready: function(){
		this.showCategories()
	},

	methods: {
		// Menampilkan category
		showCategories(){
			// Mengambil API untuk category dari http.js
			this.$http.get(API_URL + '/categories').then(function(response){

				this.status = response.data.status
				this.categories = response.data.categories

			}, function (response){
				console.log(response);
			})
		},

		// Untuk tambah category
		createCategory(){
			if( this.newCategory.name != '' ){
				var newcategory = {
					name: this.newCategory.name,
					parent_id: this.newCategory.parent_id
				}
				console.log(newcategory)
				this.$http.post(API_URL + '/categories', newcategory, (data) => {

					console.log(data)

					this.newCategory.name = ''
					this.newCategory.parent_id = '0'

					return this.showCategories()
				})
			} else {
				alert('Kategori tidak boleh kosong, silahkan ulangi lagi')
				return this.showCategories()
			}
		},

		// Untuk edit category
		editCategory(category){
			this.edit = category
			console.log(this.edit)
		},

		// Untuk update category
		updateCategory(id){
			if(this.edit.name != ''){
				var category = {
					name: this.edit.name,
					parent_id: this.edit.parent_id
				}
				this.$http.put(API_URL + '/categories/' + id, category, (data) => {

					console.log(data)

					this.edit.name = ''
					this.edit.parent_id = '0'

					return this.showCategories()
				})
			} else {
				alert('Kategori tidak boleh kosong, silahkan ulangi lagi')
				return this.showCategories()
			}
		},

		cancelEdit(category){
			return this.showCategories()
		},

		// Untuk delete category
		deleteCategory(id){
			this.$http.delete(API_URL + '/categories/' + id).then(function(response){
				this.showCategories()

				console.log(response.data.message)
			})
		},
	}
})