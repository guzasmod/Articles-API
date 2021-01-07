<template>
    <div>
    <a
        class="list-group-item"
        :class="{ 'active': selectedCategory == category.id }"
        @click="$emit('load-products', category.id)">
        {{ category.pavadinimas }}
    </a>

    <div v-if="this.$store.getters.isAdmin" class="list-group-item">

        <!-- <button class="btn btn-primary" @click="editModalCa(category)">Create</button> -->

                                                        <a class="" href="#" @click.prevent="editModalCa(category)" >
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                            
                        </a>
                        <a class="pull-right" href="#" @click.prevent="deleteCategory(category.id)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="red" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
                        </a>

                                                            <!-- Category Modal -->
            <!-- <div class="modal fade" id="addNewC" ref="addNewC" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add category Newsss</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Categoryss's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                <div class="modal-body">

                    <div class="form-group">
                        <input v-model="formc.pavadinimas" type="text" name="pavadinimas"
                            placeholder="Title"
                            class="form-control" :class="{ 'is-invalid': formc.errors.has('pavadinimas') }">
                        <has-error :form="formc" field="pavadinimas"></has-error>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>

                </form>

                </div>
            </div>
            </div> -->



        </div>

        

                <!-- <form @submit.prevent="updateKategorija(category)">
                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                <img class="img-fluid img-responsive rounded-circle mr-2" src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" width="45">
                
                <div class="form-group">
                <input v-model="category.pavadinimas" type="text" class="form-control mr-3" placeholder="Add comment">
                </div>
                <button class="btn btn-primary" type="submit">Change</button>
                </div>
                </form> -->



                                                            <!-- Category Modal -->
            <div class="modal fade" :data-show="modal" :id="'addNewCa_'+category.id" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updateKategorija(kategorija)">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input v-model="kategorija.pavadinimas" type="text" name="pavadinimas" placeholder="Title" class="form-control">
                             <!-- :class="{ 'is-invalid': formc.errors.has('pavadinimas') }"> -->
                        <!-- <has-error :form="formc" field="pavadinimas"></has-error> -->
                    </div>
                                    <!-- <div class="form-group">
                <input v-model="category.pavadinimas" type="text" class="form-control mr-3" placeholder="Add comment">
                </div>

                    <div class="form-group">
                <input v-model="this.categoryy.pavadinimas" type="text" class="form-control mr-3" placeholder="Add comment">
                </div>
                                    <div class="form-group">
                <input type="text" class="form-control mr-3" placeholder="">
                </div>
                <p>{{category.pavadinimas}}</p>
                <p>{{kategorija.pavadinimas}}</p> -->
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>

                </form>

                </div>
            </div>
            </div>

   

    </div>   
</template>

<script>
export default {
    props: [
        'category',
        'selectedCategory',
        'category_id'
    ],
    

    data: function() {
        return {
            // category: null,
            // selectedCategory: null,
            categoryy:this.category,
            selectinta:this.selectedCategory,
            categories: [],
            products: [],
            currentPage: 1,
            loading: true,

            article_id: '',
            edit: false,

            formc: new Form({
                id:'',
                pavadinimas : '',
                token: '',
                }),
            editmode: false,
            kategorija: {
                id: '',
                pavadinimas: '',
                token: '',
            },
            modal: false,
        }
    },

    created() {
         Fire.$on('AfterCreate',() => {
                this.$parent.loadCategories();
               // this.$parent.loadProducts();
            });
    },

    methods: {
    deleteCategory(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {               
              if (result.value) {
                if(this.$store.state.token != '')
                {
                    this.formc.token = this.$store.state.token;
                }

                //this.form.put('api/users/'+this.form.id)
                //Send Request to server
                //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
                //this.form.delete('api/user/'+id)
                this.formc.delete('api/categories/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'Category deleted successfully',
                              'success'
                            )
                   // this.fetchUsers();
                   Fire.$emit('AfterCreate');

                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                        })
                    })
                }
            })
        },

        editModalC(category){
            console.log('update!');
            this.editmode = true;
            this.formc.reset();
            console.log(this.editmode);
            console.log(this.editmode);
            $('#addNewC').modal('show');
            this.formc.fill(category);
            console.log(category);
            console.log(this.formc);
        },
        editModalCa(category){
            console.log('update with ca!');
            console.log(category.pavadinimas);
            console.log(this.kategorija.pavadinimas);
            //this.editmode = true;
            //this.formc.reset();
            //this.kategorija.pavadinimas = this.categoryy.pavadinimas;
            this.kategorija.pavadinimas = this.category.pavadinimas;
            console.log("cia: " + this.kategorija.pavadinimas);
            console.log(this.category_id);
            this.kategorija.id = category.id;

            $('#addNewCa_'+category.id).modal('show');
            //this.toggleModal();
            //$('#addNewCa_'+).modal('show');
            //$("'addNewCa_'+category.id").modal('show'); 
           // data-show="modal" :id="'addNewCa_'+category.id"

            //this.formc.fill(category);
            console.log(category);
            console.log(category.pavadinimas);
            console.log(this.kategorija.pavadinimas);
            console.log(this.categoryy);
            console.log(this.categoryy.pavadinimas);
            //console.log(this.formc);
        },

        toggleModal () {
            this.modal = !this.modal
        },

        newModalC(){
            console.log('suveike create');
            this.editmode = false;
            this.formc.reset();
            $('#addNewC').modal('show');
        },
        editModalWindowC(category){
           this.formc.clear();
           this.editMode = true
           this.formc.reset();
           $('#addNewC').modal('show');
           this.formc.fill(category)
        },

        updateCategory(){
                this.$Progress.start();
                if(this.$store.state.token != '')
                {
                    this.formc.token = this.$store.state.token;
                }
                this.formc.put('api/categories/'+this.formc.id)
                .then(() => {
                    // success
                    $('#addNewC').modal('hide');               
                     Swal(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )                       
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                });
        },

        updateKategorija(category){
            this.$Progress.start();
            this.kategorija.id = category.id;
            this.kategorija.pavadinimas = category.pavadinimas;
            this.kategorija.token = this.$store.state.token;

            console.log(this.kategorija);
            console.log(this.kategorija.pavadinimas);
            console.log(this.$store.state.token);
                      
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token;

                axios.put('/api/categories/'+category.id,
                this.kategorija,
                { 
                 body: this.kategorija
                })
                .then( res => {
                    if(res) {
                        $('#addNewCa_'+category.id).modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        )                       
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                         this.kategorija.pavadinimas = '';

                        // this.kategorija.pavadinimas = '';
                        // $('#addNewCa_'+category.id).modal('hide');
                        // alert('Comment added');
                    }
                })
                .catch(err => {
                    console.log(this.$store.state.token);
                    console.log(err);
                    console.log(this.kategorija);
                    //console.log(this.$store.state.user.id);
                })
        },
    }

}
</script>

<style scoped>
a {
    cursor: pointer;
    color: black;
}
a.active, a.active:hover {
    /* This is
    color: #fff;
    color: red;
    comment */
    color: #fff;
    /* background-color: lightgrey; */
     background-color:	#505050;
    border: black;

}
a.active:hover {
    text-decoration: underline;
}



</style>