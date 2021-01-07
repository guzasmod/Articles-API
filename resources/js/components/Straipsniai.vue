<template>
    <div class="container" :class="{ 'loading': loading }">
        <div class="row" v-if="!loading">
            <div class="col-lg-3">               
                <h1 class="my-4">Articles</h1>                
                <div class="list-group">
                    <category
                        v-for="category in categories"
                        :key="category.id"
                        :category="category"
                        :category_id="category.id"
                        :selected-category="selectedCategory"
                        @load-products="loadProducts"
                    ></category>        
                </div>

                <div v-if="this.$store.getters.isAdmin" class="container add_post">
                    <div class="row">
                        <div class="col text-center">
                            <button @click="newModalC" class="btn btn-success">Add Category<i class="bi bi-person-plus-fill"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z"/>
                                    <path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>
                        </div>
                    </div> 
                </div>

                <!-- <div v-if="this.$store.getters.isLoggedIn" class="container add_post"> -->
                <div v-if="isUserLoggedIn" class="container add_post">
                    <div class="row">
                        <div class="col text-center">
                            <button @click="newModal" class="btn btn-success mb-2">Add Post<i class="bi bi-person-plus-fill"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                </svg>
                            </button>
                        </div>
                    </div> 
                </div>

            </div>

            <div class="col-lg-9">
                <div class="row mt-4">
                <product v-for="product in products" :key="product.id" :product="product"></product>
                </div>

                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url, selectedCategory, pagination.current_page)">Previous</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{ pagination.last_page}}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url, selectedCategory, pagination.current_page)">Next</a></li>
                    </ul>
                </nav> -->


                <!-- too many requests xd? -->
                <nav v-if="isPagination()" aria-label="Page navigation example">
                <!-- <nav aria-label="Page navigation example"> -->
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="loadProductsV(pagination.prev_page_url, selectedCategory, pagination.previous_page)">Previous</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{ pagination.last_page}}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="loadProductsV(pagination.next_page_url, selectedCategory, pagination.next_page)">Next</a></li>
                    </ul>
                </nav>
            </div>


                <!-- Modal -->
            <div class="modal fade" id="addNew" ref="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Article</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Article's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateArticle() : createArticle()">
                <div class="modal-body">

                    <div class="form-group">
                        <input v-model="formA.pavadinimas" type="text" name="pavadinimas"
                            placeholder="Title"
                            class="form-control" :class="{ 'is-invalid': formA.errors.has('pavadinimas') }">
                        <has-error :form="formA" field="pavadinimas"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="formA.santrauka" type="text" name="santrauka"
                            placeholder="Summary"
                            class="form-control" :class="{ 'is-invalid': formA.errors.has('santrauka') }">
                        <has-error :form="formA" field="santrauka"></has-error>
                    </div>

                     <div class="form-group">
                        <input v-model="formA.turinys" type="text" name="turinys"
                            placeholder="Content"
                            class="form-control" :class="{ 'is-invalid': formA.errors.has('turinys') }">
                        <has-error :form="formA" field="turinys"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="fk_Straipsnio_kategorija_id" v-model="formA.fk_Straipsnio_kategorija_id" id="fk_Straipsnio_kategorija_id" class="form-control" :class="{ 'is-invalid': formA.errors.has('fk_Straipsnio_kategorija_id') }">
                            
                            <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
                                {{ category.pavadinimas }}
                            </option>
                            
                            <!-- <option value="">Select Category</option>
                            <option value="1">Sport</option>
                            <option value="3">Healthy</option>
                            <option value="8">Junk food</option> -->
                        </select>
                        <has-error :form="formA" field="fk_Straipsnio_kategorija_id"></has-error>
                    </div>

                    <!-- <div class="form-group">
                        <select name="user_id" v-model="form.user_id" id="user_id" class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                            <option value="">Select User</option>
                            <option value="admin">Sport</option>
                            <option value="user">Healthy</option>
                            <option value="manager">Junk food</option>
                        </select>
                        <has-error :form="form" field="user_id"></has-error>
                    </div> -->

                    <div class="form-group">
                        <select name="photo" v-model="formA.photo" id="photo" class="form-control" :class="{ 'is-invalid': formA.errors.has('photo') }">
                            <option value="">Select Article's theme photo</option>
                            <option value="https://content.active.com/Assets/Active.com+Content+Site+Digital+Assets/Fitness/Articles/Twice+a+Day/man+working+out-carousel.jpg">Sport</option>
                            <option value="https://www.judsonsmartliving.org/wp-content/uploads/Health-Foods-min-1024x501.jpeg">Healthy</option>
                            <option value="https://nypost.com/wp-content/uploads/sites/2/2019/09/junk-food-turns-kid-blind.jpg?quality=90&strip=all&w=618&h=410&crop=1">Junk food</option>
                        </select>
                        <has-error :form="formA" field="photo"></has-error>
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
            </div>

                            <!-- Category Modal -->
            <div class="modal fade" id="addNewC" ref="addNewC" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Category</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Article's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input v-model="formc.pavadinimas" type="text" name="pavadinimas"
                            placeholder="Name"
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
            </div>

        </div>
    </div>
