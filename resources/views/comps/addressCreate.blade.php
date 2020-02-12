<script type="text/x-template" id="address-template">
        <div class="col-sm-12 mb-3">
            <div class="form-row">
                <div v-show="!show" class="col-sm-12 col-md-3">
                    <label>Municipality or CAP</label>
                    <input class="form-control" type="text" v-model="municipality">
                </div>
                <div v-show="!show" class="col-sm-12 col-md-3">
                    <label>Street</label>
                    <input class="form-control" type="text" v-model="street">
                </div>
                <div v-show="!show" class="col-sm-12 col-md-3">
                    <label>Number</label>
                    <input class="form-control" type="text" v-model="number">
                </div>
                <div v-show="!show" class="col-sm-12 col-md-3">
                    <label>Cerca</label>
                    <a @click="searchAddress()" href="#" class="form-control btn btn-primary">Inserisci indirizzo</a>
                </div>
                <div v-show="show" class="col-sm-12 col-md-6 mb-3 mt-3">
                    <input class="form-control" type="text" name='address' v-model="address">
                    <input hidden type="text" name='user_id' value="{{ Auth::user()->id }}">
                    <input hidden type="text" name='latitude' v-model="lat">
                    <input hidden type="text" name='longitude' v-model="lon">
                </div>
                <div v-show="show" class="col-sm-12 col-md-6 mt-3">
                    <a @click="editAddress()" href="#" class="form-control btn btn-primary">Modifica indirizzo</a>
                </div>
            </div>
        </div>
    
</script>

<script type="text/javascript">

    Vue.component('myaddress', {

        template: "#address-template",
        data: function() {
            return {
                address: "",
                lat: "",
                lon: "",
                municipality: "",
                street: "",
                number: "",
                show: false
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
                        _this.address = element.address.freeformAddress;
                        _this.lat = element.position.lat;
                        _this.lon = element.position.lon;
                        console.log(_this.address);
                        console.log(_this.lat);
                        console.log(_this.lon);
                    });
                    
                    _this.show = true;                

                })
                .catch( function(error) {
                    console.log("Errori tornati:", error);
                })

            },
            editAddress() {
                const _this = this;
                _this.show = false;
            }
        },
        computed: {
            
        }
    });

</script>