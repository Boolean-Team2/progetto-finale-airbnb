<script type="text/x-template" id="address-template">
        <div class="col-sm-12 mb-3">
            <div class="form-row">
                <div class="col-sm-12 col-md-3">
                    <label>Municipality or CAP</label>
                    <input class="form-control" type="text" v-model="municipality">
                </div>
                <div class="col-sm-12 col-md-3">
                    <label>Street</label>
                    <input class="form-control" type="text" v-model="street">
                </div>
                <div class="col-sm-12 col-md-3">
                    <label>Number</label>
                    <input class="form-control" type="text" v-model="number">
                </div>
                <div class="col-sm-12 col-md-3">
                    <label>Cerca</label>
                    <button @click="searchAddress()" type="reset" class="form-control btn btn-primary">Inserisci indirizzo</button>
                </div>
                <div class="col-sm-12 mb-3">
                    <input class="form-control" type="text" name='address' v-model="address">
                    <input class="form-control" type="text" name='user_id' value="{{ Auth::user()->id }}">
                </div>
            </div>
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