<template>
    <div class="row">
        <div class="col-12">
            <div class="loginwrapper">
                <div class="d-flex justify-content-center h-100">
                    <div class="admin_card admin_registercard">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="page-header header">{{ header }}</h4>
                            </div>
                            <div class="col-md-12">
                                <form @submit.prevent="add">
                                    <div class="form-group">
                                        <label>管理者名 :<span class="error">*</span></label>
                                        <input type="text" class="form-control" v-model="adminData.name" placeholder="管理者名を入力してください。">
                                        <!-- <span v-if="errors.name" class="error">{{errors.name}}</span> -->
                                    </div>
                                    <div class="form-group">
                                        <label>メールアドレス :<span class="error">*</span></label>
                                        <input type="text" class="form-control" v-model="adminData.email" placeholder="メールアドレスを入力してください。">
                                    </div>
                                    <div class="form-group">
                                        <label>パスワード :<span class="error">*</span></label>
                                        <input type="password" class="form-control" v-model="adminData.password" placeholder="パスワードを入力してください。">
                                    </div>
                                    <br/>
                                    <div class="form-group ">
                                        <span class="btn main-bg-color white all-btn" @click="checkValidate()">{{subtitle}}</span>
                                        <router-link class="btn btn-danger all-btn" to="/occupationlist"> キャンセル </router-link>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    header: '管理者新規作成',
                    subtitle: '作成',
                    adminData: {
                        name: '',
                        email: '',
                        password: ''
                    },
                    errors: {
                        name: '',
                        email: '',
                        password: ''
                    }
                }
            },
            created() {
                if(this.$route.params.id){
                  this.axios
                    .get(`/api/admin/edit/${this.$route.params.id}`)
                    .then((response) => {

                    this.adminData= response.data;
                    console.log('admindatea',this.adminData)
                    console.log('fff',this.$route.params.id)
                    // if(this.feature.type == 'hospital')
                    // {
                    //     this.feature.type = 'hospital';
                    // }
                    // else if (this.feature.type == '介護') {
                    //     this.feature.type = '介護';
                    // }
                      this.header = ' 管理者編集';
                        this.subtitle = '保存';
                        return this.header;
                        return this.subtitle;

                });
              }
            },
            methods: {
                checkValidate() {
                        if (this.adminData.name) {
                            this.errors.name = "";
                        } else {
                            this.errors.name = "管理者名が必須です。";
                        }
                        if (this.adminData.email) {
                            this.errors.email = "";
                        } else {
                            this.errors.email = "メールアドレスが必須です。";
                        }
                        if (this.adminData.password) {
                            this.errors.password = "";
                        } else {
                            this.errors.password = "パスワードが必須です。";
                        }
                        if (!this.errors.name && !this.errors.email && !this.errors.password) {
                            this.add();
                        }
                    },
                    add() {
                        if (`${this.$route.params.id}` == "undefined") {
                            {
                                this.$swal({
                                    title: "確認",
                                    text: "管理者を作成してよろしいでしょうか。",
                                    type: "success",
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
                                    // this.$loading(true);
                                    this.axios.post('/api/admin/add', this.adminData)
                                        .then(response => {
                                            // this.$loading(false);
                                            this.name = ''
                                            console.log(response);
                                            this.$swal({
                                                    position: 'top-end',
                                                    type: 'success',
                                                    // title:'確認済',
                                                    text: '管理者を作成しました。',
                                                    confirmButtonText: "閉じる",
                                                    confirmButtonColor: "#6cb2eb",
                                                    // showConfirmButton: false,
                                                    // timer: 1800,
                                                    width: 250,
                                                    height: 200,
                                                })
                                                // alert('Successfully Created')
                                            this.$router.push({
                                                name: 'adminlist'
                                            });
                                        }).catch(error => {

                                            if (error.response.status == 422) {

                                                this.errors = error.response.data.errors

                                            }
                                        })
                                })

                            }
                        }else {
                            this.updateAdmin();
                        }
                    },
                    updateAdmin (){
                        this.$swal({
                            title: "確認",
                            text: "管理者を更新してよろしいでしょうか。",
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
                            // this.$loading(true);
                            this.axios.post(`/api/admin/update/${this.$route.params.id}`, this.adminData)
                .then((response) => {
                    // this.$loading(false);               
                    this.$swal({
                            position: 'top-end',
                            type: 'success',
                            text: '管理者を更新しました。',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 250,
                            height: 200,
                        })
                    // this.$router.push({name: 'featurelist'});
                    this.$router.go(-1);
                }).catch(error=>{
                    console.log(error)
                if(error.response.status == 422){

                    this.errors = error.response.data.errors

                }
                         });
           
             }) ;
                    }
            }
    }
</script>