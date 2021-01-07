<template>
    <nav class="navbar">
        <div class="brand-title">ArticlesAPI</div>
        <a v-on:click="openMobileNav()" href="#" class="toggle-button" >
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <router-link to='/'><li><a href="#">Home</a></li></router-link>
                <router-link to='/articles'><li><a href="#">Articles</a></li></router-link>
                <!-- <router-link to='/users' v-if="isManagerLoggedIn"><li><a href="#">Users</a></li></router-link> -->
                <router-link to='/users' v-if="isManagerLoggedIn"><li><a href="#">Users</a></li></router-link>
                <router-link to='/login' v-if="!isUserLoggedIn"><li><a href="#">Login</a></li></router-link>
                <router-link to='/register' v-if="!isUserLoggedIn"><li><a href="#">Register</a></li></router-link>
                 <router-link to='/profile' v-if="isUserLoggedIn"><li><a href="#">Profile</a></li></router-link>
                 <!--
                <router-link to='./logout' @click="logout"><li><a href="#">Logout</a></li></router-link>
                -->
                <li><a href="" @click="logout" v-if="isUserLoggedIn">Logout</a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'navbar',
    user_logged: false,

computed: {
    isUserLoggedIn() {
        if(this.$store.state.token !== '') {
            console.log(this.$store.state.isUserLoggedIn);
            //console.log(user_logged);
           // return this.$store.state.isUserLoggedIn;
           // user_logged = true;
            return true;
            
        }else {
            // console.log("this  shit?");
            //return !this.$store.state.isUserLoggedIn;
            //user_logged = false;
            return false;
        }
    },
    isManagerLoggedIn() {
        if(this.$store.state.token !== '' && this.$store.state.user_role == "manager") {
            console.log(this.$store.state.user_role);
            return true;
            
        }else {
            return false;
        }
    }
},

    mounted() {
                    if(this.$store.state.token !== '') {
                this.user_logged = true;
            }else {
                this.user_logged = false;
            }
    },
    created () { 
            if(this.$store.state.token !== '') {
                this.user_logged = true;
            }else {
                this.user_logged = false;
            }
    },

    methods: {
        openMobileNav() {
            const toggleButton = document.getElementsByClassName('toggle-button')[0]
            const navbarLinks = document.getElementsByClassName('navbar-links')[0]

            navbarLinks.classList.toggle('active') 

            },
        logout() {
            axios.post("/api/auth/logout", { token: this.$store.state.token})
                .then( res=> {
                    this.$store.commit('clearToken');
                    this.$router.push('/articles');
                })
        }
    }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: white;
}

.brand-title {
    font-size: 1.5rem;
    margin: .5rem;
}

.navbar-links ul {
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar-links li {
    list-style: none;
}

.navbar-links li a {
    text-decoration: none;
    color: white;
    padding: 1rem;
    display: block;
}

.navbar-links li:hover {
    background-color: #555;
}

.toggle-button {
    position: absolute;
    top: 1.5rem;
    right: 1rem;
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 21px;
}

.toggle-button .bar {
    height: 3px;
    width: 100%;
    background-color: white;
    border-radius: 10px;
}

@media (max-width: 900px) {
    .toggle-button {
        display: flex;
    }

    .navbar-links {
        display: none; 
        width: 100%;
    }

    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar-links ul {
        width: 100%;
        flex-direction: column;
    }

    .navbar-links li {
        text-align: center;
    }

    .navbar-links li a {
        padding: .5rem 1rem;
    }

    .navbar-links.active {
        display: flex;
    }
}

</style>
