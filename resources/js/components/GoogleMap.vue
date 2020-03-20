<template>
        <div class="col-md-12 pad-free m-b-10">
              <div class="col-md-12 pad-free nursing-m-b-15">
                <div class="col-md-12 pad-free postal-search">
                    <div class="form-group row pl-3">
                    <div class="col-md-12 p-0 "><label class="font-weight-bold"> 郵便番号 </label></div>
                    <div class="col-md-12 p-0">
                    <input type="text" v-model="comment.postal" v-on:keydown="postalNumber" name="postal" class="form-control white-bg-color float-left postal" id="postal" placeholder="郵便番号を入力してください。" maxlength="7"/>                    
                    <span class="float-left submit1 btn main-bg-color continue all-btn submit m-l-10  m-l-480" @click="getPostal">郵便番号より住所を検索</span>
                    <span class="float-left m-l-10 m-l-768">例）1006740 (<a href="https://www.post.japanpost.jp/zipcode/" target="_blank" class="pseudolink">郵便番号検索</a>)</span>
                    </div>
                    <span id="jsErrorMessage" class="m-t-8"></span>
                  </div>
                    <div class="col-md-12 row p-0 m-0">
                        <div class="col-md-6 pad-free nursing-m-b-15 ">
                            <div class="col-md-12 p-l-0 "><label class="font-weight-bold">  都道府県 <span class="error sp2">必須</span></label></div>
                            <div class="col-md-12 p-l-0 nursing_p-r-2">
                                <select v-model="city" class="division form-control" id="division" @change="cityChange('city',$event)">
                                  <option value="0">選択してください。</option>
                                    <option v-for="cities in city_list" :key="cities.id" v-bind:value="cities.id">
                                        {{cities.city_name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pad-free nursing-m-b-15">
                            <div class="col-md-12 p-r-0"><label class="font-weight-bold">  市区町村 <span class="error sp2">必須</span></label></div>
                            <div class="col-md-12 p-r-0 nursing_p-l-2">
                                <select v-model="township" class="division form-control" id="gmaptownship">
                                  <option value="0">選択してください。</option>
                                    <option v-for="townships in township_list" :key="townships.id" v-bind:value="townships.id" ref="township">
                                        {{townships.township_name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="form-group m-t-10 ">
                    <label class="font-weight-bold">番地（建物名）</label> 
                    <div class="row">
                      <!-- <div class="col-md-12" v-if="status === '0'">
                        <input type="text" id="address_val" name="city" class="old-city form-control white-bg-color" placeholder="番地を入力してください。" v-model="address">
                      </div> -->
                      <div class="col-md-12 nursing-m-b-15">
           
                        <input type="text" id="address_show" name="city" class="city form-control white-bg-color" placeholder="番地を入力してください。" v-model="address">
                        <!-- <input type="text" id="address_val" class="hide form-control white-bg-color" v-model="address_val"> -->
                      </div>
                      <!-- <div class="col-md-2">
                        <span class="btn news-post-btn all-btn" @click="searchAddress()">番地検索</span>
                      </div> -->
                    </div>
                    <p class="m-l-768">例）丸の内1-9-1　グラントウキョウノースタワー40階</p>
                  </div>
                </div>
                <div class="form-group">
                  <h5 class="lbl-lat-lng">緯度経度の入力または地図のマーカを移動し施設の位置を指定してください。</h5>
                    <div class="row">
                      <div class="col-lg-4 col-md-12 hos_map_lbl">
                        <label class="font-weight-bold">緯度 <span class="error sp2">必須</span></label>
                        <input type="text" class="form-control white-bg-color" name="new_lat" v-model="new_lat" id="new_lat" ref="new_lat">
                      </div>
                      <div class="col-lg-4 col-md-12">
                        <label class="font-weight-bold">経度 <span class="error sp2">必須</span></label>
                        <input type="text" class="form-control white-bg-color" name="new_long" v-model="new_long" id="new_long" ref="new_long">
                      </div>
                      <div class="nursing_map col-lg-4 col-md-12">
                        <span class="btn news-post-btn all-btn" @click="addressSelect(Number(new_lat),Number(new_long))">緯度経度から地図を検索</span>
                      </div>
                    </div>
                  </div>
                <!-- <input type="text" name="new_lat" v-model="new_lat" id="new_lat">
                <input type="text" name="new_long" v-model="new_long" id="new_long">
                <span class="btn btn-primary" @click="addressSelect(Number(new_lat),Number(new_long))">Add</span>          -->

                <!-- <label>場所検索はこちら</label>
                <gmap-autocomplete
                  @place_changed="setPlace" v-bind:value="comment.city" class="form-control m-b-10" id="gmap-search" style="display:none;">
                </gmap-autocomplete>
                <gmap-autocomplete
                  @place_changed="setPlace" class="form-control m-b-10 white-bg-color" id="gmap-search2" placeholder="場所を入力してください">
                </gmap-autocomplete> -->
                <!-- <span @click="addMarker">Add</span> -->
              </div>
              <!-- <div class="col-md-12 pad-free" v-if="address_btn">
                <label>住所:</label>
                {{comment.gmap_city}}
              </div>            -->
          <GmapMap
            id="googlemap"
            ref="map"
            :center="center"
            :zoom="10"
          >
            <GmapMarker
              v-for="(m, index) in markers"
              :key="index"
              :position="m.position"
              :clickable="true"
              :draggable="true"
              @click="center=m.position"
              @dragend="updateCoordinates"
            />

          </GmapMap>
        <!-- <span @click="callParent()">Click</span> -->

        </div>
</template>
<script>
export default {
  name: "GoogleMap",
  props:{
         address:String,
         township: Number,
         city: Number,
         township_list: Array 
        },
  data () {
    return {
      status:'0',
      markers: [],
      places: [],
      center:{},
      selected: '',
      new_lat: '',
      new_long: '',
      comment: {
        postal: '',
        city: '',
        gmap_city: ''
      },
      address_btn: false,
      city_list: [],
      address_val: '',
      test:'',
 

    //   selected_city:this.city,
    }
  },
//   computed:{
//       selectedCity: {
//           get: function(){
//                 this.selected_city = this.city;
//                 return this.selected_city;
//           },
//           set: function(newValue){
//               this.city = newValue;
//           }

//       }
//   },
  created() {
    
    this.markers = [{
        position: {
          lat: Number(localStorage.getItem('lat_num')),
          lng: Number(localStorage.getItem('lng_num'))
        }
      }];
     
    this.new_lat = Number(localStorage.getItem('lat_num'));
    this.new_long = Number(localStorage.getItem('lng_num'));


    this.center = { lat: Number(localStorage.getItem('lat_num')), lng: Number(localStorage.getItem('lng_num')) }

    $('#gmap-search').css({'display':'none'});
    this.axios.get('/api/hospital/citiesList')
        .then(response => {
            this.city_list = response.data;
        });
       
  },
  methods: {
      // callParent(){
      //   //   this.$parent.$options.methods.someParentMethod('hello');
      // },
    // receives a place object via the autocomplete component
    addressSelect: function (lat_add,lng_add) {
      // Add a new marker
      this.markers.push({
        position: {
          lng: lng_add,
          lat: lat_add
        }
      });
    //   this.markers.push({
    //     position: {
    //       lng: this.addresses[e.target.options.selectedIndex].longitude,
    //       lat: this.addresses[e.target.options.selectedIndex].latitude
    //     }
    //   });

      // Remove the previous marker
      this.markers.shift()
      // Scroll the map to the new position
      this.$refs.map.$mapPromise.then((map) => {
        map.panTo({
          lng: lng_add,
          lat: lat_add
        });
      });
    },

    updateCoordinates(e) {
      $('#new_lat').val(e.latLng.lat());
      $('#new_long').val(e.latLng.lng());
      this.new_lat = e.latLng.lat();
      this.new_long = e.latLng.lng();
    },

    // setPlace(place) {
    //   this.currentPlace = place;
    //   this.addMarker();
    // },

    //Auto complete Search
    // addMarker() {
    //   this.markers.shift()
    //   if (this.currentPlace) {
    //     const marker = {
    //       lat: this.currentPlace.geometry.location.lat(),
    //       lng: this.currentPlace.geometry.location.lng()
    //     };
    //     this.markers.push({ position: marker });
    //     this.places.push(this.currentPlace);
    //     this.center = marker;
    //     this.currentPlace = null;

    //     this.new_lat = marker.lat;
    //     this.new_long = marker.lng;

    //   }
    // },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    },
    searchplace(){
      this.comment.gmap_city = this.address;
      $('#gmap-search').focus();

    },
    getPostal: function(event) {
      
                this.status = 1;
                if (this.comment.postal.length > 5) {
                    var postal = this.comment.postal;
                    this.axios
                        .post('/api/hospital/postList/' + postal)
                        .then(response => {
                            var post_data = response.data.postal_list;
                            var length = response.data.postal_list.length;
                            if (length > 0) {
                                var pref = post_data[0]['city_id'];

                                this.address =post_data[0]['street'];
                                // this.address_val = post_data[0]['pref']+post_data[0]['city']+post_data[0]['street'];
                                this.city = post_data[0]['city_id'];
                                this.cityChange('postal','');
                                this.township = response.data.township_id[0]['id'];
                            
                                $('#jsErrorMessage').html('<div></div>');
                            }else {
                                this.address ='';
                                this.township = 0;
                                this.city = 0;
                                $('#jsErrorMessage').html('<div class="error">郵便番号の書式を確認してください。</div>');
                            }
                        });
                }
            },
            searchAddress (){
              this.address_btn = true;
              if(this.address_btn){
                // $('#gmap-search').focus();
                // this.comment.gmap_city = this.comment.city;
                $('#gmap-search').css({'display':'block'});
                $('#gmap-search2').css({'display':'none'});
                $('#gmap-search').focus();

              }else{
                this.comment.gmap_city = '';
              }

            },
            cityChange(status,event){
              
                this.axios
                .get('/api/townshiplist/'+this.city)
                .then(response=>{
                  if(status != 'postal'){
                    // this.comment.postal = '';
                    this.comment.city = this.city_list[event.target.options.selectedIndex].city_name;
                    this.address ='';
                    this.township = 0;
                }
                    this.township_list = response.data.townships;
                    localStorage.removeItem('townshiplist');
                    localStorage.setItem('townshiplist',JSON.stringify(this.township_list));
                    // this.township = this.township_list[0].id;
                    
                    this.new_lat = response.data.coordinate[0].latitude;
                    this.new_long = response.data.coordinate[0].longitude;
                    this.addressSelect(this.new_lat,this.new_long);
                });
            },
            postalNumber: function(event) {
                if(!(event.keyCode >= 48 && event.keyCode <= 57) && !(event.keyCode >= 96 && event.keyCode <= 105) 
                    && event.keyCode != 8 && event.keyCode != 46 && !(event.keyCode >= 37 && event.keyCode <= 40)) 
                {
                    event.preventDefault();
                }
            },
            // townshipChange(event) {
            //     this.address =this.comment.city+this.township_list[event.target.options.selectedIndex].township_name;
            // },

  }
};

</script>
<style scoped>
.lbl-lat-lng {
    margin: 15px 0px;
    font-weight: bold;
    border-left: 5px solid #2980b9;
    padding-left: 10px;
}
.hide{
  display: none;
}

</style>
