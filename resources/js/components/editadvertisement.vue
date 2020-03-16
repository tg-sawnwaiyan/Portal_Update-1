<template>
     <div id="ads_post">
      
          <div class="card">
              <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-header header">{{header}}</h4>
                            <br>
                        </div>
                        <div class="col-md-12">
                             <form @submit.prevent="updateAds">
                            <div class="form-group">
                                                <label>広告タイトル <span class="error sp2">必須</span></label>
                                                <input type="title" class="form-control box" id="title"  name="title" v-model="advertisement.title" placeholder="広告タイトルを入力してください。">
                                                <span v-if="errors.title" class="error">{{errors.title}}</span>
                                    </div>
                            <div class="form-group">
                                            <label>説明  <span class="error"></span></label>
                                            <textarea name="description" class="form-control" cols="50" rows="5" v-model="advertisement.description"></textarea>
                                    </div>
                            <div class="form-group">
                                <label>広告リンク  <span class="error"></span></label>
                                <input type="link" class="form-control box" id="link"  name="link" v-model="advertisement.link" placeholder="広告リンクを入力してください。">
                            </div>
                            <!-- <div class="form-group">
                                     <label>表示するロケーション : <span class="error">*</span></label><br/>
                                <div class="col-sm-9" v-for="advertisements in advertisement.location" :key="advertisements.id">
                                    <label class="form-check-label control control--checkbox">
                                        <input type = "checkbox" value ="topbar" id="tbar" name="top_bar" v-model="advertisements.topbars"> <strong>トップバー </strong> (240px*120px 300円)
                                        <div class="control__indicator"></div>
                                        </label><br/>
                                    <label class="form-check-label control control--checkbox">
                                        <input type = "checkbox"  value ="sidebar" id="sbar" name="side_bar" v-model="advertisements.sidebars" ><strong> サイドバー </strong>(167px*100px 200円)
                                        <div class="control__indicator"></div>
                                    </label>
                                
                                </div>
                            </div> -->
                            <div class="form-group" id="showimage">
                                <label>写真 <span class="error sp2">必須</span></label><br/>
                                <div class="d-flex align-items-center">
                                    <span class="btn-file d-inline-block">画像を選択        
                                        <input type="file" v-if="!showhide" ref="file" accept="image/*" id="upd_img" @change ="fileSelected">
                                        <input type="file" v-if="showhide" id="upload" accept="image/*" @change="uploadImage"> 
                                    </span> 
                                    <span class="pl-4 text-wrap w-75">{{img_name}}</span>
                                </div>
                                <span v-if="errors.photo" class="error">{{errors.photo}}</span>
                                 <div class="col-md-12" id="par">
                                        <div class="row image_preview"></div>
                                    </div>
                            </div>
                            <div class="image_show" v-if="update_img && upload_img">
                                <div class='col-md-2'>
                                 
                                    <img :src="upload_img" class='show-img' @error="imgUrlAlt">
                                </div>

                            </div>

                            <div class="form-group image_update" v-if="!update_img" id="x-image" >
                                <div class="row" >
                                    <div v-if="!showhide" id='x-image' class='col-md-4 col-6'>
                                        <span class='img-close-btn' v-on:click='closeBtnMethod(advertisement.photo)'>X</span>
                                        <img :src="'/upload/advertisement/'+ advertisement.photo"  class='show-img' alt="ads" @error="imgUrlAlt">
                                
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" v-model="old_photo" >
                            <div class="form-group">
                                <router-link to="/ads" class="btn bt-red all-btn">キャンセル</router-link>
                                <span class="btn main-bg-color white all-btn" @click="clickValidation()" >保存</span>
                            </div>
                                </form>
                            </div>
                         </div>
                    </div>
            </div>
          </div>
      
