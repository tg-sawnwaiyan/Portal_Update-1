<template>
    <div class="row">
        <div class="col-12">
            <div class="row m-b-10" v-if="!norecord_msg">
                <div class="col-md-12">
                    <router-link to="/joboffercreate" class="float-right main-bg-color create-btn all-btn" style="color: blue;">
                        <i class="fas fa-plus-circle"></i> 新しい求人票を作成
                    </router-link>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="../index.html">ホーム</a></li>
                            <li class="breadcrumb-item"><a href="../news/news_details.html"> 新しい詳細</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
          就職活動リスト</li>-->
                </ol>
            </nav>
            <div class="col-md-12 col-md-12 tab-content tab-content1 tabs pad-free border-style">
                <div class="col-md-12 scrolldiv">
                    <div v-if="norecord_msg" class="card card-default m-b-20 card-wrap">
                        <p class="record-ico">
                            <i class="fa fa-exclamation"></i>
                        </p>
                        <p>OOPS!!</p>
                        <p class="record-txt01">表示するデータありません</p>
                        <p>表示するデータありません‼新しいデータを作成してください。</p>
                        <a href="/joboffercreate" class="main-bg-color create-btn all-btn">
                            <i cl ass="fas fa-plus-circle"></i> 新しい求人票を作成
                        </a>
                    </div>

                    <div v-else class="container-fuid">
                        <h4 class="main-color m-b-10">求人採用検索</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="検索" id="search-item" @keyup="searchJobOffer()" />
                                        <input type="hidden" class="form-contrl" id="customer-id" v-model="customer_id" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h5 class="header">求人採用一覧</h5>
                        <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div>
                        <div v-else class="container-fuid">
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
                        <div class="card card-default m-b-20" v-for="job in displayItems" :key="job.id">
                            <div class="card-body joboffer-body">
                                <div class="row">
                                    <div class="col-md-12 m-t-8">
                                        <div class="joboffer-header">
                                            <h5 class="joboffer-tit clearfix">
                            <router-link :to="{name: 'job_details', params:{id:job.id,loginuser:loginuser}}">{{job.title}} </router-link>
                            <!-- <span class="job_id">jobapplylistcount{{job.count}}</span> -->
                            <span class="text-orange"><span class="job_count">{{job.count}}件</span></span>
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
                                    <div v-if="job.recordstatus == 1" class="on">オン</div>
                                    <div v-if="job.recordstatus == 0" class="on">オフ</div> 
                                     
                                    <!-- <span>OFF</span>  -->

                             </div>
                           </div>
                           
                        <!-- <div>
                            <button class="btn confirmed" v-if="job.recordstatus == 1" @click="confirm(job.id)">OFF</button>

                            <button class="btn confirm-borderbtn" v-if="job.recordstatus == 0" @click="confirm(job.id)">ON</button>
                        </div> -->

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
                                                    <router-link :to="{name: 'jobapplylist', params:{id:job.id}}" class="btn confirm-borderbtn confirmed">求人応募一覧ページへ</router-link>
                                                </li>
                                                <!-- <li><a class="btn text-success active-borderbtn">Disabled</a></li> -->
                                                <li><a class="btn text-danger delete-borderbtn" @click="deleteJob(job.id)">削除</a></li>
                                            </ul>
                                        </div>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="offset-md-4 col-md-8 mt-3" v-if="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <span class="spanclass pc-480" @click="first"><i class='fas fa-angle-double-left'></i> 最初</span>
                                    </li>
                                    <li class="page-item">
                                        <span class="spanclass" @click="prev"><i class='fas fa-angle-left'></i><span class="pc-paginate"> 前へ</span></span>
                                    </li>
                                    <li class="page-item" v-for="(i,index) in displayPageRange" :key="index" :class="{active_page: i-1 === currentPage}">
                                        <span class="spanclass" @click="pageSelect(i)">{{i}}</span>
                                    </li>
                                    <li class="page-item">
                                        <span class="spanclass" @click="next"><span class="pc-paginate">次へ </span><i class='fas fa-angle-right'></i></span>
                                    </li>
                                    <li class="page-item">
                                        <span class="spanclass pc-480" @click="last">最後 <i class='fas fa-angle-double-right'></i></span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        //  mounted(){

        //     this.count = this.countJobapplylist()

        // },
        data() {
                return {
                    jobs: [],
                    customer_id: "",
                    count: "",
                    job_id: [],
                    currentPage: 0,
                    size: 1,
                    pageRange: 5,
                    items: [],
                    pagination: false,
                    loginuser: true,
                    norecord_msg: false,
                    nosearch_msg: false,
                    subtitle: 'OFF'
                   
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
                this.getAllJobs();
                this.axios.get('/api/user').then(response => {
                this.pro_id = response.data.lat_lng[0].id;
                this.loginuser = true;
                }).catch((error) => {
                    this.loginuser = false;
                })

                // this.countJobapplylist(this.job_id);
            },
            computed: {
            pages() {
                    return Math.ceil(this.jobs.length / this.size);
                },
                displayPageRange() {
                    const half = Math.ceil(this.pageRange / 2);
                    const isEven = this.pageRange / 2 == 0;
                    const offset = isEven ? 1 : 2;
                    let start, end;
                    if (this.pages < this.pageRange) {
                        start = 1;
                        end = this.pages;
                    } else if (this.currentPage < half) {
                        start = 1;
                        end = start + this.pageRange - 1;
                    } else if (this.pages - half < this.currentPage) {
                        end = this.pages;
                        start = end - this.pageRange + 1;
                    } else {
                        start = this.currentPage - half + offset;
                        end = this.currentPage + half;
                    }
                    let indexes = [];
                    for (let i = start; i <= end; i++) {
                        indexes.push(i);
                    }
                    return indexes;
                },
                displayItems() {
                    const head = this.currentPage * this.size;
                    return this.jobs.slice(head, head + this.size);
                },
                isSelected(page) {
                    return page - 1 == this.currentPage;
                }
            },
            methods: {
                   getAllJobs() {
                    this.$loading(true);
                    this.axios.get("/api/job/index").then(response => {
                        this.$loading(false);
                        this.jobs = response.data.profilejob;
                  
                        this.customer_id = response.data.user;
                        if (this.jobs.length > this.size) {
                        this.pagination = true;
                        } else {
                            this.pagination = false;
                        }
                        if(this.jobs.length != 0){
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }

                    });
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
                            text: "削除よろしいでしょうか",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "削除",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios
                                .delete(`/api/job/delete/${id}`)
                                .then(response => {
                                    let i = this.jobs.map(item => item.id).indexOf(id); // find index of your object
                                    this.jobs.splice(i, 1);
                                    this.$swal({
                                        title: "削除済",
                                        text: "仕事を削除されました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "はい",
                                        confirmButtonColor: "#dc3545"
                                    });
                                })
                                .catch(() => {
                                    this.$swal("Failed", "wrong");
                                });
                        });
                    },
                    searchJobOffer() {
                        var search_word = $("#search-item").val();

                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        this.axios.post("/api/job/search", fd).then(response => {
                            this.jobs = response.data;
                            if (this.jobs.length > this.size) {
                            this.pagination = true;
                            } else {
                                this.pagination = false;
                            }
                            if(this.jobs.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                    },
                first() {
                    this.currentPage = 0;
                },
                last() {
                    this.currentPage = this.pages - 1;
                },
                prev() {
                    if (0 < this.currentPage) {
                        this.currentPage--;
                    }
                },
                next() {
                    if (this.currentPage < this.pages - 1) {
                        this.currentPage++;
                    }
                },
                pageSelect(index) {
                    this.currentPage = index - 1;
                },
            }
    };
</script>
<style>

/*eee*/


/*=====================*/
.checkbox {
  position: relative;
  display: inline-block;
}
.checkbox:after, .checkbox:before {
  font-family: FontAwesome;
  -webkit-font-feature-settings: normal;
          font-feature-settings: normal;
  -webkit-font-kerning: auto;
          font-kerning: auto;
  -webkit-font-language-override: normal;
          font-language-override: normal;
  font-stretch: normal;
  font-style: normal;
  font-synthesis: weight style;
  font-variant: normal;
  font-weight: normal;
  text-rendering: auto;
}
.checkbox label {
  width: 90px;
  height: 42px;
  background: #ccc;
  position: relative;
  display: inline-block;
  border-radius: 46px;
  transition: 0.4s;
}
.checkbox label:after {
  content: '';
  position: absolute;
  width: 50px;
  height: 50px;
  border-radius: 100%;
  left: 0;
  top: -5px;
  z-index: 2;
  background: #fff;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  transition: 0.4s;
}
.checkbox input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: 5;
  opacity: 0;
  cursor: pointer;
}
.checkbox input:hover + label:after {
  box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
}
.checkbox input:checked + label:after {
  left: 40px;
}
.model-7 .checkbox label {
    background: none;
    border: 2px solid #555;
    height: 22px;
    width: 50px;
  
}
.model-7 .checkbox label:after {
  background: #555;
  box-shadow: none;
  top: 1px;
  left: 2px;
  width: 16px;
  height: 16px;

}
.model-7 .checkbox input:checked + label {
  border-color: #329043;
}
.model-7 .checkbox input:checked + label:after {
  background: #3fb454;
  left: 26px;
}
.model-7 .checkbox:after, .model-11 .checkbox:before{
 /* content: 'ON'; */
  position: absolute;
  right: 7px;
  top: 6px;
  font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
  font-size: 9px;
  color:#555;
}
.model-7 .checkbox:before {
  /* content: 'OFF'; */
  position: absolute;
  left:-1px;
  top: 6px;
  font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
  font-size: 9px;
  color: #555;
}

.on{
    margin-left: 56px;
    margin-top: -32px;
    font-size: 15px;
    font-weight: bold;
}


</style>
