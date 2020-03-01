<script type="text/x-template" id="address-edit-template">
        <div class="col-sm-12 mb-3">
            <div class="form-row">
                <div v-show="update" class="col-sm-12 col-md-3">
                    <label>Municipality or CAP</label>
                    <input class="form-control" type="text" v-model="municipality">
                </div>
                <div v-show="update" class="col-sm-12 col-md-3">
                    <label>Street</label>
                    <input class="form-control" type="text" v-model="street">
                </div>
                <div v-show="update" class="col-sm-12 col-md-3">
                    <label>Number</label>
                    <input class="form-control" type="text" v-model="number">
                </div>
                <div v-show="update" class="col-sm-12 col-md-3">
                    <label>Cerca</label>
                    <a @click="searchAddress()" href="#" class="form-control btn btn-primary">Inserisci indirizzo</a>
                </div>

                {{-- Viene mostrato quando si modifica l'indirizzo --}}
                <div v-show="updated" class="col-sm-12 col-md-9">
                    <input hidden type="text" name='user_id' value="{{ Auth::user()->id }}">
                    <input hidden type="text" name="latitude" v-model="lat">
                    <input hidden type="text" name="longitude" v-model="lon">
                    <label>Updated address</label>
                    <input class="form-control" type="text" name="address" v-model="address">
                </div>
                <div v-show="updated" class="col-sm-12 col-md-3">
                    <label style="color: white">W IL TEAM 2</label>
                    <a @click="editAddress()" href="#" class="form-control btn btn-primary">Modifica indirizzo</a>
                </div>

                {{-- Campi nascosti per passaggio dati --}}
                <div id="remove" v-show="current" class="col-sm-12 col-md-9 mb-3">
                    <label>Current address</label>
                    <input class="form-control" type="text" name="address" value="{{ $apartment->address }}">
                    <input hidden type="text" name='latitude' value="{{ $apartment->latitude }}">
                    <input hidden type="text" name='longitude' value="{{ $apartment->longitude }}">
                </div>
                
                <div v-show="current" class="col-sm-12 col-md-3">
                    <label style="color: white">W IL TEAM 2</label>
                    <a @click="editAddress()" href="#" class="form-control btn btn-primary">Modifica indirizzo</a>
                </div>
            </div>
        </div>
    
</script>

<script type="text/javascript">

    Vue.component('myaddressedit', {

        template: "#address-edit-template",
        data: function() {
            return {
                address: "",
                lat: "",
                lon: "",
                municipality: "",
                street: "",
                number: "",
                edit: true,
                update: false,
                current: true
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
                    });
                    
                    _this.current = false;
                    _this.update = false;
                    _this.updated = true;
                    
                    // Elimino dal dom gli input con i values del db..
                    $('#remove').remove();

                })
                .catch( function(error) {
                    console.log("Errori tornati:", error);
                })

            },
            editAddress() {
                const _this = this;
                _this.current = false;
                _this.update = true;
            }
        }
    });

</script>