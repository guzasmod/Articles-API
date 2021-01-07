<template>
    <div>
        <div v-if="loading">
            <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="login" v-else>
        <form class="form">
            <div class="form-group">
                <input class="form-control" placeholder="Email" v-model="credentials.email">
                <div class="error-messages">{{ error_email }}</div>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" type="password" v-model="credentials.password"> 
                <div class="error-messages">{{ error_password }}</div>
                <div class="error-messages">{{ error_message }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="login">Login</button>
            
        </form>
    </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                credentials : {
                    email : '',
                    password : '',
                },
                loading : true,
                error_email : "",
                error_password : "",
                error_message : "",

            }
        },
        mounted() {
            if(this.$store.state.token !== '') {
                axios.post('/api/auth/checkToken' , { token : this.$store.state.token})
                .then( res => {
                    if(res) {
                        this.loading = false;
                        this.$router.push('/articles');
                    }
                })
                .catch(err => {
                    this.loading = false;
                    //this.$store.commit('clearToken');
                })
            }else {
                this.loading = false;
            }
        },
        methods: {
            login() {
                axios.post('/api/auth/login', this.credentials)
                .then(res => {
                    if(res.data.success){
                        // update the store
                        this.$store.commit('setToken', res.data.access_token);
                        this.$store.commit('setAuthUser', res.data.user);
                        this.$store.commit('setUserRole', res.data.user.role);
                        this.$store.commit('setUserId', res.data.user.id);
                        this.$router.push('/articles');
                        // console.log('cia dirbam');
                        // console.log(res.data.user.id);
                        // console.log(res.data.user.role);
                        // console.log(this.$store.state.user.id);
                    }
                })
                .catch(error=> {
                    console.log(error.response.data);

                    this.error_password = error.response.data.password;
                    this.error_email = error.response.data.email;
                    this.error_message = error.response.data.error;
                    console.log(this.error_password);
                    console.log(this.error_email);
                    console.log(this.error_message);
                })
            }
        }        
    }
</script>

<style scoped>
    .login {
        background-color:#FFF;
        border:1px solid #EEE;
        padding:10px;
        margin:50px auto;
        width:500px;
    }

    button {
        display: block;
        margin: 0 auto;
    }

    .error-messages {
        color: red;
        font-size: 12px; 
    }

</style>