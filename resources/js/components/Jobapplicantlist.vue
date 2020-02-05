<template>
    <div id="job_apply" class="col-12  tab-content">
        <div class="container-fluid">
                <h4 class="main-color m-b-10">求人応募者検索</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="検索" id="search-item"  @keyup="searchApplicantList" />
                                <input type="hidden" class="form-contrl" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <h5 class="header"> 求人応募者一覧</h5>
                <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div>
                <div v-else class="container-fuid">

                <div class="container-fuid scroll_responsive">
                    <table class="table table-hover custom-table">
                        <thead>
                            <tr>
                                <th>姓</th>

                                <th>名</th>

                                <th>生年月日</th>

                                <th>性別</th>

                                <th>郵便番号 </th>

                                <th>街路住所</th>

                                <!-- <th>自宅住所</th> -->

                                <th>電話番号</th>

                                <th style="width:115px;">メールアドレス</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="jobapply in jobapplies.data" :key="jobapply.id">
                                <td>{{jobapply.first_name}}</td>

                                <td>{{jobapply.last_name}}</td>

                                <td>{{jobapply.birtdday}}</td>

                                <td>{{jobapply.gender}}</td>

                                <td>{{jobapply.postal}}</td>

                                <td>{{jobapply.street_address}}</td>

                                <!-- <td>{{jobapply.home_address}}</td> -->

                                <td>{{jobapply.phone}}</td>

                                <td>{{jobapply.email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <!-- <pagination :data="jobapplies" @pagination-change-page="searchApplicantList"></pagination> -->
                            <pagination :data="jobapplies" @pagination-change-page="searchApplicantList" :limit="limitpc">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                            </pagination>
                </div>
        </div>
    </div>
</template>
<script>
export default {

      props:{
                limitpc: {
                type: Number,
                default: 5
            },
        },

   data() {
         return {

                    jobapplies: [],
                    items: [],
                    norecord: 0,
                    nosearch_msg: false,
                };

            },
              created() {
                     this.$loading(true);
                    this.axios.get(`/api/jobapplicantlist/`).then(response => {
                        this.$loading(false);
                        this.jobapplies = response.data;
                        this.norecord = this.jobapplies.data.length;
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
                            if(this.jobapplies.data.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                  },
              }
}
</script>

<style>
.page-item.active .page-link
{
    z-index: 3;
    /* color: #fff; */
    background-color: #D2571C;
    border: 1px solid #D2571C;
    box-shadow: none;
}
.page-link:focus{
    box-shadow: none;
    -webkit-box-shadow: none;
}
.page-link {
    position: relative;
    display: block;
    padding: 12px;
    margin-left: -1px;
    line-height: 12px;
    color: #000000;
    font-weight: bold;
    background-color: #fff;
    border: 1px solid #D2571C;
    margin-left: 5px;
    box-shadow: none;
}

.page-link:hover
{
    background-color: #b7c2b7;
    color: #d2571c;
    border: 1px solid #766666;
}
@media screen and ( max-width: 480px ){
    li.page-item {
        display: none;
    }
   
    .page-item:first-child,
    .page-item:nth-child( 2 ),
    /* .page-item:nth-child( 1 ), */
    .page-item:nth-last-child( 2 ),
    .page-item:last-child,
    .page-item.active,
    .page-item.disabled {
        display: block;
    }
}

</style>
