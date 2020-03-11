<template>
    <div id="commentList">
        <!--card-->
        <div class="col-12 tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                    <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color mb-3">口コミ検索</h4>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <!-- <select  v-model="profileid" class="division form-control"  @change="getComment()">
                                <option value="0">選択してください。</option>
                                <option  id="search-item" v-for="pro in profilelist" :key="pro.id" v-bind:value="pro.id">
                                    {{pro.name}}
                                </option>
                            </select> -->
                            <label>事業者名 : </label>
                            <autocomplete id="cusname"  placeholder="事業者名を検索" input-class="form-control" :source=customerList :results-display="formattedDisplay" @clear="cleartext()"  @selected="getSelected($event)">
                            </autocomplete>
                        </div>
                        <div class="col-md-12">
                            <label>施設名 : </label>
                         
                            <select v-model="selectedValue" class="division form-control" @change="getComment()">
                                <option value="0">選択してください。</option>
                                <option v-for="profile in profileList" :key="profile.id" v-bind:value="profile.id">
                                    {{profile.name}}
                                </option>
                            </select>
                              
                        </div>
                    </div>
                    <hr />
                     <!-- <div class="form-group" >
                        Search with profile name
                        <select  v-model="profileid" class="division form-control"  @change="getComment()">
                                <option value="0">選択してください。</option>
                                <option  id="search-item" v-for="pro in profilelist" :key="pro.id" v-bind:value="pro.id">
                                    {{pro.name}}
                                </option>
                        </select>
                     </div> -->
                        
                    <h5 class="header">{{title}}</h5>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">検索したデータ見つかりません。</div>
                    <div v-else class="container-fuid">
                    <div class="card card-default m-b-20" v-for="comment in comments.data" :key="comment.id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <!-- <strong>タイトル :</strong> {{comment.title}}  <br/>
                                    <strong>顧客名 :</strong> {{comment.name}}  <br/>
                                    <strong>メールアドレス:</strong>{{comment.email}} -->
                                    <table class="commentlist_tbl">
                                        <tr>
                                            <td class="align-top custom_title font-weight-bold">タイトル :</td>
                                            <td> {{comment.title}}</td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="align-top custom_title">お名前 :</td>
                                            <td> {{comment.name}} </td>
                                        </tr> -->
                                         <tr>
                                            <td class="align-top custom_title font-weight-bold">事業者名 :</td>
                                            <td> {{comment.cus_name}} </td>
                                        </tr>
                                         <tr>
                                            <td class="align-top custom_title font-weight-bold">施設名 :</td>
                                            <td> {{comment.pro_name}} </td>
                                        </tr>
                                         
                                            <!-- <tr>
                                            <td class="align-top custom_title">メールアドレス: </td>
                                            <td> {{comment.email}} </td>
                                        </tr> -->
                                    </table>
                                    <div class="d-inline-block mt-3">
                                        <button class="btn text-danger delete-borderbtn" @click="deleteComment(comment.id)">削除</button>
                                        <span class="mt-2" style="color: #81ad3b;font-weight: bold;display:block;" v-if="comment.status != 0" ><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;確認済み</span>
                                        <button class="btn confirm-borderbtn" v-else @click="commentConfirm(comment.id)"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;新規口コミ承認</button>
                                        
                                    </div>
                                </div>

                                <div class="col-3 text-right">
                                    <!-- <button class="'btn btn all-btn main-bg-color changeLink'+payment.id" type="button" @click="commentToggle(comment.id)"><span  :id="'icon' + comment.id"  class="fas fa-sort-down animate rotate"></span></button> -->
                                    <button :class="'btn drop-bg-color changeLink'+comment.id" style="min-width: 65px;font-size:13px;" @click="commentToggle(comment.id)">
                                         詳細 <i :id="'icon' + comment.id" class="fas fa-sort-down animate rotate"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="collapse card-body" :id="'changeLink' + comment.id">
                            <div class="commentWrap">

                                <div class="d-flex ">
                                    <p class="comment-underline comment-title p-b-0">{{comment.name}} <span style="font-size:12px;color:#a7a2a2ee;">({{comment.email}})</span>  
                                     <p class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> {{comment.created_date | moment("YYYY年MM月DD日") }}投稿 <span class="ml-2"><i class="fa fa-clock" aria-hidden="true"></i> {{comment.created_time}}</span></p>

                                </div>
                          
                            </div> 
                              
                                <div name="exp[]" class="col-md-12 m-t-20"><p style="color:#736e6e;">{{comment.comment}}</p></div>
                                <!-- <div  class="col-md-12 m-t-20"><p style="color:#736e6e;">{{comment.email}}</p></div> -->
                                <div  class="col-md-12 m-t-20"><p style="color:#736e6e;">{{comment.year}}</p></div>
                                <div  class="col-md-12 m-t-20" v-if="comment.zipcode"><span class="text-orange"><span class="job_ico">★</span></span><p style="color:#736e6e;">{{comment.zipcode}}</p></div>
                              
                        </div>
                    </div>
                </div>
                <!-- <pagination :data="comments" @pagination-change-page="searchcomment"></pagination> -->
                <div>
                    <pagination :data="comments" @pagination-change-page="searchcomment" :limit="limitpc">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                    </pagination>
                </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
