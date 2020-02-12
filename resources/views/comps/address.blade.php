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

                address = _this.address;

                axios.get("https://api.tomtom.com/search/2/geocode/" + address + ".json", {
                        // Per le rotte get
                        params: {
                            key:'dRFZrptPccTmSHTdFh1v7Apn0osti1eh',
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