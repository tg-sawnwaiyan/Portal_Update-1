<template>
    <!-- Page Content  -->
    <div>
        <div class="d-flex justify-content-end m-b-10" v-if="!norecord_msg">
            <router-link to="/create_news" class="main-bg-color create-btn all-btn">
                <i class="fas fa-plus-circle"></i> ニュース新規作成
            </router-link>
        </div>
        <div class="col-md-12  tab-content tab-content1 tabs pad-free">
            <div class="scrolldiv">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/create_news" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 新しいデータ作成
                    </a>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color m-b-10">ニュース検索</h4>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-6 float-left">
                                    <input type="text" class="form-control" placeholder="ニュース検索" id="search-item" @keyup="searchbyCategory()" />
                                </div>
                                <div class="col-6 float-right row align-items-baseline">
                                    <label for="selectBox col-2 col-form-label">カテゴリー</label>
                                    <div class="col-10">
                                        <select class="form-control" id="selectBox" @change="searchbyCategory()">
                                            <option selected="selected" value>全体</option>
                                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
                            <tr v-for="newsList in displayItems" :key="newsList.id">
                                <td>
                                    <div v-if="newsList.photo !=null">
                                        <img :src="'/upload/news/'+ newsList.photo"   @error="imgUrlAlt" />
                                    </div>
                                    <div  v-else> <img src="images/noimage.jpg" alt  /></div>
                                </td>
                                <td>
                                    <h5>
                                        <router-link
                                            :to="{name: 'newdetails', params:{id:newsList.id}}"
                                        >{{newsList.title}}</router-link>
                                        <!-- <router-link :to="{name: 'joh4_details', params:{id:news_list.id}}" class="mr-auto">{{news_list.title}}<router-link> -->
                                        <!-- <a hrဖef="../news/news_details.html" class="mr-auto">{{newsList.title}} </a> -->
                                    </h5>
                                    <p class="mt-2">{{newsList.main_point}}</p> 
                                    <div class="d-flex mt-4">
                                        <router-link :to="{name: 'editPost', params: {id: newsList.id}}" class="btn edit-borderbtn">編集</router-link>&nbsp;
                                        <!-- <a class="mr-auto text-danger btn delete-borderbtn" @click="deletePost(newsList.id)">削除</a> -->
                                        <button class="mr-auto text-danger btn delete-borderbtn" @click="deletePost(newsList.id)">削除</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                         
                        
                        <div class="col-12" v-if="pagination">
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
    <!-- Page Content end  -->
</template>

<script>
    import modal from "./modal.vue";
    export default {
        components: {
            modal
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
            this.axios.get("/api/news_list").then(response => {
                this.$loading(false);
                console.log(response.data)
                this.news_list = response.data;
                this.norecord = this.news_list.length
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
            });

        },
        mounted() {
            this.axios.get("/api/category/category_list").then(
                function(response) {
                    console.log(response.data)
                    this.categories = response.data;
                }.bind(this)
            );
        },
        computed: {
            pages() {
                    return Math.ceil(this.news_list.length / this.size);
                },
                displayPageRange() {
                    const half = Math.ceil(this.pageRange / 2);
                    const isEven = this.pageRange % 2 == 0;
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
                    return this.news_list.slice(head, head + this.size);
                },
                isSelected(page) {
                    return page - 1 == this.currentPage;
                }
        },
        methods: {
            // toggleModal() {
            //     this.$emit('toggleModal');
            // },
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
                        cancelButtonClass: "all-btn"
                    }).then(response => {
                        this.axios
                            .delete(`/api/new/delete/${id}`)
                            .then(response => {
                                console.log(response.data)
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
                                // let i = this.news_list.map(item => item.id).indexOf(id);
                                // this.news_list.splice(i, 1);
                                this.$swal({
                                    // title: "削除済",
                                    text: "ニュースを削除しました。",
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
                    event.target.src = "images/noimage.jpg"
                },
                first() {
                    this.currentPage = 0;
                    window.scrollTo(0,0);
                },
                last() {
                    this.currentPage = this.pages - 1;
                    window.scrollTo(0,0);
                },
                prev() {
                    if (0 < this.currentPage) {
                        this.currentPage--;
                    }
                    window.scrollTo(0,0);
                },
                next() {
                    if (this.currentPage < this.pages - 1) {
                        this.currentPage++;
                    }
                    window.scrollTo(0,0);
                },
                pageSelect(index) {
                    this.currentPage = index - 1;
                    window.scrollTo(0,0);
                },
        }
    };
</script>
<style>

</style>
