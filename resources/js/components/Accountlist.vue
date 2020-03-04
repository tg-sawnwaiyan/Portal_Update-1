<template>
    <div>
        <div class="card">
            <div v-if="!acc_status" class="card card-default card-wrap">
                <p class="record-ico">
                    <i class="fa fa-exclamation"></i>
                </p>
                <p>OOPS!!</p>

                <p v-if="!norecord_msg">Account is Deactivate!</p>
                <router-link :to="{name:'profiledit'}" class="main-bg-color create-btn all-btn" v-if="!norecord_msg">
                     Go To Activate
                </router-link>

                <p class="record-txt01" v-if="norecord_msg">表示する施設ありません</p>
                <p v-if="norecord_msg">表示する施設ありません‼新しい施設を作成してください。</p>   
                <span class="main-bg-color create-btn all-btn" v-if="norecord_msg">
                    <i class="fas fa-plus-circle"></i> 施設新規作成
                </span>             
                <!-- <router-link :to="{name:'profiledit'}" class="main-bg-color create-btn all-btn" v-if="!norecord_msg">
                    <i class="fas fa-plus-circle"></i> 施設新規作成
                </router-link> -->
            </div>

            <div class="row" v-else>
                <!-- Create account Area -->

                <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 m-t-8">
                            <div class="form-group" id="newcreate">
                                <span v-if="type == 'nursing'" class="btn main-bg-color white all-btn"  @click="ShowHideDiv()">

                                        介護施設新規作成
                                </span>
                                <span v-else class="btn main-bg-color white all-btn"  @click="ShowHideDiv()">

                                病院施設新規作成
                                </span>
                            </div>
                            <div id="nusNew">
                                <div class="form-group">
                                    <label>施設名 </label>
                                    <input type="text" class="form-control" v-model="nursing_data.name" placeholder="施設名を入力してください。">
                                    <span v-if="errors.name" class="error">{{errors.name}}</span>
                                </div>
                                <div class="form-group" >
                                    <label>都道府県</label>
                                    <select v-model="nursing_data.city_id" class="division form-control custom-select"  @change="getTownship()">
                                            <option value="0">選択してください。</option>
                                            <option v-for="cities in city_list" :key="cities.id" v-bind:value="cities.id">
                                                {{cities.city_name}}
                                            </option>
                                    </select>
                                    <span v-if="errors.city" class="error">{{errors.city}}</span>
                                </div>
                                <div class="form-group" >
                                    <label>市区町村</label>
                                    <select v-model="nursing_data.town_id" class="division form-control custom-select" @change="changeTownship()"  >
                                            <option value="0">選択してください。</option>
                                            <option v-for="tw in town_list" :key="tw.id" v-bind:value="tw.id">
                                                {{tw.township_name}}
                                            </option>
                                    </select>
                                    <span v-if="errors.township" class="error">{{errors.township}}</span>
                                </div>
                                <div class="form-group">
                                    <span  class="btn btn-danger"  style="margin-left:680px;" @click="CancelNew()">
                                        キャンセル
                                    </span>
                                    <span style="float:right" class="btn main-bg-color white all-btn"  @click="CreateNew()">
                                        作成
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>



                <!-- End Create account Area -->
                <div class="col-md-12">                    
                    <div class="card  text-dark">                        
                        <div class="card-body">                            
                            <div class="row">                                
                                <div class="col-md-12">
                                    <h4 class="page-header header">施設一覧</h4>
                                </div>
                                <!-- nursing -->
                                <div class="row col-12 m-lr-0  rl" v-if="type == 'nursing'">
                                    <div class="col-xs-12 col-sm-3 column" v-for="nursingprofiles in nursingprofile" :key="nursingprofiles.id">
                                        <div class="card_1">
                                          <img :src="'/upload/nursing_profile/'+ nursingprofiles.logo" alt="aa" @error="imgUrlAlt" />
                                            <div class="card-content">
                                             <div class="title-toggle">
                                                <span class="card-title">
                                                    {{nursingprofiles.name}}
                                                </span>
                                                <span>
                                                    <input type="checkbox" :id="nursingprofiles.id" class="switch-input" v-if="nursingprofiles.activate == 1" @click="changeActivate(nursingprofiles.id)" checked>
                                                    <input type="checkbox" :id="nursingprofiles.id" class="switch-input" v-if="nursingprofiles.activate == 0" @click="changeActivate(nursingprofiles.id)">
                                                    <label :for="nursingprofiles.id" class="switch-label">
                                                        <span v-if="nursingprofiles.activate == 1">On</span>
                                                        <span v-if="nursingprofiles.activate == 0">Off</span>
                                                    </label>
                                                </span>
                                             </div>
                                                
                                                <p class="">
                                                    <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人編集</router-link>
                                                    <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人応募者一覧</router-link>
                                                </p>
                                            </div>
                                            <div class="card-read-more">
                                                <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="btn btn-sm edit-borderbtn" style="font-weight:bold; float:left;margin-left:10px">編集</router-link>
                                                
                                                <span class="btn btn-sm btn-outline-danger" @click="profileDelete(nursingprofiles.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                           
                                <!-- nursing -->
                                <!-- hospital -->
                                <div class="row col-12 m-lr-0  rl" v-else>
                                    <div class="col-xs-12 col-sm-3 column" v-for="hospitalprofiles in hospitalprofile" :key="hospitalprofiles.id">
                                        <div class="card_1">
                                          <img :src="'/upload/hospital_profile/'+ hospitalprofiles.logo" @error="imgUrlAlt" />
                                            <div class="card-content">
                                             <div class="title-toggle">
                                                <span class="card-title">
                                                    {{hospitalprofiles.name}}
                                                </span>
                                                <span>
                                                    <input type="checkbox" :id="hospitalprofiles.id" class="switch-input" v-if="hospitalprofiles.activate == 1" @click="changeActivate(hospitalprofiles.id)" checked>
                                                    <input type="checkbox" :id="hospitalprofiles.id" class="switch-input" v-if="hospitalprofiles.activate == 0" @click="changeActivate(hospitalprofiles.id)">
                                                    <label :for="hospitalprofiles.id" class="switch-label">
                                                        <span v-if="hospitalprofiles.activate == 1">On</span>
                                                        <span v-if="hospitalprofiles.activate == 0">Off</span>
                                                    </label>
                                                </span>
                                             </div>
                                                
                                                <p class="">
                                                    <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人編集</router-link>
                                                    <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人応募者一覧</router-link>
                                                </p>
                                            </div>
                                            <div class="card-read-more">
                                                <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="btn btn-sm edit-borderbtn" style="font-weight:bold; float:left;margin-left:10px">編集</router-link>
                                                
                                                <span class="btn btn-sm btn-outline-danger" @click="profileDelete(hospitalprofiles.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- hospital -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
       return{
            nursingprofile:[],
            type:null,
            hospitalprofile:[],
            norecord_msg: false,
            acc_status: true,
            errors: {
                password: "" ,
                name:"",
                city:'',
                township:''
            },
            city_list:[],
            town_list:[],
            nursing_data:{
                name:'',
                city_id:'',
                town_id:'',  
            },
       }
    },
    created(){
        this.getAccountList();
        this.getCity();
    },

    methods: {
        imgUrlAlt(event) { 
            event.target.src = "/images/noimage.jpg"
        },
        getCity(){
                this.nursing_data.city_id = 0;
                this.nursing_data.town_id= 0;
                this.axios.get('/api/hospital/citiesList').then(response => {

                            this.city_list = response.data;

                });
        },
        ShowHideDiv(){

                document.getElementById('newcreate').style.display = "none";
                document.getElementById('nusNew').style.display = "block";
                
        },
        CreateNew(){
            if(this.nursing_data.name != '' )
            {
                this.errors.name = "";
            }
            else{
                this.errors.name = "施設名は必須です";
            }
            if(this.nursing_data.city_id != 0 )
            {
                this.errors.city = "";
            }
            else{
                this.errors.city = "都道府県は必須です";
            }
            if(this.nursing_data.town_id != 0)
            {
                this.errors.township = "";
    
            }
            else{
                    this.errors.township = "市区町村は必須です";
            }
            if(this.errors.city == ""  &&  this.errors.township == "" && this.errors.name == "")
                {
                this.axios.post(`/api/nursing/movelatlng/${this.cusid}`, this.nursing_data)
                                .then((response) => {
                                    this.$swal({
                                    // title: "確認",
                                    text: "施設を作成しました。",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonColor: "#6cb2eb",                       
                                    confirmButtonText: "閉じる",
                                    confirmButtonClass: "all-btn",
                                
                        }).then(response => { 
                            this.getAccountList();
                        });

                    document.getElementById('newcreate').style.display = "block";
                    document.getElementById('nusNew').style.display = "none";
                    this.nursing_data.name = '';
                    this.nursing_data.town_id = 0;
                    this.nursing_data.city_id = 0;
                });
            }  
        },
        CancelNew(){
                document.getElementById('newcreate').style.display = "block";
                document.getElementById('nusNew').style.display = "none";
                this.nursing_data.city_id = 0;
                this.nursing_data.town_id = 0;
                this.errors.city = '';
                this.errors.township = '';
        },
        getTownship(){
                this.errors.city = '';
                this.nursing_data.town_id = 0;
                this.axios.get('/api/auth/township',{
                params:{
                    city:this.nursing_data.city_id
                },
                }).then((response)=>{
                    this.town_list = response.data.townships
                })
        },
        getAccountList(){
         
            this.cusid = this.$route.params.id;
            this.type = this.$route.params.type;
        // this.type = this.$auth.user().type_id == 2?'hospital':'nursing';
            if(this.type == "nursing") {
                this.axios.get(`/api/account_nursing/${this.cusid}`).then(response => {
                    console.log("res",response.data)
                //this.$loading(false);
                this.nursingprofile = response.data.nuscustomer;
                
                if(response.data.status == 0) {
                    this.acc_status = false;
                }
                else{
                    this.acc_status = true;
                }
                
                if(this.nursingprofile.length != 0){
                    this.norecord_msg = false;
                }else{
                    this.norecord_msg = true;
                }
            });
            } else {
                this.axios.get(`/api/account_hospital/${this.cusid}`).then(response => {
                    //this.$loading(false);
                    this.hospitalprofile = response.data.hoscustomer;

                    if(response.data.status == 0) {
                        this.acc_status = false;
                    }
                    else{
                        this.acc_status = true;
                    }

                    if(this.hospitalprofile.length != 0){
                        this.norecord_msg = false;
                    }else{
                        this.norecord_msg = true;
                    }
            });
            }
        },
        changeActivate(id, $event){
            console.log("id",id);
            this.type = this.$route.params.type;
            if(this.type == "nursing") {
                console.log("if",id);
                this.$swal({
                            title: "---",
                            text: "---",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios.get(`/api/changeActivateNus/${id}`)
                                    .then(response => {
                                        this.getAccountList();
                                });
                            this.$swal({
                                text: "-----",
                                type: "success",
                                width: 350,
                                height: 200,
                                confirmButtonText: "閉じる",
                                confirmButtonColor: "#dc3545"
                            });
                        });
                
            }else{

                this.$swal({
                            title: "----",
                            text: "-----",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios.get(`/api/changeActivateHos/${id}`)
                                    .then(response => {
                                        this.getAccountList();
                                });
                            this.$swal({
                                text: "-----",
                                type: "success",
                                width: 350,
                                height: 200,
                                confirmButtonText: "閉じる",
                                confirmButtonColor: "#dc3545"
                            });
                        }).catch(error => {
                            
                            this.getAccountList();
                           
                          
                        });
                
            }
            
        },
        profileDelete(id){
            this.type = this.$route.params.type;
            if(this.type == "nursing") {

                this.$swal({
                            title: "------",
                            text: "------",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios.delete(`/api/profileDeleteNus/${id}`)
                                    .then(response => {
                                        this.getAccountList();
                        });
                            this.$swal({
                                    text: "-----",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#dc3545"
                                });
                        });
               
            }else{
                this.$swal({
                            title: "----",
                            text: "----",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios.delete(`/api/profileDeleteHos/${id}`)
                                      .then(response => {
                                        this.getAccountList();
                                });
                            this.$swal({
                                text: "-----",
                                type: "success",
                                width: 350,
                                height: 200,
                                confirmButtonText: "閉じる",
                                confirmButtonColor: "#dc3545"
                            });
                        });
                
            }
        }
    }
}
</script>


