<template>
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card  text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="page-header header">施設一覧</h4>
                                <br>
                            </div>
                            <div class="row col-12 m-lr-0" v-if="type == 'nursing'">
                            <div class="col-md-3 m-b-10 nursing_responsive"  v-for="nursingprofiles in nursingprofile" :key="nursingprofiles.id">
                                <div class="card h-100 ">
                                    <!-- <img :src="logo" id="thumbnil" class="profile_logo m-b-8" alt="Logo"  @error="imgUrlAlt" width="200px" > -->
                                    <!-- <img :src="'/upload/nursing_profile/'+ nursingprofile.logo" id="thumbnil" class="profile_logo m-b-8" alt="Logo"  width="200px" > -->
                                   <div class="card-body nus_account">
                                       <div class="img_title">
                                            <img :src="'/upload/nursing_profile/'+ nursingprofiles.logo" alt="aa" @error="imgUrlAlt" />
                                       </div>
                                          <p class="acc_color"><strong>{{nursingprofiles.name}}</strong></p>
                                          <p v-if="nursingprofiles.email">{{nursingprofiles.email}}</p>
                                          <router-link :to="{ path:'/profile/nursing/'+ nursingprofiles.id}" class="btn btn-success" style="font-weight:bold;">Edit</router-link>
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
</template>
<script>
export default {
    data() {
       return{
            nursingprofile:[],
            type:null,
            hospitalprofile:[],
             
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
                console.log("aaa",this.nursingprofile);
            });
            } else {
                this.axios.get(`/api/account_hospital/${this.cusid}`).then(response => {
                    //this.$loading(false);
                    this.hospitalprofile = response.data;
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
</style>