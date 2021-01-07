<template>
    <div>

        <div class="user_table card card-body mb-2" v-for="user in users" v-bind:key="user.id"> 
            <h3>{{user.email}}</h3>
            <p>{{user.name}}</p>
            <hr>
            <button @click="deleteUser(user.id)" class="btn btn-danger btn-sm">Delete</button>
        </div>

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">Previous</a></li>
                 <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{ pagination.last_page}}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">Next</a></li>
            </ul>
            </nav>
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
            edit: false
        }
    },

    created() {
        this.fetchUsers();
        console.log(this.users);
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

</style>