<template>
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
                                        <span v-if="errors.name" class="error">{{errors.name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>メールアドレス :<span class="error">*</span></label>
                                        <input type="text" class="form-control" v-model="adminData.email" placeholder="メールアドレスを入力してください。">
                                        <span v-if="errors.email" class="error">{{errors.email}}</span>
                                    </div>
                                    <div class="form-group" v-if="!show">
                                        <label>パスワード :<span class="error">*</span></label>
                                        <input type="password" class="form-control" v-model="adminData.password" placeholder="パスワードを入力してください。">
                                        <span v-if="errors.password" class="error">{{errors.password}}</span>
                                        <div class="error" id="newpasswordlength" style="display: none;">パスワードは少なくとも6桁でなければなりません。</div>
                                    </div>
                                        <div class="form-group" v-if="show">
                                            <label class="old-pass">現在のパスワード:<span class="error">*</span></label>
                                            <input type="password" name="old_password" placeholder="現在のパスワードを入力してください。" v-model="old_password" class="form-control old-password">
                                            <span v-if="errors.old_password" class="error">{{errors.old_password}}</span>
                                            <br>
                                            <label class="old-pass">新しいパスワード:<span class="error">*</span></label>
                                            <input type="password" name="new_password" placeholder="新しいパスワードを入力してください。" v-model="new_password" class="form-control new-password">
                                            <span v-if="errors.new_password" class="error">{{errors.new_password}}</span>
                                            <div class="error" id="newpasswordlength" style="display: none;">パスワードは少なくとも6桁でなければなりません。</div>
                                            <br>
                                            <label class="old-pass">新しいパスワードをもう一度入力してください<span class="error">*</span></label>
                                            <input type="password" name="comfirm_password" class="form-control confirm-password" v-model="confirm_password" placeholder="新しいパスワードをもう一度入力してください" @keyup="password_validate()">
                                            <span v-if="errors.old_password" class="error">{{errors.confirm_password}}</span>
                                            <div class="col-md-12 pad-free">
                                                <span v-if="errors.edit_password" class="error">{{errors.edit_password}}</span>
                                            </div>
                                            <br>
                                        </div>
                                    <div class="form-group ">
                                        <span class="btn main-bg-color white all-btn" @click="checkValidate()">{{subtitle}}</span>
                                        <router-link class="btn btn-danger all-btn" to="t_is_admin_register"> キャンセル </router-link>
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
                    header: '管理者新規作成',
                    subtitle: '作成',
                    adminData: {
                        name: '',
                        email: '',
                        password: '',
                        old_password: '',
                        new_password: '',
                        confirm_password: '',
                    },
                    errors: {
                        name: '',
                        email: '',
                        password: '',
                        edit_password: '',
                        old_password: '',
                        new_password: '',
                        confirm_password: '',
                    },
                    show: false,
                  
                    old_password: '',
                    new_password: '',
                    confirm_password: '',
                    admin_id: this.$route.params.id,
                }
            },
            created() {
                if(this.$route.params.id){
                    this.show = true;
                  this.axios
                    .get(`/api/main_admin/edit/${this.$route.params.id}`)
                    .then((response) => {

                    this.adminData= response.data;
                      this.header = ' 管理者編集';
                        this.subtitle = '保存';
                        return this.header;
                        return this.subtitle;

                });
              }else {
                  this.show = false;
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
                        if (this.old_password) {
                            this.errors.old_password = "";
                        }else{
                            this.errors.old_password = "現在のパスワードが必須です。"
                        }
                        if (this.new_password) {
                            this.errors.new_password = "";
                        }else{
                            this.errors.new_password = "新しいパスワードが必須です。"
                        }
                        if (this.confirm_password) {
                            this.errors.confirm_password = "";
                        }else{
                            this.errors.confirm_password = "新しいパスワードをもう一度入力が必要です。"
                        }
                        if (!this.errors.name && !this.errors.email && (!(this.errors.password) || !(this.errors.old_password && this.errors.new_password && this.errors.confirm_password))) {
                            this.add();
                        }
                        

                    },
                    add() {
                        if (`${this.$route.params.id}` == "undefined") {
                            if (this.adminData.password.length < 6) {
                            $('#newpasswordlength').css('display', 'block');
                            return;
                        }
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
                                    this.$loading(true);
                                    this.axios.post('/api/main_admin/add', this.adminData)
                                        .then(response => {
                                            this.$loading(false);
                                            this.name = ''
                                            console.log(response);
                                            this.$swal({
                                                    position: 'top-end',
                                                    type: 'success',
                                                    text: '管理者を作成しました。',
                                                    confirmButtonText: "閉じる",
                                                    confirmButtonColor: "#6cb2eb",
                                                    width: 250,
                                                    height: 200,
                                                })
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
                        if (this.new_password.length < 6) {
                            $('#newpasswordlength').css('display', 'block');
                            return;
                        }
                        if ("'" + this.new_password + "'" === "'" + this.confirm_password + "'") {
                            let arr = new FormData();
                            arr.append('admin_id', this.admin_id)
                            arr.append('name',this.adminData.name)
                            arr.append('email',this.adminData.email)
                            arr.append('old_pass', this.old_password)
                            arr.append('new_pass', this.new_password)
                            this.axios
                                .post(`/api/main_admin/update`, arr)
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
                                        return;
                                    }else{
                                        this.$swal({
                                            position: 'top-end',
                                            type: 'success',
                                            title: '管理者を更新しました',
                                            confirmButtonText: "閉じる",
                                            confirmButtonColor: "#6cb2eb",
                                            width: 250,
                                            height: 200,
                                        })
                                        this.password_confirmation = null;
                                        this.old_password = null;
                                        this.$router.push({
                                                name: 'adminlist'
                                            });
                                    }
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
                                    confirmButtonClass: "all-btn",
                                })
                        }
           
             }) ;
        },
        password_validate() {
                        window.pwd_same = false;
                        if(this.new_password != this.confirm_password) {
                            this.errors.edit_password = "※パスワードが一致しません。";
                        }
                        else {
                            this.errors.edit_password = null;
                            window.pwd_same = true;
                        }
                    },
    }
}
</script>