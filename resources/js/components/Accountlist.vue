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
                <!-- End Create account Area -->
                <div class="col-md-12">                    
                    <div class="card  text-dark">                        
                        <div class="card-body">                            
                            <div class="row">                                
                                <div class="col-md-12">
                                    <h4 class="page-header header">施設一覧</h4>
                                </div>
                                <!-- nursing -->
                                <div class="row col-12 m-lr-0 rl" v-if="type == 'nursing'">
                                    <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-xl-3 column" v-for="nursingprofiles in nursingprofile" :key="nursingprofiles.id">
                                        <div class="card_1">                                    
                                            <img :src="'/upload/nursing_profile/'+ nursingprofiles.logo" alt="aa" @error="imgUrlAlt" />
                                            <div class="card-content">
                                                <span class="card-title text-truncate">
                                                    {{nursingprofiles.name}}
                                                </span>
                                            <!-- <span class="email">{{nursingprofiles.email}}</span> -->
                                            </div>
                                            <div class="card-read-more">
                                                <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">編集</router-link>
                                                <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人編集</router-link>
                                                <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人応募者一覧</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- nursing -->
                                <!-- hospital -->
                                <div class="row col-12 m-lr-0  rl" v-else>
                                    <div class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-xl-3 column" v-for="hospitalprofiles in hospitalprofile" :key="hospitalprofiles.id">
                                        <div class="card_1">                                    
                                            <img :src="'/upload/hospital_profile/'+ hospitalprofiles.logo" @error="imgUrlAlt"/>
                                            <div class="card-content">
                                                <span class="card-title text-truncate">
                                                    {{hospitalprofiles.name}}
                                                </span>
                                                <!-- <span class="email">({{hospitalprofiles.email}})</span> -->
                                            </div>
                                            <div class="card-read-more">
                                                <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">編集</router-link>
                                                <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人編集</router-link>
                                                <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">求人応募者一覧</router-link>
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
       }
    },
    created(){
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
    methods: {
        imgUrlAlt(event) { 
          
            event.target.src = "/images/noimage.jpg"
        },
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
.card_1 {
    display: block; 
    margin-bottom: 10px;
    line-height: 1.42857143;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 1px 3px 0 rgba(174, 174, 174, 0.16),0 1px 3px 0 rgba(0,0,0,0.12);
    transition: box-shadow .25s; 
    height:385px;
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
.card-content {
  padding:15px;
  text-align:left;
  height:80px;
}
.card-title {
  margin-top:0px;
  font-weight: 100;
  font-size: 1.125rem;
  display: block;
  margin-bottom:0px !important;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  /* border-top: 1px solid #D4D4D4; */
  padding:0px 0px 10px 10px;
  top: 332px;
   position: absolute;

}
.card-read-more a {
  text-decoration: none !important;
  padding:10px;
  font-weight:600;
  text-transform: uppercase
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
</style>