<template>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#">
        <img class="card-img-top" :src="product.photo ? product.photo : 'http://placehold.it/700x400'">
      </a>
      <div class="card-body">
        <h5 class="card-title">
        <router-link :to="{ name: 'articles', params: {id: product.id } }"><a href="#">{{ product.pavadinimas }}</a></router-link>
        </h5>
 
        <p class="card-text">{{ limitDescription(product.turinys, 100) }}</p>
       




                   <button v-if="isAdminOrAuthor(product)" class="btn btn-primary pull-left w-50" @click.prevent="editModalz(product)">Edit <i class="bi bi-trash"></i>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>
    </button>

                    <button v-if="isAdminOrAuthor(product)" class="btn btn-danger pull-right w-45" @click="deleteArticle(product.id)">Delete <i class="bi bi-trash"></i>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
    </button>




      </div>
    </div>

        <!-- Modal -->
            <div class="modal fade" :data-show="modal" :id="'addNews_'+product.id" :ref="'addNews_'+product.id" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmodee" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmodee" id="addNewLabel">Update Article's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmodee ? updateArticle(formA) : createArticle()">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="pavadinimas">Title:</label>
                        <input v-model="formA.pavadinimas" type="text" name="pavadinimas"
                            placeholder="Title"
                            class="form-control" :class="{ 'is-invalid': formA.errors.has('pavadinimas') }">
                        <has-error :form="formA" field="pavadinimas"></has-error>
                    </div>

                    <div class="form-group">
                        <label for="santrauka">Summary:</label>
                        <input v-model="formA.santrauka" type="text" name="santrauka"
                            placeholder="Summary"
                            class="form-control" :class="{ 'is-invalid': formA.errors.has('santrauka') }">
                        <has-error :form="formA" field="santrauka"></has-error>
                    </div>

                     <div class="form-group">
                        <label for="turinys">Content:</label>
                        <textarea v-model="formA.turinys" class="form-control" id="turinys" rows="5" :class="{ 'is-invalid': formA.errors.has('turinys') }"></textarea>
                        <has-error :form="formA" field="turinys"></has-error>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="fk_Straipsnio_kategorija_id" v-model="formA.fk_Straipsnio_kategorija_id" id="fk_Straipsnio_kategorija_id" class="form-control" :class="{ 'is-invalid': formA.errors.has('fk_Straipsnio_kategorija_id') }">
                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">
                            {{ category.pavadinimas }}
                            </option>
                        </select>
                        <has-error :form="formA" field="fk_Straipsnio_kategorija_id"></has-error>
                    </div>

                    <div class="form-group">
                        <label for="pavadinimas">Article's theme:</label>
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
                    <button v-show="editmodee" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmodee" type="submit" class="btn btn-primary">Create</button>
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
        'product'
    ],

    data: function() {
        return {
            categories: [],
            //products: [],
            selectedCategory: null,
            currentPage: 1,
            loading: true,

            article_id: '',
            pagination: {},
            edit: false,
            editmodee: false,

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

            article: {
                id:'',
                pavadinimas : '',
                santrauka: '',
                turinys: '',
                sukurimo_data: '',
                fk_Straipsnio_kategorija_id: '',
                user_id: '',
                photo: '',
                token: '',
            },
            modal: false,
        }
    },

    created() {
        Fire.$on('AfterCreate',() => {
            
        });
    },

    methods: {
        limitDescription: function (string, length) {
            return string.length > length ? string.substring(0, length) + "..." : string;
        },

        updateArticle(product){
            console.log("SUVEIKE UPDATE");
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
                console.log(this.formA);
                this.formA.put('api/posts/'+this.formA.id)
                //this.form.put('api/users/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNews_'+product.id).modal('hide');
                    //$('#addNews').modal('hide');                  
                     Swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                         this.formA.pavadinimas = '';
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log(this.formA);
                });
        },

        createArticle(){
            this.$Progress.start()

            if(this.$store.state.token != '')
            {
                this.formA.token = this.$store.state.token;
                //this.form.user_id = this.$store.state.user.id;
                this.formA.user_id = this.$store.state.user_id;
            }

            this.formA.user_id = this.$store.state.user_id;      
            this.formA.post('api/posts')
                .then(() => {                   
                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events
                        Toast.fire({
                          icon: 'success',
                          title: 'Article created successfully'
                        })
                        this.$Progress.finish()
                        $('#addNews').modal('hide');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log(this.formA);
                    console.log("oh sheeeet");
                    console.log(this.store.state.user);
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

        editModalz(product){
            console.log(product.id);
            this.loadCategories();
            this.editmodee = true;
            this.formA.reset();
            $('#addNews_'+product.id).modal('show');
            //$('#addNews').modal('show');
            this.formA.fill(product);
            this.formA.pavadinimas = product.pavadinimas;
            console.log("this log");
            console.log(product);
            //console.log(this.editmodee);
            //console.log(this.form);
        },

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

        newModal(){
            this.loadCategories();
            console.log("suveike naujas");
            this.editmodee = false;
            this.formA.reset();
            $('#addNews').modal('show');
        },
        editModalWindow(article){
           this.formA.clear();
           this.editModee = true
           this.formA.reset();
           $('#addNews').modal('show');
           this.formA.fill(article)
           console.log("xd");
           console.log(article);
        },

        isAdminOrAuthor(straipsnis) {     
            if(this.$store.getters.isAdmin || straipsnis.user_id == this.$store.state.user_id){
                return true;
            } else {
                return false;
            }
        },

        toggleModal () {
            this.modal = !this.modal
        },
    }
}
</script>

<style scoped>

</style>