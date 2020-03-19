<template>
    <div>
        <div class="">            
            <div v-if="!acc_status" class="card card-default card-wrap">
                <p class="record-ico">
                    <i class="fa fa-exclamation"></i>
                </p>  
                <p class="record-txt01">アカウントが無効になりました。</p>
                
                <router-link :to="{name:'profiledit'}" class="main-bg-color create-btn all-btn">
                    アクティベートへ
                </router-link>

            </div>

            <!-- Create account Area --> 
            <div v-else >
                <div v-if="norecord_msg && !createNew" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>                    
                    <p class="record-txt01" v-if="norecord_msg">施設が登録されていません。</p>
                    <span class="main-bg-color create-btn all-btn" v-if="norecord_msg" @click="ShowHideDiv()">
                        <i class="fas fa-plus-circle"></i> 施設新規作成
                    </span> 
                </div>
                <div v-if="!createNew && !norecord_msg" class="col-12 tab-content" id="nusBlock">                        
                    <div class="p-2 p0-480">                            
                        <div class="container-fuid">                                
                            <div class="col-md-12 d-flex header pb-3 admin_header">
                                <h5>施設一覧</h5>
                                <div class="ml-auto">
                                    <a class="" id="newcreate">
                                        <span v-if="type == 'nursing'" class="main-bg-color create-btn all-btn"  @click="ShowHideDiv()">
                                            <span><i class="fas fa-plus-circle"></i> <span class="dinone">介護施設新規作成</span></span>
                                        </span>
                                        <span v-else class="main-bg-color create-btn all-btn"  @click="ShowHideDiv()">
                                        <i class="fas fa-plus-circle"></i> <span class="dinone">病院施設新規作成</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <!-- nursing -->
                            <div class="row col-12 m-lr-0  rl" v-if="type == 'nursing'">
                                <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 column" v-for="nursingprofiles in nursingprofile" :key="nursingprofiles.id">
                                    <div class="card_1">
                                        <img :src="'/upload/nursing_profile/'+ nursingprofiles.logo" alt="aa" @error="imgUrlAlt" />
                                        <div class="card-content">
                                            <div class="title-toggle" style="width:100%;">
                                            <span class="d-inline-block text-truncate font-weight-bold card-title card-title-leftwrapper">
                                                {{nursingprofiles.name}}
                                            </span>
                                            <span class="card-title-rightwrapper model-7">                                                 
                                                <div class="checkbox">
                                                    <input type='checkbox' :id="nursingprofiles.id" v-if="nursingprofiles.activate == 1" @click="changeActivate(nursingprofiles.id,nursingprofiles.activate)" checked/>
                                                    <input type='checkbox' :id="nursingprofiles.id" v-if="nursingprofiles.activate == 0" @click="changeActivate(nursingprofiles.id,nursingprofiles.activate)"  />
                                                    <label for="checkbox"></label>
                                                    <div  v-if="nursingprofiles.activate == 1" class="on">公開中</div>
                                                    <div v-if="nursingprofiles.activate == 0" class="on">非公開</div>
                                                </div>                                                                                             
                                            </span>
                                            </div>
                                            
                                            <p>
                                                <router-link :to="{ path:'/profilejobofferlist/nursing/'+ nursingprofiles.id}" style="font-weight:bold;text-decoration:underline;">
                                                <i class="vsm--icon fa fa-edit fa-fw" style="color: #585858;"></i>求人編集</router-link>&nbsp;&nbsp;
                                                <router-link :to="{ path:'/jobapplicantlist/nursing/profile/'+ nursingprofiles.id}" style="font-weight:bold;text-decoration:underline;">
                                                <i class="vsm--icon fa fa-list" style="color: #585858;"></i>求人応募者一覧</router-link>
                                            </p>
                                            
                                        </div>
                                        <div class="card-read-more">
                                            <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="btn edit-borderbtn" style="float:left;">編集</router-link>
                                            
                                            <span class="btn text-danger delete-borderbtn" @click="profileDelete(nursingprofiles.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i>削除</span>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                            <!-- nursing -->
                            <!-- hospital -->
                            <div class="row col-12 m-lr-0  rl" v-else>
                                <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 column" v-for="hospitalprofiles in hospitalprofile" :key="hospitalprofiles.id">
                                    <div class="card_1">
                                        <img :src="'/upload/hospital_profile/'+ hospitalprofiles.logo" @error="imgUrlAlt" />
                                        <div class="card-content">
                                            <div class="title-toggle">
                                            <span class="d-inline-block text-truncate font-weight-bold card-title card-title-leftwrapper">
                                                {{hospitalprofiles.name}}
                                            </span>
                                            <span class="card-title-rightwrapper model-7">  
                                                <div class="checkbox">
                                                    <input type='checkbox' :id="hospitalprofiles.id" v-if="hospitalprofiles.activate == 1" @click="changeActivate(hospitalprofiles.id,hospitalprofiles.activate)" checked/>
                                                    <input type='checkbox' :id="hospitalprofiles.id" v-if="hospitalprofiles.activate == 0" @click="changeActivate(hospitalprofiles.id,hospitalprofiles.activate)"  />
                                                    <label for="checkbox"></label>
                                                    <div   v-if="hospitalprofiles.activate == 1" class="on">公開中</div>
                                                    <div v-if="hospitalprofiles.activate == 0" class="on">非公開</div>
                                                </div>                                            
                                            </span>
                                            </div>
                                            
                                            <p>
                                                <router-link :to="{ path:'/profilejobofferlist/hospital/'+ hospitalprofiles.id}" class="" style="font-weight:bold;text-decoration:underline;">
                                                    <i class="vsm--icon fa fa-edit fa-fw" style="color: #585858;"></i>求人編集</router-link>&nbsp;&nbsp;
                                                <router-link :to="{ path:'/jobapplicantlist/hospital/profile/'+ hospitalprofiles.id}" class="" style="font-weight:bold;text-decoration:underline;">
                                                    <i class="vsm--icon fa fa-list fa-fw" style="color: #585858;"></i>求人応募者一覧</router-link>
                                            </p>
                                            
                                        </div>
                                        <div class="card-read-more">
                                            <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="btn edit-borderbtn" style="float:left;">編集</router-link>
                                                
                                            <span class="btn text-danger delete-borderbtn" @click="profileDelete(hospitalprofiles.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i>削除</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- hospital -->
                        </div>
                    </div>
                </div>

                <div v-if="createNew">
                    <div class="col-md-12 pad-free">
                        <div class="card text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 data-v-81a927b4="" class="page-header header">施設作成</h4>
                                    </div>
                                    <div class="mt-2 pb-5 col-md-12">
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
                                                <span class="btn bt-red all-btn" @click="CancelNew()">
                                                    キャンセル
                                                </span>                                               
                                                <span class="btn main-bg-color white all-btn"  @click="CreateNew()">
                                                    作成
                                                </span>                                                
                                            </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- End Create account Area --> 
                
            </div>               
            
        </div>
    </div>
