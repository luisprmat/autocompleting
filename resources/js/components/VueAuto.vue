<template>
    <div>
        <div class="form-group">
            <vue-typeahead-bootstrap
                v-model="query"
                :data="countries"
                placeholder="Buscar un pais"
                @hit="getCountry(query)"
            ></vue-typeahead-bootstrap>
        </div>
        <div class="form-group">
            <a :href="url" class="btn btn-primary" role="button">Ver pais seleccionado</a>
        </div>
    </div>
</template>

<script>
    import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap'

    export default {
        components: { VueTypeaheadBootstrap },
        data() {
            return {
                query: '',
                countries: [],
                countrySelected: {},
                url: ''
            }
        },
        mounted() {
            axios.get(`/api/countries`)
                .then(res => {
                    console.log(res.data)
                    this.countries = res.data
                })
                .catch(err => {
                    console.log(err.response)
                })
        },
        methods: {
            getCountry(name) {
                axios.get(`/api/countries/${name}`)
                    .then(res => {
                        this.countrySelected = res.data
                        this.getUrl()
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    })
            },
            getUrl() {
                this.url = `/countries/${this.countrySelected.id}`
            }
        },
    }
</script>
