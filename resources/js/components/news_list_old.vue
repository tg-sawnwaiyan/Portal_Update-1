<template>
    <!-- Page Content  -->
    <div>
        <div class="d-flex justify-content-end m-b-10" v-if="!norecord_msg">
            <router-link to="/create_news" class="main-bg-color create-btn all-btn">
                <i class="fas fa-plus-circle"></i> ニュース新規作成
            </router-link>
        </div>
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>                
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <router-link to="/create_news" class="main-bg-color create-btn alt-btn">
                        <i class="fas fa-plus-circle"></i> 新しいデータ作成
                    </router-link>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color m-b-10">ニュース検索</h4>
                    <!-- Testing Start -->
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <input type="text" class="form-control w-75 w-sm-100" placeholder="ニュース検索" id="search-item" @keyup="searchbyCategory()" />
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class=" d-flex  justify-content-md-end align-items-center">
                            <label for="selectBox" class="w-sm-25">カテゴリー</label>
                            <select  id="selectBox" class="form-control w-65 w-sm-75 ml-2" @change="searchbyCategory()">
                                    <option selected="selected" value>全体</option>
                                    <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <h5 class="header">ニュース一覧</h5>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">新規作成するデタが消える。</div> 

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
                                        >{{newsList.title}}</router-link>
                                    </h5>
                                    <p class="mt-2">{{newsList.main_point}}</p>
                                    <div class="d-flex mt-4">
                                        <router-link :to="{ path:'/editPost/'+ newsList.id}" class="btn edit-borderbtn">編集</router-link>
                                        <button class="btn delete-borderbtn ml-2" @click="deletePost(newsList.id)">削除</button>
                                    </div>
                                </td>
                            </tr>
                                <pagination :data="news_list" @pagination-change-page="getResults"></pagination>
                        </table>
                    </div>
                    <!-- Testing End -->

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
                currentPage: 0,
                size: 10,
                pageRange: 5,
                items: [],
                pagination: false,
            };
        },
        created() {

            this.$loading(true);
            this.getResults();

        },
        methods: {
            getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                this.$http.get('/api/news_list?page=' + page)
                    .then(response => {

                        this.news_list = response.data.news;
                        this.categories = response.data.category;

                        this.norecord = this.news_list.length
                        if(this.norecord > this.size) {
                            this.pagination = true;
                        } else {
                            this.pagination = false;
                        }
                        if(this.norecord != 0){
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }

                        this.$loading(false);
                    });
            },

            deletePost(id) {
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
                            .delete(`/api/new/delete/${id}`)
                            .then(response => {
                                this.news_list = response.data;

                                this.norecord = this.news_list.length;
                                if (this.norecord > this.size) {
                                    this.pagination = true;
                                } else {
                                    this.pagination = false;
                                }
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

                searchbyCategory() {
                    var search_word = $("#search-item").val();

                    var selected_category = document.getElementById("selectBox").value;
                    let fd = new FormData();
                    fd.append("search_word", search_word);
                    fd.append("selected_category", selected_category);
                    this.$loading(true);
                    this.axios.post("/api/news_list/search", fd).then(response => {
                        this.$loading(false);
                        this.news_list = response.data;
                        this.norecord = this.news_list.length;
                        if(this.news_list.length > this.size){
                            this.pagination = true;
                        }else{
                            this.pagination = false;
                        }
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
<style>

</style>
