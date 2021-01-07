<template>
<div>
    <div class="d-flex justify-content-center" v-if="loading">
        <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
        </div>
    </div>


<div class="container mt-5 d-flex justify-content-center" v-else>
    <div class="card p-3">
        <div class="d-flex align-items-center">
            <div class="image"> <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" class="rounded" width="155"> </div>
            <div class="ml-3 w-100">
                <h4 class="mb-0 mt-0">{{ name }}</h4> <span>{{ this.$store.state.user_role}}</span>
                <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                    <div class="d-flex flex-column"> <span class="articles">Articles</span> <span class="number1">{{ post_count }}</span> </div>
                    <div class="d-flex flex-column"> <span class="rating">Comments</span> <span class="number2">{{ comment_count }}</span> </div>
                    <div class="d-flex flex-column"> <span class="followers">Followers</span> <span class="number3">980</span> </div>
                </div>
                <div class="button mt-2 d-flex flex-row align-items-center template-demo"> <button type="button" class="btn-sm w-100 btn btn-social-icon btn-outline-facebook"><i class="fa fa-facebook"></i></button> <button type="button" class="btn-sm w-100 btn btn-social-icon btn-outline-youtube"><i class="fa fa-youtube"></i></button> <button type="button" class="btn-sm w-100 btn btn-social-icon btn-outline-twitter"><i class="fa fa-twitter"></i></button> </div>
            </div>
        </div>
    </div>
</div>

</div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                loading : true,
                post_count : 0,
                comment_count : 0,
                name : "",
            }
        },
        mounted() {
            this.loadProfile();

            if(this.$store.state.token !== '') {
                axios.post('/api/auth/checkToken' , { token : this.$store.state.token})
                .then( res => {
                        this.loading = false;
                })
                .catch(err => {
                    this.$store.commit('clearToken');
                    this.$router.push('/login');
                    this.loading = false;             
                })
            }else {
                this.loading = false;
                this.$router.push('/login');
            }
        },

        methods: {
            loadProfile: function() {
                axios.post('api/auth/user-profile' , { token : this.$store.state.token})
                .then((response) => {
                    //this.straipsniai = response.data.data;
                    //this.straipsniai = response.data.data; jeigu requestas nera data klases viduj
                    console.log(response.data);
                    this.post_count = response.data.post_count;
                    this.comment_count = response.data.comment_count;
                    this.name = response.data.user.name;
                })
                .catch( function (error) {
                    console.log(error);
                });
            }
        }
}
</script>

<style scoped>

body {
    background-color: #B3E5FC;
    border-radius: 10px
}

.card {
    width: 400px;
    border: none;
    border-radius: 10px;
    background-color: #fff
}

.stats {
    background: #f2f5f8 !important;
    color: #000 !important
}

.articles {
    font-size: 10px;
    color: #a1aab9
}

.number1 {
    font-weight: 500
}

.followers {
    font-size: 10px;
    color: #a1aab9
}

.number2 {
    font-weight: 500
}

.rating {
    font-size: 10px;
    color: #a1aab9
}

.number3 {
    font-weight: 500
}

.template-demo>.btn {
     margin-right: 0.5rem !important
 }

 .template-demo {
     margin-top: 0.5rem !important
 }

 .btn.btn-rounded {
     border-radius: 50px
 }

 .btn-outline-facebook {
     border: 1px solid #3b579d;
     color: #3b579d
 }

 .btn-outline-facebook:hover {
     background: #3b579d;
     color: #ffffff
 }

 .btn-outline-youtube {
     border: 1px solid #e52d27;
     color: #e52d27
 }

 .btn-outline-twitter {
     border: 1px solid #2caae1;
     color: #2caae1
 }

 .btn-outline-dribbble {
     border: 1px solid #ea4c89;
     color: #ea4c89
 }

 .btn-outline-linkedin {
     border: 1px solid #0177b5;
     color: #0177b5
 }

 .btn-outline-instagram {
     border: 1px solid #dc4a38;
     color: #dc4a38
 }

 .btn-outline-twitter:hover {
     background: #2caae1;
     color: #ffffff
 }

 .btn-outline-linkedin:hover {
     background: #0177b5;
     color: #ffffff
 }

 .btn-outline-youtube:hover {
     background: #e52d27;
     color: #ffffff
 }

 .btn-outline-instagram:hover {
     background: #e52d27;
     color: #ffffff
 }

 .btn-facebook {
     background: #3b579d;
     color: #ffffff
 }

 .btn-youtube {
     background: #e52d27;
     color: #ffffff
 }

 .btn-twitter {
     background: #2caae1;
     color: #ffffff
 }

 .btn-dribbble {
     background: #ea4c89;
     color: #ffffff
 }

 .btn-linkedin {
     background: #0177b5;
     color: #ffffff
 }

 .btn-instagram {
     background: #dc4a38;
     color: #ffffff
 }

 .btn-facebook:hover,
 .btn-facebook:focus {
     background: #2d4278;
     color: #ffffff
 }

 .btn-youtube:hover,
 .btn-youtube:focus {
     background: #c21d17;
     color: #ffffff
 }

 .btn-twitter:hover,
 .btn-twitter:focus {
     background: #1b8dbf;
     color: #ffffff
 }

 .btn-dribbble:hover,
 .btn-dribbble:focus {
     background: #e51e6b;
     color: #ffffff
 }

 .btn-linkedin:hover,
 .btn-linkedin:focus {
     background: #015682;
     color: #ffffff
 }

 .btn-instagram:hover,
 .btn-instagram:focus {
     background: #bf3322;
     color: #ffffff
 }

</style>