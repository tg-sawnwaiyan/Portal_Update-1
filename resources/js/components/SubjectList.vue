<template>
    <div>
        <div class="d-flex justify-content-end m-b-10" v-if="!norecord_msg">
            <router-link to="/subject" class="main-bg-color create-btn all-btn">
                <i class="fas fa-plus-circle"></i> 診療科目新規作成
            </router-link>
        </div>
        <div class="col-12 tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                    <a href="/subject" class="main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 新しく作る
                    </a>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color m-b-10">診療科目検索</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="診療科目検索" id="search-item" @keyup="searchSubject()">
                        </div>
                        <!-- <div class="col-md-2">
                        <button class="btn secondary-bg-color all-btn white">検索</button>
                    </div> -->
                    </div>
                    <hr/>
                    <h5 class="header">診療科目一覧</h5>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">新規作成するデタが消える。</div>
                    <div v-else class="container-fuid">
                        <div class="card card-default m-b-20" v-for="subject in subjects.data" :key="subject.id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-8 m-t-8">{{subject.name}}</div>
                                        <div class="col-md-6 col-sm-4 text-right admin_page_edit">
                                            <router-link :to="{name:'subject', params:{id : subject.id}}" class="btn edit-borderbtn">編集</router-link>
                                            <button class="btn text-danger delete-borderbtn" @click="deleteSubject(subject.id)">削除</button>                                      </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <pagination :data="subjects" @pagination-change-page="searchSubject"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
                return {
                    subjects: [],
                    norecord: 0,
                    norecord_msg: false,
                    nosearch_msg: false,
                    items: [],
                }
            },
            created() {
                this.$loading(true);
                this.axios
                    .get('/api/subjects/subject')
                    .then(response => {
                        this.$loading(false);
                        this.subjects = response.data;
                        this.norecord = this.subjects.data.length;
                        if (this.norecord != 0){
                            this.norecord_msg = false;
                        }else {
                            this.norecord_msg = true;
                        }
                    });
            },
            methods: {
                deleteSubject(id) {
                        this.$swal({
                            title: "確認",
                            text: "診療科目を削除してよろしいでしょうか。",
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
                            this.axios.delete(`/api/subjects/delete/${id}`)
                                .then(response => {
                                    this.subjects = response.data;
                                    this.norecord = this.subjects.data.length;
                                    if (this.norecord != 0){
                                        this.norecord_msg = false;
                                    }else {
                                        this.norecord_msg = true;
                                    }
                                    //    let i = this.subjects.map(item => item.id).indexOf(id); // find index of your object
                                    //     this.subjects.splice(i, 1)
                                    this.$swal({
                                        // title: "削除済",
                                        text: "診療科目を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                                }).catch(() => {
                                    this.$swal("失礼しました。", "サーバーに問題があります。");
                                });
                        });
                    },
                    searchSubject(page) {
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                        var search_word = $("#search-item").val();

                        let fd = new FormData();
                        fd.append("search_word", search_word)
                        this.$loading(true);
                        this.axios.post("/api/subjects/search?page="+page, fd).then(response => {
                        this.$loading(false);
                        this.subjects = response.data;
                        if(this.subjects.data.length != 0) {
                            this.nosearch_msg = false;
                        }else{
                            this.nosearch_msg = true;
                        }
                        });
                    },
            }
    }
</script>
