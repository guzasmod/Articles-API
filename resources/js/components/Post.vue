<template>
    <div>

        <!-- <div>User {{ $route.params.id }}</div> -->


        <div class="user_table card card-body mb-2"> 
            <h2 class="text-center">{{post.pavadinimas}}</h2>
            <img class="card-img-top" :src="post.photo ? post.photo : 'http://placehold.it/700x400'">
            <br>
            <p>{{post.turinys}}</p>
            <hr>
            <small>Sukurta: {{post.sukurimo_data}}</small>
            <!-- <button class="btn btn-danger btn-sm">Delete</button> -->
        </div>

  <!-- <div class="form-group picture">
    <label for="exampleFormControlSelect1" id="pictureForm">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option value="https://content.active.com/Assets/Active.com+Content+Site+Digital+Assets/Fitness/Articles/Twice+a+Day/man+working+out-carousel.jpg">Sport</option>
      <option value="https://nypost.com/wp-content/uploads/sites/2/2019/09/junk-food-turns-kid-blind.jpg?quality=90&strip=all&w=618&h=410&crop=1">Junk Food</option>
      <option value="https://www.judsonsmartliving.org/wp-content/uploads/Health-Foods-min-1024x501.jpeg">Healthy food</option>
    </select>
  </div> -->

<!--
        <div class="user_table card card-body mb-2" v-for="user in users" v-bind:key="user.id"> 
            <h3>{{user.email}}</h3>
            <p>{{user.name}}</p>
            <hr>
            <button @click="deleteUser(user.id)" class="btn btn-danger btn-sm">Delete</button>
        </div>
-->

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-8">

            
            <!-- <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                <div class="profile-image"><img class="rounded-circle" src="https://i.imgur.com/06EM6Iy.jpg" width="70"></div>
                <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1"><i class="fa fa-sort-up fa-2x hit-voting"></i><span>127</span><i class="fa fa-sort-down fa-2x hit-voting"></i></div>
                <div class="d-flex flex-column ml-3">
                    <div class="d-flex flex-row post-title">
                        <h5>Is sketch 3.9.1 stable?</h5><span class="ml-2">(Jesshead)</span>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center post-title"><span class="bdge mr-1">video</span><span class="mr-2 comments">13 comments&nbsp;</span><span class="mr-2 dot"></span><span>6 hours ago</span></div>
                </div>
            </div> -->


            <div class="coment-bottom bg-white p-2 px-4">

                <form v-if="isUserLoggedIn" @submit.prevent="addArticle">
                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                <!-- <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/KLeobJk.jpg" width="38"> -->
                <img class="img-fluid img-responsive rounded-circle mr-2" src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" width="45">
                
                <div class="form-group">
                <input v-model="komentaras.turinys" type="text" class="form-control mr-3" placeholder="Add comment">
                </div>
                <!-- <button class="btn btn-primary" type="submit">Comment</button> -->
                <button class="btn btn-success" type="submit">Comment</button>
                </div>
                </form>
                
                <div class="collapsable-comment">
                    <div class="d-flex flex-row justify-content-between align-items-center action-collapse p-2" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-1" href="#collapse-1"><span>Comments</span><i class="fa fa-chevron-down servicedrop"></i></div>
                    <div id="collapse-1" class="collapse">

                        <div v-for="comment in komentarai" v-bind:key="comment.id" class="commented-section mt-2 bg-light shadow-sm p-3 mb-5 bg-white rounded">
                            <div class="d-flex flex-row align-items-center commented-user">
                                <h5 class="mr-2">{{comment.useris}}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{comment.sukurimo_data}}</span>
                                <!-- <h5 class="mr-2">{{comment.email}}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{comment.sukurimo_data}}</span> -->
                            </div>
                            <div class="comment-text-sm"><span>{{comment.turinys}}</span></div>
                            <div class="reply-section">
                                <div class="d-flex flex-row align-items-center voting-icons">
                                    <i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i>
                                    <i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i>
                                    <span class="ml-2">0</span><span class="dot ml-2"></span>
                                    <h6 class="ml-2 mt-1">Reply</h6>

                                    <button v-if="isAdminOrAuthor(comment)" class="btn btn-primary pull-right w-45" @click="editModal(comment)">Edit <i class="bi bi-trash"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>

                                    <button v-if="isAdminOrAuthor(comment)" class="btn btn-danger pull-right w-45" @click="deleteComment(comment.id)">Delete <i class="bi bi-trash"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>

                                </div>
                                



                            </div>
                        </div>
                  
                        


                    </div>
                </div>



    <!-- Modal -->
            <div class="modal fade" id="addNew" ref="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Comment's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form @submit.prevent="editmode ? updateArticle() : addArticle()"> -->
                <form @submit.prevent="updateComment()">
                <div class="modal-body">
      
                    <div class="form-group">
                        <label for="turinys">Content:</label>
                        <textarea v-model="form.turinys" class="form-control" id="turinys" rows="5" :class="{ 'is-invalid': form.errors.has('turinys') }"></textarea>
                        <has-error :form="form" field="turinys"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                </div>

                </form>

                </div>
            </div>
            </div>


            </div>
        </div>
    </div>
