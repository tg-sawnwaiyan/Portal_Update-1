<template>
<div>
    <div class="card">
        <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示する施設ありません</p>
                    <p>表示する施設ありません‼新しい施設を作成してください。</p>
                    <router-link :to="{name:'profiledit'}" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 施設新規作成
                    </router-link>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <div class="card  text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="page-header header">施設一覧</h4>
                            </div>
                            <div class="row col-12 m-lr-0 rl" v-if="type == 'nursing'">



                            <div class="col-xs-4 col-sm-2 col-md-4 col-lg-2 col-xl-2 column" v-for="nursingprofiles in nursingprofile" :key="nursingprofiles.id">
                                <div class="card_1">                                    
                                    <img :src="'/upload/nursing_profile/'+ nursingprofiles.logo" alt="aa" @error="imgUrlAlt" />
                                </a>
                                    <div class="card-content">
                                        <span class="card-title text-truncate">
                                            {{nursingprofiles.name}}
                                        </span>
                                       <span class="email">test@gmail.com</span>
                                    </div>
                                    <div class="card-read-more">
                                    <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="main-bg-color btn btn-sm all-btn" style="font-weight:bold;">編集</router-link>
                                        
                                    </div>
                                </div>
                            </div>



                            </div>
                              <div class="row col-12 m-lr-0" v-else>
                               <div class="col-md-3 m-b-10 nursing_responsive" v-for="hospitalprofiles in hospitalprofile" :key="hospitalprofiles.id">
                                    <div class="card h-100">
                                        <div class="card-body nus_account">
                                            <div class="img_title">
                                                <img :src="'/upload/hospital_profile/'+ hospitalprofiles.logo" @error="imgUrlAlt"/>
                                            </div>
                                            <p class="acc_color"><strong>{{hospitalprofiles.name}}</strong></p>
                                            <p v-if="hospitalprofiles.email"> ({{hospitalprofiles.email}})</p>
                                            <router-link :to="{ path:'/profile/hospital/'+ hospitalprofiles.id}" class="btn btn-success" style="font-weight:bold;">Edit</router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
             
       }
    },
    created(){
        this.cusid = this.$route.params.id;
        this.type = this.$route.params.type;
        // this.type = this.$auth.user().type_id == 2?'hospital':'nursing';
            if(this.type == "nursing") {
                this.axios.get(`/api/account_nursing/${this.cusid}`).then(response => {
                //this.$loading(false);
                this.nursingprofile = response.data;
                if(this.nursingprofile.length != 0){
                    this.norecord_msg = false;
                }else{
                    this.norecord_msg = true;
                }
            });
            } else {
                this.axios.get(`/api/account_hospital/${this.cusid}`).then(response => {
                    //this.$loading(false);
                    this.hospitalprofile = response.data;
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
    height: 170px;
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
    height:311px;
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
  top: 260px;
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