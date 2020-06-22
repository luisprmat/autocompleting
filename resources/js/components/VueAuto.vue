<template>
    <div>
        <div class="form-group">
            <vue-typeahead-bootstrap
                v-model="query"
                :data="countries"
                :serializer="item => item.name"
                placeholder="Buscar un pais"
                @hit="countrySelected = $event"
                @input="getCountryList"
            ><template slot="suggestion" slot-scope="{ htmlText }">
                <div class="d-flex align-items-center justify-content-between">
                    <span v-html="htmlText"></span>
                    <!-- <span>8A</span> -->
                </div>
            </template>
            </vue-typeahead-bootstrap>
        </div>
        <p v-if="countrySelected">Seleccionaste <span>{{ countrySelected.id }}: {{ countrySelected.name }}</span></p>
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
                countrySelected: null,
                url: '',
                countries: []
            }
        },
        methods: {
            getCountryList(name) {
                axios.get(`/api/countries/?query=${this.query}`)
                    .then(res => {
                        this.countries = res.data.data
                        if(this.countrySelected) this.getUrl()
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