</template>

<script>

     import Autocomplete from 'vuejs-auto-complete'
    export default {
       
        components: {
            Autocomplete,
        },
    
         props:{
            limitpc: {
                type: Number,
                default: 5
            },
        },
        data() {
               return {
                    comments: [],
                    profileList:[],
                    norecord: 0,
                    items: [],
                    norecord_msg: false,
                    nosearch_msg: false,
                    title: '',
                    type:'',
                    profileid:'',
                    customerList:'',
                    cusid:'',
                    proid:'',
                    table_name: {
                        profile: ''
                    },
                    cusname:'',
                    selectedValue:0

                }

            },
            created() {
                this.selectedValue = 0;
                this.profileid = 0;
                this.$loading(true);
                if(this.$route.path == "/nuscommentlist"){
                     this.type = "nursing";
                    this.title = "口コミ一覧";
                    this.axios
                    .get('/api/comments/comment/3')
                    .then(response => {
                        this.$loading(false);
                        this.comments = response.data.commentlist;
                        
                        // this.profilelist = response.data.profilelist;
                        this.norecord = this.comments.data.length;                   
                        if(this.norecord != 0) {
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }
                    });
                }
                else if(this.$route.path == "/hoscommentlist"){
                     this.type = "hospital";
                    this.title = "口コミ一覧";
                    this.axios
                    .get('/api/comments/comment/2')
                    .then(response => {
                        this.$loading(false);
                        this.comments = response.data.commentlist;
                        // this.profilelist = response.data.profilelist;
                        this.norecord = this.comments.data.length;
                        if(this.norecord != 0) {
                            this.norecord_msg = false;
                        }else{
                            this.norecord_msg = true;
                        }
                    });
                }

                 this.axios.get('/api/job/customerList/'+this.type).then(response=> {
                    this.customerList = response.data;
                });
            },
            methods: {
              getComment()
                {

                    this.$loading(true);
                    if(this.$route.path == "/nuscommentlist"){ 
                        this.axios.get('/api/comments/getCustomComment/3/'+this.selectedValue).then(response => {
                            this.$loading(false);
                            this.comments = response.data;
                            if(this.comments.data.length == 0)
                            {
                                this.nosearch_msg = true;
                            }
                            else{
                                this.nosearch_msg = false;
                            }
                        });
                    }
                    else if(this.$route.path == "/hoscommentlist"){
                        this.axios.get('/api/comments/getCustomComment/2/'+this.selectedValue).then(response => {
                            this.$loading(false);
                                this.comments = response.data;
                                if(this.comments.data.length == 0)
                                {
                                    this.nosearch_msg = true;
                                }
                                else{
                                    this.nosearch_msg = false;
                                }
                                                    
                         });
                    }
                },
                cleartext(){
                
                    this.selectedValue = 0;
                    this.profileList = [];
                    this.getComment();

                },
                getSelected(event){
                  
                    if(this.type == "nursing"){
                        this.table_name.profile = 'nursing_profiles';
                    }else {
                        this.table_name.profile = 'hospital_profiles';
                    }

                    this.cusid = event.value;
                    this.axios.post(`/api/job/profileList/${this.cusid}`,this.table_name).then(response=> {
                    this.profileList = response.data;
                    this.selectedValue = 0;
                   
                });
                },
                deleteComment(id) {
                        this.$swal({
                            title: "確認",
                            text: "コメントを削除してよろしいでしょうか。",
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
                             if(this.$route.path == "/nuscommentlist"){
                                  this.type = "nursing";
                              }
                              else{
                                  this.type = "hospital"
                              }
                            this.axios
                                .delete(`/api/comments/delete/${id}`+'/'+this.type)
                                .then(response => {
                                    this.comments = response.data;
                                   this.norecord = this.comments.data.length;
                                    if(this.norecord > this.size){
                                        this.pagination = true;
                                    }else{
                                        this.pagination = false;
                                    }
                                    if(this.norecord != 0) {
                                        this.norecord_msg = false;
                                    }else{
                                        this.norecord_msg = true;
                                    }
                                    // let i = this.categories.map(item => item.id).indexOf(id); // find index of your object
                                    // this.categories.splice(i, 1);
                                    this.$swal({
                                        // title: "削除済",
                                        text: "コメントを削除しました。",
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
                    commentConfirm(id) {
                        this.$swal({
                            title: "確認",
                            text: "口コミを投稿してよろしいでしょうか。",
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
                            cancelButtonClass: "all-btn",
                            allowOutsideClick: false,
                        }).then(response => {
                            this.$loading(true);
                             if(this.$route.path == "/nuscommentlist"){
                                  this.type = "nursing";
                              }
                              else{
                                  this.type = "hospital"
                              }
                            this.axios.get(`/api/comments/confirm/${id}`+'/'+this.type)
                                .then(response => {
                                    this.$loading(false);
                                    this.comments = response.data.comments;
                                    this.$swal({
                                            title: "確認済",
                                            text: "口コミを投稿しました。",
                                            type: "success",
                                            width: 350,
                                            height: 200,
                                            confirmButtonText: "閉じる",
                                            confirmButtonColor: "#6cb2eb",
                                            allowOutsideClick: false,
                                        })
                                        .catch(() => {
                                            this.$swal({
                                                title: "エラーメッセージ",
                                                text: "プロセスを続行します",
                                                type: "error",
                                                width: 350,
                                                height: 200,
                                                confirmButtonText: "閉じる",
                                                confirmButtonColor: "#dc3545",
                                                allowOutsideClick: false,
                                            });
                                        });
                                })

                        });
                    },
                    searchcomment(page) {
                        if(this.$route.path == "/nuscommentlist"){
                            this.type = "nursing";
                        }
                        else
                        {  
                            this.type = "hospital"
                        }
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                               
                        var search_word = this.selectedValue;
                        let fd = new FormData();
                        fd.append("search_word", search_word);
                        fd.append("type",this.type);
                        this.$loading(true);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.axios.post("/api/comments/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.comments = response.data;
                            if(this.comments.data.length == 0){
                                this.nosearch_msg = true;
                            }else{
                                this.nosearch_msg = false;
                            }
                         });
                    },
                    commentToggle(id) {
                        var class_by_id = $('#icon' + id).attr('class');
                        if (class_by_id == "fas fa-sort-down animate rotate") {
                            $('#icon' + id).removeClass("fas fa-sort-down animate rotate");
                            $('.changeLink' + id).removeClass("fas fa-sort-down animate");
                            $('#icon' + id).addClass("fas fa-sort-down animate");
                            $('#changeLink' + id).show('medium');
                        } else {

                            $('#icon' + id).removeClass("fas fa-sort-down animate");
                            $('.changeLink' + id).removeClass("fas fa-sort-down animate");
                            $('#icon' + id).addClass("fas fa-sort-down animate rotate");
                            $('#changeLink' + id).hide('medium');
                        }

                    },
            }
    }
</script>
<style scoped>
    .comment-title {
    background-size: 29px;
    /* background :#b6b4b4; */
    color: #2980b9;
    display: block;
    font-size: 16px;
    font-weight: 700;
    padding-bottom: 10px;
}
.comment-date {
    margin-left: auto;
    font-size: 12px;
    color: #777;

}
</style>
