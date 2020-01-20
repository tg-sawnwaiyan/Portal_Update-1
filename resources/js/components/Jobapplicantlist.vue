<template>
     <div class="row">
         <div class="col-12">
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

                        <div class="container-fuid">
                            <table class="table table-hover custom-table">
                                <thead style="background-color:rgb(183, 218, 210);">
                                    <tr>
                                         <th>姓</th>

                                        <th>名</th>

                                        <th>生年月日</th>

                                        <th>性別</th>

                                        <th>郵便番号 </th>

                                        <th>街路住所</th>

                                        <!-- <th>自宅住所</th> -->

                                        <th>電話番号</th>

                                        <th>メールアドレス</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="jobapply in displayItems" :key="jobapply.id">

                                         <th>{{jobapply.first_name}}</th>

                                        <th>{{jobapply.last_name}}</th>

                                        <th>{{jobapply.birthday}}</th>

                                        <th>{{jobapply.gender}}</th>

                                        <th>{{jobapply.postal}}</th>

                                        <th>{{jobapply.street_address}}</th>

                                        <!-- <th>{{jobapply.home_address}}</th> -->

                                        <th>{{jobapply.phone}}</th>

                                        <th>{{jobapply.email}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12" v-if="pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <span class="spanclass pc-480" @click="first"><i class='fas fa-angle-double-left'></i> 最初</span>
                                            </li>
                                            <li class="page-item">
                                                <span class="spanclass" @click="prev"><i class='fas fa-angle-left'></i> <span class="pc-paginate">前へ</span></span>
                                            </li>
                                            <li class="page-item" v-for="(i,index) in displayPageRange" :key="index" :class="{active_page: i-1 === currentPage}">
                                                <span class="spanclass" @click="pageSelect(i)">{{i}}</span>
                                            </li>
                                            <li class="page-item">
                                                <span class="spanclass" @click="next"><span class="pc-paginate">次へ</span> <i class='fas fa-angle-right'></i></span>
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
   data() {

                return {

                    jobapplies: [],
                    currentPage: 0,
                    size: 10,
                    pageRange: 5,
                    items: [],
                    pagination: false,
                    norecord: 0,
                    nosearch_msg: false,
                };

            },
              created() {
                     this.$loading(true);
                    this.axios.get(`/api/jobapplicantlist/`).then(response => {
                        this.$loading(false);
                        this.jobapplies = response.data;
                        this.norecord = this.jobapplies.length;
                        if (this.norecord > this.size) {
                            this.pagination = true;
                        } else {
                            this.pagination = false;
                        }
                    });
              },
              computed: {
                pages() {
                        return Math.ceil(this.jobapplies.length / this.size);
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
                        return this.jobapplies.slice(head, head + this.size);
                    },
                    isSelected(page) {
                        return page - 1 == this.currentPage;
                    }
            },
              methods: {
                  searchApplicantList() {
                      var search_word = $("#search-item").val();

                      let fd = new FormData();
                        fd.append("search_word", search_word);
                        this.axios.post("/api/jobapplicant/search", fd).then(response => {
                            this.jobapplies = response.data;
                            if (this.jobapplies.length > this.size) {
                            this.pagination = true;
                            } else {
                                this.pagination = false;
                            }
                            if(this.jobapplies.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                  },
                //   first() {
                //     this.currentPage = 0;
                // },
                // last() {
                //     this.currentPage = this.pages - 1;
                // },
                // prev() {
                //     if (0 < this.currentPage) {
                //         this.currentPage--;
                //     }
                // },
                // next() {
                //     if (this.currentPage < this.pages - 1) {
                //         this.currentPage++;
                //     }
                // },
                // pageSelect(index) {
                //     this.currentPage = index - 1;
                //     window.scrollTo(0,0);
                // },
                  first() {
                    this.currentPage = 0;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                },
                last() {
                    this.currentPage = this.pages - 1;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                },
                prev() {
                    if (0 < this.currentPage) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.currentPage--;
                    }
                },
                next() {
                    if (this.currentPage < this.pages - 1) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.currentPage++;
                    }
                },
                pageSelect(index) {
                    this.currentPage = index - 1;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    // window.scrollTo(0,0);
                },
              }
}
</script>
