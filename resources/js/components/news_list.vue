<template>
    <!-- Page Content  -->
    <div id="news_list">       
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/create_news" class="main-bg-color create-btn alt-btn">
                        <i class="fas fa-plus-circle"></i> ニュース新規作成
                    </a>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color mb-3">ニュース検索</h4>
                    <div class="row mb-4">
                        <div class="col-12 col-sm-6">
                            <input type="text" class="form-control w-75 w-sm-100" placeholder="ニュース検索" id="search-item" @keyup="searchbyCategory()" />
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class=" d-flex  justify-content-md-end align-items-center">
                            <label for="selectBox" class="select_label  mr-2">カテゴリー</label>
                            <select  id="selectBox" class="form-control select_box" @change="searchbyCategory()">
                                    <option selected="selected" value>全体</option>
                                    <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex header pb-3 admin_header">
                        <h5>ニュース一覧</h5>
                        <div class="ml-auto" v-if="!norecord_msg">
                            <router-link to="/create_news" class="main-bg-color create-btn all-btn">
                                <i class="fas fa-plus-circle"></i> <span class="first_txt">ニュース</span><span class="dinone">新規作成</span>
                            </router-link>
                        </div>
                    </div>
                    
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div> 

                    <div v-else class="container-fuid">
                        <table class="table List_tbl">
                            <tr v-for="newsList in news_list.data" :key="newsList.id">
                                <td>
                                    <div v-if="newsList.photo !=null">
                                        <img :src="'/upload/news/'+ newsList.photo"   @error="imgUrlAlt" />
                                    </div>
                                    <div  v-else> <img src="/images/noimage.jpg" alt  /></div>
                                </td>
                                <td>
                                    <h5>
                                        <router-link
                                            :to="{name: 'newdetails', params:{id:newsList.id}}"
                                            class="pseudolink"
                                        >{{newsList.title}}</router-link>
                                    </h5>
                                    <p class="mt-2">{{newsList.main_point}}</p>
                                    <div class="d-flex mt-4">
                                        <router-link :to="{ path:'/editPost/'+ newsList.id}" class="btn edit-borderbtn">編集</router-link>
                                        <button class="btn delete-borderbtn ml-2" @click="deletePost(newsList.id)">削除</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- <pagination :data="news_list" @pagination-change-page="searchbyCategory"></pagination> -->
                         <div>
                              <pagination :data="news_list" @pagination-change-page="searchbyCategory" :limit="limitpc">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                            </pagination>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Content end  -->
</template>

<script>
    export default {
        components: {
        },
           props:{
          
          limitpc: {
                type: Number,
                default: 5
            },
        },

        data() {
            return {
                news_list: [],

                norecord: 0,
                norecord_msg: false,
                nosearch_msg: false,
                categories: {
                    id: "",
                    name: ""
                },
                isOpen: false,
                items: [],
                pagination: false,
            };
        },
        created() {

            this.$loading(true);
            this.getResults();

        },
        methods: {
            getResults() {

                this.$http.get('/api/news_list')
                    .then(response => {

                        this.news_list = response.data.news;
                        this.categories = response.data.category;
                        this.norecord = this.news_list.length
                        // if(this.norecord > this.size) {
                        //     this.pagination = true;
                        // } else {
                        //     this.pagination = false;
                        // }
                        if(this.norecord != 0){
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }

                        this.$loading(false);
                    });
            },

            deletePost(id) {
                   var selected_category = document.getElementById("selectBox").value;
                   if(selected_category == null || selected_category == '')
                   {
                       selected_category = 0;
                   }
              
                    this.$swal({
                        title: "確認",
                        text: "ニュースを削除してよろしいでしょうか。",
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
                       
                       this.$loading(true);
                        this.axios
                            .delete(`/api/new/delete/${id}`+'/'+selected_category)
                            .then(response => {
                                this.news_list = response.data;

                                this.norecord = this.news_list.length;
                                // if (this.norecord > this.size) {
                                //     this.pagination = true;
                                // } else {
                                //     this.pagination = false;
                                // }
                                if(this.norecord != 0){
                                    this.norecord_msg = false;
                                }else{
                                    this.norecord_msg = true;
                                }
                                 this.$loading(false);

                                this.$swal({
                                    text: "ニュースを削除しました。",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#dc3545",
                                     allowOutsideClick: false,
                                });
                            })
                            .catch(() => {
                                this.$swal("Failed", "wrong");
                            });
                    });
                },
                searchbyCategory(page) {

                    if (typeof page === 'undefined') {
                        page = 1;
                    }
                    var search_word = $("#search-item").val();

                    var selected_category = document.getElementById("selectBox").value;
                    let fd = new FormData();
                    fd.append("search_word", search_word);
                    fd.append("selected_category", selected_category);
                    fd.append("postid",null);
                    this.$loading(true);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    this.axios.post("/api/news_list/search?page="+page, fd).then(response => {
                        this.$loading(false);
                        this.news_list = response.data;
                        this.norecord = this.news_list.data.length;
                        // if(this.news_list.length > this.size){
                        //     this.pagination = true;
                        // }else{
                        //     this.pagination = false;
                        // }
                        if(this.norecord != 0) {
                            this.nosearch_msg = false;
                        }else{
                            this.nosearch_msg = true;
                        }
                    });
                },
                imgUrlAlt(event) {
                    event.target.src = "/images/noimage.jpg"
                },
        }
    };
</script>