</template>

<script>
export default {
        mounted() {
    },
    
    data: function() {
        return {
            categories: [],
            products: [],
            selectedCategory: null,
            currentPage: 1,
            currentPageUrl: '',
            loading: true,

            article_id: '',
            pagination: {},
            edit: false,

            form: new Form({
                id:'',
                pavadinimas : '',
                santrauka: '',
                turinys: '',
                sukurimo_data: '',
                fk_Straipsnio_kategorija_id: '',
                user_id: '',
                photo: '',
                token: '',
                }),
                formc: new Form({
                id:'',
                pavadinimas : '',
                token: '',
                }),

            formA: new Form({
                id:'',
                pavadinimas : '',
                santrauka: '',
                turinys: '',
                sukurimo_data: '',
                fk_Straipsnio_kategorija_id: '',
                user_id: '',
                photo: '',
                token: '',
                }),

            editmode: false,
        }
    },

    computed: {
    isUserLoggedIn() {
        if(this.$store.state.token !== '') {
            console.log(this.$store.state.isUserLoggedIn);
            return true;
            
        }else {
            return false;
        }
    },
},

    created() {
        this.loadCategories();
        //this.loadProducts();
        this.loadProductsV(this.currentPageUrl, this.selectedCategory, this.currentPage);

        Fire.$on('AfterCreate',() => {
            //kai i ta pati puslapi, kur pasirinkta kategorija.
            this.loadProducts(this.selectedCategory, this.currentPage);
            //this.loadProductsV(this.currentPageUrl, this.selectedCategory, this.currentPage);
            //be refresho pakeicia, bet jei pasirinkta kategorija, tai reloadina i pagrindini
            //this.fetchArticles();
        });
    },

    methods: {
        loadCategories: function() {
            axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data.data;
               //console.log(response.data.data);
            })
            .catch( function (error) {
                console.log(error);
            });
        },

        loadProducts: function(category = null, page = 1) {
            this.loading = true;
            console.log("lod xd");
            this.selectedCategory = category;
            this.currentPage = page;

            let vm = this;

            axios.get('/api/posts', {
                params: {
                    category,
                    page
                }
            })
            .then((response) => {
                    const {data, ...pagination} = response.data;
                    this.products = data;
                    this.loading = false;
                    console.log(response.data);
                    vm.makePagination(response.data.meta, response.data.links);
            })
            .catch( function (error) {
                console.log(error);
            });
        },

        loadProductsV: function(page_url, category = null, page = 1) {
            this.loading = true;
            this.selectedCategory = category;
            this.currentPage = page;
            this.currentPageUrl = page_url;

            let vm = this;

            page_url = page_url || '/api/posts';
            //page = page || 1;

            axios.get(page_url, {
                params: {
                    category,
                    //page
                }
            })
            .then((response) => {
                    const {data, ...pagination} = response.data;
                    this.products = data;
                    this.loading = false;
                    vm.makePagination(response.data.meta, response.data.links);
            })
            .catch( function (error) {
                console.log(error);
            });
        },

        fetchArticles: function(page_url, category, page) {
            let vm = this;
            // jeigu yra page_url tai paiims page_url, jei ne - tai /api/posts
            page_url = page_url || '/api/posts';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.products = res.data;
               // vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
        },

        makePagination: function(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            }           
            this.pagination = pagination;
            // console.log(this.pagination);
            // console.log("page inside pagination: "+ this.pagination.next_page_url );
        },

        updateArticle(){
            console.log("watafak");
            //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})

            //axios.post('/api/users/' + id , { token : this.$store.state.token})
            //axios.put('/api/users/' + id , { token : this.$store.state.token})
                this.$Progress.start();
                // console.log('Editing data');
                if(this.$store.state.token != '')
                {
                    this.formA.token = this.$store.state.token;
                }
                //console.log('kas vykst ble');
                console.log(this.formA.role);
                this.formA.put('api/posts/'+this.formA.id)
                //this.form.put('api/users/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');                  
                     Swal(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                         //console.log(this.form.role);
                         //this.$router.push('/userss');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log(this.formA);
                    console.log(this.formA.role);
                    //console.log(this.$store.state.token);
                   // console.log(this.form.xd);
                    //console.log(this.token);
                });
        },

        createArticle(){
            console.log("kuriam");
            this.$Progress.start()
            //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
            if(this.$store.state.token != '')
            {
                this.formA.token = this.$store.state.token;
                this.formA.user_id = this.$store.state.user_id;
                console.log("sheet")
                console.log(this.$store.state.user);
                console.log(this.$store.state.token);
            }
                this.formA.user_id = this.$store.state.user_id;
                console.log("sheet")
                console.log(this.$store.state.user_id);

            this.formA.post('api/posts')
                .then(() => {                   
                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events
                        Toast.fire({
                          icon: 'success',
                          title: 'Article created successfully'
                        })
                        this.$Progress.finish()
                        $('#addNew').modal('hide');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log("oh sheet");
                    console.log(this.formA);
                })
        },

        deleteArticle(id) {
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
                    this.formA.token = this.$store.state.token;
                }

                //this.form.put('api/users/'+this.form.id)
                //Send Request to server
                //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
                //this.form.delete('api/user/'+id)
                this.formA.delete('api/posts/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'Article deleted successfully',
                              'success'
                            )
                   // this.fetchUsers();

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

        editModal(article){
            this.editmode = true;
            this.formA.reset();
            $('#addNew').modal('show');
            this.formA.fill(article);
        },
        newModal(){
            this.editmode = false;
            this.formA.reset();
            $('#addNew').modal('show');
        },
        editModalWindow(article){
           this.formA.clear();
           this.editMode = true
           this.formA.reset();
           $('#addNew').modal('show');
           this.formA.fill(article)
        },

        editModalC(category){
            this.editmode = true;
            this.formc.reset();
            $('#addNewC').modal('show');
            this.formc.fill(category);
        },
        newModalC(){
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
            console.log("watafak");
                this.$Progress.start();
                // console.log('Editing data');
                if(this.$store.state.token != '')
                {
                    this.formc.token = this.$store.state.token;
                }

                this.form.put('api/categories/'+this.formc.id)
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
                    console.log(this.formc);
                });
        },

        createCategory(){
            this.$Progress.start()
            //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
            if(this.$store.state.token != '')
            {
                this.formc.token = this.$store.state.token;
            }
                console.log("sheet")
                console.log(this.$store.state.user_id);

            this.formc.post('api/categories')
                .then(() => {                   
                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events
                        Toast.fire({
                          icon: 'success',
                          title: 'Category created successfully'
                        })
                        this.$Progress.finish()
                        $('#addNewC').modal('hide');
                        this.loadCategories();
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log("oh sheet");
                    console.log(this.formc);
                })
        },

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
                this.formc.delete('api/categories/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'Category deleted successfully',
                              'success'
                            )
                   // this.fetchUsers();

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

        isPagination() {
            if(this.pagination.next_page_url == null && this.pagination.prev_page_url == null) {
                return false;
            } else {
                return true;
            }
            
        }

    }
}
</script>

<style scoped>
    .add_post{
        margin-top: 20px;
 }

</style>