<template>
    <!-- Page Content  -->
    <div id="content">
        <div class="card">
            <div class="card-body">
                <div v-if='status == 1'>
                    <h4 class="page-header header">ニュース編集</h4>
                </div>
                <div v-else>
                    <h4 class="page-header header">ニュース新規作成</h4>
                </div>
                <br>
                <form @submit.prevent="updatepost">
                    <div class="form-group">
                        <label>題名:<span class="error">*</span></label>
                        <input type="text" class="form-control" placeholder="題名を入力してください。" v-model="news.title">
                        <span v-if="errors.title" class="error">{{errors.title}}</span>
                    </div>

                    <div class="form-group" id="showimage">
                        <label class="">写真:</label>
                        <div class="custom-file">
                            <input type="file" ref="file" accept="image/*" @change="fileSelected">
                        </div>
                    </div>

                    <div class="image_show" v-if="upload_img">
                        <div class='col-md-2'>
                            <span class='img-close-btn' v-on:click="removeUpload()">X</span>
                            <img :src="upload_img" class='show-img'>
                        </div>
                    </div>
                    <div class="form-group image_update" id="x-image" v-if ="news.photo && !upload_img && !old_photo">
                        <div class="col-md-12" >
                            <div id='x-image' class='col-md-2'>
                                <span class='img-close-btn' v-on:click='closeBtnMethod(news.photo)'>X</span>
                                <img :src="'/upload/news/'+ news.photo" class='show-img' alt="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>主な情報:<span class="error">*</span></label>
                        <input type="text" class="form-control" placeholder="ニュースの主な情報を入力してください。" v-model="news.main_point">
                        <span v-if="errors.main_point" class="error">{{errors.main_point}}</span>
                    </div>
                    <div class="form-group">
                        <label>カテゴリー:<span class="error">*</span></label>
                            <select v-model="selectedValue" class="form-control" @change='getstates()'>
                                <option v-bind:value="0">選択してください。</option>
                                <option v-for="category in categories" :key="category.id" v-bind:value="category.id">
                                    {{category.name}}
                                </option>
                            </select>
                        <span v-if="errors.category_id" class="error">{{errors.category_id}}</span>
                    </div>
                    <div class="form-group">
                        <label>内容:<span class="error">*</span></label>
                        <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" placeholder="内容を入力してください。" v-model="news.body"></textarea>
                        <span v-if="errors.body" class="error">{{errors.body}}</span>
                    </div>
                    <div class="form-group">
                        <label>関連ニュース:</label>
                        <div class="card related-card">
                            <div class="card-body">
                                <input type="hidden" v-model="old_photo" >
                                <div class="d-sm-flex">
                                    <div class="d-flex align-items-center cat_box">
                                         <label class="cat_lbl"> カテゴリー:</label>
                                        <select v-model="category_id_1" id="categories" class="form-control cat_select" @change='getPostsByCatId()'>
                                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">
                                                {{category.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="search_box">
                                        <input type="text" placeholder="関連ニュース検索" aria-label="search" id="search-word" class="form-control form_search" @keyup='getSearchPostsByCatId()'>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="related_post_box card card-default" v-for="news in displayItems" :key="news.id">
                                        <div class="card-body">
                                            <label class="form-check-label control control--checkbox">
                                                <input type="checkbox" :value="news.id" id="aaa" v-model="checkedNews">
                                                <div id="create_news" class="create_news">
                                                    <p>
                                                         <img :src="'/upload/news/'+ news.photo" class="float-left m-r-10" alt="news" @error="imgUrlAlt">
                                                         {{news.title}}
                                                    </p>
                                                </div>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- <div class="offset-md-4 col-md-8 mt-3" v-if="pagination">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <span class="spanclass" @click="first"><i class='fas fa-angle-double-left'></i> 最初</span>
                                                </li>
                                                <li class="page-item">
                                                    <span class="spanclass" @click="prev"><i class='fas fa-angle-left'></i> 前へ</span>
                                                </li>
                                                <li class="page-item" v-for="(i,index) in displayPageRange" :key="index" :class="{active_page: i-1 === currentPage}">
                                                    <span class="spanclass" @click="pageSelect(i)">{{i}}</span>
                                                </li>
                                                <li class="page-item">
                                                    <span class="spanclass" @click="next">次へ <i class='fas fa-angle-right'></i></span>
                                                </li>
                                                <li class="page-item">
                                                    <span class="spanclass" @click="last">最後 <i class='fas fa-angle-double-right'></i></span>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div> -->
                                    <div class="col-12 mt-3" v-if="pagination">
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
                                                    <span class="spanclass" @click="next"><span class="pc-480">次へ </span><i class='fas fa-angle-right'></i></span>
                                                </li>
                                                <li class="page-item">
                                                    <span class="spanclass pc-480" @click="last">最後 <i class='fas fa-angle-double-right'></i></span>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <input type="hidden" v-model="checkedNews" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="btn main-bg-color white all-btn" @click="checkValidate()" v-if='status == 1'> 保存</span>
                        <span class="btn main-bg-color white all-btn" @click="checkValidate()" v-if='status == 0'> 作成</span>
                        <span @click="$router.go(-1)" :to="{name: 'news_list'}" class="btn btn-danger all-btn">キャンセル</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
                return {
                    selectedValue: 0,
                    status:0,
                    arr: [],
                    errors: {
                        title: "",
                        main_point: "",
                        body: "",
                        category_id: "",
                    },
                    news: {
                        title: '',
                        mainPoint: '',
                        body: '',
                        category_id: '',
                        category_name: '',
                        related_news: '',
                        photo: '',
                    },
                    categories: {
                        id: '',
                        name: ''
                    },
                    category_id_1: '1',
                    related_news: [],
                    checkedNews: [],
                    old_photo: "",
                    upload_img: null,
                    currentPage: 0,
                    size: 12,
                    pageRange: 5,
                    items: [],
                    pagination: false,
                    // check_head: false,
                    search_word:''
                }
            },
            created() {
                if(this.$route.name == "editPost"){
                    this.status = 1;
                    this.axios
                        .get(`/api/new/editPost/${this.$route.params.id}`)
                        .then((response) => {
                            this.news = response.data;
                            this.checkedNews = [];
                            if(this.news.related_news != undefined){
                                this.checkedNews = this.news.related_news.split(',');
                            }
                            else{
                                this.checkedNews = [];
                            }

                            if(this.news.photo == null || this.news.photo == '') {
                                this.old_photo = '';
                            }
                            // console.log(this.news.photo);

                            // this.updateselected();
                            this.selectedValue = this.news.category_id;
                        });
                        this.getPostsByCatId();
                        this.getSearchPostsByCatId();
                 } 
                else {
                    // this.axios.get('/api/category/category_list')
                    // .then(function(response) {
                    //     this.categories = response.data;
                    // }.bind(this));
                    this.getPostsByCatId();
                }
            },
            mounted() {
                this.axios.get('/api/category/category_list')
                .then(function(response) {
                    this.categories = response.data;
                }.bind(this));
            },
            computed: {
            pages() {
                    return Math.ceil(this.related_news.length / this.size);
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
                    // if(this.check_head == true){
                    //     const head = 0;
                    //     return this.related_news.slice(head,head + this.size);
                    // }else{
                        const head = this.currentPage * this.size;
                        return this.related_news.slice(head,head + this.size);
                    // }
                },
                isSelected(page) {
                    return page - 1 == this.currentPage;
                }
        },
            methods: {
                    fileSelected(e) {
                        // $('.image_show').html("<div class='col-md-2'><img src='" + URL.createObjectURL(event.target.files[0]) + "' class='show-img'></div>");

                        // this.upload_img = this.news.photo;

                        this.news.photo = event.target.files[0];
                        this.upload_img = URL.createObjectURL(event.target.files[0]);

                    },
                    // updateselected() {
                    //     $('.image_update').html("<div id='x-image' class='col-md-2'><span class='img-close-btn' onClick='closebtn()'>X</span><img src= upload/news/" + this.news.photo + " class='show-img''></div>");
                    // },
                    removeUpload(e) {
                         this.$swal({
                            title: "確認",
                            text: "削除してよろしいでしょうか",
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
                                this.$swal({
                                        // title: "削除されました",
                                        text: "画像を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                           });
                        this.news.photo = '';
                        this.upload_img = '';
                        this.reset();
                    },
                    reset() {
                        const input = this.$refs.file;
                        input.type = 'text';
                        input.type = 'file';
                    },
                    updatepost() {
                        this.$swal({
                            title:"確認",
                            text: "ニュースを更新よろしいでしょうか。",
                            type: "info",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#6cb2eb",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            let fData = new FormData();
                            fData.append('photo', this.news.photo)
                            fData.append('title', this.news.title)
                            fData.append('main_point', this.news.main_point)
                            fData.append('body', this.news.body)
                            fData.append('category_id', this.news.category_id)
                            fData.append('related_news', this.checkedNews)
                            fData.append('old_photo',this.old_photo)
                            this.$loading(true);
                            this.axios.post(`/api/new/update/${this.$route.params.id}`, fData).then(response => {
                                this.$loading(false);
                                 this.$swal({
                                    position: 'top-end',
                                    type: 'success',
                                    text: 'ニュースを更新しました。',
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#6cb2eb",
                                    width: 250,
                                    height: 200,
                                })

                                this.$router.go(-1);
                            })
                            .catch(error=>{
                            if(error.response.status == 422){
                                this.errors = error.response.data.errors
                            }
                            });
                        });

                    },
                    add() {
                            this.$swal({
                            title: "確認",
                            text: "ニュースを投稿してよろしいでしょうか。",
                            type: "info",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#6cb2eb",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                        let fData = new FormData();
                            fData.append('photo', this.news.photo)
                            fData.append('title', this.news.title)
                            fData.append('main_point', this.news.main_point)
                            fData.append('body', this.news.body)
                            fData.append('category_id', this.news.category_id)
                            fData.append('related_news', this.checkedNews)
                            console.log(fData);
                            this.$loading(true);
                        this.axios.post('/api/new/add', fData)
                            .then(response => {
                            this.$loading(false);
                            this.name = ''
                            console.log(response);
                            this.$swal({
                            position: 'top-end',
                            type: 'success',
                            // title: "確認済",
                            text: 'ニュースを投稿しました。',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            // showConfirmButton: false,
                            // timer: 1800,
                            width: 270,
                            height: 200,
                        })
                                this.$router.push({
                                    name: 'news_list'
                                })
                            }).catch(error=>{

                            if(error.response.status == 422){

                                this.errors = error.response.data.errors
                            }});

                        })
                    },
                    getstates: function() {
                        this.news.category_id = this.selectedValue;
                    },
                    getPostsByCatId: function() {
                        var cat_id = this.category_id_1;
                        this.axios
                        .post('/api/new/getPostsByCatId/' + cat_id)
                        .then(response => {
                            this.related_news = response.data;
                            // this.check_head = true;
                            if(this.related_news.length > this.size) {
                                this.pagination = true;
                            }else{
                                this.pagination = false;
                            }
                        });
                    },
                    getSearchPostsByCatId: function() {
                        var cat_id = this.category_id_1;
                        if(this.search_word == '') {
                            var search_word = this.search_word;
                        }  else {
                            var search_word = $('#search-word').val();
                        }

                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        fd.append("selected_category", cat_id);
                        this.axios.post("/api/news_list/search", fd).then(response => {
                            this.related_news = response.data;
                            this.check_head = true;
                            if(this.related_news.length > this.size) {
                                this.pagination = true;
                            }else{
                                this.pagination = false;
                            }
                        });
                        this.search_word = '1';
                    },
                    closeBtnMethod: function(old_photo) {
                        // console.log(old_photo);
                        if(confirm)
                        {
                            this.$swal({
                            title: "削除",
                            text: "画像を削除してよろしいでしょうか。",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#d41010",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                            }).then(response =>{
                            var image_x = document.getElementById('x-image');
                            image_x.parentNode.removeChild(image_x);
                            document.getElementById('showimage').style.display = 'block';
                           }).then(response => {
                                this.$swal({
                                        // title: "削除されました",
                                        text: "画像を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                                    this.old_photo = old_photo;
                                    this.getPostsByCatId;
                           });

                        }
                    },
                    checkValidate() {
                        if (this.news.title) {
                            this.errors.title = "";
                        } else {
                            this.errors.title = "ニュースの題名が必須です。";
                        }
                        if (this.news.main_point) {
                            this.errors.main_point = "";
                        } else {
                            this.errors.main_point = "ニュースの主な情報が必須です。";
                        }
                        if (this.news.body) {
                            this.errors.body = "";
                        } else {
                            this.errors.body = "ニュースの内容が必須です。";
                        }
                        if (this.news.category_id) {
                            this.errors.category_id = "";
                        } else {
                            this.errors.category_id = "ニュースのカテゴリーが必須です。";
                        }
                        if (
                            !this.errors.title &&
                            !this.errors.main_point &&
                            !this.errors.body &&
                            !this.errors.category_id
                        ) {
                            if(this.status == 0) {
                                this.add();
                            } else {
                                this.updatepost();
                            }
                        }
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
    }
</script>
