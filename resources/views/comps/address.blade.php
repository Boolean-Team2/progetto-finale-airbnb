<script type="text/x-template" id="address-template">
    <div>
        <label>Municipality or CAP</label>
        <input type="text" v-model="municipality">
        <label>Street</label>
        <input type="text" v-model="street">
        <label>Number</label>
        <input type="text" v-model="number">

        <label for="myaddress">Address</label>
        <input type="text" name='myaddress' v-model="address">

        <button @click="searchAddress()" type="reset" class="btn btn-primary">Cerca</button>
    </div>
</script>

<script type="text/javascript">

    Vue.component('test', {

        template: "#address-template",
        data: function() {
            return {
                address: "",
                municipality: "",
                street: "",
                number: "",
            };
        },
        methods: {
            searchAddress() {
                
                const _this = this;

                console.clear();
                
                query = _this.street + " " + _this.municipality + " " + _this.number;
                ext = ".json";
                
                console.log("Sto cercando:", query);

                axios.get("https://api.tomtom.com/search/2/geocode/" + query + ext, {
                        // Per le rotte get
                        params: {
                            key: 'dRFZrptPccTmSHTdFh1v7Apn0osti1eh',
                            limit: 1
                        }
                    }
                )
                .then( function(dataTornati) {
                    console.log("Dati tornati:", dataTornati.data.results);
                    var indirizzo = dataTornati.data.results;

                    indirizzo.forEach(element => {
                        _this.address=element.address.freeformAddress;
                        console.log(element.address.freeformAddress);
                    });

                    
                    

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