<template>
    <!-- Page Content  -->
    <div id="news_list">       
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">                
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p class="record-txt01">ニュースが登録されていません。</p>
                    <router-link to="/create_news" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> ニュース新規作成
                    </router-link>
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
                    
                    <!-- <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div> -->

                    <div v-if="nosearch_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                     <p class="record-txt01">検索したデータ見つかりません。</p>
                </div> 

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
                                    <h5 class="align-middle"><span v-if="newsList.category_id == 26" class="breaking-tip" style="font-size: 12px;line-height: 12px;">PR</span>
                                        <router-link
                                            :to="{name: 'newdetails', params:{id:newsList.id}}"
                                            class="pseudolink"
                                        >{{newsList.title}}</router-link>
                                    </h5>                                   
                                    <p class="mt-2">{{newsList.main_point}}</p>
                                     <div class="card-title-rightwrapper model-7 mt-2">                                                 
                                        <div class="checkbox">
                                            <input type='checkbox' :id="newsList.id" v-if="newsList.recordstatus == 1" @click="changeActivate(newsList.id,newsList.recordstatus)" checked/>
                                            <input type='checkbox' :id="newsList.id" v-if="newsList.recordstatus == 0" @click="changeActivate(newsList.id,newsList.recordstatus)"  />
                                            <label for="checkbox"></label>
                                            <div  v-if="newsList.recordstatus == 1" class="on">公開中</div>
                                            <div v-if="newsList.recordstatus == 0" class="on">非公開</div>
                                        </div>                                                                                             
                                    </div>
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
                activate_text: '',
            };
        },
        created() {
            this.$loading(true);
            this.getResults();

        },
        methods: {
            changeActivate(id,activate, $event){
                if(activate == 1)
                {
                this.activate_text = "非公開にしてよろしいでしょうか。";
                }
                else{
                    this.activate_text = "公開してよろしいでしょうか。";
                }
            
                this.$swal({
                    allowOutsideClick: false,
                    text: this.activate_text,
                    type: "warning",
                    width: 350,
                    height: 200,
                    showCancelButton: true,
                    confirmButtonColor: "#eea025",
                    cancelButtonColor: "#b1abab",
                    cancelButtonTextColor: "#000",
                    confirmButtonText: "はい",
                    cancelButtonText: "キャンセル",
                    confirmButtonClass: "all-btn",
                    cancelButtonClass: "all-btn"
                }).then(response => {
                    this.axios.get(`/api/changeRecordstatus/${id}`)
                        .then(response => {
                            this.getResults();
                    });
                
                }).catch(error =>{
                    if(activate == 1){
                        $("#"+id).prop("checked", true);
                    }else{
                        $("#"+id).prop("checked", false);
                    }                
                });
            },
            getResults() {
                this.$http.get('/api/news_list')
                    .then(response => {

                        this.news_list = response.data.news;
                        this.categories = response.data.category;
                        this.norecord = this.news_list.data.length                       
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
                        // title: "確認",
                        text: "ニュースを削除してよろしいでしょうか。",
                        type: "warning",
                        width: 350,
                        height: 200,
                        showCancelButton: true,
                        confirmButtonColor: "#eea025",
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
                                    confirmButtonColor: "#31cd38",
                                     allowOutsideClick: false,
                                });
                            })
                            .catch(() => {
                                this.$swal({                                  
                                    html: "システムエラーです。<br/>社内エンジニアにお問い合わせください。<br/><a href='mailto:pg@management-partners.co.jp'>pg@management-partners.co.jp</a>",
                                    type: "error",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#FF5462",
                                    allowOutsideClick: false,
                                });
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
