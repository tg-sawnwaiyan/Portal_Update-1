<template>
    <div id="job_apply">
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">
                <h4 class="main-color mb-3">求人応募者検索 <a @click="$router.go(-1)" v-if="$route.params.id" class="btn btn-danger all-btn submit float-right"><i class="fas fa-arrow-left"></i>&nbsp;戻る</a></h4>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="検索" id="search-item"  @keyup="searchApplicantList()" />
                        <input type="hidden" class="form-contrl" />
                    </div>
                </div>
                <hr /> 

               

                <h5  class="header"> 求人応募者一覧 
                    <span v-if="page == 'job' && job_id != ''"> 
                        「{{job_title}} <span class="pro_num">({{job_id}})</span>」
                    </span>
              
                    <span  class="pro_num" v-if="page == 'profile' && proname != ''">
                        「{{proname}}」
                    </span>
                </h5>
            
                    
                <!-- <div v-if="nosearch_msg" class="container-fuid no_search_data">求人応募者が登録されていません</div> -->
                  <div v-if="nosearch_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                    <i class="fa fa-exclamation"></i>
                    </p>                   
                    <p class="record-txt01">求人応募者が登録されていません</p>
                </div>
                <div v-else class="container-fuid">
                    <div class="card card-default m-b-20"  v-for="jobapply in jobapplies.data" :key="jobapply.id">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="joboffer-tit clearfix">
                                        <p><span class="text-primary">姓:&nbsp;</span>{{jobapply.first_name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-3  text-right">
                                        <button :class="'btn btn drop-bg-color changeLink'+jobapply.id"  @click="applicatnToggle(jobapply.id)">
                                        詳細 <i :id="'icon' + jobapply.id" class="fas fa-sort-down animate rotate"></i></button>
                                    </div>
                                </div>
                                <p><span class="text-primary">名:&nbsp; </span>{{jobapply.last_name}}
                                            <!-- <span class="text-orange"><span class="job_count">{{job.count}}件</span></span> -->
                                </p>
                                <p><span class="text-primary">メールアドレス:&nbsp;</span><span>{{jobapply.email}}</span></p>
                                <div class="collapse" :id="'changeLink' + jobapply.id">                                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">&#xa5;</span>生年月日:&nbsp;</span><span class=""> {{jobapply.birthday}}</span></p>
                                            </td>
                                            <td class="w-50">
                                                <!-- <p><span class="text-primary">性別:</span><span>{{jobapply.gender}}</span></p>   -->
                                                 <p class="mb-2"><span class="text-orange"><span class="job_ico"><i class="fa fa-user"></i></span> 性別:&nbsp;</span><span class=""> {{jobapply.gender}}</span></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico">★</span> 郵便番号:&nbsp;</span><span class=""> {{jobapply.postal}}</span></p>
                                            </td>
                                            <td  class="w-50">
                                                    <p><span class="text-primary"><span class="job_ico"><i class="fa fa-map-marker-alt"></i></span>街路住所:&nbsp;</span>{{jobapply.street_address}}</p> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="w-50">
                                                    <p class="mb-2"><span class="text-orange"><span class="job_ico"><img src="/images/icons8-phone.png" width="75%"></span> 電話番号:&nbsp;</span><span class=""> {{jobapply.phone}}</span></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <span class="btn delete-borderbtn mr-2 mb-2" @click="jobApplicantDelete(jobapply.id)">削除</span>
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
            search_id:0,
            job_title: '',
            type: null,
            page: null,
            job_id:'',
            proname:''
        };

    },
    created() {
        this.getJobapplicantList();
    },

    methods: {
        searchApplicantList(page) {

            if(typeof page === "undefined"){
                page = 1;
            }
           
            var search_word = $("#search-item").val();

            let fd = new FormData();
            fd.append("search_word", search_word);
            fd.append("search_id",this.search_id);
            fd.append("pages",this.page);
            fd.append("type",this.type);
            this.$loading(true);
            $("html, body").animate({ scrollTop: 0 }, "slow");
            this.axios.post("/api/jobapplicant/search?page="+page, fd).then(response => {
                this.$loading(false);
                this.jobapplies = response.data;
                if(this.jobapplies.data.length != 0){
                    
                     this.nosearch_msg = false;
                }
                else{
                     this.nosearch_msg = true;
                }
                if(this.jobapplies.data.length != 0 && this.page == 'job')
                {
                     this.job_id = this.jobapplies.data[0].jobid;
                     this.job_title = this.jobapplies.data[0].job_title;
                }
                else if(this.jobapplies.data.length  && this.page == 'profile'){
                    this.proname = this.jobapplies.data[0].proname;
                }
        
            });
        },
        
        getJobapplicantList(){
            if(this.$route.name == 'jobapplicantlist'){
                this.search_id = 0;
                this.type = 'admin';
                this.page = null;  
            }
            else{                        
                this.type = this.$route.params.type;
                this.search_id = this.$route.params.id;                        
                this.page = this.$route.params.page;                        
            }
            this.$loading(true);
            this.axios.get("/api/jobapplicantlist/"+this.type+"/"+this.page+"/"+this.search_id).then(response => {
                this.$loading(false);
                this.jobapplies = response.data;
                if(this.jobapplies.data.length != 0){
                    
                     this.nosearch_msg = false;
                }
                else{
                     this.nosearch_msg = true;;
                }
             
                if(this.jobapplies.data.length != 0 && this.page == 'job')
                {
                     this.job_id = this.jobapplies.data[0].jobid;
                     this.job_title = this.jobapplies.data[0].job_title;
                }
                else if(this.page == 'profile'){
                    this.proname = this.jobapplies.data[0].proname;
                   
                }
                
                // this.norecord = this.jobapplies.data.length;
              
            
                // if (this.norecord > this.size) {
                //     this.pagination = true;
                // } else {
                //     this.pagination = false;
                // }
            });
        },

        applicatnToggle(id) {
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

        jobApplicantDelete(id){
            this.$swal({
                title: "確認",
                text: "求人応募者を削除してよろしいでしょうか。",
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
                cancelButtonClass: "all-btn",
                allowOutsideClick: false,
            }).then(response => {
                this.axios.delete(`/api/jobApplicantDelete/${id}`)
                        .then(res => {
                        this.getJobapplicantList();
                    });
                this.$swal({
                    text: "求人応募者を削除しました。",
                    type: "success",
                    width: 350,
                    height: 200,
                    confirmButtonText: "閉じる",
                    confirmButtonColor: "#dc3545",
                    allowOutsideClick: false,
                });
            });                       
        }
    }
}
</script>