</div>


    </div>  
</template>

<script>
export default {    
    data: function() {
        return {
            users: [],
            user: {
                id: '',
                name: '',
                email: '',
            },
            user_id: '',
            pagination: {},
            edit: false,
            post: {
                id: '',
                pavadinimas: '',
                santrauka: '',
                turinys: '',
                santrauka: '',
                sukurimo_data: '',
                fk_Straipsnio_kategorija_id: '',
                user_id: '',
                photo: '',
            },
            komentaras: {
                id: '',
                turinys: '',
                useris: '',
                email: '',
                fk_Straipsnis_id: '',
            },
            postt : {},
            komentarai: {},
            editmode: false,
            form: new Form({
                id:'',
                turinys : '',
                sukurimo_data: '',
                useris: '',
                email: '',
                fk_Straipsnis_id: '',
                token: '',
            }),
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
        this.getPost(this.$route.params.id);
        // console.log(this.$route.params.id);
        // console.log("cheeeck this out:");
        // console.log(this.postt);
        // console.log(this.komentarai);
    },

    methods: {
        fetchUsers: function(page_url) {
            let vm = this;
            page_url = page_url || '/api/users';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.users = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => 
            console.log(err));
        },

        fetchComments: function(page_url) {
            let vm = this;
            page_url = page_url || '/api/users';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.users = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => 
            console.log(err));
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
        },
        deleteUser: function(id) {
            if(confirm('Are you sure?')) {

                axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
                .then( res => {
                    if(res) {
                        alert('User removed');
                        this.fetchUsers();
                    }
                })
                .catch(err => {
                    console.log(this.$store.state.token);
                    console.log(err)
                })
            }
        },

        getPost: function(id) {
            axios.get('/api/posts/' + id , { token : this.$store.state.token})
                .then( res => {
                    if(res) {
                        this.post = res.data.data;
                        this.postt = res.data.data;
                        this.komentarai = res.data.data.komentarai;
                    }
                })
                .catch(err => {
                    //console.log(this.$store.state.token);
                    console.log(err)
                })
        },

        addArticle: function() {
            this.$Progress.start()
            this.komentaras.fk_Straipsnis_id = this.post.id;
            this.komentaras.useris = this.$store.state.user_name;
            this.komentaras.email = this.$store.state.user_email;

            console.log(this.komentaras.turinys);
            console.log(this.komentaras.turinys);
            console.log(this.$store.state.user_name);
            console.log(this.$store.state.user_email);
            console.log(this.$store.state.token);
                      

            if(this.edit == false) {

                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token;

                axios.post('/api/comments',
                this.komentaras,
                { 
                 body: this.komentaras
                })
                .then( res => {
                    if(res) {
                        this.komentaras.turinys = '';
                        this.komentaras.useris = '';
                        this.komentaras.email = '';
                        this.komentaras.fk_Straipsnis_id = '';
                        Fire.$emit('AfterCreatedUserLoadIt'); //custom events
                        Toast.fire({
                          icon: 'success',
                          title: 'Comment created successfully'
                        })
                        this.$Progress.finish()
                        //alert('Comment added');
                        this.getPost(this.$route.params.id);
                    }
                })
                .catch(err => {
                    console.log(this.$store.state.token);
                    console.log(err);
                    console.log(this.komentaras);
                    console.log(this.$store.state.user.id);
                })
            } else {

            }
        },

        deleteComment: function(id) {
            // if(confirm('Are you sure?')) {

            //     //axios.delete('/api/comments/' + id , { token : this.$store.state.token})
            //     axios.delete('/api/comments/' + id , { headers: {"Authorization" : `Bearer ${this.$store.state.token}`}})
            //     .then( res => {
            //         if(res) {
            //             alert('Comment removed');
            //             this.getPost(this.$route.params.id);
            //         }
            //     })
            //     .catch(err => {
            //         console.log(this.$store.state.token);
            //         console.log(err)
            //     })
            // }




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

                //this.form.post('api/users/delete/'+id)
                axios.delete('/api/comments/' + id , { headers: {"Authorization" : `Bearer ${this.$store.state.token}`}})
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'Comment deleted successfully',
                              'success'
                            )
                        this.getPost(this.$route.params.id);

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

        updateComment() {
                this.$Progress.start();
                if(this.$store.state.token != '')
                {
                    this.form.token = this.$store.state.token;
                }
                console.log("xdd" + this.form);
                console.log(this.form);
                this.form.put('/api/posts/'+this.post.id+'/comments/'+this.form.id)
                //this.form.put('api/comments/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');                  
                     Swal.fire(
                        'Updated!',
                        'Information has been updated sike.',
                        'success'
                        )
                        
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                         console.log("xDDDzz");
                         console.log(this.form);
                         this.getPost(this.$route.params.id);
                         //this.$router.push('/userss');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    //console.log(this.$store.state.token);
                   // console.log(this.form.xd);
                    //console.log(this.token);
                });
            },

        editArticle(comment) {
            this.edit = true;
            this.komentaras.turinys = comment.turinys;
        },

        editModal(comment){
            this.editmode = true;
            console.log("pries reseta:");
            console.log(this.form);
            this.form.reset();
            console.log("pooo reseta:");
            console.log(this.form);
            $('#addNew').modal('show');
            this.form.fill(comment);
        },
        editModalWindow(comment){
           this.form.clear();
           this.editMode = true;
           this.form.reset();
           $('#addNew').modal('show');
           this.form.fill(comment);
        },

        isAdminOrAuthor(komentaras) {       
            if(this.$store.getters.isAdmin || komentaras.email == this.$store.state.user_email){
                return true;
            } else {
                return false;
            }
        }

    }
}
</script>

<style scoped>
    .user_table {

        margin:20px auto;
        width:50%;
    }

        button {
        display: block;
        margin: 0 auto;
    }
    .picture {
        margin:20px auto;
        width:50%; 
    }

body {
    background: #eee
}

.bdge {
    height: 21px;
    background-color: orange;
    color: #fff;
    font-size: 11px;
    padding: 8px;
    border-radius: 4px;
    line-height: 3px
}

.comments {
    text-decoration: underline;
    text-underline-position: under;
    cursor: pointer
}

.dot {
    height: 7px;
    width: 7px;
    margin-top: 3px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block
}

.hit-voting:hover {
    color: blue
}

.hit-voting {
    cursor: pointer
}

.servicedrop {
    transition-delay: 1s
}

.action-collapse {
    cursor: pointer
}

</style>