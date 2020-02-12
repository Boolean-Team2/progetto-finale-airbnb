<script type="text/x-template" id="address-template">
    <div>
        <input type="text" v-model="address">
        <button @click="searchAddress()" type="reset" class="btn btn-primary">Cerca</button>
    </div>
</script>

<script type="text/javascript">

    Vue.component('test', {

        template: "#address-template",
        data: function() {
            return {
                address: ""
            };
        },
        methods: {
            searchAddress() {
                
                const _this = this;
                
                console.log("Sto cercando:", _this.address);

                query = _this.address;
                ext = ".json";
                api_key = 'dRFZrptPccTmSHTdFh1v7Apn0osti1eh';

                // https://api.tomtom.com/search/2/geocode/4%20north%202nd%20street%20san%20jose.json?key=nGr3NaPGtkTDaByWJX5ms6A6artaA8om

                axios.get("https://api.tomtom.com/search/2/geocode/" + query + ext, {
                        // Per le rotte get
                        params: {
                            key: 'dRFZrptPccTmSHTdFh1v7Apn0osti1eh',
                        }
                    }
                )
                .then( function(dataTornati) {
                    console.log("Dati tornati:", dataTornati);
                    _this.movies = dataTornati.data.results;
                })
                .catch( function(error) {
                    console.log("Errori tornati:", error);
                })

            }
        },
        computed: {
            
        }
    });

</script>