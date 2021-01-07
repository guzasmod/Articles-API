<template>
    <div>
        <div class="register">
        <form class="form">
            <div class="form-group">
                <input class="form-control" placeholder="Email" v-model="credentials.email">
                <div class="error-messages">{{ error_email }}</div>
            </div>
                <div class="form-group">
                <input class="form-control" placeholder="Name" v-model="credentials.name">
                <div class="error-messages">{{ error_name }}</div>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" type="password" v-model="credentials.password"> 
                <div class="error-messages">{{ error_password }}</div>
                <div class="error-messages">{{ error_message }}</div>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Confirm password" type="password" v-model="credentials.password_confirmation"> 
                <div class="error-messages">{{ error_password }}</div>
                <div class="error-messages">{{ error_message }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="register">Register</button>
            
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
                    name : '',
                    password : '',
                    password_confirmation : '',
                },
                loading : true,
                error_email : "",
                error_name : "",
                error_password : "",
                error_message : "",

            }
        },
        mounted() {
        },
        methods: {
            register() {
                axios.post('/api/auth/register', this.credentials)
                .then(res => {
                    if(res.data.success){
                        // update the store
                      //  this.$store.commit('setToken', res.data.access_token);
                      //  this.$store.commit('setAuthUser', res.data.user);
                      //  this.$store.commit('setUserRole', res.data.user.role);
                        console.log("sekminga!");
                        this.$router.push('/login');
                        console.log(res.data);
                    }
                })
                .catch(error=> {
                    console.log(error.response.data);

                    this.error_password = error.response.data.password;
                    this.error_name = error.response.data.name;
                    this.error_email = error.response.data.email;
                    this.error_message = error.response.data.error;
                })
            },

        }        
    }
</script>

<style scoped>
    .register {
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