<template>
    <div>
        <div class="d-flex justify-content-end m-b-10" v-if="!norecord_msg">
            <router-link to="/specialfeature" class="main-bg-color create-btn all-btn">
                <i class="fas fa-plus-circle"></i> 特徴新規作成
            </router-link>
        </div>
        <!--card-->
        <div class="col-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/specialfeature" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 新しいデータ作成
                    </a>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color m-b-10">特徴検索</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="特徴検索" id="search-item" @keyup="searchFeature()" />
                        </div>
                    </div>
                    <hr />
                    <h5 class="header">{{title}}</h5>
                    <div class="col-md-12 pad-free scrolldiv p0-480">
                        <div v-if="nosearch_msg" class="container-fuid no_search_data">新規作成するデタが消える。</div>
                        <div v-else class="container-fuid scroll_responsive">
                            <table class="table table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th>特徴名</th>
                                        <th>略語</th>
                                        <!-- <th>カテゴリー</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="feature in features.data" :key="feature.id">
                                        <td>{{feature.name}}</td>
                                        <td>{{feature.short_name}}</td>
                                        <!-- <td>{{feature.type}}</td> -->
                                        <td class="text-right pr-4">
                                            <!-- <button class="btn btn-sm btn-primary all-btn" v-if="getUser.status == 1">Approved</button> -->
                                            <router-link :to="{name:'specialfeature', params:{id : feature.id}}" class="btn edit-borderbtn">編集</router-link>
                                            <button class="btn text-danger delete-borderbtn" @click="deleteFeature(feature.id)">削除</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- <pagination :data="features" @pagination-change-page="searchFeature"></pagination> -->
                            <div>
                              <pagination :data="features" @pagination-change-page="searchFeature" :limit="limitpc">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                            </pagination>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
        </div>
        <!--end card-->
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
                    features: [],
                    norecord: 0,
                    norecord_msg: false,
                    nosearch_msg: false,
                    items: [],
                    title: '',
                };
            },

            created() {
                this.$loading(true);
                if(this.$route.path == "/nusfeaturelist"){
                    this.title = "特徴一覧";
                    this.axios.get("/api/feature/featurelist/nursing").then(response => {
                        this.$loading(false);
                        this.features = response.data;
                        this.norecord = this.features.data.length;
                        if (this.norecord != 0){
                            this.norecord_msg = false;
                        }else {
                            this.norecord_msg = true;
                        }
                    });
                }
                else if(this.$route.path == "/hosfeaturelist"){
                    this.title = "特徴一覧";
                    this.axios.get("/api/feature/featurelist/hospital").then(response => {
                        this.$loading(false);
                        this.features = response.data;
                        this.norecord = this.features.data.length;
                        if (this.norecord != 0){
                            this.norecord_msg = false;
                        }else {
                            this.norecord_msg = true;
                        }
                    });
                }

            },
            methods: {
                deleteFeature(id) {
                        this.$swal({
                            title: "確認",
                            text: "特徴を削除してよろしいでしょうか。",
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
                                .delete(`/api/feature/delete/${id}`)
                                .then(response => {
                                    this.features = response.data;
                                    this.norecord = this.features.data.length;
                                    if (this.norecord > this.size) {
                                        this.pagination = true;
                                    } else {
                                        this.pagination = false;
                                    }
                                    if (this.norecord != 0){
                                        this.norecord_msg = false;
                                    }else {
                                        this.norecord_msg = true;
                                    }
                                    this.$swal({
                                        // title: "削除済",
                                        text: "特徴を削除しました。",
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

                    searchFeature(page) {
                        if (typeof page === 'undefined') {
                        page = 1;
                        }
                        var search_word = $("#search-item").val();
                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        this.$loading(true);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.axios.post("/api/feature/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.features = response.data;
                            if(this.features.data.length != 0){
                                this.nosearch_msg = false;
                            }else {
                                this.nosearch_msg = true;
                            }
                        });
                    },
            }
    };
</script>
