<template>
    <!-- Page Content  -->
    <div id="news_post">
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
                        <label>題名: <span class="error sp2">必須</span></label>
                        <input type="text" class="form-control" placeholder="題名を入力してください。" v-model="news.title">
                        <span v-if="errors.title" class="error">{{errors.title}}</span>
                    </div>

                    <div class="form-group" id="showimage">
                        <label class="">写真:</label>
                        <!-- <div class="custom-file">
                            <input type="file" ref="file" accept="image/*" @change="fileSelected">
                        </div> -->
                        <div class="d-flex align-items-center">
                            <span class="btn-file d-inline-block">画像を選択        
                                <input type="file" ref="file" accept="image/*" @change="fileSelected">
                            </span> 
                            <span class="pl-4">{{img_name}}</span>
                        </div>                    
                        
                    </div>                    
                    
                    <div class="image_show" v-if="upload_img ">
                        <div class='col-md-2'>
                            <!-- <span class='img-close-btn test' v-on:click="removeUpload()" v-if='status == 1'>X</span> -->
                            <img :src="upload_img" class='show-img' @error="imgUrlAlt">
                        </div>
                    </div>  
    
                    <div  class="form-group image_update" id="x-image" v-if ="noimage == 0 && news.photo && !upload_img && !old_photo">
                        <div class="col-md-12" >
                            <div id='x-image' class='col-md-2' >
                                <span class='img-close-btn' v-on:click='closeBtnMethod(news.photo)'>X</span>
                                <img :src="'/upload/news/'+ news.photo" class='show-img' alt="" @error="imgUrlAlt1">
                            </div>
                        </div>
                    </div>
                 
                    <div class="form-group">
                        <label>内容要約: <span class="error sp2">必須</span></label>
                        <input type="text" class="form-control" placeholder="ニュースの内容要約を入力してください。" v-model="news.main_point">
                        <span v-if="errors.main_point" class="error">{{errors.main_point}}</span>
                    </div>
                    <div class="form-group">
                        <label>カテゴリー: <span class="error sp2">必須</span></label>
                            <select v-model="selectedValue" class="form-control" @change='getstates()'>
                                <option v-bind:value="0">選択してください。</option>
                                <option v-for="category in categories" :key="category.id" v-bind:value="category.id">
                                    {{category.name}}
                                </option>
                            </select>
                        <span v-if="errors.category_id" class="error">{{errors.category_id}}</span>
                    </div>
                    <div class="form-group">
                        <label>内容: <span class="error sp2">必須</span></label>
                        <quill-editor  ref="myQuilEditor" id="exampleFormControlTextarea1" class="rounded-0" placeholder="内容を入力してください。"  @change="onDetailInfoEditorChange($event)" v-model="news.body" :options="editorOption" @blur="onEditorBlur($event)" @focus="onEditorFocus($event)"/>
                        <span v-if="errors.body" class="error">{{errors.body}}</span>
                    </div>
                    <div class="form-group">
                        <label>関連ニュース</label>
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

                                <div class="row m-0">
                                    <div class="related_post_box card card-default" v-for="r_news in related_news.data" :key="r_news.id">
                                        <div class="card-body">
                                            <label class="form-check-label control control--checkbox">
                                                <input type="checkbox" :value="r_news.id" id="aaa" v-model="checkedNews">
                                                <div id="create_news" class="create_news">
                                                    <p>
                                                         <img :src="'/upload/news/'+ r_news.photo" class="float-left m-r-10" alt="news" @error="imgUrlAlt">
                                                         {{r_news.title}}
                                                    </p>
                                                </div>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <pagination :data="related_news" @pagination-change-page="getPostsByCatId"></pagination>
                                </div> -->

                                 <div>
                              <pagination :data="related_news" @pagination-change-page="getSearchPostsByCatId" :limit="limitpc" class="mt-3">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                            </pagination>
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
import 'quill/dist/quill.snow.css'
import {quillEditor} from 'vue-quill-editor'

    export default {
        components: {
            quillEditor
        },
           props:{
            limitpc: {
                type: Number,
                default: 5
            },
        },

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
                    search_word:'',
                    img_name : '',
                    noimage:0,
                }
            },
            created() {
                this.noimage = 0;
                this.getResults();
            },
            mounted() {
                this.axios.get('/api/category/category_list')
                .then(function(response) {
                    this.categories = response.data;
                }.bind(this));
            },
            methods: {
                
                getResults() {
                   
                    if(this.$route.name == "editPost"){
                        this.status = 1;
                        this.axios
                            .get(`/api/new/editPost/${this.$route.params.id}`)
                            .then((response) => {
                                this.news = response.data;
                               
                               this.noimage = 0;
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
                                this.selectedValue = this.news.category_id;
                        });
                        this.getPostsByCatId();
                        this.getSearchPostsByCatId();
                    } 
                    else {
                        this.getPostsByCatId();
                    }
                },
                    fileSelected(e) {
                        this.news.photo = event.target.files[0];
                        this.upload_img = URL.createObjectURL(event.target.files[0]);
                        const file =event.target.files[0];
                        this.img_name = file.name;
                    },
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
                                        text: "画像を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                           }).then(response => {
                            this.img_name = '';
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
                    onDetailInfoEditorChange({ editor, html, text }) {
                        this.news['body'] = html
                    },
                    updatepost() {
                        this.$swal({
                            title:"確認",
                            text: "ニュースを更新してよろしいでしょうか。",
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
                            this.$loading(true);
                        this.axios.post('/api/new/add', fData)
                            .then(response => {
                            this.$loading(false);
                            this.name = ''
                            this.$swal({
                            position: 'top-end',
                            type: 'success',
                            text: 'ニュースを投稿しました。',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
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
                    getPostsByCatId: function(page) {
                        if (typeof page === 'undefined') {
                            page = 1;
                        }
                        var cat_id = this.category_id_1;
                        let fd = new FormData();
                        fd.append("cat_id", cat_id);

                        this.axios
                        .post('/api/new/getPostsByCatId/page=' + page,fd)
                        .then(response => {
                            this.related_news = response.data;
                            if(this.related_news.length > this.size) {
                                this.pagination = true;
                            }else{
                                this.pagination = false;
                            }
                        });
                    },
                    getSearchPostsByCatId(page) {
                        if (typeof page === 'undefined') {
                            page = 1;
                        }
                        var cat_id = this.category_id_1;
                        
                        if(this.search_word == '') {
                            var search_word = this.search_word;
                        }  else {
                            var search_word = $('#search-word').val();
                        }

                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        fd.append("selected_category", cat_id);
                        this.axios.post("/api/news_list/search?page=" + page,fd).then(response => {
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
                            this.errors.title = "ニュースの題名は必須です。";
                        }
                        if (this.news.main_point) {
                            this.errors.main_point = "";
                        } else {
                            this.errors.main_point = "ニュースの内容要約は必須です。";
                        }
                        if (this.news.body) {
                            this.errors.body = "";
                        } else {
                            this.errors.body = "ニュースの内容は必須です。";
                        }
                        if (this.news.category_id) {
                            this.errors.category_id = "";
                        } else {
                            this.errors.category_id = "ニュースのカテゴリーは必須です。";
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
              
               event.target.src = "/images/noimage.jpg"
            },

            imgUrlAlt1(event) {
              
                this.noimage = 1;
                event.target.src = "/images/noimage.jpg"
            },

            
            
            }

            
            
    }



 
</script>

<style>
 .quill-editor{
          background-color: #fff;
  }
</style>
