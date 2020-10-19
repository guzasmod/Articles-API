<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                    <a class="list-group-item" v-for="straipsnis in straipsniai" v-bind:key="straipsnis.id">
                        {{ straipsnis.id }}
                        {{ straipsnis.pavadinimas }}
                        {{ straipsnis.santrauka }}
                        {{ straipsnis.turinys }}
                        {{ straipsnis.fk_Straipsnio_kategorija_id }}
                    </a>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            straipsniai: []
        }
    },

    mounted() {
        this.loadPosts();
    },

    methods: {
        loadPosts: function() {
            //load api
            axios.get('api/straipsniai')
            .then((response) => {
                this.straipsniai = response.data.data;
                //this.straipsniai = response.data.data; jeigu requestas nera data klases viduj
            })
            .catch( function (error) {
                console.log(error);
            });
        }
    }
}
</script>