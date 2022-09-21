<template>
    <div class="container-my-5">
        <div class="row justify-content-end mb-3 mt-3">
            <div class="col-4">
                <button class="btn btn-primary"><i class="fas fa-plus-circle mr-1" @click= "create"></i>Create</button>
            </div>
                <div class="col-4">
                <form @submit.prevent= "searchProduct">
                    <div class="input-group">
                        <input type="text" v-model= "search" class="form-control" placeholder="Search"/>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                               <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <h4 class="card-header text-info">{{ isEditMode ? 'Edit' : 'Create'}}</h4>
                    <div class="card-body">
                        <AlertError :form= "product" message= "There were some problems with your input!" />
                        <form  @submit.prevent = "isEditMode ? update() : store()">
                            <div class="form-group">
                                <label>Name:</label>
                                <input v-model= "product.name" type="text" class="form-control" :class= "{ 'is-invalid': product.errors.has('name')}">
                                <div v-if= "product.errors.has('name')" v-html= "product.errors.get('name')" class="text-danger"/>
                            </div>
                            <div class="form-group">
                                <label>Price:</label>
                                <input v-model= "product.price" type="number" class="form-control" :class= "{ 'is-invalid': product.errors.has('price')}">
                                <div v-if= "product.errors.has('price')" v-html= "product.errors.get('price')" class="text-danger"/>
                            </div>
                            <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i>Save</button>
                        </form>
                    </div>
                </div>
            </div>
                <div class="col-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for= "product in products.data" :key= "product.id">
                            <th>{{ product.id }}</th>
                            <th>{{ product.name }}</th>
                            <th>{{ product.price }}</th>
                            <button type="button" class="btn btn-success btn-sm" @click= "edit(product)"><i class="fas fa-edit mr-1"></i>Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" @click= "destroy(product.id)"><i class="fas fa-trash mr-1"></i>Delete</button>
                        </tr>
                        </tbody>
                    </table>
                    <pagination :data= "products" @pagination-change-page= "view"></pagination>
                </div>
        </div>
    </div>
</template>
<script>

import { Form } from 'vform'

export default {
    name: 'ProductComponent',
    data() {
        return {
            isEditMode: false,
            search: '',
            products: {},
            product: new Form({
                id: '',
                name: '',
                price: ''
            })
        }
    },
    methods: {
        searchProduct(){
            axios.get('/api/product?search=' +this.search)
            .then(response => this.products = response.data)
        },
        view(page = 1){
            // this.$Progress.start()
            axios.get('/api/product?page=' + page)
            .then(response => {
            this.products = response.data;
            // this.$Progress.finish()
        })
        // .catch(error => {
        //     this.$Progress.fail()
        // })
        },
        create() {
            this.product.clear();
            this.isEditMode = false;
            // this.product.id = "";
            // this.product.name = "";
            // this.product.price = "";
            this.product.reset();
            //this.product.price = product.price;
                Toast.fire({
                icon: 'success',
                title: 'Created successfully'
                         })
        },
        store() {
            this.product.post('/api/product')
            .then(response => {
                this.view();
                this.product.id = product.id;
                this.product.name = product.name;
            });
    },
        edit(product) {
            this.product.clear();
            this.isEditMode = true;
            // this.product.id = product.id;
            // this.product.name = product.name;
            // this.product.price = product.price;
            this.product.fill(product);
    },
        update() {
            this.product.put(`/api/product/${this.product.id}`,this.product)
            .then(response => {
            this.view();
            // this.product.id = "";
            // this.product.name = "";
            // this.product.price = "";
            this.product.reset();
                Toast.fire({
                icon: 'success',
                title: 'Updated successfully'
                         })
        })
    },
        destroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
            axios.delete(`/api/product/${id}`)
           .then(response => {
            this.view();
                Swal.fire({ title: 'Deleted!',icon: 'success' }); 
                Toast.fire({
                icon: 'success',
                title: 'Deleted successfully'
                         })
           });
            }  
});
        // if(!confirm('Are you sure you want to delete?')){
        //     return;
        // }
    }
},
        created() {
       this.view();
    },
};
</script>