<style scoped>
 .acc_color{
        color:#2980b9
    }
img{
    vertical-align: middle;
    border-style: none;
    width: 100%;
    height: 230px;
}
.email{
    color:#8e8c8c;
}


.img-card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
}
.img-card img{
  width: 100%;
  height: 200px;
  object-fit:cover; 
  transition: all .25s ease;
} 

.all-btn{
    min-width: 60px;
}
.rl{
    padding:0px;
}
@media screen and (max-width: 1200px) and ( min-width:990px ) {
    .column{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 33.33333333%;
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;

    }
}
@media screen and (max-width: 1683px) and ( min-width:1201px ) {
    .column{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 33.33333333%;
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;

    }
}
@media screen and (max-width: 787px) and ( min-width:576px ) {
    .column{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 33.33333333%;
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;

    }
}
.column{
    padding-right: 7px;
    padding-left: 7px;
}
.model-7{
    text-align:end;
}
.checkbox{
    text-align:left;
}
.card-title{
    display:unset;
}



.container-fostrap {
  display: table-cell;
  padding: 1em;

  vertical-align: middle;
}
.fostrap-logo {
  width: 100px;
  margin-bottom:15px
}
h1.heading {
  color: #fff;
  font-size: 1.15em;
  font-weight: 900;
  margin: 0 0 0.5em;
  color: #505050;
}
@media (min-width: 450px) {
  h1.heading {
    font-size: 3.55em;
  }
}
@media (min-width: 760px) {
  h1.heading {
    font-size: 3.05em;
  }
}
@media (min-width: 900px) {
  h1.heading {
    font-size: 3.25em;
    margin: 0 0 0.3em;
  }
} 
.card_1 {
  display: block; 
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
    transition: box-shadow .25s; 
}
.card_1:hover {
  box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
.img-card {
  width: 100%;
  height:200px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
}
.img-card img{
  width: 100%;
  height: 200px;
  object-fit:cover; 
  transition: all .25s ease;
} 
.title-toggle{
    margin-bottom:10px;
}
.card-content {
  padding:10px;
  text-align:left;
}
.card-title {
  margin-top:0px;
  font-weight: 600;
  font-size: 20px;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  border-top: 1px solid #D4D4D4;
  padding:10px 10px 10px 0px;
  text-align:right;
}
.card-read-more a {
  text-decoration: none !important;
  font-weight:600;
  text-transform: uppercase
}




/* toggle */
.switch-input {
  display: none;
}
.switch-label {
    float:right;
  position: relative;
  display: inline-block;
  cursor: pointer;
  color: #727272;
  font-weight: 500;
  text-align: left;
  padding: 5px 0 4px 44px;
}
.switch-label:before, .switch-label:after {
  content: "";
  position: absolute;
  margin: 0;
  outline: 0;
  top: 50%;
  -webkit-transform: translate(0, -50%);
  transform: translate(0, -50%);
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
.switch-label:before {
  left: 1px;
  width: 34px;
  height: 14px;
  background-color: #b6b6b6;
  border-radius: 8px;
}
.switch-label:after {
  left: 0;
  width: 20px;
  height: 20px;
  background-color: #FAFAFA;
  border-radius: 50%;
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.14), 0 2px 2px 0 rgba(0, 0, 0, 0.098), 0 1px 5px 0 rgba(0, 0, 0, 0.084);
}
.switch-label .toggle--on {
  display: none;
}
.switch-label .toggle--off {
  display: inline-block;
}
.switch-input:checked + .switch-label:before {
  background-color: #2F6FA8;
}
.switch-input:checked + .switch-label:after {
  background-color: #428BCA;
  -webkit-transform: translate(80%, -50%);
  transform: translate(80%, -50%);
}
.switch-input:checked + .switch-label .toggle--on {
  display: inline-block;
}
.switch-input:checked + .switch-label .toggle--off {
  display: none;
}
.switch-input:checked + .switch-label .toggle--option {
  color: #428BCA;
}

</style>