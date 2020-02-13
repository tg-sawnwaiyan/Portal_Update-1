<template>
    <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
            <div class="user_card">           
                <div class="d-flex justify-content-center">
                <div class="brand_logo_container logo_bk">
                    <img src="/images/login.png" class="brand_logo" alt="logo">
                </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="row width">
                        <div class="col-12 m-t-50">               
                            <form autocomplete="off" @submit.prevent="resetPass" method="post" v-if="!has_success">
                                <div class="mb-3">
                                <div class="input-group ">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control input_user" id="password" @keyup="password_validate()" name="password" value="" v-model="password"  autofocus placeholder="新しいパスワード">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                    
                                </div>
                                 <span v-if="errors.password" class="error"><small>{{errors.password}}</small></span>
                                </div>
                                <div class="mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control input_user" id="confirm_pass" @keyup="password_validate()" name="confirm_pass" value="" v-model="confirm_pass"  autofocus placeholder="もう一度入力してください。">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                    
                                </div>
                                 <span v-if="errors.confirmPassword" class="error"><small>{{errors.confirmPassword}}</small></span>
                                </div>
                               
                                
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" name="button" id="changePass" class="btn login_btn" :disabled="is_disabled">変更</button>
                                </div>

                                <div class="d-flex justify-content-center mt-3" v-if="has_error">
                                    <p class="alert alert-danger col-12" style="text-align:center" v-if="has_error">{{error_text}}</p>
                                </div>

                               
                            </form>                            
                            
                            <div class="col-12" v-if="has_success">
                                <p class="alert alert-success col-12" style="text-align:center;font-size:1.2em;">
                                    Password Reset Successful.
                                </p>
                                <p class="alert alert-success col-12" style="text-align:center;">
                                    Youn can <router-link to="/login" class="col-12" style="font-weight:bold;font-size:1.2em;">ログイン</router-link> Now.
                                </p>                         
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
        password: null,
        confirm_pass: null,
        has_error: false,
        has_success: false,
        is_disabled: false,
        errors:{
            password:'',
            confirmPassword:''
        }
      }
    },
    mounted() {
      //
    },
    created() {
        console.log(this.$route.query.code)
    },
    methods: {
        resetPass() {
            if(this.password == '' || this.password == null)
            {
                this.errors.password = "パスワードが必須です。";
            }
            else{
                this.errors.password = '';
            }
             if(this.confirm_pass == '' || this.confirm_pass == null)
            {
                this.errors.confirmPassword = "パスワードが必須です。";
            }
            else{
                this.errors.confirmPassword = '';
            }
            if(this.password.length < 6 || this.confirm_pass.length < 6)
            {
                this.has_error = true;
                this.error_text = "Password must be greater than 6 ";
            }
            else{
                this.error_text = '';
            }

            if(this.errors.password == '' && this.errors.confirmPassword == '' && this.error_text == '')
            {
                      // get the redirect object
                    var fData = new FormData();
                    fData.append('password', this.password);
                    fData.append('token', this.$route.query.code);
                    this.axios.post('/api/resetpassword',fData) 
                    .then(response => {
                        console.log(response)
                        if(response.data == "success"){
                            this.has_success = true;
                        }
                        else{
                            this.has_error = true;
                            this.error_text = "Token Expired. Send Mail again.";
                            this.is_disabled = true;
                            $("#changePass").css('cursor','not-allowed')
                        }
                    })
            }
            
        },
        password_validate() {
             if(this.password == '' || this.password == null)
            {
                this.errors.password = "パスワードが必須です。";
            }
            else{
                this.errors.password = '';
            }
             if(this.confirm_pass == '' || this.confirm_pass == null)
            {
                this.errors.confirmPassword = "パスワードが必須です。";
            }
            else{
                this.errors.confirmPassword = '';
            }
            if(($('#password').val() != $('#confirm_pass').val()) ) {
                console.log('a');
                this.has_error = true;
                this.error_text = "※パスワードが一致しません。 ";
                this.is_disabled = true;
                $("#changePass").css('cursor','not-allowed')
            }
            else {
                  console.log('b');
                this.has_error = false;
                this.is_disabled = false;
                $("#changePass").css('cursor','pointer')
            }
        },
    }
  }
</script>
<style scoped>
.d-flex .alert-danger{
    width:90%;
    top:200px;
}
</style>