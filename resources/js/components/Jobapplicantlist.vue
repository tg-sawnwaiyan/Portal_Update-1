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
                 <pagination :data="jobapplies" @pagination-change-page="searchApplicantList"></pagination>
                </div>
        </div>
    </div>
</template>
<script>
export default {
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
