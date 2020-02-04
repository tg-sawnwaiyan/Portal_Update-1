<template>
    <div id="ads_list">
        <div class="d-flex justify-content-end m-b-10" v-if="!norecord_msg">
            <router-link to="/advertisement" class="main-bg-color create-btn all-btn">
                <i class="fas fa-plus-circle"></i> 広告新規作成
            </router-link>
        </div>
        <div class="col-md-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/advertisement" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 新しいデータ作成
                    </a>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color m-b-10">広告検索</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="広告検索" id="search-item" @keyup="searchAdvertisment()" />
                        </div>
                    </div>
                    <hr />
                    <h5 class="header">広告一覧</h5>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">新規作成するデタが消える。</div>
                    <div v-else class="container-fuid">
                        <table  class="table List_tbl">
                            <tr  v-for="ads in advertisements.data" :key="ads.id">
                                <td>
                                    <div>
                                        <img :src="'/upload/advertisement/'+ ads.photo" class="img-fluid" alt="ads" @error="imgUrlAlt" />
                                    </div>
                                </td>
                                <td>
                                    <h5  class="mb-2"><strong>タイトル</strong></h5>
                                    <p>{{ads.title}}</p>
                                    <!-- <div class="col-md-2 max-width16"><strong>描写  :</strong></div><div class="col-md-10">{{ads.description}}</div> -->
                                    <div class="d-flex mt-4">
                                        <router-link :to="{name: 'editadvertisement', params: { id: ads.id }}" class="btn edit-borderbtn">編集</router-link>
                                        <button class="btn delete-borderbtn ml-2" @click="deleteAds(ads.id)">削除</button>
                                        <!-- <button class="btn delete-borderbtn" @click="toggleModal">削除</button>                                 -->
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- <div v-for="ads in displayItems" :key="ads.id" class="card card-default m-b-20">
                            <div class="card-body news-post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img :src="'/upload/advertisement/'+ ads.photo" class="img-fluid" alt="ads" @error="imgUrlAlt" />
                                    </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class=" col-md-3 custom_title">
                                            <strong>タイトル :</strong>
                                        </div>
                                        <div class="col-md-9">{{ads.title}}</div>
                                    </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <router-link :to="{name: 'editadvertisement', params: { id: ads.id }}" class="btn edit-borderbtn">編集</router-link>
                                                <button class="btn delete-borderbtn" @click="deleteAds(ads.id)">削除</button>
                                            </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <pagination :data="advertisements" @pagination-change-page="searchAdvertisment"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
                return {
                    advertisements: [],
                    isOpen: false,
                    norecord: 0,
                    items: [],
                    norecord_msg: false,
                    nosearch_msg: false,
                };
            },
            created() {
                this.$loading(true);
                this.axios.get("/api/advertisement/ads").then(response => {
                    this.$loading(false);
                    this.advertisements = response.data;
                    this.norecord = this.advertisements.data.length;
                    if(this.norecord != 0) {
                        this.norecord_msg = false;
                    }else{
                        this.norecord_msg = true;
                    }
                });
            },
            methods: {
                // toggleModal() {
                //     this.isOpen = !this.isOpen;
                // },
                deleteAds(id) {
                        this.$swal({
                            title: "確認",
                            text: "広告を削除してよろしいでしょうか。",
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
                            this.axios.delete(`/api/advertisement/delete/${id}`).then(response => {
                                this.advertisements = response.data;
                                this.norecord = this.advertisements.data.length;
                                if(this.norecord != 0) {
                                    this.norecord_msg = false;
                                }else{
                                    this.norecord_msg = true;
                                }
                                //alert("Delete Successfully!");
                                //   let a = this.advertisements.map(item => item.id).indexOf(id);
                                //   this.advertisements.splice(a, 1);
                                this.$swal({
                                    // title: "削除済",
                                    text: "広告を削除しました。",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#dc3545"
                                });
                            });
                        })

                    },

                    searchAdvertisment(page) {
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                        var search_word = $("#search-item").val();
                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        this.$loading(true);
                        this.axios.post("/api/advertisement/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.advertisements = response.data;
                            if(this.advertisements.data.length != 0){
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                    },
                    imgUrlAlt(event) {
                        event.target.src = "images/noimage.jpg"
                    },
            }
    }
</script>