</template>
<script>
export default {
          data() {
            return {
                errors: {
                    title:"",
                    location:"",
                    photo:""
                },
                advertisement: {
                    title: '',
                    description:'',
                    link:'',
                    // location : [{
                    //     topbars: false,
                    //     sidebars:false
                    // }],
                    location:'',
                    photo:'',
                },
                ischeck:'',
                old_photo: "",
                upload_img:'',
                update_img: false,
                showhide:false,
                header : '',
                img_name : ''
            }
        },
        created() {
            if(this.$route.name == "editadvertisement"){
                 this.showhide = false;
                 this.axios
                .get(`/api/advertisement/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.advertisement.title = response.data.title;
                    this.advertisement.description = response.data.description;
                    this.advertisement.link = response.data.link;
                    this.advertisement.location = "topbar";
                    // this.ischeck = response.data.location;
                    // this.updateCheck(this.ischeck);
                    this.advertisement.photo=response.data.photo;
                });
                this.header = '広告編集';
            }
            else{
                this.showhide = true;
                this.advertisement.title = '';
                this.advertisement.description = '';
                this.advertisement.link = '';
                this.ischeck = '';
                this.advertisement.photo='';     
                this.header = '広告新規作成';
            }
           
        },
         methods: {
            imgUrlAlt(event) {
                event.target.src = "/images/noimage.jpg"
            },
            fileSelected(){
            
                this.advertisement.photo = event.target.files[0];
                this.upload_img = URL.createObjectURL(event.target.files[0]);
                this.update_img = true;
                const file =event.target.files[0];
                this.img_name = file.name;
            },

            closeBtnMethod: function(old_photo) {
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
                    cancelButtonClass: "all-btn",
                    allowOutsideClick: false,
                }).then(response => {
                        this.$swal({
                                text: "画像を削除しました。",
                                type: "success",
                                width: 350,
                                height: 200,
                                confirmButtonText: "閉じる",
                                confirmButtonColor: "#dc3545",
                                allowOutsideClick: false,
                            });
                    }).then(response => {
                        this.img_name = '';
                        this.update_img = true;
                        this.advertisement.photo = '';
                        if(this.advertisement.photo){
                            var image_x = document.getElementById('x-image');
                            image_x.parentNode.removeChild(image_x);
                        }
                }); 
            },
            // updateCheck: function (check){
            //     this.advertisement.location.shift()
            //    if(check == "topbar"){
            //      this.advertisement.location.push({
            //         topbars: 1,
            //         sidebars:0
            //     });
            //    }
            //    else if(check == "sidebar"){
            //         this.advertisement.location.push({
            //             topbars: 0,
            //             sidebars:1
            //         });
            //    }
            //    else{
            //         this.advertisement.location.push({
            //             topbars: 1,
            //             sidebars:1
            //         });
            //     }
            // },
            uploadImage() {
                
                $('.image_preview').html("<div class='col-md-2'><img src='" + URL.createObjectURL(event.target.files[0]) + "' class='show-img'></div>");
                this.advertisement.photo = event.target.files[0];
                const file =event.target.files[0];
                this.img_name = file.name;
            },

            updateAds() {
               
                    this.$swal({
                        title: "確認",
                        text: "広告を更新してよろしいでしょうか",
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
                        this.errors = [];
                        let adsData = new FormData();
                        this.advertisement.location = "topbar";
                        // for(var i=0;i<arr.length;i++)
                        // {
                        //     if(arr[i]['topbars'] == 1 && arr[i]['sidebars'] == 0)
                        //     {
                        //         adsData.append('location', 'topbar');
                        //     }
                        //     else if(arr[i]['sidebars'] == 1 && arr[i]['topbars'] == 0)
                        //     {
                        //         adsData.append('location', 'sidebar');
                        //     }
                        //     else if(arr[i]['sidebars'] == 1 && arr[i]['topbars'] == 1)
                        //     {
                        //         adsData.append('location', 'sidebar,topbar');
                        //     }
                        // }
                        adsData.append('location',this.advertisement.location)
                        adsData.append('title',this.advertisement.title)
                        adsData.append('description',this.advertisement.description)
                        adsData.append('link',this.advertisement.link)
                        adsData.append('photo',this.advertisement.photo)
                        adsData.append('old_photo',this.old_photo)
                      
                        this.$loading(true);
                        this.axios.post(`/api/advertisement/update/${this.$route.params.id}`, adsData)
                        .then((response) => {
                            this.$loading(false);
                           
                            this.$swal({
                                position: 'top-end',
                                type: 'success',
                                title: '広告を更新しました。',                             
                                confirmButtonText: "閉じる",
                                confirmButtonColor: "#6cb2eb",
                                width: 250,
                                height: 200,
                                allowOutsideClick: false,
                            })
                            this.$router.push({name: 'ads'});
                        }).catch(error=>{
                        if(error.response.status == 422){
                            this.errors = error.response.data.errors
                        }
                    })
                });
             

            },
              add() {
                  this.advertisement.location = "topbar";
                  this.$swal({
                            title: "確認",
                            text: "広告を投稿してよろしいでしょうか。",
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
                             let adsData = new FormData();
                            adsData.append('title', this.advertisement.title)
                            adsData.append('description', this.advertisement.description)
                            adsData.append('link', this.advertisement.link)
                            adsData.append('location', this.advertisement.location)
                            adsData.append('photo', this.advertisement.photo)
                            this.$loading(true);
                        this.axios.post('/api/advertisement/add', adsData)
                              .then((response) => {
                        this.$loading(false);
                       
                        this.$swal({
                            position: 'top-end',
                            type: 'success',
                            // title:'確認済',
                            text: '広告を投稿しました。',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 250,
                            height: 200,
                            allowOutsideClick: false,
                        })
                        this.$router.push({
                            name: 'ads'
                        });
                    }).catch(error => {

                        if (error.response.status == 422) {

                            this.errors = error.response.data.errors

                        }
                         });
               
                    })
            },

            clickValidation() {
                if (this.advertisement.title) 
                {
                    this.errors.title = "";
                } else 
                {
                    this.errors.title = " 題名は必須です。";
                }
            
                if(this.advertisement.photo)
                {
                    this.errors.photo = "";     
                } else 
                {    
                    this.errors.photo = "写真は必須です。";
                }

                if(!this.errors.title && !this.errors.photo && this.$route.params.id)
                {
                this.updateAds();
                }
                else if(!this.errors.title && !this.errors.photo && !this.$route.params.id){
                    this.add();
                }
            }

        }
}
</script>
