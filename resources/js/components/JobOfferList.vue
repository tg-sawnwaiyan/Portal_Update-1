<template>
    <div id="joboffer_list">
        <div class="col-12 tab-content">
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.html">ホーム</a></li>
                            <li class="breadcrumb-item"><a href="../news/news_details.html"> 新しい詳細</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
          就職活動リスト</li>
                </ol>
            </nav> -->
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default m-b-20 card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p style="color:#a5a5a5;">表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/joboffercreate" class="main-bg-color create-btn all-btn">
                        <i cl ass="fas fa-plus-circle"></i> 求人新規作成
                    </a>
                </div>

                <div v-else class="container-fuid">
                    <h4 class="main-color mb-3">求人検索</h4>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="検索" id="search-item" @keyup="searchJobOffer()" />
                            <input type="hidden" class="form-contrl" id="customer-id" v-model="customer_id" />                               
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex header pb-3 admin_header">
                        <h5>求人一覧</h5>
                        <div class="ml-auto" v-if="!norecord_msg">
                            <router-link to="/joboffercreate" class="main-bg-color create-btn all-btn">
                                <i class="fas fa-plus-circle"></i> <span class="first_txt"> 求人</span><span>新規作成</span>
                            </router-link>
                        </div>
                    </div>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div>
                    <div v-if="$auth.check(1)" class="container-fuid">
                        <div class="card card-default m-b-20" v-for="job in jobs.data" :key="job.id">
                            <div class="card-body joboffer-body">
                                <div class="row">
                                    <div class="col-md-12 m-t-8">
                                        <div class="joboffer-header">
                                            <h5 class="joboffer-tit clearfix">
                                                <router-link :to="{name: 'job_details', params:{id:job.id,loginuser:loginuser}}">{{job.title}} </router-link>
                                                <!-- <span class="job_id">jobapplylistcount{{job.count}}</span> -->
                                                <span class="float-right">応募者数:
                                                <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
                                                </span>
                                                <!-- <label class="switch">
                                                    <input type="checkbox" v-if="job.recordstatus != 1" >
                                                    <input type="checkbox" v-else @click="confirm(job.id)">
                                                    <span class="slider round"></span>
                                                </label> -->
                                                <div class="model-7">
                                                    <div class="checkbox">
                                                            <input type='checkbox' v-if="job.recordstatus == 1" @click="confirm(job.id)" checked/>
                                                            <input type='checkbox' v-if="job.recordstatus==0" @click="confirm(job.id)"  />
                                                            <label for="checkbox"></label>
                                                            <div v-if="job.recordstatus == 1" class="on">公開中</div>
                                                            <div v-if="job.recordstatus == 0" class="on">非行化</div>

                                                            <!-- <span>OFF</span>  -->

                                                        </div>
                                                </div>
                                                <span class="job_id">求人番号：{{job.jobid}}</span>
                                            </h5>
                                        </div>

                                        <div class="joboffer-body">

                                            <p class="mb-2"><span class="text-orange"><span class="job_ico">&#xa5;</span>給料 :</span><span class=""> {{job.salary}}</span></p>
                                            <p class="mb-2"><span class="text-orange"><span class="job_ico">★</span> スキル :</span><span class=""> {{job.skills}}</span></p>
                                            <ul class="btn-list mt-4">
                                                <li>
                                                    <router-link :to="{name: 'joboffercreate', params:{id:job.id}}" class="btn edit-borderbtn">編集</router-link>
                                                </li>
                                                <li>
                                                    <router-link :to="{path: '/jobapplicantlist/'+job.id, params:{title:job.title}}" class="btn confirm-borderbtn confirmed">求人応募一覧ページへ</router-link>
                                                </li>
                                                <!-- <li><a class="btn text-success active-borderbtn">Disabled</a></li> -->
                                                <li><a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fuid" v-if="$auth.check(2)">
                        <div class="card card-default m-b-20" v-for="job in jobs.data" :key="job.id">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="joboffer-tit clearfix">
                                            <router-link :to="{name: 'job_details', params:{id:job.id,loginuser:loginuser}}">{{job.title}} </router-link>
                                            
                                        </div>
                                    </div>
                                    <div class="col-3  text-right">
                                        <!-- <button :class="'btn drop-bg-color changeLink'+job.id"  @click="jobToggle(job.id)">
                                        <i :id="'icon' + job.id" class="fas fa-sort-down animate rotate"></i> 詳細</button> -->
                                        <p class="float-right">応募者数:
                                            <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="model-7 col-6">
                                        <div class="checkbox">
                                            <input type='checkbox' v-if="job.recordstatus == 1" @click="confirm(job.id)" checked/>
                                            <input type='checkbox' v-if="job.recordstatus==0" @click="confirm(job.id)"  />
                                            <label for="checkbox"></label>
                                            <div v-if="job.recordstatus == 1" class="on">公開中</div>
                                            <div v-if="job.recordstatus == 0" class="on">非行化</div>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <button :class="'btn drop-bg-color changeLink'+job.id"  @click="jobToggle(job.id)">
                                        詳細 <i :id="'icon' + job.id" class="fas fa-sort-down animate rotate"></i></button>
                                        <!-- <p class="float-right">応募者数:
                                            <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
                                        </p> -->
                                    </div>
                                </div>
                                
                                    <div class="collapse" :id="'changeLink' + job.id">
                                        <div class="d-flex mt-3 mb-2">
                                            <!-- <p class="">応募者数:
                                            <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
                                            </p> -->
                                            <p class="job_id mt-0  d-flex align-items-center">求人番号：{{job.jobid}}</p>
                                        </div>
                                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">&#xa5;</span>給料 :</span><span class=""> {{job.salary}}</span></p>
                                            </td>
                                            <td class="w-50">
                                                <p><span class="text-primary">事業者名:</span><span>{{job.name}}</span></p>  
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">★</span> スキル :</span><span class=""> {{job.skills}}</span></p>
                                            </td>
                                            <td  class="w-50">
                                                    <p><span class="text-primary">施設名:</span><span v-for="profile_name in job.profile_name" :key="profile_name.id">{{profile_name.name}}</span></p> 
                                            </td>
                                        </tr>
                                    </table>
                                    <ul class="btn-list mt-4">
                                        <li>
                                            <router-link :to="{name: 'joboffercreate', params:{id:job.id}}" class="btn edit-borderbtn">編集</router-link>
                                        </li>                           
                                        <li><a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a></li>
                                        <li class="mt-2" v-if="job.count">
                                            <router-link :to="{path: '/jobapplicantlist/'+job.id, params:{title:job.title}}" class="btn confirm-borderbtn confirmed">求人応募一覧ページへ</router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <table class="table table-hover custom-table">
                            <tbody>
                                <tr  v-for="job in jobs.data" :key="job.id">
                                    <th>
                                        <h5 class="joboffer-tit clearfix">
                                            <router-link :to="{name: 'job_details', params:{id:job.id,loginuser:loginuser}}">{{job.title}} </router-link>
                                            <div class="model-7">
                                                <div class="checkbox">
                                                    <input type='checkbox' v-if="job.recordstatus == 1" @click="confirm(job.id)" checked/>
                                                    <input type='checkbox' v-if="job.recordstatus==0" @click="confirm(job.id)"  />
                                                    <label for="checkbox"></label>
                                                    <div v-if="job.recordstatus == 1" class="on">公開中</div>
                                                    <div v-if="job.recordstatus == 0" class="on">非行化</div>
                                                </div>
                                            </div>
                                        </h5>
                                    </th>
                                    <th>
                                        <p><span>事業者名:</span><span>{{job.name}}</span></p>
                                        <p><span >施設名:</span><span v-for="profile_name in job.profile_name" :key="profile_name.id">{{profile_name.name}}</span></p>
                                    </th>

                                    <th>
                                        <p class="mb-2"><span class="text-orange"><span class="job_ico">&#xa5;</span>給料 :</span><span class=""> {{job.salary}}</span></p>
                                        <p class="mb-2"><span class="text-orange"><span class="job_ico">★</span> スキル :</span><span class=""> {{job.skills}}</span></p>
                                    </th>

                                    <th>
                                        <span class="">応募者数:
                                            <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
                                        </span><br>
                                        <span class="job_id" style="float: left">求人番号：{{job.jobid}}</span>
                                    </th>

                                    <th>
                                        <ul class="btn-list mt-4">
                                            <li>
                                                <router-link :to="{name: 'joboffercreate', params:{id:job.id}}" class="btn edit-borderbtn">編集</router-link>
                                            </li>
                                            <li><a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a></li>
                                            <li>
                                                <router-link :to="{name: 'jobapplylist', params:{id:job.id,title:job.title}}" class="btn confirm-borderbtn confirmed">求人応募一覧ページへ</router-link>
                                            </li>
                                        </ul>
                                    </th>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                    <!-- <pagination :data="jobs" @pagination-change-page="searchJobOffer"></pagination> -->
                    <div>
                            <pagination :data="jobs" @pagination-change-page="searchJobOffer" :limit="limitpc">
                            <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                            <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>

                            <!-- <table class="table table-hover custom-table">
              <thead style="background-color:rgb(183, 218, 210);">
                <tr>
                  <th>施設種別</th>
                  <th>仕事内容</th>
                  <th>雇用形態</th>
                 <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="job in jobs" :key="job.id">
                  <th>
                    <p> {{job.title}}</p>
                  </th>
                  <th>
                    <p>{{job.description}}</p>
                  </th>
                  <th>{{job.employment_status}}</th>
                  <th class="text-right">

                    <small>
                      <router-link
                        :to="{name: 'joboffercreate', params:{id:job.id}}"
                        class="btn edit-borderbtn"
                      >編集</router-link>
                    </small>
                    <small>
                      <a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a>
                    </small>
                   <router-link
                        :to="{name: 'jobapplylist', params:{id:job.id}}"
                        class="btn edit-borderbtn">jobapplylist</router-link>

                  </th>
                </tr>
              </tbody>
            </table> -->

                        <!-- <div>
                            <button class="btn confirmed" v-if="job.recordstatus == 1" @click="confirm(job.id)">OFF</button>

                            <button class="btn confirm-borderbtn" v-if="job.recordstatus == 0" @click="confirm(job.id)">ON</button>
                        </div> -->






                                        <!-- <label>
                      <strong>Title :</strong>
                      {{job.title}}
                    </label>
                    <br />
                    <label>
                      <strong>Description :</strong>
                      {{job.description}}
                    </label>
                    <br />
                    <label>
                      <strong>Type :</strong>
                      {{job.employment_status}}
                    </label>
                    <br />
                    <small>
                      <router-link
                        :to="{name: 'joboffercreate', params:{id:job.id}}"
                        class="btn edit-borderbtn"
                      >編集</router-link>
                    </small> &nbsp;
                    <small>
                      <a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a>
                    </small> -->