</template>
<script>
export default {
    data() {
       return{
           createNew: false,
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
            activate_text:'',
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
            this.createNew = true;                  
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
                        allowOutsideClick: false,
                        text: "施設を作成しました。",
                        type: "success",
                        width: 350,
                        height: 200,
                        confirmButtonColor: "#31CD38",                       
                        confirmButtonText: "閉じる",
                        confirmButtonClass: "all-btn",
                            
                    }).then(response => { 
                        this.createNew = false;
                        this.getAccountList();
                    });

                    this.nursing_data.name = '';
                    this.nursing_data.town_id = 0;
                    this.nursing_data.city_id = 0;
                });
            }  
        },
        CancelNew(){
            this.createNew = false;               
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
        changeActivate(id,activate, $event){
            if(activate == 1)
            {
               this.activate_text = "施設を非公開にしてよろしいでしょうか。";
            }
            else{
                this.activate_text = "施設を公開してよろしいでしょうか。";
            }
          
            this.type = this.$route.params.type;
        
            this.$swal({
                allowOutsideClick: false,
                title: "確認",
                text: this.activate_text,
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
                this.axios.get(`/api/changeActivate/${id}/`+this.type)
                    .then(response => {
                        this.getAccountList();
                });
            
            }).catch(error =>{
                if(activate == 1){
                    $("#"+id).prop("checked", true);
                }else{
                    $("#"+id).prop("checked", false);
                }
                
            });

        },
        profileDelete(id){
            this.type = this.$route.params.type;

                this.$swal({
                    allowOutsideClick: false,
                    title: "確認",
                    text: "施設を削除してよろしいでしょうか。",
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
                    this.$loading(true);
                    this.axios.delete(`/api/profileDelete/${id}/`+this.type)
                    .then(response => {
                        this.$loading(false);
                        this.getAccountList();
                    });
                
                });
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
.rl{
    padding:0px;
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
  opacity: 0.9;
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
  font-size: 20px;
}
.card-title-leftwrapper{
  width: 70%;
}
.card-title-rightwrapper{
  width: 30%;
}
.card-title-rightwrapper .checkbox{
    vertical-align: top;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  border-top: 1px solid #D4D4D4;
  padding:10px 10px;
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