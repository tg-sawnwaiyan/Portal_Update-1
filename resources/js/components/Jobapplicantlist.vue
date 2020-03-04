<template>
    <div id="job_apply">
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">
                <h4 class="main-color mb-3">求人応募者検索 <a @click="$router.go(-1)" v-if="$route.params.id" class="btn btn-danger all-btn submit float-right">戻る</a></h4>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="検索" id="search-item"  @keyup="searchApplicantList" />
                        <input type="hidden" class="form-contrl" />
                    </div>
                </div>
                <hr />
                <h5 class="header"> 求人応募者一覧 <span v-if="this.$route.params.id"> 「{{job_title}} <span class="pro_num">({{jobapplies.data[0].jobid}})</span>」 </span></h5>


                <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div>
                <div v-else class="container-fuid">
                    <div class="card card-default m-b-20" v-for="jobapply in jobapplies.data" :key="jobapply.id">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="joboffer-tit clearfix">
                                        <p><span class="text-primary">姓:</span>{{jobapply.first_name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-3  text-right">
                                        <button :class="'btn btn drop-bg-color changeLink'+jobapply.id"  @click="applicatnToggle(jobapply.id)">
                                        詳細 <i :id="'icon' + jobapply.id" class="fas fa-sort-down animate rotate"></i></button>
                                    </div>
                                </div>
                                <p><span class="text-primary">名:</span>{{jobapply.last_name}}
                                            <!-- <span class="text-orange"><span class="job_count">{{job.count}}件</span></span> -->
                                </p>
                                <p><span class="text-primary">メールアドレス:</span><span>{{jobapply.email}}</span></p>
                                <div class="collapse" :id="'changeLink' + jobapply.id">                                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">&#xa5;</span>生年月日 :</span><span class=""> {{jobapply.birtdday}}</span></p>
                                            </td>
                                            <td class="w-50">
                                                <!-- <p><span class="text-primary">性別:</span><span>{{jobapply.gender}}</span></p>   -->
                                                 <p class="mb-2"><span class="text-orange"><span class="job_ico"><i class="fa fa-briefcase"></i></span> 性別 :</span><span class=""> {{jobapply.gender}}</span></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">★</span> 郵便番号 :</span><span class=""> {{jobapply.postal}}</span></p>
                                            </td>
                                            <td  class="w-50">
                                                    <p><span class="text-primary"><span class="job_ico"><i class="fa fa-map-marker-alt"></i></span>街路住所:</span>{{jobapply.street_address}}</p> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico"><img src="/images/icons8-phone.png" width="75%"></span> 電話番号 :</span><span class=""> {{jobapply.phone}}</span></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                    
                            </div>
                        </div>

                    <!-- <div class="container-fuid scroll_responsive">
                        <table class="table table-hover custom-table">
                            <thead>
                                <tr>
                                    <th>姓</th>

                                    <th>名</th>

                                    <th>生年月日</th>

                                    <th>性別</th>

                                    <th>郵便番号 </th>

                                    <th>街路住所</th> -->

                                    <!-- <th>自宅住所</th> -->

                                    <!-- <th>電話番号</th>

                                    <th style="width:115px;">メールアドレス</th>
                                </tr>
                            </thead>
                            <tbody> -->
                                <!-- <tr  v-for="jobapply in jobapplies.data" :key="jobapply.id">
                                    <td>{{jobapply.first_name}}</td>

                                    <td>{{jobapply.last_name}}</td>

                                    <td>{{jobapply.birtdday}}</td>

                                    <td>{{jobapply.gender}}</td>

                                    <td>{{jobapply.postal}}</td>

                                    <td>{{jobapply.street_address}}</td> -->

                                    <!-- <td>{{jobapply.home_address}}</td> -->

                                    <!-- <td>{{jobapply.phone}}</td>

                                    <td>{{jobapply.email}}</td>
                                </tr>
                            </tbody>
                        </table> -->
                    <!-- </div> -->
                    <!-- <pagination :data="jobapplies" @pagination-change-page="searchApplicantList"></pagination> -->
                    <pagination :data="jobapplies" @pagination-change-page="searchApplicantList" :limit="limitpc" class="mt-3">
                        <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                        <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

      props:{
                limitpc: {
                type: Number,
                default: 5,
            },
        },

   data() {
         return {

                    jobapplies: [],
                    items: [],
                    norecord: 0,
                    nosearch_msg: false,
                    job_id:0,
                    job_title: ''
                };

            },
              created() {
                  if (this.$route.params.id) {
                       this.job_id = this.$route.params.id;
                  }
                  else{
                      this.job_id = 0;
                  }
                    this.$loading(true);
                    this.axios.get(`/api/jobapplicantlist/`+this.job_id).then(response => {
                        console.log("list",response.data)
                        this.$loading(false);
                        this.jobapplies = response.data;
                        console.log("jobapplies",this.jobapplies)
                        this.job_title = this.jobapplies.data[0].title;
                        console.log("title",this.jobapplies.data[0]);
                        this.norecord = this.jobapplies.length;
                      
                        if (this.norecord > this.size) {
                            this.pagination = true;
                        } else {
                            this.pagination = false;
                        }
                    });
              },
              methods: {
                  searchApplicantList(page) {
                      if(typeof page === "undefined"){
                          page = 1;
                      }
                      var search_word = $("#search-item").val();

                      let fd = new FormData();
                        fd.append("search_word", search_word);
                        this.$loading(true);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.axios.post("/api/jobapplicant/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.jobapplies = response.data;
                            console.log("this.jobappliessearch",this.jobapplies);
                            if(this.jobapplies.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                  },
                  applicatnToggle(id) {
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
              }
}
</script>

