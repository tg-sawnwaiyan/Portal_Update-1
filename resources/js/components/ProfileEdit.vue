<template>
    <!--test-->
    <div class="row">
        <div class="col-md-12">
            <div class="card  text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-header header">プロファイル設定 <a v-if="$auth.check(2)" @click="$router.go(-1)" class="btn btn-danger all-btn submit float-right">戻る</a></h4>
                            <br>
                        </div>
                        <form class="col-md-8">
                            <div class="card card-default m-b-20 col-md-11">
                                <div class="card-body">
                                    <!-- <div class="header2"> -->
                                        <h5 class=" clearfix">事業者番号 <span style="color:orange;font-weight:bold">{{customer_info.cusnum}}</span></h5>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <!--card-->
                            <!-- <div class="card card-default m-b-20 col-md-11">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 m-t-8">
                                            <div class="header2">
                                                <h5 class=" clearfix">顧客ロゴ</h5>
                                            </div>
                                            <div class="form-group mg">
                                                <div>
                                                    <img :src="logo" id="thumbnil" class="profile_logo m-b-8" alt="Logo"  @error="imgUrlAlt" width="200px" >
                                                    <br>
                                                    <input type="file" name="" class="customer-logo m-b-10" id="customer-logo" @change="preview_image(this)">

                                                </div>
                                                <div class="">
                                                    <span class="btn main-bg-color white all-btn"  @click="profileChange()">
                                                        変更
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--card-->

                            <!--card-->
                            <div class="card card-default m-b-20 col-md-11">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 m-t-8">
                                            <div class="header2">
                                                <h5 class=" clearfix">パスワード設定</h5>
                                            </div>
                                            <div class="form-group">

                                                <label class="old-pass">現在のパスワード</label>
                                                <input type="password" name="old_password" v-model="old_password" placeholder="現在のパスワードを入力してください。" class="form-control old-password">
                                                <div class="error" id="oldpassword" style="display: none;">現在のパスワードが必要です。</div>
                                                <br>
                                                <label class="old-pass">新しいパスワード</label>
                                                <input type="password" name="new_password" placeholder="新しいパスワードを入力してください。" class="form-control new-password" v-model="password">
                                                <div class="error" id="newpassword" style="display: none;">新しいパスワードが必要です。</div>
                                                <div class="error" id="newpasswordlength" style="display: none;">パスワードは少なくとも6桁でなければなりません。</div>
                                                <br>
                                                <label class="old-pass">新しいパスワードをもう一度入力してください</label>
                                                <input type="password" name="comfirm_password" class="form-control confirm-password" placeholder="新しいパスワードをもう一度入力してください" v-model="password_confirmation" @keyup="password_validate()">
                                                <div class="error" id="confirmpassword" style="display: none;">新しいパスワードをもう一度入力が必要です。</div>
                                                <div class="col-md-12 pad-free">
                                                    <span v-if="errors.password" class="error">{{errors.password}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <span class="btn main-bg-color white all-btn"  @click="passwordChange()">変更</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--card-->
                            <!--card-->
                            <div class="card card-default m-b-20 col-md-11">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 m-t-8">
                                            <div class="header2">
                                                <h5 class=" clearfix">メール設定</h5>
                                            </div>
                                            <div class="form-group">
                                                <label class="email-address">メールアドレス</label>
                                                <input type="text" class="form-control email" v-model="customer_info.email">
                                            </div>
                                            <div class="form-group">
                                                <span class="btn main-bg-color white all-btn"  @click="emailChange()">
                                                変更
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-default m-b-20 col-md-11" >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 m-t-8">
                                            
                                            <div class="form-group" id="newcreate">
                                              
                                                <span v-if="customer_info.type_id == 2" class="btn main-bg-color white all-btn"  @click="Save()">
                                                    New Hospital Account Create
                                                </span>
                                                <span v-else class="btn main-bg-color white all-btn"  @click="Save()">
                                                    New Nursing Account Create
                                                </span>
                                            </div>
                                            <div id="nusNew">
                                                 <div class="form-group">
                                                    <label>Name </label>
                                                    <input type="text" class="form-control" v-model="nursing_data.name" placeholder="Enter  name...">
                                                    <span v-if="errors.name" class="error">{{errors.name}}</span>
                                                </div>
                                                <div class="form-group" >
                                                    <select v-model="nursing_data.city_id" class="division form-control"  @change="getTownship()">
                                                            <option value="0">選択してください。</option>
                                                            <option v-for="cities in city_list" :key="cities.id" v-bind:value="cities.id">
                                                                {{cities.city_name}}
                                                            </option>
                                                    </select>
                                                     <span v-if="errors.city" class="error">{{errors.city}}</span>
                                                </div>
                                                <div class="form-group" >
                                                    <select v-model="nursing_data.town_id" class="division form-control" @change="changeTownship()"  >
                                                            <option value="0">市区町村を選択してください。</option>
                                                            <option v-for="tw in town_list" :key="tw.id" v-bind:value="tw.id">
                                                                {{tw.township_name}}
                                                            </option>
                                                    </select>
                                                     <span v-if="errors.township" class="error">{{errors.township}}</span>
                                                </div>
                                                <div class="form-group">
                                                     <span  class="btn btn-danger"  style="margin-left:700px;" @click="CancelNew()">
                                                        Cancel
                                                    </span>
                                                    <span style="float:right" class="btn main-bg-color white all-btn"  @click="CreateNew()">
                                                        Create
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default m-b-20 col-md-11">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 m-t-8">
                                            <div class="header2">
                                                <h5 class=" clearfix" v-if="accout_status == '解除'">事業者登録を{{accout_status}}します。</h5>
                                                <h5 class=" clearfix" v-else>事業者登録を{{accout_status}}。</h5>
                                            </div>
                                            <div class="form-group">
                                                <!-- <button class="btn confirmed" v-if="customer_info.accout_status != 0" >{{accout_status}}</button>
                                                <button class="btn confirm-borderbtn" v-else @click="AccountStatusChange(customer_info.recordstatus)">{{accout_status}}</button> -->
                                                <span class="btn btn-danger"  v-if="customer_info.recordstatus ==1"  @click="AccountStatusChange(customer_info.recordstatus)">
                                                    {{accout_status}}
                                                </span>

                                                <span class="btn btn-success" v-if="customer_info.recordstatus ==0" @click="AccountStatusChange(customer_info.recordstatus)">
                                                    {{accout_status}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--card-->
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!--test-->
    </div>

</template>

<script>
    export default {
        data() {
                return {
                    customer_info: [],
                    type: this.$route.params.type,
                    logo: '',
                    cusid: this.$route.params.id,
                    upload_img: null,
                    image: '',
                    accout_status:'',
                    password: '',
                    password_confirmation: '',
                    old_password: '',
                   errors: {
                        password: "" ,
                        name:"",
                        city:'',
                        township:''
                    },
                    city_list:[],
                    town_list:[],
                    nursing_data:{
                        name:'',
                        city_id:'',
                        town_id:'',  
                    }
                }
            },
            created() {
                
                this.nursing_data.city_id = 0;
                this.nursing_data.town_id= 0;
                 this.axios.get('/api/hospital/citiesList')
                .then(response => {
                    this.city_list = response.data;
                  
                });
                this.axios
                    .get('/api/customerinfo/' + this.cusid)
                    .then(response => {
                        this.customer_info = response.data;
                        console.log(this.customer_info);
                        if(this.customer_info.recordstatus == '1') {
                            this.accout_status = '解除';
                        } else {
                            this.accout_status = '解除しない';
                        }
                        if (this.customer_info.type_id == '2') {
                            this.logo = '/upload/hospital_profile/' + response.data.logo;
                        } else {
                            this.logo = '/upload/nursing_profile/' + response.data.logo;
                        }
                    });
            },
            methods: {
                 Save(){
                    document.getElementById('newcreate').style.display = "none";
                    document.getElementById('nusNew').style.display = "block";
                },
                CreateNew(){
                    if(this.nursing_data.name != '' )
                    {
                        this.errors.name = "";
                    }
                    else{
                       this.errors.name = "Name is required";
                    }
                    if(this.nursing_data.city_id != 0 )
                    {
                        this.errors.city = "";
                    }
                    else{
                       this.errors.city = "都道府県は必須です";
                    }
                    if(this.nursing_data.town_id != 0)
                    {
                        this.errors.township = "";
            
                    }
                    else{
                         this.errors.township = "市区町村は必須です";
                    }
                    if(this.errors.city == ""  &&  this.errors.township == "" && this.errors.name == "")
                    {
                        this.axios.post(`/api/nursing/movelatlng/${this.cusid}`, this.nursing_data)
                                        .then((response) => {
                                            this.$swal({
                                            // title: "確認",
                                            text: "Success",
                                            type: "success",
                                            width: 350,
                                            height: 200,
                                            confirmButtonColor: "#6cb2eb",                       
                                            confirmButtonText: "作成",
                                            confirmButtonClass: "all-btn",
                                        
                                });

                            document.getElementById('newcreate').style.display = "block";
                            document.getElementById('nusNew').style.display = "none";
                            this.nursing_data.name = '';
                            this.nursing_data.town_id = 0;
                            this.nursing_data.city_id = 0;
                        });
                    }  
                },
                CancelNew(){
                     document.getElementById('newcreate').style.display = "block";
                     document.getElementById('nusNew').style.display = "none";
                     this.nursing_data.city_id = 0;
                     this.nursing_data.town_id = 0;
                     this.errors.city = '';
                     this.errors.township = '';
                },
                imgUrlAlt(event) {
                    event.target.src = "/images/noimage.jpg"
                },
                preview_image(fileInput) {
                        this.logo = URL.createObjectURL(event.target.files[0]);
                    },
                    profileChange() {
                        var file = document.getElementsByClassName('customer-logo')[0].files[0];
                        if (file) {
                            var file_name = file.name;
                            let fd = new FormData();
                            fd.append('file', file)
                            fd.append('photo', file_name)
                            this.axios.post('/api/user/movephoto', fd)
                                .then(response => {}).catch(error => {
                                    console.log(error);
                                    if (error.response.status == 422) {
                                        this.errors = error.response.data.errors
                                    }
                                })
                            let arr = new FormData();
                            arr.append('logo', file_name)
                            this.$swal({
                                title: "確認",
                                text: "お客様のロゴを変更しましたか？",
                                type: "info",
                                width: 350,
                                height: 200,
                                showCancelButton: true,
                                confirmButtonColor: "#6cb2eb",
                                cancelButtonColor: "#b1abab",
                                cancelButtonTextColor: "#000",
                                confirmButtonText: "作成",
                                cancelButtonText: "キャンセル",
                                confirmButtonClass: "all-btn",
                                cancelButtonClass: "all-btn"
                            }).then(response => {
                                this.axios
                                    .post(`/api/customer/update/${this.cusid}`, arr)
                                    .then((response) => {
                                        this.$swal({
                                                position: 'top-end',
                                                type: 'success',
                                                title: '更新されました。',
                                                confirmButtonText: "閉じる",
                                                confirmButtonColor: "#6cb2eb",
                                                width: 250,
                                                height: 200,
                                            })
                                            // alert('Logo is Successfully Updated!');
                                    }).catch(error => {

                                        if (error.response.status == 422) {
                                            this.errors = error.response.data.errors
                                        }
                                    });
                            });

                        }

                    },
                    passwordChange() {
                        if (this.old_password == '') {
                            $('#oldpassword').css('display', 'block');
                            return;
                        }
                        if (this.password == '') {
                            $('#newpassword').css('display', 'block');
                            return;
                        }
                        if (this.password.length < 6) {
                            $('#newpasswordlength').css('display', 'block');
                            return;
                        }
                        if (this.password_confirmation == '') {
                            $('#confirmpassword').css('display', 'block');
                            return;
                        }
                        if ("'" + this.password + "'" === "'" + this.password_confirmation + "'") {
                            let arr = new FormData();
                            arr.append('old_pass', this.old_password)
                            arr.append('new_pass', this.password)
                            arr.append('cus_id', this.cusid)
                            this.axios
                                .post(`/api/user/password-change`, arr)
                                .then((response) => {
                                    if (response.data == 'oldpasswordwrong') {
                                        this.$swal({
                                            position: 'top-end',
                                            type: 'error',
                                            title: '現在のパスワードが一致しません。',
                                            confirmButtonText: "閉じる",
                                            confirmButtonColor: "#6cb2eb",
                                            width: 250,
                                            height: 200,
                                        })
                                        // alert('Please Enter Correct Old Password!');
                                        return;
                                    }else{
                                        this.$swal({
                                            position: 'top-end',
                                            type: 'success',
                                            title: 'パスワードを変更しました',
                                            confirmButtonText: "閉じる",
                                            confirmButtonColor: "#6cb2eb",
                                            width: 250,
                                            height: 200,
                                        })
                                        this.password = null;
                                        this.password_confirmation = null;
                                        this.old_password = null;
                                    }
                                    // alert('Password is Successfully Changed!');
                                }).catch(error => {

                                    if (error.response.status == 422) {
                                        this.errors = error.response.data.errors
                                    }
                                });
                        } else {
                            this.$swal({
                                    title: "確認",
                                    text: "新しいパスワードと確認パスワードは同じでなければなりません。",
                                    type: "warning",
                                    width: 350,
                                    height: 200,
                                    showCancelButton: true,
                                    confirmButtonColor: "#6cb2eb",
                                    cancelButtonColor: "#b1abab",
                                    cancelButtonTextColor: "#000",
                                    confirmButtonText: "閉じる",
                                    // cancelButtonText: "キャンセル",
                                    confirmButtonClass: "all-btn",
                                    // cancelButtonClass: "all-btn"
                                })
                                // alert('New-Password And Confirm-Password must be same!')
                        }
                    },
                    emailChange(id) {
                        var email = $('.email').val();

                        let arr = new FormData();
                        arr.append('email', email)
                        arr.append('cus_id', this.cusid)

                        this.$swal({
                            title: "確認",
                            text: "メールアドレスを変更しますか。",
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
                            this.axios
                                .post(`/api/user/email-change`, arr)
                                .then(response => {
                                    this.name = ''
                                    this.$swal({
                                            position: 'top-end',
                                            type: 'success',
                                            title: 'メールが変更されました',
                                            confirmButtonText: "閉じる",
                                            confirmButtonColor: "#6cb2eb",
                                            width: 250,
                                            height: 200,
                                        })
                                        // alert('Email is Successfully Changed!');
                                }).catch(error => {

                                    if (error.response.status == 422) {
                                        this.errors = error.response.data.errors
                                    }
                                });
                        })
                    },
                     getTownship(){
                         this.errors.city = '';
                        this.nursing_data.town_id = 0;
                        this.axios.get('/api/auth/township',{
                        params:{
                            city:this.nursing_data.city_id
                        },
                        }).then((response)=>{
                            this.town_list = response.data.townships
                        })
                  },
                  changeTownship(){
                      this.errors.township = '';

                  },
                    AccountStatusChange(status) {
                        if(status == '1') {
                            var confirm_text = '事業者登録を解除しないですか。';
                        } else {
                            var confirm_text = '事業者登録を解除しますか。';
                        }
                        let fd = new FormData();
                            fd.append('status', status)
                            fd.append('cus_id',this.cusid)
                            // console.log('fd',cusid)
                        this.$swal({
                                title: "確認",
                                text: confirm_text,
                                type: "info",
                                width: 350,
                                height: 200,
                                showCancelButton: true,
                                confirmButtonColor: "#6cb2eb",
                                cancelButtonColor: "#b1abab",
                                cancelButtonTextColor: "#000",
                                confirmButtonText: "作成",
                                cancelButtonText: "キャンセル",
                                confirmButtonClass: "all-btn",
                                cancelButtonClass: "all-btn"
                            }).then(response => {
                                this.axios
                                    .post('api/customer/account_update', fd)
                                    .then((response) => {
                                        console.log(response);
                                        this.customer_info = response.data;
                                        this.$swal({
                                                position: 'top-end',
                                                type: 'success',
                                                title: '更新されました。',
                                                confirmButtonText: "閉じる",
                                                confirmButtonColor: "#6cb2eb",
                                                width: 250,
                                                height: 200,
                                            })
                                        if(this.customer_info.recordstatus == '1') {
                                            this.accout_status = '解除';
                                        } else {
                                            this.accout_status = '解除しない';
                                        }
                                        if (this.customer_info.type_id == '2') {
                                            this.logo = '/upload/hospital_profile/' + response.data.logo;
                                        } else {
                                            this.logo = '/upload/nursing_profile/' + response.data.logo;
                                        }

                                    }).catch(error => {

                                        if (error.response.status == 422) {
                                            this.errors = error.response.data.errors
                                        }
                                    });
                            });
                    },
                    password_validate() {
                        window.pwd_same = false;
                        var nursing_type_exist = false;
                        if(this.password != this.password_confirmation) {
                            this.errors.password = "※パスワードが一致しません。";
                        }
                        else {
                            this.errors.password = null;
                            window.pwd_same = true;
                        }
                    },
            }
    }
</script>
