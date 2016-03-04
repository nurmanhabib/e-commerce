new Vue({
	el: '#products',
	data(){
		return {
			products: '',
			categories: '',
			newProducts: {
				code: '',
				name: '',
				description: '',
				price: '',
				tags: '',
				category_id: 0
			},
			edit: {
				code: '',
				name: '',
				description: '',
				price: '',
				tags: '',
				category_id: ''
			}
		}
	},
	ready: function(){
		console.log(getCookie('amtekcommerce_token'));
		this.showProducts()
	},
	methods: {
		showProducts(){
			this.$http.get(API_URL + '/products').then(function(response){

				this.products = response.data.products

			}, function(response){
				console.log(response);
			})

			this.$http.get(API_URL + '/categories').then(function(response){

				this.categories = response.data.categories
				
			})
		},

		addProducts(){
			if ( this.newProducts.name != '' ) {
				var newproducts = {
					code: this.newProducts.code,
					name: this.newProducts.name,
					description: this.newProducts.description,
					price: this.newProducts.price,
					tags: this.newProducts.tags,
					category_id: this.newProducts.category_id
				}

				console.log(newproducts)

				this.$http.post(API_URL + '/products', newproducts, (data) => {

					console.log(data);
					//Mengembalikan inputan kosong pada form input
					this.newProducts.code = ''
					this.newProducts.name = ''
					this.newProducts.description = ''
					this.newProducts.price = ''
					this.newProducts.tags = ''
					this.newProducts.category_id = 0

					return this.showProducts()
				}).error((err) => {
					console.log(err)
				})
			} else {
				alert('Nama tidak boleh kosong')
				return this.showProducts()
			}
		},

		// Untuk edit products
		editProducts(product){
			this.edit = product
			console.log(this.edit)
		},

		// Untuk update products
		updateProducts(id){
			if(this.edit.name != ''){
				var product = {
					code: this.edit.code,
					name: this.edit.name,
					description: this.edit.description,
					price: this.edit.price,
					tags: this.edit.tags,
					category_id: this.edit.category_id
				}
				this.$http.put(API_URL + '/products/' + id, product, (data) => {

					console.log(data)

					this.edit.code = ''
					this.edit.name = ''
					this.edit.description = ''
					this.edit.price = ''
					this.edit.tags = ''
					this.edit.category_id = '0'

					return this.showProducts()
				})
			} else {
				alert('Ka')
			}
		},

		cancelEdit(product){
			return this.showProducts()
		},

		deleteProducts(id){
			this.$http.delete(API_URL + '/products/' + id).then(function(response){
				this.showProducts()

				console.log(response.data.message);
			})
		}
	}
})