</template>
<script>
    export default {

           props:{
          
          limitpc: {
                type: Number,
                default: 5
            },
        },
        //  mounted(){

        //     this.count = this.countJobapplylist()

        // },
        data() {
                return {
                    jobs: [],
                    customer_id: "",
                    count: "",
                    job_id: [],
                    items: [],
                    loginuser: true,
                    norecord_msg: false,
                    nosearch_msg: false,
                    subtitle: 'OFF',
                    pro_id: 0,

                };
            },

            created() {
                //     this.axios.get("/api/job/index").then(response => {
                //     console.log(response.data);
                //     this.jobs = response.data.profilejob;
                //     this.customer_id = response.data.user;
                //     if (this.jobs.length > this.size) {
                //     this.pagination = true;
                //     } else {
                //         this.pagination = false;
                //     }

                // });
                

                if(this.$route.name == "profilejobofferlist"){
                    this.pro_id = this.$route.params.id;
                    this.type = this.$route.params.type;
                }
                else{
                    this.pro_id = null;
                    this.type = 'admin';
                }
                this.getAllJobs();
                
                this.axios.get('/api/user').then(response => {
                // this.pro_id = response.data.lat_lng[0].id;
                this.loginuser = 'true';
                }).catch((error) => {
                    this.loginuser = 'false';
                })

                // this.countJobapplylist(this.job_id);
            },
            methods: {
                   getAllJobs() {
                    this.$loading(true);
                    this.axios.get("/api/job/index/"+this.type+"/"+this.pro_id).then(response => {
                        this.$loading(false);
                        this.jobs = response.data.profilejob;
                        console.log('result',this.jobs)
                        this.customer_id = response.data.user;
                        if(this.jobs.data.length != 0){
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }

                    });
                },
                jobToggle(id) {
                    console.log(id);
                        var class_by_id = $('#icon' + id).attr('class');
                        if (class_by_id == "fas fa-sort-down animate rotate") {
                            $('#icon' + id).removeClass("fas fa-sort-down animate rotate");
                            $('.changeLink' + id).removeClass("fas fa-sort-down animate");
                            $('#icon' + id).addClass("fas fa-sort-down animate");
                            $('#changeLink' + id).show('medium');
                        } else {

                            $('#icon' + id).removeClass("fas fa-sort-down animate");
                            $('.changeLink' + id).removeClass("fas fa-sort-down animate");
                            $('#icon' + id).addClass("fas fa-sort-down animate rotate");
                            $('#changeLink' + id).hide('medium');
                        }

                    },

                //  confirm(id) {
                //     console.log(id);
                //             this.axios.get(`/api/job/confirm/${id}`)
                //                 .then(response => {
                //                     this.jobs = response.data.jobs;
                //                     // const path = `/jobofferlist/`;
                //                     // // if ($route.path !== path) this.$router.push(path);
                //                     // this.$router.push('/jobofferlist/').catch(err => {
                //                     //     console.log('no go');
                //                     // })
                //                     location.reload();
                //                 });


                //     },
                confirm(id) {

                    this.axios.get(`/api/job/confirm/${id}`)
                        .then(response => {


                            // this.jobs = response.data.jobs;
                            this.getAllJobs();
                        });


                    },
                deleteJob(id) {
                        this.$swal({
                            title: "確認",
                            text: "求人を削除してよろしいでしょうか。",
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
                            this.axios
                                .delete(`/api/job/delete/${id}`)
                                .then(response => {
                                    // let i = this.jobs.map(item => item.id).indexOf(id); // find index of your object
                                    // this.jobs.splice(i, 1);
                                    this.jobs = response.data.profilejob;
                                    this.customer_id = response.data.user;
                                    if(this.jobs.data.length != 0){
                                        this.norecord_msg = false;
                                    }else{
                                        this.norecord_msg = true;
                                    }
                                    this.$swal({
                                        text: "求人を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                                })
                                .catch(() => {
                                    this.$swal("Failed", "wrong");
                                });
                        });
                    },
                    searchJobOffer(page) {
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                        var search_word = $("#search-item").val();

                        let fd = new FormData();
                        fd.append("search_word", search_word);
                         this.$loading(true);
                         $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.axios.post("/api/job/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.jobs = response.data.jobsearch;
                            if(this.jobs.data.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                    },
            }
    };
</script>
<style>

/*eee*/


/*=====================*/

</style>
