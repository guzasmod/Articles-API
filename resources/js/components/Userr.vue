<template>
    <div class="container">
        <div class="row mt-5" v-if="this.$store.getters.isManager">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success pull-right" @click="newModal">Add New <i class="bi bi-person-plus-fill"></i>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered At</th>
                        <th>Modify</th>
                  </tr>

                  <tr v-for="user in users" :key="user.id">

                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.role | upText}}</td>
                    <td>{{user.created_at | myDate}}</td>

                    <td>
                        <a href="#" @click="editModal(user)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                            
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="red" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
                        </a>

                    </td>
                  </tr>
                </tbody></table>

                
              </div>
              
              <!-- /.card-body -->

            </div>
            
            <!-- /.card -->
          </div>
        </div>
        

        <!-- <div v-if="!$store.getters.isManager">
            <not-found></not-found>
        </div> -->

                    <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">Previous</a></li>
                 <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{ pagination.last_page}}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">Next</a></li>
            </ul>
            </nav>

    <!-- Modal -->
            <div class="modal fade" id="addNew" ref="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">

                     <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                     <div class="form-group">
                        <input v-model="form.email" type="email" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="role" v-model="form.role" id="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="manager">Manager</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password"
                        placeholder="Password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
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



</template>

<script>
export default {    
    data: function() {
        return {
            //token: this.$store.state.token,
            users: [],
            pagination: {},
            edit: false,
            form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    role: '',
                    token: '',
                }),
                editmode: false,
                
        }
    },

    created() {
        this.fetchUsers();

                   Fire.$on('AfterCreate',() => {
                this.fetchUsers();
           });
         
           //console.log(this.$store.getters.isManager);
           //console.log(this.$users);

    },

    methods: {
        fetchUsers: function(page_url) {
            let vm = this;
            page_url = page_url || '/api/users';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.users = res.data;
                //console.log(this.users);
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


            updateUser(){
                this.$Progress.start();
                if(this.$store.state.token != '')
                {
                    this.form.token = this.$store.state.token;
                }
                this.form.put('api/users/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');                  
                     Swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                         console.log("xDDD");
                         //this.$router.push('/userss');
                })
                .catch((err) => {
                    this.$Progress.fail();
                    console.log(this.$Progress);
                    console.log(err);
                    console.log(this.form);
                    console.log(this.form.role);
                    //console.log(this.$store.state.token);
                   // console.log(this.form.xd);
                    //console.log(this.token);
                });
            },


        editModal(user){
            this.editmode = true;
            console.log("pries reseta:");
            console.log(this.form);
            this.form.reset();
            console.log("pooo reseta:");
            console.log(this.form);
            $('#addNew').modal('show');
            this.form.fill(user);
        },
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        editModalWindow(user){
           this.form.clear();
           this.editMode = true
           this.form.reset();
           $('#addNew').modal('show');
           this.form.fill(user)
        },
  
        loadUsers() {
        fetchUsers();
        //axios.get("api/user").then( data => (this.users = data.data));

          //pick data from controller and push it into users object

        },

        createUser(){

            this.$Progress.start()
            //axios.post('/api/users/delete/' + id , { token : this.$store.state.token})
            if(this.$store.state.token != '')
            {
                this.form.token = this.$store.state.token;
            }

            this.form.post('api/users')
                .then(() => {
                   
                    Fire.$emit('AfterCreatedUserLoadIt'); //custom events

                        Toast.fire({
                          icon: 'success',
                          title: 'User created successfully'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                })
                .catch(() => {
                   console.log("Error......")
                })

     

            //this.loadUsers();
          },
          deleteUser(id) {
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
                    this.form.token = this.$store.state.token;
                }

                this.form.post('api/users/delete/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'User deleted successfully',
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

    .pagination {
        margin: 10px;
    }

</style>