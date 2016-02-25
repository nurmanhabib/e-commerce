new Vue({
	el: '#category',
	data(){
		return {
			status: '',
			categories: '',
			newcategory: {
				name: '',
				parent: ''
			},
			newCategory: ''
		}
	},
	ready: function(){
		this.checkNewCategory()
	},
	methods: {
		showCategories(){
			this.$http.get(API_URL + '/categories').then(function(response){
				// this.$set('categories', response.categories)
				this.status = response.data.status
				this.categories = response.data.categories
				console.log(this.categories)
			}, function (response){
				console.log(response);
			})
		},

		createCategory(){
			var newcategory = {
				name: this.newcategory.name,
				parent_id: this.newcategory.parent
			}
			console.log(newcategory)
			this.$http.post(API_URL + '/categories', newcategory, (data) => {
				this.newCategory = 'true'
				console.log(data)
				return this.checkNewCategory()
			})
		},

		checkNewCategory(){
			var newCategory = this.newcategory
			if( newCategory!=='' ){
				this.newCategory = ''
				return this.showCategories()
			} else {
				return this.showCategories()
			}
		}
	}
})